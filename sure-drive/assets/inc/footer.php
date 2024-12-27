    <!-- BACK-TO-TOP BUTTON CONTAINER -->
    <div class="div-to-top-btn-container">
        <button class="btn-to-top">
            <ion-icon name="chevron-up-outline"></ion-icon>
        </button>
    </div>

    <!-- PAGE FOOTER -->
    <footer class="page-footer">
        <!-- SUBSCRIPTION CONTAINER -->
        <?php if ($page !== 'checkout') { ?>
        <div class="div-subscription-container">
            <h2 class="heading-secondary">Newsletter Subscription</h2>
            <div class="div-sub-form-container">
                <form 
                    class="form form-subscription" 
                    action="<?php echo DOMAIN; ?>/assets/process/newsletter.php" 
                    method="POST"
                >
                    <div class="div-sub-input-container">
                        <div class="div-sub-input-icon-container">
                            <ion-icon name="mail"></ion-icon>
                            <input id="subscription_email" type="email" name="subscription-email">
                        </div>
                        <button class="btn btn-primary btn-subscribe" type="submit">Subscribe</button>
                    </div>
                </form>
                <p>
                    By subscribing to our newsletter, you agree to our terms 
                    and services. You can unsubscribe at any time.
                </p>
            </div>
        </div>
        <?php } ?>
        <!-- FOOTER INFO CONTAINER -->
        <div class="div-footer-info-container">
            <!-- FOOTER INFO CONTAINER HEADER -->
            <header class="footer-info-header">
                <div 
                    class="div-footer-logo-container logo-container" 
                    data-href="<?php echo DOMAIN; ?>/home" 
                    data-target="_self"
                >
                    <ion-icon class="logo-icon" name="car-sport"></ion-icon>
                    <h2 class="heading-secondary">SureDrive</h2>
                </div>
                <?php if ($url[0] !== 'checkout') { ?>
                <a 
                    class="btn btn-primary" 
                    href="<?php echo DOMAIN; ?>/<?php echo $action_href; ?>"
                >
                    <?php echo $action_name; ?>
                </a>
                <?php } ?>
            </header>
            <!-- FOOTER LINKS CONTAINER -->
            <div class="div-footer-links-container grid-4-columns">
                <!-- INDIVIDUAL LINKS CONTAINER -->
                <div class="div-links-container">
                    <h4 class="heading-quaternary">Website Map</h4>
                    <ul class="footer-links-list">
                        <li class="footer-links-list-item">
                            <ion-icon class="<?php echo $title === 'Home' ? 'active-footer-link' : ''; ?>" name="home"></ion-icon>
                            <a 
                                class="<?php echo $title === 'Home' ? 'active-footer-link' : ''; ?>" 
                                href="<?php echo DOMAIN; ?>/home"
                            >
                                Home
                            </a>
                        </li>
                        <li class="footer-links-list-item">
                            <ion-icon class="<?php echo $title === 'Details' ? 'active-footer-link' : ''; ?>" name="car-sport"></ion-icon>
                            <a 
                                class="<?php echo $title === 'Details' ? 'active-footer-link' : ''; ?>" 
                                href="<?php echo DOMAIN; ?>/details"
                            >
                                Car Details
                            </a>
                        </li>
                        <li class="footer-links-list-item">
                            <ion-icon class="<?php echo $title === 'About' ? 'active-footer-link' : ''; ?>" name="information-circle"></ion-icon>
                            <a 
                                class="<?php echo $title === 'About' ? 'active-footer-link' : ''; ?>" 
                                href="<?php echo DOMAIN; ?>/about"
                            >
                                About SureDrive
                            </a>
                        </li>
                        <li class="footer-links-list-item">
                            <ion-icon class="<?php echo $title === 'Profile' ? 'active-footer-link' : ''; ?>" name="person"></ion-icon>
                            <a 
                                class="<?php echo $title === 'Profile' ? 'active-footer-link' : ''; ?>" 
                                href="<?php echo DOMAIN; ?>/profile"
                            >
                                User Profile
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- INDIVIDUAL LINKS CONTAINER -->
                <div class="div-links-container">
                    <h4 class="heading-quaternary">Company Notice</h4>
                    <ul class="footer-links-list">
                        <li class="footer-links-list-item">
                            <ion-icon name="open-outline"></ion-icon>
                            <a href="#" target="_blank">
                                Privacy Policy
                            </a>
                        </li>
                        <li class="footer-links-list-item">
                            <ion-icon name="open-outline"></ion-icon>
                            <a href="#">
                                User Agreement
                            </a>
                        </li>
                        <li class="footer-links-list-item">
                            <ion-icon name="open-outline"></ion-icon>
                            <a href="#">
                                Shipping Rates
                            </a>
                        </li>
                        <li class="footer-links-list-item">
                            <ion-icon name="open-outline"></ion-icon>
                            <a href="#">
                                Help
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- INDIVIDUAL LINKS CONTAINER -->
                <div class="div-links-container">
                    <h4 class="heading-quaternary">Contact Us</h4>
                    <ul class="footer-links-list">
                        <li class="footer-links-list-item">
                            <ion-icon name="location"></ion-icon>
                            <a href="https://maps.app.goo.gl/LEXS2gRJewQzGfhX8" target="_blank">
                                Dubrovnik, Croatia
                            </a>
                        </li>
                        <li class="footer-links-list-item">
                            <ion-icon name="mail"></ion-icon>
                            <a href="mailto:support@rental.com">
                                support@suredrive.com
                            </a>
                        </li>
                        <li class="footer-links-list-item">
                            <ion-icon name="call"></ion-icon>
                            <a href="tel:+385 99 123 4567">
                                +385 99 123 4567
                            </a>
                        </li>
                        <li class="footer-links-list-item">
                            <ion-icon name="home"></ion-icon>
                            <a href="tel:+385 20 433 000">
                                +385 20 433 000
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- INDIVIDUAL LINKS CONTAINER -->
                <div class="div-links-container">
                    <h4 class="heading-quaternary">Follow Us</h4>
                    <ul class="social-links-list">
                        <li class="social-links-list-item">
                            <a href="http://www.facebook.com/">
                                <ion-icon name="logo-facebook"></ion-icon>
                            </a>
                        </li>
                        <li class="social-links-list-item">
                            <a href="http://www.instagram.com/">
                                <ion-icon name="logo-instagram"></ion-icon>
                            </a>
                        </li>
                        <li class="social-links-list-item">
                            <a href="http://www.x.com/">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a>
                        </li>
                        <li class="social-links-list-item">
                            <a href="http://www.linkedin.com/">
                                <ion-icon name="logo-linkedin"></ion-icon>
                            </a>
                        </li>
                        <li class="social-links-list-item">
                            <a href="http://www.youtube.com/">
                                <ion-icon name="logo-youtube"></ion-icon>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- COPYRIGHT CONTAINER -->
        <div class="div-copyright-container">
          <p>&copy; 2024 AppDev Inc. | All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
