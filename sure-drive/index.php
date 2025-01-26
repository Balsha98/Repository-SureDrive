<?php

require_once 'configuration.php';
require_once 'assets/models/Router.php';
echo Router::renderPage($_GET['path'] ?? '/');
