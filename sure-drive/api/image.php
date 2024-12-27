<?php

require_once '../models/Database.php';
$database = Database::get_instance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['image'])) {
        ['img_edit_id' => $item_id, 'img_edit_type' => $item_type] = $_POST;
        $image = file_get_contents($_FILES['image']['tmp_name']);

        if ($item_type === 'car') {
            $database->update_item_image('description', $item_type, $image, $item_id);
        } else if ($item_type === 'user') {
            $database->update_item_image($item_type, $item_type, $image, $item_id);
        }
    }
}
