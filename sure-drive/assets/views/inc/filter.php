            <!-- ASIDE FILTER OPTIONS -->
            <aside class="aside-filter-options">
                <form 
                    class="form form-filter-options"
                    action="<?php echo SERVER; ?>/api/filter.php" 
                    method="POST"
                >
                    <!-- FILTER OPTIONS HEADER -->
                    <header class="filter-options-header">
                        <h3 class="heading-tertiary">Filter Options</h3>
                        <button class="icon-btn aside-icon-btn" type="button">
                            <ion-icon class="aside-icon" name="close-outline"></ion-icon>
                        </button>
                    </header>
                    <!-- FILTER BY MAKE -->
                    <ul class="filter-option-list">
                        <li class="filter-option-list-item">
                            <div class="div-filter-heading-container">
                                <div class="div-dot">&nbsp;</div>
                                <span class="span-filter-heading">Make:</span>
                            </div>
                            <ul class="checkbox-list make-checkbox-list" data-filter-name="make">
                                <?php
                                $makes = $database->getDistinctCarMakes();
                                foreach ($makes as $make) {
                                    echo "
                                        <li class='checkbox-list-item' data-make='{$make['make']}'>
                                            <div class='div-checkbox'>
                                                <ion-icon name='checkmark-outline'></ion-icon>
                                            </div>
                                            <span>{$make['make']}</span>
                                        </li>
                                    ";
                                }
                                ?>
                            </ul>
                        </li>
                        <!-- FILTER BY FUEL -->
                        <li class="filter-option-list-item">
                            <div class="div-filter-heading-container">
                                <div class="div-dot">&nbsp;</div>
                                <span class="span-filter-heading">Fuel:</span>
                            </div>
                            <ul class="checkbox-list fuel-checkbox-list" data-filter-name="fuel">
                                <li class="checkbox-list-item" data-fuel="Diesel">
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>Diesel</span>
                                </li>
                                <li class="checkbox-list-item" data-fuel="Gasoline">
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>Gasoline</span>
                                </li>
                                <li class="checkbox-list-item" data-fuel="Electric">
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>Electric</span>
                                </li>
                            </ul>
                        </li>
                        <!-- FILTER BY SHIFT -->
                        <li class="filter-option-list-item">
                            <div class="div-filter-heading-container">
                                <div class="div-dot">&nbsp;</div>
                                <span class="span-filter-heading">Shift:</span>
                            </div>
                            <ul class="checkbox-list shift-checkbox-list" data-filter-name="shift">
                                <li class="checkbox-list-item" data-shift="Manual">
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>Manual</span>
                                </li>
                                <li class="checkbox-list-item" data-shift="Automatic">
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>Automatic</span>
                                </li>
                            </ul>
                        </li>
                        <!-- FILTER BY YEAR -->
                        <li class="filter-option-list-item">
                            <div class="div-filter-heading-container">
                                <div class="div-dot">&nbsp;</div>
                                <span class="span-filter-heading">Year:</span>
                            </div>
                            <div class="div-input-range-container">
                                <input id="range_year_min" type="number" min="2000" step="1">
                                <span>to</span>
                                <input id="range_year_max" type="number" max="<?php echo date('Y'); ?>" step="1">
                            </div>
                            <ul class="checkbox-list year-checkbox-list" data-filter-name="year">
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="2000"
                                    data-max="2004"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>2000 &mdash; 2004</span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="2004"
                                    data-max="2008"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>2004 &mdash; 2008</span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="2008"
                                    data-max="2012"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>2008 &mdash; 2012</span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="2012"
                                    data-max="2016"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>2012 &mdash; 2016</span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="2016" 
                                    data-max="<?php echo date('Y'); ?>"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>&gt; 2016</span>
                                </li>
                            </ul>
                        </li>
                        <!-- FILTER BY MILEAGE -->
                        <li class="filter-option-list-item">
                            <div class="div-filter-heading-container">
                                <div class="div-dot">&nbsp;</div>
                                <span class="span-filter-heading">Mileage (km):</span>
                            </div>
                            <div class="div-input-range-container">
                                <input id="range_mileage_min" type="number" min="0" step="10000">
                                <span>to</span>
                                <input id="range_mileage_max" type="number" min="0" step="10000">
                            </div>
                            <ul class="checkbox-list mileage-checkbox-list" data-filter-name="mileage">
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="10000"
                                    data-max="20000"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>
                                        10,000<small>km</small> &mdash; 20,000<small>km</small>
                                    </span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="20000"
                                    data-max="30000"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>
                                        20,000<small>km</small> &mdash; 30,000<small>km</small>
                                    </span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="30000"
                                    data-max="40000"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>
                                        30,000<small>km</small> &mdash; 40,000<small>km</small>
                                    </span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="40000"
                                    data-max="50000"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>
                                        40,000<small>km</small> &mdash; 50,000<small>km</small>
                                    </span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="50000"
                                    data-max="<?php echo $database->getMaxValue('mileage', 'description')['max']; ?>"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>
                                        &gt; 50,000<small>km</small>
                                    </span>
                                </li>
                            </ul>
                        </li>
                        <!-- FILTER BY PRICE -->
                        <li class="filter-option-list-item">
                            <div class="div-filter-heading-container">
                                <div class="div-dot">&nbsp;</div>
                                <span class="span-filter-heading">Price ($):</span>
                            </div>
                            <div class="div-input-range-container">
                                <input id="range_price_min" type="number" min="0" step="1000">
                                <span>to</span>
                                <input id="range_price_max" type="number" min="0" step="1000">
                            </div>
                            <ul class="checkbox-list price-checkbox-list" data-filter-name="final_price">
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="10000"
                                    data-max="20000"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>
                                        <small>$</small>10,000 &mdash; <small>$</small>20,000
                                    </span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="20000"
                                    data-max="30000"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>
                                        <small>$</small>20,000 &mdash; <small>$</small>30,000
                                    </span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="30000"
                                    data-max="40000"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>
                                        <small>$</small>30,000 &mdash; <small>$</small>40,000
                                    </span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="40000"
                                    data-max="50000"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>
                                        <small>$</small>40,000 &mdash; <small>$</small>50,000
                                    </span>
                                </li>
                                <li 
                                    class="checkbox-list-item" 
                                    data-min="50000"
                                    data-max="<?php echo $database->getMaxValue('final_price', 'description')['max']; ?>"
                                >
                                    <div class="div-checkbox">
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    </div>
                                    <span>
                                        &gt; <small>$</small>50,000
                                    </span>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- FILTER BUTTON -->
                    <div class="div-sticky-btn-container">
                        <button class="btn btn-primary btn-filter" type="submit">Filter</button>
                    </div>
                </form>
            </aside>
            <!-- ASIDE OVERLAY -->
            <div class="aside-overlay">&nbsp;</div>
