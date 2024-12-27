<?php

require_once '../models/Database.php';
require_once '../helpers/Encoder.php';

$database = Database::get_instance();
$data = Encoder::from_json(file_get_contents('php://input'));

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    ['commission_edit_id' => $user_id, 'commission' => $commission] = $data;
    $database->update_value_for_user_type('commission', 'seller', $commission, $user_id);
}
