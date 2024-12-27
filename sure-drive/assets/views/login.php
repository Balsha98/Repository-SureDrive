<?php
if (Session::is_set('logged_in')) {
    Redirect::redirect_to('home');
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='icon' href='assets/media/car-rental-icon.ico'>
    <link rel='stylesheet' href='assets/css/general.css?ts=<?php echo $timestamp; ?>'>
    <link rel='stylesheet' href='assets/css/login.css?ts=<?php echo $timestamp; ?>'>
    <script src='assets/js/jQuery.js' defer></script>
    <script type="module" src='assets/js/request.js' defer></script>
    <script type="module" src="assets/js/general.js" defer></script>
    <script type="module" src='assets/js/login.js' defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" defer></script>
    <title>SureDrive | Login</title>
</head>

<body>
    <!-- LOGIN CONTAINER -->
    <div class="div-login-container">
        <!-- LOGIN CONTAINER HEADER -->
        <header class="login-container-header">
            <h1 class="heading-primary">Welcome back, User!</h1>
            <p>Don't have an account? <a href="<?php echo DOMAIN; ?>/signup">Sign Up</a>.</p>
        </header>
        <!-- LOGIN FORM -->
        <form 
            class="form" 
            action="<?php echo DOMAIN; ?>/api/login.php" 
            method="POST"
        >
            <div class="div-multi-input-containers">
                <div class="div-input-container">
                    <label for="username">Username:</label>
                    <div class="div-input-icon-container">
                        <input id="username" type="text" name="username" autofocus>
                        <ion-icon name="person"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container">
                    <label for="password">Password:</label>
                    <div class="div-input-icon-container">
                        <input id="password" type="password" name="password">
                        <ion-icon name="lock-closed"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="div-grid-btn-container grid-2-columns">
                <a class="btn btn-secondary" href="<?php echo DOMAIN; ?>/home">Back</a>
                <button 
                    class="btn btn-primary btn-form-submit" 
                    data-href="<?php echo DOMAIN; ?>/profile" 
                    data-target="_self" 
                    type="submit"
                >
                    Sign In
                </button>
            </div>
        </form>
    </div>

    <!-- BLUR OVERLAY -->
    <div class="blur-overlay">&nbsp;</div>
</body>

</html>
