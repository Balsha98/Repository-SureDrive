<?php
if (Session::is_set('logged_in')) {
    Redirect::redirectTo('home');
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='icon' href='assets/media/car-rental-icon.ico'>
    <link rel='stylesheet' href='assets/css/general.css?ts=<?php echo $timestamp; ?>'>
    <link rel='stylesheet' href='assets/css/signup.css?ts=<?php echo $timestamp; ?>'>
    <script src='assets/js/lib/jQuery.js' defer></script>
    <script type="module" src="assets/js/helper/general.js" defer></script>
    <script type="module" src='assets/js/views/signup.js' defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" defer></script>
    <title>SureDrive | Signup</title>
</head>

<body>
    <!-- SIGNUP CONTAINER -->
    <div class="div-signup-container">
        <!-- SIGNUP CONTAINER HEADER -->
        <header class="signup-container-header">
            <h1 class="heading-primary">Welcome to SureDrive!</h1>
            <p>Already have an account? <a href="<?php echo SERVER; ?>/login">Log in</a>.</p>
        </header>
        <!-- SIGNUP FORM -->
        <form 
            class="form" 
            action="<?php echo SERVER; ?>/api/signup.php" 
            method="POST"
        >
            <div class="div-multi-input-containers grid-2-columns">
                <div class="div-input-container required-input-container">
                    <label for="username">Username:</label>
                    <div class="div-input-icon-container">
                        <input id="username" type="text" name="username" autofocus>
                        <ion-icon name="person"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="user_email">Email:</label>
                    <div class="div-input-icon-container">
                        <input id="user_email" type="email" name="user_email">
                        <ion-icon name="mail"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="password">Password:</label>
                    <div class="div-input-icon-container">
                        <input id="password" type="password" name="password">
                        <ion-icon name="lock-closed"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="role_id">Type of Role:</label>
                    <div class="div-input-icon-container">
                        <select id="role_id" name="role">
                            <option value="0">&nbsp; Select Role</option>
                            <option value="2">&nbsp; Buyer</option>
                            <option value="3">&nbsp; Seller</option>
                            <option value="4">&nbsp; Owner</option>
                        </select>
                        <ion-icon name="man"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="div-grid-btn-container grid-2-columns">
                <a class="btn btn-secondary" href="<?php echo SERVER; ?>/login">Back</a>
                <button 
                    class="btn btn-primary btn-form-submit" 
                    data-href="<?php echo SERVER; ?>/profile" 
                    data-target="_self" 
                    type="submit"
                >
                    Sign Up
                </button>
            </div>
        </form>
    </div>

    <!-- BLUR OVERLAY -->
    <div class="blur-overlay">&nbsp;</div>
</body>

</html>
