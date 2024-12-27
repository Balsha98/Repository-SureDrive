<?php
if (!Session::is_set('logged_in')) {
    Redirect::redirect_to('login');
}

$database = Database::get_instance();

// Get car details.
$car_id = $_POST['checkout_car_id'];
$car_data = $database->get_car_details_by_id($car_id);
$image = Image::render_image('car', $car_data['car_image']);
$make = $car_data['make'];
$model = $car_data['model'];
$car_name = "{$make} {$model}";
$seller_id = $car_data['seller_id'];
$owner_id = $car_data['owner_id'];
$mileage = $car_data['mileage'];
$year = $car_data['year'];
$shift = $car_data['shift'];

// Formatting prices.
$original_price = $car_data['original_price'];
$original_formatted = Format::format_number($original_price, 2);
$final_price = $car_data['final_price'];
$final_formatted = Format::format_number($final_price, 2);

// Get receipt prices.
$discount = Format::format_number($original_price - $final_price, 2);
$tax = $final_price * 0.05;
$tax_formatted = Format::format_number($tax, 2);
$total = $final_price + $tax;
$total_formatted = Format::format_number($total, 2);
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo DOMAIN; ?>/assets/media/car-rental-icon.ico">
    <link rel="stylesheet" href="<?php echo DOMAIN; ?>/assets/css/general.css?ts=<?php echo $timestamp; ?>">
    <link rel="stylesheet" href="<?php echo DOMAIN; ?>/assets/css/checkout.css?ts=<?php echo $timestamp; ?>">
    <script src="<?php echo DOMAIN; ?>/assets/js/jQuery.js" defer></script>
    <script type="module" src="<?php echo DOMAIN; ?>/assets/js/cookie.js" defer></script>
    <script type="module" src="<?php echo DOMAIN; ?>/assets/js/general.js" defer></script>
    <script type="module" src="<?php echo DOMAIN; ?>/assets/js/request.js" defer></script>
    <script type="module" src="<?php echo DOMAIN; ?>/assets/js/checkout.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" defer></script>
    <title>SureDrive | Checkout</title>
</head>

<body>
    <!-- PAGE HEADER -->
    <header class="page-header">
        <div 
            class="div-header-logo-container logo-container" 
            data-href="<?php echo DOMAIN; ?>/home" 
            data-target="_self"
        >
            <ion-icon class="logo-icon" name="car-sport"></ion-icon>
            <h1 class="heading-primary">SureDrive</h1>
        </div>
        <div class="div-page-name-container">
            <ion-icon name="lock-closed"></ion-icon>
            <h3 class="heading-tertiary">Checkout</h3>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="main-container">
        <!-- CHECKOUT FORM PROCESS -->
        <section class="section-form-process">
            <form 
                class="form form-process" 
                action="<?php echo DOMAIN; ?>/api/checkout.php" 
                method="POST"
            >
                <!-- SHIPPING ADDRESS FORM -->
                <div class="div-form-process-container">
                    <header class="form-process-header">
                        <div class="div-heading-text-container">
                            <span class="span-heading-dot">&nbsp;</span>
                            <h3 class="heading-tertiary">Shipping Address</h3>
                        </div>
                        <ion-icon name="airplane"></ion-icon>
                    </header>
                    <div class="div-form-inputs-container shipping-form-inputs" data-form-index="1">
                        <div class="div-multi-input-containers grid-2-columns">
                            <div class="div-input-container required-input-container">
                                <label for="first_name">First Name:</label>
                                <input id="first_name" type="text" name="first_name">
                            </div>
                            <div class="div-input-container required-input-container">
                                <label for="last_name">Last Name:</label>
                                <input id="last_name" type="text" name="last_name">
                            </div>
                        </div>
                        <div class="div-input-container required-input-container">
                            <label for="shipping_address">Address:</label>
                            <input id="shipping_address" type="text" name="shipping_address">
                        </div>
                        <div class="div-input-container">
                            <label for="apt_number">Apt. Number/Suite Floor:</label>
                            <input id="apt_number" type="text" name="apt_number">
                        </div>
                        <div class="div-multi-input-containers grid-3-columns">
                            <div class="div-input-container required-input-container">
                                <label for="country">Country:</label>
                                <input id="country" type="text" name="country">
                            </div>
                            <div class="div-input-container required-input-container">
                                <label for="city">City:</label>
                                <input id="city" type="text" name="city">
                            </div>
                            <div class="div-input-container required-input-container">
                                <label for="zip">Zip Code:</label>
                                <input id="zip" type="number" name="zip">
                            </div>
                        </div>
                        <div class="div-grid-btn-container grid-3-columns">
                            <button class="btn-reset" type="button">
                                <ion-icon name="refresh"></ion-icon>
                            </button>
                            <button 
                                class="btn btn-primary btn-next-step" 
                                data-step-index="2"
                                type="button" 
                            >
                                Next Step
                            </button>
                        </div>
                    </div>
                </div>
                <!-- CONTACT INFORMATION FORM -->
                <div class="div-form-process-container">
                    <header class="form-process-header">
                        <div class="div-heading-text-container">
                            <span class="span-heading-dot">&nbsp;</span>
                            <h3 class="heading-tertiary">Contact Information</h3>
                        </div>
                        <ion-icon name="call"></ion-icon>
                    </header>
                    <div class="div-form-inputs-container contact-form-inputs hide-element" data-form-index="2">
                        <div class="div-input-container required-input-container">
                            <label for="order_email">Email Address:</label>
                            <input id="order_email" type="email" name="order_email">
                        </div>
                        <div class="div-input-container required-input-container">
                            <label for="order_phone">Phone Number:</label>
                            <input id="order_phone" type="tel" name="order_phone">
                        </div>
                        <div class="div-grid-btn-container grid-3-columns">
                            <button class="btn-reset" type="button">
                                <ion-icon name="refresh"></ion-icon>
                            </button>
                            <button 
                                class="btn btn-secondary btn-previous-step" 
                                data-step-index="1"
                                type="button"
                            >
                                Previous Step
                            </button>
                            <button 
                                class="btn btn-primary btn-next-step" 
                                data-step-index="3"
                                type="button"
                            >
                                Next Step
                            </button>
                        </div>
                    </div>
                </div>
                <!-- PAYMENT DETAILS FORM -->
                <div class="div-form-process-container">
                    <header class="form-process-header">
                        <div class="div-heading-text-container">
                            <span class="span-heading-dot">&nbsp;</span>
                            <h3 class="heading-tertiary">Payment Details</h3>
                        </div>
                        <ion-icon name="card"></ion-icon>
                    </header>
                    <div class="div-form-inputs-container payment-form-inputs hide-element" data-form-index="3">
                        <div class="div-multi-input-containers grid-2-columns">
                            <div class="div-input-container required-input-container">
                                <label for="payment_email">Email Address:</label>
                                <input id="payment_email" type="email" name="payment_email">
                            </div>
                            <div class="div-input-container required-input-container">
                                <label for="cardholder_name">Cardholder Full Name:</label>
                                <input id="cardholder_name" type="text" name="cardholder_name">
                            </div>
                        </div>
                        <div class="div-input-container required-input-container">
                            <label for="card_number">Card Number:</label>
                            <input id="card_number" type="number" name="card_number">
                        </div>
                        <div class="div-multi-input-containers grid-2-columns">
                            <div class="div-input-container required-input-container">
                                <label for="expiration_date">Expiration:</label>
                                <input id="expiration_date" type="text" name="expiration_date">
                            </div>
                            <div class="div-input-container required-input-container">
                                <label for="cvc">CVC:</label>
                                <input id="cvc" type="text" name="cvc">
                            </div>
                        </div>
                        <div class="div-grid-btn-container grid-3-columns">
                            <button class="btn-reset" type="button">
                                <ion-icon name="refresh"></ion-icon>
                            </button>
                            <button 
                                class="btn btn-secondary btn-previous-step" 
                                data-step-index="2" 
                                type="button"
                            >
                                Previous Step
                            </button>
                            <button 
                                class="btn btn-primary btn-confirm-payment" 
                                data-href="<?php echo DOMAIN . '/home'; ?>" 
                                data-target="_self" 
                                type="submit"
                            >
                                Confirm Payment
                            </button>
                        </div>
                    </div>
                </div>
                <!-- HIDDEN INPUTS CONTAINER -->
                <div class="div-hidden-inputs-container">
                    <input id="car_id" type="hidden" name="car_id" value="<?php echo $car_id; ?>">
                    <input id="seller_id" type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
                    <input id="owner_id" type="hidden" name="owner_id" value="<?php echo $owner_id; ?>">
                    <input id="car_name" type="hidden" name="car_name" value="<?php echo $car_name; ?>">
                    <input id="make" type="hidden" name="make" value="<?php echo $make; ?>">
                    <input id="model" type="hidden" name="model" value="<?php echo $model; ?>">
                    <input id="year" type="hidden" name="year" value="<?php echo $year; ?>">
                    <input id="car_image" type="hidden" name="car_image" value="<?php echo $image; ?>">
                    <input id="mileage" type="hidden" name="mileage" value="<?php echo $mileage; ?>">
                    <input id="shift" type="hidden" name="shift" value="<?php echo $shift; ?>">
                    <input id="final_price" type="hidden" name="final_price" value="<?php echo $final_price; ?>">
                    <input id="total_price" type="hidden" name="total_price" value="<?php echo $total; ?>">
                </div>
            </form>
        </section>
        <!-- PRICE OVERVIEW -->
        <section class="section-overview">
            <div class="div-car-overview-container">
                <div class="div-car-img-container">
                    <img src="data:image/png;base64,<?php echo $image; ?>" alt="Car Image">
                </div>
                <div class="div-car-info-container">
                    <h4 class="heading-quaternary"><?php echo $car_name; ?></h4>
                    <ul class='car-overview-list'>
                        <li class='car-overview-list-item'>
                            <span class='span-overview-dot'>&nbsp;</span>
                            <p>
                                <strong>Mileage</strong> &mdash; <?php echo $mileage; ?><small>km</small>
                            </p>
                        </li>
                        <li class='car-overview-list-item'>
                            <span class='span-overview-dot'>&nbsp;</span>
                            <p>
                                <strong>Year of Production</strong> &mdash; <?php echo $year; ?>
                            </p>
                        </li>
                        <li class='car-overview-list-item'>
                            <span class='span-overview-dot'>&nbsp;</span>
                            <p>
                                <strong>Shift</strong> &mdash; <?php echo $shift; ?>
                            </p>
                        </li>
                    </ul>
                    <div class='div-price-container grid-2-columns'>
                        <span class='span-previous-price'>
                            <small>&dollar;</small><?php echo $original_formatted; ?>
                        </span>
                        <span class='span-current-price'>
                            <small>&dollar;</small><?php echo $final_formatted; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="div-price-overview-container">
                <ul class="price-overview-list">
                    <li class="price-overview-list-item">
                        <p>Discount:</p>
                        <span class="span-discount">-&dollar;<?php echo $discount; ?></span>
                    </li>
                    <li class="price-overview-list-item">
                        <p>Shipping Fee:</p>
                        <span>Free</span>
                    </li>
                    <li class="price-overview-list-item">
                        <p>Est. Tax:</p>
                        <span class="span-tax">+&dollar;<?php echo $tax_formatted; ?></span>
                    </li>
                </ul>
                <div class="div-total-price-container">
                    <p>Total:</p>
                    <span>
                        <small>&dollar;</small><?php echo $total_formatted; ?>
                    </span>
                </div>
            </div>
        </section>
    </main>

<?php
require_once 'assets/inc/footer.php';
?>
