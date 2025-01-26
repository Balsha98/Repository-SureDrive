<?php

require_once '../assets/class/Session.php';
require_once '../assets/class/Database.php';
require_once '../assets/class/helper/Encoder.php';

Session::start();
$database = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_type = $_POST['item_type'];
    if ($item_type === 'car') {
        $database->insertNewCar($data);

        if (!isset($_POST['add_car_image'])) {
            $car_id = $database->getLastAddedItemID($item_type)['id'];
            $image = file_get_contents($_FILES['add_car_image']['tmp_name']);
            $database->updateItemImage('description', $item_type, $image, $car_id);
        }
    } else if ($item_type === 'user') {
        $database->insertNewUser($data);

        if (!isset($_POST['add_user_image'])) {
            $user_id = $database->getLastAddedItemID($item_type)['id'];
            $image = file_get_contents($_FILES['add_user_image']['tmp_name']);
            $database->updateItemImage($item_type, $item_type, $image, $user_id);
        }
    }
} else {
    $data = Encoder::fromJSON(file_get_contents('php://input'));

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $item_type = $data['item_type'];
        $item_id = $data["edit_{$item_type}_id"];
        if ($item_type === 'car') {
            $database->updateCarByID($item_id, $data);
        } else if ($item_type === 'user') {
            $database->updateUserByID($item_id, $data);
        } else if ($item_type === 'profile') {
            $database->updateUserProfile($item_id, $data);
            Session::setSessionVar('username', $data['edit_profile_username']);
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $database->deleteItem($data['item_delete_type'], $data['item_delete_id']);
    }
}
