<?php

require_once '../assets/models/Database.php';
require_once '../assets/helpers/Encoder.php';

$database = Database::get_instance();
$data = Encoder::from_json(file_get_contents('php://input'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo Encoder::to_json($database->get_filtered_cars($data));
}
