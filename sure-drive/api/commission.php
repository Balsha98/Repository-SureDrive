<?php

require_once '../assets/class/Database.php';
require_once '../assets/class/helper/Encoder.php';

$database = Database::getInstance();
$data = Encoder::fromJSON(file_get_contents('php://input'));

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    ['commission_edit_id' => $user_id, 'commission' => $commission] = $data;
    $database->updateValueForUserType('commission', 'seller', $commission, $user_id);
}
