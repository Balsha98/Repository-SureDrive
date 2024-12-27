    <!-- MAIN CONTAINER -->
    <main class="main-container">
        <!-- HERO SECTION -->
        <section class="section-hero">
            <!-- CAROUSEL BUTTON PREVIOUS -->
            <div class="div-carousel-btn-container div-btn-carousel-left">
                <button class="btn-carousel" data-direction="prev">
                    <ion-icon name="chevron-back-outline"></ion-icon>
                </button>
            </div>
            <?php
            $cars = $database->get_all_cars();
            foreach ($cars as $i => $car) {
                if ($i < 3) {
                    $hero_id = $i + 1;
                    $translate = $i * 100;

                    $car_id = $car['car_id'];
                    $name = "{$car['make']} {$car['model']}";
                    $image = Image::render_image('car', $car['car_image']);
                    $year = $car['year'];

                    if ($i === 0) {
                        $first_car_id = $car_id;
                        $first_car_name = $name;
                        $first_car_year = $year;
                    }

                    echo "
                        <div 
                            class='div-hero-img-container translate-{$translate}-x' 
                            data-hero-car='{$hero_id}' 
                            data-name='{$name}' 
                            data-year='{$year}' 
                            data-id='{$car_id}'
                        >
                            <img src='data:image/png;base64,{$image}' alt='Placeholder'>
                        </div>
                    ";
                } else {
                    break;
                }
            }
            ?>
            <!-- CAROUSEL INFO CONTAINER -->
            <header class='section-hero-header'>
                <div class='hero-header-text-container'>
                    <h2 class='heading-secondary heading-car-name'><?php echo $first_car_name; ?></h2>
                    <p>Year of Production &mdash; <span class="span-production-year"><?php echo $first_car_year; ?></span></p>
                </div>
                <a 
                    class='btn btn-primary btn-view-details' 
                    href='<?php echo DOMAIN; ?>/details/<?php echo $first_car_id; ?>'
                >
                    View Details
                </a>
            </header>
            <!-- CAROUSEL LINES -->
            <ul class="lines-list">
                <li class="lines-list-item active-line" data-hero-car="1">&nbsp;</li>
                <li class="lines-list-item" data-hero-car="2">&nbsp;</li>
                <li class="lines-list-item" data-hero-car="3">&nbsp;</li>
            </ul>
            <div class='blur-overlay'>&nbsp;</div>
            <!-- CAROUSEL BUTTON NEXT -->
            <div class="div-carousel-btn-container div-btn-carousel-right">
                <button class="btn-carousel" data-direction="next">
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                </button>
            </div>
        </section>
        <!-- CARS SECTION -->
        <section id="section-cars" class="section-cars">
            <?php
            // FILTER OPTIONS FILE
            require_once 'assets/inc/filter.php';
            ?>
            <!-- CARS CONTAINER -->
            <div class="div-cars-container">
                <!-- SEARCH OPTIONS CONTAINER -->
                <div class="div-search-options-container">
                    <!-- FILTER OPTIONS BUTTON -->
                    <button class="btn btn-primary aside-icon-btn btn-show-filter">
                        <ion-icon class="aside-icon" name="filter-outline"></ion-icon>
                        <span>Filter Options</span>
                    </button>
                    <!-- SORT OPTIONS CONTAINER -->
                    <div class="div-sort-options-container">
                        <h4 class="heading-quaternary">Sort By</h4>
                        <select class="select-sort" name="select-sort">
                            <option value="0">&mdash; Select Option &mdash;</option>
                            <option value="price/low">Price (Cheapest)</option>
                            <option value="price/high">Price (Costliest)</option>
                            <option value="production/low">Production (Oldest)</option>
                            <option value="production/high">Production (Latest)</option>
                            <option value="date/low">Date Added (Oldest)</option>
                            <option value="date/high">Date Added (Latest)</option>
                        </select>
                    </div>
                </div>
                <!-- CARS GRID CONTAINER -->
                <div class="div-cars-grid-container grid-4-columns">
                    <?php
                    foreach ($cars as $car) {
                        $id = $car['car_id'];
                        $name = "{$car['make']} {$car['model']}";
                        $mileage = $car['mileage'];
                        $shift = $car['shift'];
                        $year = $car['year'];
                        $date_added = $car['date_added'];
                        $image = Image::render_image('car', $car['car_image']);
                        $original_price = $car['original_price'];
                        if (is_null($original_price)) {
                            $original_price = '';
                        }

                        $original_formatted = Format::format_number($car['original_price'], 2);
                        $final_price = $car['final_price'];
                        $final_formatted = Format::format_number($car['final_price'], 2);

                        echo "
                            <div 
                                class='div-car-card-container' 
                                data-href='" . DOMAIN . "/details/{$id}' 
                                data-target='_self' 
                                data-car-id='{$id}' 
                                data-price='{$final_price}' 
                                data-production='{$year}' 
                                data-date='{$date_added}'
                            >
                                <div class='div-car-img-container'>
                                    <img src='data:image/jpeg;base64,{$image}' alt='Car Image'>
                                </div>
                                <div class='div-car-text-container'>
                                    <h3 class='heading-tertiary'>{$name}</h3>
                                    <ul class='car-details-list'>
                                        <li class='car-details-list-item'>
                                            <span class='span-details-dot'>&nbsp;</span>
                                            <p>
                                                <strong>Mileage</strong> &mdash; {$mileage}<small>km</small>
                                            </p>
                                        </li>
                                        <li class='car-details-list-item'>
                                            <span class='span-details-dot'>&nbsp;</span>
                                            <p>
                                                <strong>Year of Production</strong> &mdash; {$year}
                                            </p>
                                        </li>
                                        <li class='car-details-list-item'>
                                            <span class='span-details-dot'>&nbsp;</span>
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
                            </div>
                        ";
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
