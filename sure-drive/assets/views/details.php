<?php
$car_id = 0;
if (isset($_COOKIE['last_viewed_car'])) {
    $car_id = (int) $_COOKIE['last_viewed_car'];
} else if (!is_numeric($url[1])) {
    Redirect::redirect_to('/home');
} else {
    $car_id = (int) $url[1];
}

// Get car data.
$car_data = $database->get_car_details_by_id($car_id);
$car_name = "{$car_data['make']} {$car_data['model']}";
$car_image = Image::render_image('car', $car_data['car_image']);

// Get seller data.
$seller = $car_data['username'];
$seller_image = Image::render_image('user', $car_data['user_image']);
$location_parts = explode(',', $car_data['location']);
$seller_country = trim($location_parts[1]);
$seller_city = trim($location_parts[0]);
$seller_email = $car_data['user_email'];
$seller_phone = $car_data['user_phone'];
?>

    <!-- MAIN CONTAINER -->
    <main class="main-container">
        <section class="section-car-user-details">
            <div class="div-car-details-container">
                <header class="car-name-header">
                    <h3 class="heading-tertiary"><?php echo $car_name; ?></h3>
                </header>
                <div class="div-lg-car-img-container">
                    <img src="data:image/png;base64,<?php echo $car_image; ?>" alt="Car Image">
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
                        <img src="data:image/png;base64,<?php echo $seller_image; ?>" alt="User Image">
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
                                <span><?php echo $seller_country; ?></span>
                                <a href="https://www.google.com/maps/place/<?php echo $seller_city; ?>" target="_blank">
                                    <?php echo $seller_city; ?>
                                </a>
                            </div>
                        </li>
                        <li class="contact-details-list-item">
                            <ion-icon name="mail"></ion-icon>
                            <a href="mailto:<?php echo $seller_email; ?>">
                                <?php echo $seller_email; ?>
                            </a>
                        </li>
                        <li class="contact-details-list-item">
                            <ion-icon name="call"></ion-icon>
                            <a href="tel:<?php echo $seller_phone; ?>">
                                <?php echo $seller_phone; ?>
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
                $data = [$car_data['mileage'], $car_data['horse_power'], $car_data['fuel'], $car_data['shift'], $car_data['year']];
                $labels = ['Mileage', 'Horse Power', 'Fuel', 'Shift', 'Production'];

                for ($i = 0; $i < count($data); $i++) {
                    $value = $data[$i];
                    if ($labels[$i] === 'Mileage') {
                        $value = Format::format_number($data[$i], 0) . '<small>km</small>';
                    } else if ($labels[$i] === 'Horse Power') {
                        $value = Format::format_number($data[$i], 0) . '<small>hp</small>';
                    }

                    echo "
                        <li class='car-features-list-item'>
                            <figure class='figure-feature'>
                                <img src='" . DOMAIN . "/assets/media/{$icons[$i]}-icon.png' alt='Feature'>
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
                        'Make' => $car_data['make'],
                        'Model' => $car_data['model'],
                        'Year of Production' => $car_data['year'],
                        'Mileage' => $car_data['mileage'],
                        'Horse Power' => $car_data['horse_power'],
                        'Fuel' => $car_data['fuel'],
                        'Shift' => $car_data['shift'],
                        'Color' => $car_data['color'],
                        'Original Price' => $car_data['original_price'],
                        'Final Price' => $car_data['final_price'],
                        'Added On' => $car_data['date_added']
                    ];

                    foreach ($data as $label => $value) {
                        $class_name = strtolower(implode('-', explode(' ', $label)));

                        $attr = '';
                        if ($label === 'Mileage') {
                            $value = sprintf('%s<small>km</small>', Format::format_number($value, 0));
                        } else if ($label === 'Horse Power') {
                            $value = sprintf('%s<small>hp</small>', Format::format_number($value, 0));
                        } else if ($label === 'Color') {
                            $attr = "data-color='{$value}'";
                        } else if (str_contains($label, 'Price')) {
                            $value = sprintf('<small>$</small>%s', Format::format_number($value, 2));
                        } else if ($label === 'Added On') {
                            $value = date_format(date_create($value), 'F jS, Y');
                        }

                        echo "
                            <li class='car-description-list-item'>
                                <span class='span-list-item-dot'>&nbsp;</span>
                                <p class='{$class_name}'>
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
                    <img src="data:image/png;base64,<?php echo $car_image; ?>" alt="Car Image">
                </div>
                <?php if (!isset($user_role_id) || $user_role_id === 2) { ?>
                <form action="<?php echo DOMAIN; ?>/checkout" method="POST">
                    <input id="checkout_car_id" type="hidden" name="checkout_car_id" value="<?php echo $car_id; ?>">
                    <button class="btn btn-primary">Checkout</button>
                </form>
                <?php } ?>
            </div>
        </section>
    </main>
