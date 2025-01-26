<?php

require_once '../assets/class/Session.php';
require_once '../assets/class/Database.php';
require_once '../assets/class/helper/Encoder.php';

Session::start();
$data = Encoder::fromJSON(file_get_contents('php://input'));
$data['logged_in'] = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = Database::getInstance();

    // Login credentials.
    $username = $data['username'];
    $password = $data['password'];

    if ($database->verifyUserLogin($username, $password)) {
        Session::setSessionVar('logged_in', true);
        Session::setSessionVar('username', $username);

        $user_data = $database->getUserData($username);
        Session::setSessionVar('user_id', $user_data['user_id']);
        Session::setSessionVar('role_id', $user_data['role_id']);
    } else {
        $data['logged_in'] = false;
    }

    header('content-type:application/json');
    echo Encoder::toJSON($data);
}
