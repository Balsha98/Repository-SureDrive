<?php

require_once '../models/Session.php';
require_once '../models/Database.php';
require_once '../helpers/Encoder.php';

Session::start_session();
$database = Database::get_instance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_type = $_POST['item_type'];
    if ($item_type === 'car') {
        $database->insert_new_car($data);

        if (!isset($_POST['add_car_image'])) {
            $car_id = $database->get_last_added_item_id($item_type)['id'];
            $image = file_get_contents($_FILES['add_car_image']['tmp_name']);
            $database->update_item_image('description', $item_type, $image, $car_id);
        }
    } else if ($item_type === 'user') {
        $database->insert_new_user($data);

        if (!isset($_POST['add_user_image'])) {
            $user_id = $database->get_last_added_item_id($item_type)['id'];
            $image = file_get_contents($_FILES['add_user_image']['tmp_name']);
            $database->update_item_image($item_type, $item_type, $image, $user_id);
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = Encoder::from_json(file_get_contents('php://input'));

    $item_type = $data['item_type'];
    $item_id = $data["edit_{$item_type}_id"];
    if ($item_type === 'car') {
        $database->update_car_by_id($item_id, $data);
    } else if ($item_type === 'user') {
        $database->update_user_by_id($item_id, $data);
    } else if ($item_type === 'profile') {
        $database->update_user_profile($item_id, $data);
        Session::set_session_var('username', $data['edit_profile_username']);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = Encoder::from_json(file_get_contents('php://input'));
    $database->delete_item($data['item_delete_type'], $data['item_delete_id']);
}
