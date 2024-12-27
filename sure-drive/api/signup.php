<?php

require_once '../models/Session.php';
require_once '../models/Database.php';
require_once '../helpers/Encoder.php';

Session::start_session();
$data = Encoder::from_json(file_get_contents('php://input'));
$data['logged_in'] = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = Database::get_instance();

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
        Session::set_session_var('logged_in', true);
        Session::set_session_var('username', $username);
        $database->user_signup($data);

        $user_data = $database->get_user_data($username);
        Session::set_session_var('user_id', $user_data['user_id']);
        Session::set_session_var('role_id', $user_data['role_id']);

        // Send welcome email.
        // Email::send($email, 'Welcome', 'welcome-template');
    }

    header('content-type:application/json');
    echo Encoder::to_json($data);
}
