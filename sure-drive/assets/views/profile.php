<?php
if (!Session::is_set('logged_in')) {
    Redirect::redirect_to('/login');
}

// User data.
$user_data = $database->get_user_data($username);
$user_id = (int) $user_data['user_id'];
$profile_image = Image::render_image('user', $user_data['user_image']);
$email = $user_data['user_email'];
$phone = $user_data['user_phone'];
$location = $user_data['location'];

// Role specific data.
$role_id = (int) $user_data['role_id'];
$role_name = $user_data['role_name'];
$user_type = strtolower($role_name);
if ($role_id === 3) {
    [$commission] = $database->get_user_type_data($user_type, $user_id);
}

require_once 'assets/inc/popup.php';
?>

    <!-- MAIN CONTAINER -->
    <main class="main-container">
        <!-- SECTION USER DETAILS -->
        <section class="section-user-details">
            <!-- USER PROFILE -->
            <div class="div-user-profile-container">
                <span class="span-profile-user-id">
                    <small>#</small><?php echo $user_id; ?>
                </span>
                <div class="div-profile-img-container">
                    <div 
                        class="div-edit-btn-icon-container" 
                        data-img-id="user/<?php echo $user_id; ?>"
                    >
                        <button class="btn-edit-img">
                            <ion-icon name="pencil"></ion-icon>
                        </button>
                    </div>
                    <img src="data:image/jpeg;base64,<?php echo $profile_image; ?>" alt="Profile Image">
                </div>
                <div class="div-user-info-container">
                    <h2 class="heading-secondary"><?php echo $username; ?></h2>
                    <span class="span-verified-icon">
                        <ion-icon name="checkmark-outline"></ion-icon>
                    </span>
                </div>
            </div>
            <!-- USER DETAILS -->
            <div class="div-user-details-container">
                <header class="user-details-header">
                    <h2 class="heading-tertiary">Profile Details</h2>
                </header>
                <form 
                    class="form" 
                    action="<?php echo DOMAIN; ?>/api/profile.php" 
                    method="PUT"
                >
                    <div class="div-multi-input-containers grid-2-columns">
                        <div class="div-input-container">
                            <label for="edit_profile_username">Username:</label>
                            <div class="div-input-icon-container">
                                <input id="edit_profile_username" type="text" name="username" value="<?php echo $username; ?>">
                                <ion-icon name="person"></ion-icon>
                            </div>
                        </div>
                        <div class="div-input-container">
                            <label for="edit_profile_email">Email:</label>
                            <div class="div-input-icon-container">
                                <input id="edit_profile_email" type="email" name="email" value="<?php echo $email; ?>">
                                <ion-icon name="mail"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="div-multi-input-containers grid-2-columns">
                        <div class="div-input-container">
                            <label for="edit_profile_phone">Phone Number:</label>
                            <div class="div-input-icon-container">
                                <input id="edit_profile_phone" type="tel" name="phone" value="<?php echo $phone; ?>">
                                <ion-icon name="call"></ion-icon>
                            </div>
                        </div>
                        <div class="div-input-container">
                            <label for="edit_profile_location">Location (City, Country):</label>
                            <div class="div-input-icon-container">
                                <input id="edit_profile_location" type="text" name="location" value="<?php echo $location; ?>">
                                <ion-icon name="location"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="div-form-btn-container">
                        <button class="btn btn-primary btn-save-profile">Save</button>
                    </div>
                    <div class="div-hidden-inputs-container">
                        <input id="edit_profile_id" type="hidden" name="id" value="<?php echo $user_id; ?>">
                    </div>
                </form>
            </div>
        </section>
        <?php
        if ($role_id === 1) {
            $users = $database->get_all_users();
            $users_label = 'Total Users';
            $users_icon = 'people';

            $cars = $database->get_all_cars();
            $cars_label = 'Total Cars';

            $sales = $database->get_all_sales();
            $sales_label = 'Total Sales';
            $sales_icon = 'pricetag';
        } else {
            $funds_icon = 'card';
            if ($role_id === 2) {
                [$user_type_data] = $database->get_user_type_data($user_type, $user_id);
                $cars = $database->get_bought_cars_by_user_id($user_id);

                $funds = Format::format_number($user_type_data['funds_spent'], 2);
                $funds_label = 'Funds Spent';
                $cars_label = 'Cars Bought';
            } else {
                [$user_type_data] = $database->get_user_type_data($user_type, $user_id);
                $cars = $database->get_cars_for_user_id($user_type, $user_id);

                $funds = Format::format_number($user_type_data['funds_made'], 2);
                $funds_label = 'Funds Made';
                $cars_label = 'Cars ' . ($role_id === 3 ? 'Sold' : 'Owned');
                $total_cars = $user_type_data[strtolower(implode('_', explode(' ', $cars_label)))];
            }

            $sales = $database->get_sales_for_user_id($user_id);

            [$member_date] = explode(' ', $user_data['member_since']);
            $member_since = date_format(date_create($member_date), 'M jS, Y');
            $member_label = 'Member Since';
            $member_icon = 'calendar-clear';
        }
        ?>
        <!-- SECTION DASHBOARD -->
        <section class="section-dashboard">
            <?php if ($role_id === 3) { ?>
            <button class="btn-edit-commission">
                <ion-icon name="pie-chart"></ion-icon>
                <span>Commission</span>
            </button>    
            <?php } ?>
            <!-- SECTION DASHBOARD HEADER -->
            <header class="section-dashboard-header">
                <span class="span-section-subheading">Profile Dashboard</span>
            </header>
            <ul class="dashboard-features-list grid-4-columns">
                <li class="dashboard-features-list-item">
                    <div class="div-dashboard-feature-icon">
                        <span class="span-feature-icon">
                            <ion-icon name="man"></ion-icon>
                        </span>
                        <p><?php echo $role_name; ?></p>
                    </div>
                    <span>Type of Role</span>
                </li>
                <li class="dashboard-features-list-item">
                    <div class="div-dashboard-feature-icon">
                        <span class="span-feature-icon">
                            <ion-icon name="<?php echo $role_id === 1 ? $users_icon : $funds_icon; ?>"></ion-icon>
                        </span>
                        <p><?php echo $role_id === 1 ? count($users) : "<small>\$</small>{$funds}"; ?></p>
                    </div>
                    <span><?php echo $role_id === 1 ? $users_label : $funds_label; ?></span>
                </li>
                <li class="dashboard-features-list-item">
                    <div class="div-dashboard-feature-icon">
                        <span class="span-feature-icon">
                            <ion-icon name="car-sport"></ion-icon>
                        </span>
                        <p><?php echo $role_id < 3 ? count($cars) : $total_cars; ?></p>
                    </div>
                    <span><?php echo $cars_label; ?></span>
                </li>
                <li class="dashboard-features-list-item">
                    <div class="div-dashboard-feature-icon">
                        <span class="span-feature-icon">
                            <ion-icon name="<?php echo $role_id === 1 ? $sales_icon : $member_icon; ?>"></ion-icon>
                        </span>
                        <p><?php echo $role_id === 1 ? count($sales) : $member_since; ?></p>
                    </div>
                    <span><?php echo $role_id === 1 ? $sales_label : $member_label ?></span>
                </li>
            </ul>
        </section>
        <!-- SECTION LIST CONTAINER -->
        <section class="section-list-containers">
            <?php if ($role_id === 1) { ?>
            <!-- USERS LIST CONTAINER -->
            <div class="div-list-container users-list-container">
                <header class="list-container-header users-list-header">
                    <div class="div-heading-container">
                        <div class="div-list-heading-dot">&nbsp;</div>
                        <h3 class="heading-tertiary">Users List</h3>
                    </div>
                    <ion-icon name="people"></ion-icon>
                </header>
                <div class="div-scroll-list-container hide-element">
                    <ul class="items-list grid-4-columns">
                        <li class="items-list-item" data-card-id="user/new">
                            <div class="div-add-new">
                                <span>Add New</span>
                            </div>
                            <div class="div-user-card-header">
                                <div class="div-edit-btns-container">
                                    <button class="btn-modify">
                                        <ion-icon name="add-outline"></ion-icon>
                                    </button>
                                </div>
                                <div class="div-user-img-container">
                                    <img src="<?php echo DOMAIN; ?>/assets/media/user-placeholder.jpeg" alt="Placeholder">
                                </div>
                                <div class="div-user-card-header-text-container">
                                    <h4 class="heading-quaternary">Username</h4>
                                    <div class="div-verified-container">
                                        <p>Role</p>
                                        <span class="span-verified-icon">
                                            <ion-icon name="checkmark-outline"></ion-icon>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <ul class="user-card-details-list">
                                <li class="user-card-details-list-item">
                                    <ion-icon name="location"></ion-icon>
                                    <div class="div-location-container">
                                        <span>Country Name</span>
                                        <a href="#">
                                            City Location
                                        </a>
                                    </div>
                                </li>
                                <li class="user-card-details-list-item">
                                    <ion-icon name="mail"></ion-icon>
                                    <a href="#">
                                        user@example.com
                                    </a>
                                </li>
                                <li class="user-card-details-list-item">
                                    <ion-icon name="call"></ion-icon>
                                    <a href="#">
                                        +123 45 678 9101
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                        foreach ($users as $user) {
                            $id = (int) $user['user_id'];

                            if ($user_id !== $id) {
                                $image = Image::render_image('user', $user['user_image']);
                                $name = $user['username'];
                                $user_role_id = $user['role_id'];
                                $user_role_name = $user['role_name'];

                                $location = $user['location'];
                                $location_parts = explode(',', $location);
                                $country = trim($location_parts[1]);
                                $city = trim($location_parts[0]);

                                $email = $user['user_email'];
                                $phone = $user['user_phone'];

                                echo "
                                    <li class='items-list-item' data-card-id='user/{$id}'>
                                        <div class='div-user-card-header'>
                                            <span class='span-card-item-id'>
                                                <small>#</small>{$id}
                                            </span>
                                            <div class='div-edit-btns-container'>
                                                <button class='btn-trash'>
                                                    <ion-icon name='trash'></ion-icon>
                                                </button>
                                                <button class='btn-modify'>
                                                    <ion-icon name='pencil'></ion-icon>
                                                </button>
                                            </div>
                                            <div 
                                                class='div-user-img-container'
                                            >
                                                <div 
                                                    class='div-edit-btn-icon-container' 
                                                    data-img-id='user/{$id}'
                                                >
                                                    <button class='btn-edit-img'>
                                                        <ion-icon name='pencil'></ion-icon>
                                                    </button>
                                                </div>
                                                <img src='data:image/jpeg;base64,{$image}' alt='User Image'>
                                            </div>
                                            <div class='div-user-card-header-text-container'>
                                                <h4 class='heading-quaternary'>{$name}</h4>
                                                <div class='div-verified-container'>
                                                    <p>{$user_role_name}</p>
                                                    <span class='span-verified-icon'>
                                                        <ion-icon name='checkmark-outline'></ion-icon>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class='user-card-details-list'>
                                            <li class='user-card-details-list-item'>
                                                <ion-icon name='location'></ion-icon>
                                                <div class='div-location-container'>
                                                    <span>{$country}</span>
                                                    <a href='https://www.google.com/maps/place/{$city}' target='_blank'>
                                                        {$city}
                                                    </a>
                                                </div>
                                            </li>
                                            <li class='user-card-details-list-item'>
                                                <ion-icon name='mail'></ion-icon>
                                                <a href='mailto:{$email}'>
                                                    {$email}
                                                </a>
                                            </li>
                                            <li class='user-card-details-list-item'>
                                                <ion-icon name='call'></ion-icon>
                                                <a href='tel:{$phone}'>
                                                    {$phone}
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- CAR HIDDEN DETAILS -->
                                        <div class='div-hidden-inputs-container'>
                                            <input id='edit_user_id_{$id}' type='hidden' value='{$id}'>
                                            <input id='edit_user_username_{$id}' type='hidden' value='{$name}'>
                                            <input id='edit_user_email_{$id}' type='hidden' value='{$email}'>
                                            <input id='edit_user_phone_{$id}' type='hidden' value='{$phone}'>
                                            <input id='edit_user_location_{$id}' type='hidden' value='{$location}'>
                                            <input id='edit_user_role_id_{$id}' type='hidden' value='{$user_role_id}'>
                                        </div>
                                    </li>
                                ";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php } ?>
            <!-- CARS LIST CONTAINER -->
            <div class="div-list-container cars-list-container">
                <header class="list-container-header cars-list-header">
                    <div class="div-heading-container">
                        <div class="div-list-heading-dot">&nbsp;</div>
                        <h3 class="heading-tertiary">Cars List</h3>
                    </div>
                    <ion-icon name="car-sport"></ion-icon>
                </header>
                <div class="div-scroll-list-container hide-element">
                    <ul class="items-list grid-4-columns">
                        <?php if ($role_id !== 2) { ?>
                        <!-- ADD NEW CAR TO THE LIST -->
                        <li class="items-list-item" data-card-id="car/new">
                            <div class="div-add-new">
                                <span>Add New</span>
                            </div>
                            <div class="div-car-img-container">
                                <img src="<?php echo DOMAIN; ?>/assets/media/car-placeholder.jpeg" alt="Placeholder">
                            </div>
                            <div class="div-card-text-container">
                                <div class="div-edit-btns-container">
                                    <button class="btn-modify">
                                        <ion-icon name="add-outline"></ion-icon>
                                    </button>
                                </div>
                                <h3 class="heading-tertiary">Car Name</h3>
                                <ul class='card-details-list'>
                                    <li class='card-details-list-item'>
                                        <span class="span-card-details-dot">&nbsp;</span>
                                        <p>
                                            <strong>Mileage</strong> &mdash; New
                                        </p>
                                    </li>
                                    <li class='card-details-list-item'>
                                        <span class="span-card-details-dot">&nbsp;</span>
                                        <p>
                                            <strong>Year of Production</strong> &mdash; New
                                        </p>
                                    </li>
                                    <li class='card-details-list-item'>
                                        <span class="span-card-details-dot">&nbsp;</span>
                                        <p>
                                            <strong>Shift</strong> &mdash; New
                                        </p>
                                    </li>
                                </ul>
                                <div class='div-price-container grid-2-columns'>
                                    <span class='span-previous-price'>
                                        Org. Price
                                    </span>
                                    <span class='span-current-price'>
                                        Fin. Price
                                    </span>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                        <?php
                        if ($role_id !== 2) {
                            foreach ($cars as $car) {
                                $id = $car['car_id'];
                                $car_seller_id = $car['seller_id'];
                                $car_owner_id = $car['owner_id'];
                                $make = $car['make'];
                                $model = $car['model'];
                                $name = "{$make} {$model}";
                                $year = $car['year'];
                                $note = $car['note'];
                                $image = Image::render_image('car', $car['car_image']);
                                $mileage = $car['mileage'];
                                $horse_power = $car['horse_power'];
                                $fuel = $car['fuel'];
                                $color = $car['color'];
                                $shift = $car['shift'];

                                // Formatting prices.
                                $original_price = $car['original_price'];
                                $original_formatted = Format::format_number($original_price, 2);
                                $final_price = $car['final_price'];
                                $final_formatted = Format::format_number($final_price, 2);

                                echo "
                                    <li class='items-list-item' data-card-id='car/{$id}'>
                                        <div class='div-car-img-container'>
                                            <span class='span-card-item-id'>
                                                <small>#</small>{$id}
                                            </span>
                                            <div 
                                                class='div-edit-btn-icon-container' 
                                                data-img-id='car/{$id}'
                                            >
                                                <button class='btn-edit-img'>
                                                    <ion-icon name='pencil'></ion-icon>
                                                </button>
                                            </div>
                                            <img src='data:image/jpeg;base64,{$image}' alt='Car Image'>
                                        </div>
                                        <div class='div-card-text-container'>
                                            <button class='btn-grid btn-toggle-car-edit-btns' data-container-id='{$id}'>
                                                <ion-icon name='grid'></ion-icon>
                                            </button>
                                            <div class='div-car-edit-btns-container' data-container-id='{$id}'>
                                                <button class='btn-trash'>
                                                    <ion-icon name='trash'></ion-icon>
                                                </button>
                                                <button class='btn-modify'>
                                                    <ion-icon name='pencil'></ion-icon>
                                                </button>
                                                <a class='btn-view-details' href='" . DOMAIN . "/details/{$id}'>
                                                    <ion-icon name='eye'></ion-icon>
                                                </a>
                                                <button class='btn-toggle-car-edit-btns' data-container-id='{$id}'>
                                                    <ion-icon name='chevron-up'></ion-icon>
                                                </button>
                                            </div>
                                            <h3 class='heading-tertiary'>{$name}</h3>
                                            <ul class='card-details-list'>
                                                <li class='card-details-list-item'>
                                                    <span class='span-card-details-dot'>&nbsp;</span>
                                                    <p>
                                                        <strong>Mileage</strong> &mdash; {$mileage}<small>km</small>
                                                    </p>
                                                </li>
                                                <li class='card-details-list-item'>
                                                    <span class='span-card-details-dot'>&nbsp;</span>
                                                    <p>
                                                        <strong>Year of Production</strong> &mdash; {$year}
                                                    </p>
                                                </li>
                                                <li class='card-details-list-item'>
                                                    <span class='span-card-details-dot'>&nbsp;</span>
                                                    <p>
                                                        <strong>Shift</strong> &mdash; {$shift}
                                                    </p>
                                                </li>
                                            </ul>
                                            <div class='div-price-container grid-2-columns'>
                                                <span class='span-previous-price'>
                                                    <small>\$</small>{$original_formatted}
                                                </span>
                                                <span class='span-current-price'>
                                                    <small>\$</small>{$final_formatted}
                                                </span>
                                            </div>
                                        </div>
                                        <!-- CAR HIDDEN DETAILS -->
                                        <div class='div-hidden-inputs-container'>
                                            <input id='edit_car_id_{$id}' type='hidden' value='{$id}'>
                                            <input id='edit_car_seller_id_{$id}' type='hidden' value='{$car_seller_id}'>
                                            <input id='edit_car_owner_id_{$id}' type='hidden' value='{$car_owner_id}'>
                                            <input id='edit_car_make_{$id}' type='hidden' value='{$make}'>
                                            <input id='edit_car_model_{$id}' type='hidden' value='{$model}'>
                                            <input id='edit_car_year_{$id}' type='hidden' value='{$year}'>
                                            <input id='edit_car_note_{$id}' type='hidden' value='{$note}'>
                                            <input id='edit_car_mileage_{$id}' type='hidden' value='{$mileage}'>
                                            <input id='edit_car_horse_power_{$id}' type='hidden' value='{$horse_power}'>
                                            <input id='edit_car_fuel_{$id}' type='hidden' value='{$fuel}'>
                                            <input id='edit_car_color_{$id}' type='hidden' value='{$color}'>
                                            <input id='edit_car_shift_{$id}' type='hidden' value='{$shift}'>
                                            <input id='edit_car_original_price_{$id}' type='hidden' value='{$original_price}'>
                                            <input id='edit_car_final_price_{$id}' type='hidden' value='{$final_price}'>
                                        </div>
                                    </li>
                                ";
                            }
                        } else {
                            foreach ($cars as $car) {
                                $id = $car['car_id'];
                                $make = $car['make'];
                                $model = $car['model'];
                                $name = "{$make} {$model}";
                                $year = $car['year'];
                                $image = Image::render_image('car', $car['car_image']);
                                $mileage = $car['mileage'];
                                $shift = $car['shift'];

                                // Formatting the price.
                                $final_price = $car['final_price'];
                                $final_formatted = Format::format_number($final_price, 2);

                                echo "
                                    <li class='items-list-item'>
                                        <div class='div-car-img-container'>
                                            <span class='span-card-item-id'>
                                                <small>#</small>{$id}
                                            </span>
                                            <img src='data:image/jpeg;base64,{$image}' alt='Car Image'>
                                        </div>
                                        <div class='div-card-text-container'>
                                            <h3 class='heading-tertiary'>{$name}</h3>
                                            <ul class='card-details-list'>
                                                <li class='card-details-list-item'>
                                                    <span class='span-card-details-dot'>&nbsp;</span>
                                                    <p>
                                                        <strong>Mileage</strong> &mdash; {$mileage}<small>km</small>
                                                    </p>
                                                </li>
                                                <li class='card-details-list-item'>
                                                    <span class='span-card-details-dot'>&nbsp;</span>
                                                    <p>
                                                        <strong>Year of Production</strong> &mdash; {$year}
                                                    </p>
                                                </li>
                                                <li class='card-details-list-item'>
                                                    <span class='span-card-details-dot'>&nbsp;</span>
                                                    <p>
                                                        <strong>Shift</strong> &mdash; {$shift}
                                                    </p>
                                                </li>
                                            </ul>
                                            <div class='div-price-container'>
                                                <span class='span-current-price'>
                                                    <small>\$</small>{$final_formatted}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                ";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- SALES LIST CONTAINER -->
            <div class="div-list-container sales-list-container">
                <header class="list-container-header sales-list-header">
                    <div class="div-heading-container">
                        <div class="div-list-heading-dot">&nbsp;</div>
                        <h3 class="heading-tertiary">Sales List</h3>
                    </div>
                    <ion-icon name="analytics"></ion-icon>
                </header>
                <div class="div-scroll-list-container hide-element">
                    <ul class="items-list grid-3-columns">
                        <?php
                        foreach ($sales as $sale) {
                            $id = $sale['sale_id'];
                            $car_name = $sale['car_name'];
                            $buyer = $sale['buyer'];
                            $seller = $sale['seller'];
                            $owner = $sale['owner'];
                            $commission = $sale['commission'];
                            $total_price = Format::format_number($sale['total_price'], 2);
                            $date = date_format(date_create($sale['date']), 'M jS, Y');

                            echo "
                                <li class='items-list-item'>
                                    <header class='items-list-item-header'>
                                        <h4 class='heading-quaternary'>Sale Item</h4>
                                        <span><small>#</small>{$id}</span>
                                    </header>
                                    <div class='div-sale-details-container'>
                                        <div class='div-flex-container'>
                                            <span>Car:</span>
                                            <p>{$car_name}</p>
                                        </div>
                                        <div class='div-flex-container'>
                                            <span>Buyer:</span>
                                            <p>{$buyer}</p>
                                        </div>
                                        <div class='div-flex-container'>
                                            <span>Seller:</span>
                                            <p>{$seller}</p>
                                        </div>
                                        <div class='div-flex-container'>
                                            <span>Owner:</span>
                                            <p>{$owner}</p>
                                        </div>
                                        <div class='div-flex-container'>
                                            <span>Commission:</span>
                                            <p>{$commission}%</p>
                                        </div>
                                        <div class='div-flex-container'>
                                            <span>Total Price:</span>
                                            <p><span>\$</span>{$total_price}</p>
                                        </div>
                                        <div class='div-flex-container'>
                                            <span>Date:</span>
                                            <p>{$date}</p>
                                        </div>
                                    </div>
                                </li>
                            ";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    </main>
