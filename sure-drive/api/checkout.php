<?php
require_once '../assets/models/Session.php';
require_once '../assets/models/Database.php';
require_once '../assets/helpers/Encoder.php';

Session::start_session();
$database = Database::get_instance();
$data = Encoder::from_json(file_get_contents('php://input'));
$buyer_id = Session::get_session_var('user_id');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buyer related data.
    $data['user_id'] = $buyer_id;
    $data['buyer'] = Session::get_session_var('username');

    $buyer_funds_spent = $database->get_value_for_user_type('funds_spent', 'buyer', $buyer_id);
    $buyer_funds_spent += (float) $data['total_price'];
    $database->update_value_for_user_type('funds_spent', 'buyer', $buyer_funds_spent, $buyer_id);

    $cars_bought = $database->get_value_for_user_type('cars_bought', 'buyer', $buyer_id);
    $database->update_value_for_user_type('cars_bought', 'buyer', ++$cars_bought, $buyer_id);

    // Seller related data.
    $seller_id = $data['seller_id'];
    [$seller] = $database->get_user_type_data('user', $seller_id);
    $data['seller'] = $seller['username'];

    [$commission] = $database->get_user_type_data('seller', $seller_id);
    $data['commission'] = $commission['commission'];

    $seller_funds_made = (float) $database->get_value_for_user_type('funds_made', 'seller', $seller_id);
    $seller_funds_made += (float) $data['final_price'] * ((float) $commission['commission'] / 100);
    $database->update_value_for_user_type('funds_made', 'seller', $seller_funds_made, $seller_id);

    $cars_sold = (int) $database->get_value_for_user_type('cars_sold', 'seller', $seller_id);
    $database->update_value_for_user_type('cars_sold', 'seller', ++$cars_sold, $seller_id);

    // Owner related data.
    $owner_id = $data['owner_id'];
    [$owner] = $database->get_user_type_data('user', $owner_id);
    $data['owner'] = $owner['username'];

    $owner_funds_made = (float) $database->get_value_for_user_type('funds_made', 'owner', $owner_id);
    $owner_funds_made += (float) $data['final_price'] - $seller_funds_made;
    $database->update_value_for_user_type('funds_made', 'owner', $owner_funds_made, $owner_id);

    $cars_owned = $database->get_value_for_user_type('cars_owned', 'owner', $owner_id);
    $database->update_value_for_user_type('cars_owned', 'owner', ++$cars_owned, $owner_id);

    // Insert new sale.
    $database->insert_new_sale($data);
    $sale_id = $database->get_last_added_item_id('sale')['id'];
    $data['sale_id'] = $sale_id;

    // Insert new shipment.
    $database->insert_new_shipment($data);

    // Deleting the purchased car.
    $database->delete_item('car', $data['car_id']);

    // Save the purchased car for the buyer.
    $database->insert_new_bought_car($data);
}
