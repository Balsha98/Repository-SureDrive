<?php

// Get dull server path.
$full_domain = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}";
define('DOMAIN', $full_domain);

// Process request via Router class.
require_once 'assets/models/Router.php';
echo Router::render_page($_GET['path'] ?? '/');
