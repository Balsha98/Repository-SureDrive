<?php

require_once '../assets/models/Session.php';
require_once '../assets/models/Database.php';
require_once '../assets/helpers/Encoder.php';

Session::start_session();
$data = Encoder::from_json(file_get_contents('php://input'));
$data['logged_in'] = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = Database::get_instance();

    // Login credentials.
    $username = $data['username'];
    $password = $data['password'];

    if ($database->verify_user_login($username, $password)) {
        Session::set_session_var('logged_in', true);
        Session::set_session_var('username', $username);

        $user_data = $database->get_user_data($username);
        Session::set_session_var('user_id', $user_data['user_id']);
        Session::set_session_var('role_id', $user_data['role_id']);
    } else {
        $data['logged_in'] = false;
    }

    header('content-type:application/json');
    echo Encoder::to_json($data);
}
