<?php

require_once 'configuration.php';
require_once 'assets/models/Router.php';
echo Router::render_page($_GET['path'] ?? '/');
