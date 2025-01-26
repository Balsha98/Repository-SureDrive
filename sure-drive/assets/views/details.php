<?php
$carID = 0;
if (isset($_COOKIE['last_viewed_car'])) {
    $carID = (int) $_COOKIE['last_viewed_car'];
} else if (!is_numeric($url[1])) {
    Redirect::redirectTo('/home');
} else {
    $carID = (int) $url[1];
}

// Get car data.
$carData = $database->getCarDetailsByID($carID);
$carName = "{$carData['make']} {$carData['model']}";
$carImage = Image::renderImage('car', $carData['car_image']);

// Get seller data.
$seller = $carData['username'];
$sellerImage = Image::renderImage('user', $carData['user_image']);
$locationParts = explode(',', $carData['location']);
$sellerCountry = trim($locationParts[1]);
$sellerCity = trim($locationParts[0]);
$sellerEmail = $carData['user_email'];
$sellerPhone = $carData['user_phone'];
?>

    <!-- MAIN CONTAINER -->
    <main class="main-container">
        <section class="section-car-user-details">
            <div class="div-car-details-container">
                <header class="car-name-header">
                    <h3 class="heading-tertiary"><?php echo $carName; ?></h3>
                </header>
                <div class="div-lg-car-img-container">
                    <img src="data:image/png;base64,<?php echo $carImage; ?>" alt="Car Image">
                </div>
            </div>
            <div class="div-user-btn-container">
                <button class="btn-show-user">
                    <ion-icon name="person"></ion-icon>
                </button>
            </div>
            <div class="div-user-details-container">
                <div class="div-close-btn-container">
                    <button class="btn-close-user">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                </div>
                <header class="user-details-header">
                    <div class="div-user-img-container">
                        <img src="data:image/png;base64,<?php echo $sellerImage; ?>" alt="User Image">
                    </div>
                    <div class="div-user-details">
                        <h3 class="heading-tertiary"><?php echo $seller; ?></h3>
                        <div class="div-verified-container">
                            <span>Verified</span>
                            <div class="div-verified-icon">
                                <ion-icon name="checkmark-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="div-contact-details-container">
                    <h4 class="heading-quaternary">Contact Details</h4>
                    <ul class="contact-details-list">
                        <li class="contact-details-list-item">
                            <ion-icon name="location"></ion-icon>
                            <div class="div-location-container">
                                <span><?php echo $sellerCountry; ?></span>
                                <a href="https://www.google.com/maps/place/<?php echo $sellerCity; ?>" target="_blank">
                                    <?php echo $sellerCity; ?>
                                </a>
                            </div>
                        </li>
                        <li class="contact-details-list-item">
                            <ion-icon name="mail"></ion-icon>
                            <a href="mailto:<?php echo $sellerEmail; ?>">
                                <?php echo $sellerEmail; ?>
                            </a>
                        </li>
                        <li class="contact-details-list-item">
                            <ion-icon name="call"></ion-icon>
                            <a href="tel:<?php echo $sellerPhone; ?>">
                                <?php echo $sellerPhone; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="div-car-features-container">
            <header>
                <span class="span-section-subheading">General Features</span>
            </header>
            <ul class="car-features-list">
                <?php
                $icons = ['mileage', 'engine', 'fuel', 'shift', 'calendar'];
                $data = [$carData['mileage'], $carData['horse_power'], $carData['fuel'], $carData['shift'], $carData['year']];
                $labels = ['Mileage', 'Horse Power', 'Fuel', 'Shift', 'Production'];

                for ($i = 0; $i < count($data); $i++) {
                    $value = $data[$i];
                    if ($labels[$i] === 'Mileage') {
                        $value = Format::formatNumber($data[$i], 0) . '<small>km</small>';
                    } else if ($labels[$i] === 'Horse Power') {
                        $value = Format::formatNumber($data[$i], 0) . '<small>hp</small>';
                    }

                    echo "
                        <li class='car-features-list-item'>
                            <figure class='figure-feature'>
                                <img src='" . SERVER . "/assets/media/{$icons[$i]}-icon.png' alt='Feature'>
                                <figcaption>{$value}</figcaption>
                            </figure>
                            <span>{$labels[$i]}</span>
                        </li>
                    ";
                }
                ?>
            </ul>
        </div>
        <section class="section-car-description">
            <div class="div-car-description-container">
                <header class="car-description-header">
                    <span>Description</span>
                    <h2 class="heading-secondary">Car Description</h2>
                </header>
                <ul class="car-description-list">
                    <?php
                    $data = [
                        'Make' => $carData['make'],
                        'Model' => $carData['model'],
                        'Year of Production' => $carData['year'],
                        'Mileage' => $carData['mileage'],
                        'Horse Power' => $carData['horse_power'],
                        'Fuel' => $carData['fuel'],
                        'Shift' => $carData['shift'],
                        'Color' => $carData['color'],
                        'Original Price' => $carData['original_price'],
                        'Final Price' => $carData['final_price'],
                        'Added On' => $carData['date_added']
                    ];

                    foreach ($data as $label => $value) {
                        $className = strtolower(implode('-', explode(' ', $label)));

                        $attr = '';
                        if ($label === 'Mileage') {
                            $value = sprintf('%s<small>km</small>', Format::formatNumber($value, 0));
                        } else if ($label === 'Horse Power') {
                            $value = sprintf('%s<small>hp</small>', Format::formatNumber($value, 0));
                        } else if ($label === 'Color') {
                            $attr = "data-color='{$value}'";
                        } else if (str_contains($label, 'Price')) {
                            $value = sprintf('<small>$</small>%s', Format::formatNumber($value, 2));
                        } else if ($label === 'Added On') {
                            $value = date_format(date_create($value), 'F jS, Y');
                        }

                        echo "
                            <li class='car-description-list-item'>
                                <span class='span-list-item-dot'>&nbsp;</span>
                                <p class='{$className}'>
                                    <strong>{$label}</strong> &mdash; <span {$attr}>{$value}</span>
                                </p>
                            </li>
                        ";
                    }
                    ?>
                </ul>
            </div>
            <div class="div-description-card-container">
                <div class="div-sm-car-img-container">
                    <img src="data:image/png;base64,<?php echo $carImage; ?>" alt="Car Image">
                </div>
                <?php if (!isset($userRoleID) || $userRoleID === 2) { ?>
                <form action="<?php echo SERVER; ?>/checkout" method="POST">
                    <input id="checkout_car_id" type="hidden" name="checkout_car_id" value="<?php echo $carID; ?>">
                    <button class="btn btn-primary">Checkout</button>
                </form>
                <?php } ?>
            </div>
        </section>
    </main>
