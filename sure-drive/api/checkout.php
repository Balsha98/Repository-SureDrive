<?php
require_once '../assets/classes/Session.php';
require_once '../assets/classes/Database.php';
require_once '../assets/classes/helpers/Encoder.php';

Session::start();
$database = Database::getInstance();
$data = Encoder::fromJSON(file_get_contents('php://input'));
$buyerID = Session::getSessionVar('user_id');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buyer related data.
    $data['user_id'] = $buyerID;
    $data['buyer'] = Session::getSessionVar('username');

    $buyerFundsSpent = $database->getValueForUserType('funds_spent', 'buyers', $buyerID);
    $buyerFundsSpent += (float) $data['total_price'];
    $database->updateValueForUserType('funds_spent', 'buyers', $buyerFundsSpent, $buyerID);

    $carsBought = $database->getValueForUserType('cars_bought', 'buyers', $buyerID);
    $database->updateValueForUserType('cars_bought', 'buyers', ++$carsBought, $buyerID);

    // Seller related data.
    $sellerID = $data['seller_id'];
    [$seller] = $database->getUserTypeData('users', $sellerID);
    $data['seller'] = $seller['username'];

    [$commission] = $database->getUserTypeData('sellers', $sellerID);
    $data['commission'] = $commission['commission'];

    $sellerFundsMade = (float) $database->getValueForUserType('funds_made', 'sellers', $sellerID);
    $sellerFundsMade += (float) $data['final_price'] * ((float) $commission['commission'] / 100);
    $database->updateValueForUserType('funds_made', 'sellers', $sellerFundsMade, $sellerID);

    $carsSold = (int) $database->getValueForUserType('cars_sold', 'sellers', $sellerID);
    $database->updateValueForUserType('cars_sold', 'sellers', ++$carsSold, $sellerID);

    // Owner related data.
    $ownerID = $data['owner_id'];
    [$owner] = $database->getUserTypeData('users', $ownerID);
    $data['owner'] = $owner['username'];

    $ownerFundsMade = (float) $database->getValueForUserType('funds_made', 'owners', $ownerID);
    $ownerFundsMade += (float) $data['final_price'] - $sellerFundsMade;
    $database->updateValueForUserType('funds_made', 'owners', $ownerFundsMade, $ownerID);

    $carsOwned = $database->getValueForUserType('cars_owned', 'owners', $ownerID);
    $database->updateValueForUserType('cars_owned', 'owners', ++$carsOwned, $ownerID);

    // Insert new sale.
    $database->insertNewSale($data);
    $saleID = $database->getLastAddedItemID('sales')['id'];
    $data['sale_id'] = $saleID;

    // Insert new shipment.
    $database->insertNewShipment($data);

    // Deleting the purchased car.
    $database->deleteItem('cars', $data['car_id']);

    // Save the purchased car for the buyer.
    $database->insertNewBoughtCar($data);
}
