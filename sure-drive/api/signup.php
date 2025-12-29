<?php

require_once '../assets/classes/Session.php';
require_once '../assets/classes/Database.php';
require_once '../assets/classes/helpers/Encoder.php';

Session::start();
$data = Encoder::fromJSON(file_get_contents('php://input'));
$data['logged_in'] = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = Database::getInstance();

    // Login credentials.
    $username = $data['username'];
    $password = $data['password'];

    $email = $data['user_email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $data['logged_in'] = false;
    }

    $role_id = (int) $data['role_id'];
    if ($role_id === 0) {
        $data['logged_in'] = false;
    }

    if ($data['logged_in']) {
        Session::setSessionVar('logged_in', true);
        Session::setSessionVar('username', $username);
        $database->userSignup($data);

        $user_data = $database->getUserData($username);
        Session::setSessionVar('user_id', $user_data['user_id']);
        Session::setSessionVar('role_id', $user_data['role_id']);

        // Send welcome email.
        // Email::send($email, 'Welcome', 'welcome-template');
    }

    header('content-type:application/json');
    echo Encoder::toJSON($data);
}
