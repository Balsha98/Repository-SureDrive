<?php

class Router
{
    private static $sideViews = [
        'login',
        'signup',
        'checkout',
        'logout'
    ];

    private static $mainViews = [
        'home',
        'details',
        'about',
        'profile'
    ];

    private static $mainViewsData = [
        'home' => [
            'file_name' => 'home',
            'title' => 'Home',
        ],
        'details' => [
            'file_name' => 'details',
            'title' => 'Details',
        ],
        'about' => [
            'file_name' => 'about',
            'title' => 'About',
        ],
        'profile' => [
            'file_name' => 'profile',
            'title' => 'Profile',
        ]
    ];

    static function renderPage($url)
    {
        // Require additional scripts.
        require_once 'assets/models/Session.php';
        require_once 'assets/models/Database.php';
        require_once 'assets/helpers/Redirect.php';
        require_once 'assets/helpers/Format.php';
        require_once 'assets/helpers/Image.php';

        $timestamp = time();
        Session::start_session();

        $page = '';
        if ($url === '/') {
            $page = 'home';
        } else {
            $url = explode('/', $url);
            if (!in_array($url[0], self::$mainViews)) {
                if (in_array($url[0], self::$sideViews)) {
                    require_once "assets/views/{$url[0]}.php";
                }

                return;
            }

            $page = $url[0];
        }

        $html = "assets/views/{$page}.php";
        if (file_exists($html)) {
            $database = Database::get_instance();
            $page_data = self::$mainViewsData[$page];
            $file = $page_data['file_name'];
            $title = $page_data['title'];

            $username = 'Guest';
            $first_name = $username;
            if (Session::is_set('logged_in')) {
                $username = Session::get_session_var('username');
                $user_role_id = Session::get_session_var('role_id');

                $username_parts = explode(' ', $username);
                if (is_array($username_parts)) {
                    $first_name = $username_parts[0];
                }
            }

            $actionHref = $username === 'Guest' ? 'login' : 'logout';
            $actionName = $username === 'Guest' ? 'Sign In' : 'Log Out';

            ob_start();

            require_once 'assets/inc/header.php';
            require_once $html;
            require_once 'assets/inc/footer.php';

            // Get content.
            return ob_get_clean();
        }
    }
}
