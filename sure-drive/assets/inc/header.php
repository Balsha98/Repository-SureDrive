<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo DOMAIN; ?>/assets/media/car-rental-icon.ico">
    <link rel="stylesheet" href="<?php echo DOMAIN; ?>/assets/css/general.css?ts=<?php echo $timestamp; ?>">
    <link rel="stylesheet" href="<?php echo DOMAIN; ?>/assets/css/<?php echo $file; ?>.css?ts=<?php echo $timestamp; ?>">
    <script src="<?php echo DOMAIN; ?>/assets/js/jQuery.js" defer></script>
    <script type="module" src="<?php echo DOMAIN; ?>/assets/js/cookie.js" defer></script>
    <script type="module" src="<?php echo DOMAIN; ?>/assets/js/general.js" defer></script>
    <script type="module" src="<?php echo DOMAIN; ?>/assets/js/request.js" defer></script>
    <script type="module" src="<?php echo DOMAIN; ?>/assets/js/<?php echo $file; ?>.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" defer></script>
    <title>SureDrive | <?php echo $title; ?></title>
</head>

<body>
    <!-- PAGE HEADER -->
    <header class="page-header">
        <!-- HEADER LOGO CONTAINER -->
        <div 
            class="div-header-logo-container logo-container" 
            data-href="<?php echo DOMAIN; ?>/home" 
            data-target="_self"
        >
            <ion-icon class="logo-icon" name="car-sport"></ion-icon>
            <h1 class="heading-primary">SureDrive</h1>
        </div>
        <!-- MENU INFO CONTAINER -->
        <div class="div-menu-info-container">
            <span class="span-active-page">
                <?php echo $title; ?>
            </span>
            <button class="icon-btn navbar-icon-btn">
                <ion-icon class="sidebar-icon" name="menu-outline"></ion-icon>
            </button>
        </div>
    </header>

    <!-- PAGE SIDEBAR -->
    <div class="page-sidebar">
        <header class="sidebar-header">
            <h2 class="heading-secondary">Hello, <?php echo $first_name; ?>.</h2>
            <button class="icon-btn navbar-icon-btn">
                <ion-icon class="sidebar-icon" name="close-outline"></ion-icon>
            </button>
        </header>
        <!-- SIDEBAR NAV -->
        <nav class="sidebar-nav">
            <ul class="sidebar-link-list">
                <li 
                    class="sidebar-link-list-item <?php echo $title === 'Home' ? 'active-page-link' : ''; ?>" 
                    data-href="<?php echo DOMAIN; ?>/home"
                    data-target="_self"
                >
                    <span>Home</span>
                    <ion-icon class="right-chevron-icon" name="chevron-forward-outline"></ion-icon>
                </li>
                <li 
                    class="sidebar-link-list-item <?php echo $title === 'Details' ? 'active-page-link' : ''; ?>" 
                    data-href="<?php echo DOMAIN; ?>/details"
                    data-target="_self"
                >
                    <span>Details</span>
                    <ion-icon class="right-chevron-icon" name="chevron-forward-outline"></ion-icon>
                </li>
                <li 
                    class="sidebar-link-list-item <?php echo $title === 'About' ? 'active-page-link' : ''; ?>" 
                    data-href="<?php echo DOMAIN; ?>/about"
                    data-target="_self"
                >
                    <span>About</span>
                    <ion-icon class="right-chevron-icon" name="chevron-forward-outline"></ion-icon>
                </li>
                <li 
                    class="sidebar-link-list-item <?php echo $title === 'Profile' ? 'active-page-link' : ''; ?>" 
                    data-href="<?php echo DOMAIN; ?>/profile"
                    data-target="_self"
                >
                    <span>Profile</span>
                    <ion-icon class="right-chevron-icon" name="chevron-forward-outline"></ion-icon>
                </li>
            </ul>
        </nav>
        <div class="div-single-btn-container">
            <a 
                class="btn btn-primary" 
                href="<?php echo DOMAIN; ?>/<?php echo $action_href; ?>"
            >
                <?php echo $action_name; ?>
            </a>
        </div>
    </div>

    <!-- SIDEBAR OVERLAY -->
    <div class="page-sidebar-overlay">&nbsp;</div>
