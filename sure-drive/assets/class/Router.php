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

    public static function renderPage($url)
    {
        // Require additional scripts.
        require_once 'assets/class/Session.php';
        require_once 'assets/class/Database.php';
        require_once 'assets/class/helper/Redirect.php';
        require_once 'assets/class/helper/Format.php';
        require_once 'assets/class/helper/Image.php';

        $timestamp = time();
        Session::start();

        $page = '';
        if ($url === '/') {
            $page = 'home';
        } else {
            $url = explode('/', $url);
            if (!in_array($url[0], self::$mainViews)) {
                $page = $url[0];
                if (in_array($page, self::$sideViews)) {
                    $title = $page;
                    require_once "assets/views/{$page}.php";
                }

                return;
            }

            $page = $url[0];
        }

        $html = "assets/views/{$page}.php";
        if (file_exists($html)) {
            $database = Database::getInstance();
            $pageData = self::$mainViewsData[$page];
            $file = $pageData['file_name'];
            $title = $pageData['title'];

            $username = 'Guest';
            $firstName = $username;
            if (Session::is_set('logged_in')) {
                $username = Session::getSessionVar('username');
                $userRoleID = Session::getSessionVar('role_id');

                $usernameParts = explode(' ', $username);
                if (is_array($usernameParts)) {
                    [$firstName] = $usernameParts;
                }
            }

            $actionHref = $username === 'Guest' ? 'login' : 'logout';
            $actionName = $username === 'Guest' ? 'Sign In' : 'Log Out';

            ob_start();

            require_once 'assets/views/inc/header.php';
            require_once $html;
            require_once 'assets/views/inc/footer.php';

            // Get content.
            return ob_get_clean();
        }
    }
}
