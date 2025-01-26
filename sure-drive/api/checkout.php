<?php
require_once '../assets/class/Session.php';
require_once '../assets/class/Database.php';
require_once '../assets/class/helper/Encoder.php';

Session::start();
$database = Database::getInstance();
$data = Encoder::fromJSON(file_get_contents('php://input'));
$buyerID = Session::getSessionVar('user_id');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buyer related data.
    $data['user_id'] = $buyerID;
    $data['buyer'] = Session::getSessionVar('username');

    $buyerFundsSpent = $database->getValueForUserType('funds_spent', 'buyer', $buyerID);
    $buyerFundsSpent += (float) $data['total_price'];
    $database->updateValueForUserType('funds_spent', 'buyer', $buyerFundsSpent, $buyerID);

    $carsBought = $database->getValueForUserType('cars_bought', 'buyer', $buyerID);
    $database->updateValueForUserType('cars_bought', 'buyer', ++$carsBought, $buyerID);

    // Seller related data.
    $sellerID = $data['seller_id'];
    [$seller] = $database->getUserTypeData('user', $sellerID);
    $data['seller'] = $seller['username'];

    [$commission] = $database->getUserTypeData('seller', $sellerID);
    $data['commission'] = $commission['commission'];

    $sellerFundsMade = (float) $database->getValueForUserType('funds_made', 'seller', $sellerID);
    $sellerFundsMade += (float) $data['final_price'] * ((float) $commission['commission'] / 100);
    $database->updateValueForUserType('funds_made', 'seller', $sellerFundsMade, $sellerID);

    $carsSold = (int) $database->getValueForUserType('cars_sold', 'seller', $sellerID);
    $database->updateValueForUserType('cars_sold', 'seller', ++$carsSold, $sellerID);

    // Owner related data.
    $ownerID = $data['owner_id'];
    [$owner] = $database->getUserTypeData('user', $ownerID);
    $data['owner'] = $owner['username'];

    $ownerFundsMade = (float) $database->getValueForUserType('funds_made', 'owner', $ownerID);
    $ownerFundsMade += (float) $data['final_price'] - $sellerFundsMade;
    $database->updateValueForUserType('funds_made', 'owner', $ownerFundsMade, $ownerID);

    $carsOwned = $database->getValueForUserType('cars_owned', 'owner', $ownerID);
    $database->updateValueForUserType('cars_owned', 'owner', ++$carsOwned, $ownerID);

    // Insert new sale.
    $database->insertNewSale($data);
    $saleID = $database->getLastAddedItemID('sale')['id'];
    $data['sale_id'] = $saleID;

    // Insert new shipment.
    $database->insertNewShipment($data);

    // Deleting the purchased car.
    $database->deleteItem('car', $data['car_id']);

    // Save the purchased car for the buyer.
    $database->insertNewBoughtCar($data);
}
