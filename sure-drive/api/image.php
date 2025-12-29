<?php

require_once '../assets/classes/Database.php';
$database = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['image'])) {
        ['img_edit_id' => $itemID, 'img_edit_type' => $itemType] = $_POST;
        $image = file_get_contents($_FILES['image']['tmp_name']);

        if ($itemType === 'car') {
            $database->updateItemImage('description', $itemType, $image, $itemID);
        } else if ($itemType === 'user') {
            $database->updateItemImage($itemType, $itemType, $image, $itemID);
        }
    }
}
