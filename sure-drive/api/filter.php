<?php

require_once '../assets/class/Database.php';
require_once '../assets/class/helper/Encoder.php';

$database = Database::getInstance();
$data = Encoder::fromJSON(file_get_contents('php://input'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo Encoder::toJSON($database->getFilteredCars($data));
}
