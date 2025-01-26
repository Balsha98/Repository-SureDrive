    <?php if ($roleID !== 2) { ?>
    <?php if ($roleID === 1) { ?>
    <!-- MODIFY USER POPUP -->
    <div class="div-popup popup-modify-user">
        <button class="btn-close-popup">
            <ion-icon name="close-outline"></ion-icon>
        </button>
        <header class="popup-header">
            <h2 class="heading-secondary">
                <span class="span-action-upper">&nbsp;</span> User
            </h2>
            <p>
                You are about to <span class="span-action-lower">&nbsp;</span> a user.
            </p>
        </header>
        <form 
            class="form form-modify form-modify-user form-add-user hide-element" 
            action="<?php echo SERVER; ?>/api/profile.php" 
            enctype="multipart/form-data" 
            data-form-type="user/add"
            method="{}"
        >
            <div class="div-multi-input-containers grid-3-columns">
                <div class="div-input-container required-input-container">
                    <label for="add_user_username">Username:</label>
                    <div class="div-input-icon-container">
                        <input id="add_user_username" type="text" name="username">
                        <ion-icon name="person"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="add_user_password">Password:</label>
                    <div class="div-input-icon-container">
                        <input id="add_user_password" type="password" name="password">
                        <ion-icon name="lock-closed"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container">
                    <span>User Image:</span>
                    <div class="div-input-img-container user-img-container" data-content="Select new image.">
                        <label class="label-img-upload" for="add_user_image" data-img-type="user">Choose</label>
                        <input id="add_user_image" type="file" name="image" accept="image/jpeg">
                    </div>
                </div>
            </div>
            <div class="div-multi-input-containers grid-4-columns">
                <div class="div-input-container required-input-container">
                    <label for="add_user_email">Email:</label>
                    <div class="div-input-icon-container">
                        <input id="add_user_email" type="email" name="email">
                        <ion-icon name="mail"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container">
                    <label for="add_user_phone">Phone:</label>
                    <div class="div-input-icon-container">
                        <input id="add_user_phone" type="tel" name="phone">
                        <ion-icon name="call"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container">
                    <label for="add_user_location">Location (City, Country):</label>
                    <div class="div-input-icon-container">
                        <input id="add_user_location" type="text" name="location">
                        <ion-icon name="location"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="add_user_role_id">Type of Role:</label>
                    <div class="div-input-icon-container">
                        <select id="add_user_role_id" name="role">
                            <option value="">&nbsp; Select Role</option>
                            <option value="1">&nbsp; Administrator</option>
                            <option value="2">&nbsp; Buyer</option>
                            <option value="3">&nbsp; Seller</option>
                            <option value="4">&nbsp; Owner</option>
                        </select>
                        <ion-icon name="man"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="div-grid-btn-container grid-2-columns">
                <button class="btn btn-secondary btn-cancel" type="button">Cancel</button>
                <button class="btn btn-primary btn-form-submit" type="submit">&nbsp;</button>
            </div>
            <div class="div-hidden-inputs-container">
                <input id="add_user_id" type="hidden" name="id">
            </div>
        </form>
        <form 
            class="form form-modify form-modify-user form-edit-user" 
            action="<?php echo SERVER; ?>/api/profile.php" 
            data-form-type="user/edit" 
            method="{}"
        >
            <div class="div-multi-input-containers grid-2-columns">
                <div class="div-input-container required-input-container">
                    <label for="edit_user_username">Username:</label>
                    <div class="div-input-icon-container">
                        <input id="edit_user_username" type="text" name="username">
                        <ion-icon name="person"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="edit_user_email">Email:</label>
                    <div class="div-input-icon-container">
                        <input id="edit_user_email" type="email" name="email">
                        <ion-icon name="mail"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="div-multi-input-containers grid-3-columns">
                <div class="div-input-container">
                    <label for="edit_user_phone">Phone:</label>
                    <div class="div-input-icon-container">
                        <input id="edit_user_phone" type="tel" name="phone">
                        <ion-icon name="call"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container">
                    <label for="edit_user_location">Location (City, Country):</label>
                    <div class="div-input-icon-container">
                        <input id="edit_user_location" type="text" name="location">
                        <ion-icon name="location"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="edit_user_role_id">Type of Role:</label>
                    <div class="div-input-icon-container">
                        <select id="edit_user_role_id" name="role">
                            <option value="">&nbsp; Select Role</option>
                            <option value="1">&nbsp; Administrator</option>
                            <option value="2">&nbsp; Buyer</option>
                            <option value="3">&nbsp; Seller</option>
                            <option value="4">&nbsp; Owner</option>
                        </select>
                        <ion-icon name="man"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="div-grid-btn-container grid-2-columns">
                <button class="btn btn-secondary btn-cancel" type="button">Cancel</button>
                <button class="btn btn-primary btn-form-submit" type="submit">&nbsp;</button>
            </div>
            <div class="div-hidden-inputs-container">
                <input id="edit_user_id" type="hidden" name="id">
            </div>
        </form>
    </div>
    <?php } ?>

    <!-- MODIFY CAR POPUP -->
    <div class="div-popup popup-modify-car">
        <button class="btn-close-popup">
            <ion-icon name="close-outline"></ion-icon>
        </button>
        <header class="popup-header">
            <h2 class="heading-secondary">
                <span class="span-action-upper">&nbsp;</span> Car
            </h2>
            <p>
                You are about to <span class="span-action-lower">&nbsp;</span> a car.
            </p>
        </header>
        <form 
            class="form form-modify form-modify-car form-add-car hide-element" 
            action="<?php echo SERVER; ?>/api/profile.php" 
            enctype="multipart/form-data" 
            data-form-type="car/add" 
            method="{}"
        >
            <div class="div-multi-input-containers grid-4-columns">
                <?php $sellers_owners = $database->getSellersAndOwners(); ?>
                <div class="div-input-container required-input-container">
                    <label for="add_car_seller_id">Seller:</label>
                    <div class="div-input-icon-container">
                        <select id="add_car_seller_id" name="seller_id">
                            <option value="">&nbsp; Select Seller</option>
                            <?php
                            foreach ($sellers_owners as $user) {
                                echo "
                                    <option value='{$user['user_id']}'>
                                        &nbsp; {$user['username']}
                                    </option>
                                ";
                            }
                            ?>
                        </select>
                        <ion-icon name="person"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="add_car_owner_id">Owner:</label>
                    <div class="div-input-icon-container">
                        <select id="add_car_owner_id" name="owner_id">
                            <option value="">&nbsp; Select Owner</option>
                            <?php
                            foreach ($sellers_owners as $user) {
                                echo "
                                    <option value='{$user['user_id']}'>
                                        &nbsp; {$user['username']}
                                    </option>
                                ";
                            }
                            ?>
                        </select>
                        <ion-icon name="person"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="add_car_make">Make:</label>
                    <div class="div-input-icon-container">
                        <input id="add_car_make" type="text" name="make">
                        <ion-icon name="car-sport"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="add_car_model">Model:</label>
                    <div class="div-input-icon-container">
                        <input id="add_car_model" type="text" name="model">
                        <ion-icon name="car-sport"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="div-multi-input-containers grid-3-columns">
                <div class="div-input-container required-input-container span-2-columns">
                    <label for="add_car_note">Note:</label>
                    <textarea id="add_car_note" name="note"></textarea>
                </div>
                <div class="div-multi-input-containers">
                    <div class="div-input-container required-input-container">
                        <label for="add_car_year">Year:</label>
                        <div class="div-input-icon-container">
                            <input id="add_car_year" type="number" name="year">
                            <ion-icon name="calendar-clear"></ion-icon>
                        </div>
                    </div>
                    <div class="div-input-container required-input-container">
                        <label for="add_car_fuel">Fuel:</label>
                        <div class="div-input-icon-container">
                            <select id="add_car_fuel" name="fuel">
                                <option value="">&nbsp; Select Fuel</option>
                                <option value="Diesel">&nbsp; Diesel</option>
                                <option value="Gasoline">&nbsp; Gasoline</option>
                                <option value="Electric">&nbsp; Electric</option>
                            </select>
                            <ion-icon name="funnel"></ion-icon>
                        </div>
                    </div>
                    <div class="div-input-container required-input-container">
                        <label for="add_car_shift">Shift:</label>
                        <div class="div-input-icon-container">
                            <select id="add_car_shift" name="shift">
                                <option value="">&nbsp; Select Shift</option>
                                <option value="Manual">&nbsp; Manual</option>
                                <option value="Automatic">&nbsp; Automatic</option>
                            </select>
                            <ion-icon name="cog"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div-multi-input-containers grid-3-columns">
                <div class="div-input-container required-input-container">
                    <label for="add_car_horse_power">Horse Power:</label>
                    <div class="div-input-icon-container">
                        <input id="add_car_horse_power" type="number" name="horse_power">
                        <ion-icon name="construct"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="add_car_color">Color:</label>
                    <input id="add_car_color" type="color" name="color">
                </div>
                <div class="div-input-container">
                    <span>Car Image:</span>
                    <div class="div-input-img-container car-img-container" data-content="Select new image.">
                        <label class="label-img-upload" for="add_car_image" data-img-type="car">Choose</label>
                        <input id="add_car_image" type="file" name="image" accept="image/jpeg">
                    </div>
                </div>
            </div>
            <div class="div-multi-input-containers grid-3-columns">
                <div class="div-input-container required-input-container">
                    <label for="add_car_mileage">Mileage:</label>
                    <div class="div-input-icon-container">
                        <input id="add_car_mileage" type="number" name="mileage">
                        <ion-icon name="speedometer"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container">
                    <label for="add_car_original_price">Original Price:</label>
                    <div class="div-input-icon-container">
                        <input id="add_car_original_price" type="number" name="original_price">
                        <ion-icon name="pricetag"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="add_car_final_price">Final Price:</label>
                    <div class="div-input-icon-container">
                        <input id="add_car_final_price" type="number" name="final_price">
                        <ion-icon name="pricetag"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="div-grid-btn-container grid-2-columns">
                <button class="btn btn-secondary btn-cancel" type="button">Cancel</button>
                <button class="btn btn-primary btn-form-submit" type="submit">&nbsp;</button>
            </div>
            <div class="div-hidden-inputs-container">
                <input id="add_car_id" type="hidden" name="id">
            </div>
        </form>
        <form 
            class="form form-modify form-modify-car form-edit-car" 
            action="<?php echo SERVER; ?>/api/profile.php" 
            data-form-type="car/edit" 
            method="{}"
        >
            <div class="div-multi-input-containers grid-4-columns">
                <div class="div-input-container required-input-container">
                    <label for="edit_car_seller_id">Seller:</label>
                    <div class="div-input-icon-container">
                        <select id="edit_car_seller_id" name="seller_id">
                            <option value="">&nbsp; Select Seller</option>
                            <?php
                            foreach ($sellers_owners as $user) {
                                echo "
                                    <option value='{$user['user_id']}'>
                                        &nbsp; {$user['username']}
                                    </option>
                                ";
                            }
                            ?>
                        </select>
                        <ion-icon name="person"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="edit_car_owner_id">Owner:</label>
                    <div class="div-input-icon-container">
                        <select id="edit_car_owner_id" name="owner_id">
                            <option value="">&nbsp; Select Owner</option>
                            <?php
                            foreach ($sellers_owners as $user) {
                                echo "
                                    <option value='{$user['user_id']}'>
                                        &nbsp; {$user['username']}
                                    </option>
                                ";
                            }
                            ?>
                        </select>
                        <ion-icon name="person"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="edit_car_make">Make:</label>
                    <div class="div-input-icon-container">
                        <input id="edit_car_make" type="text" name="make">
                        <ion-icon name="car-sport"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="edit_car_model">Model:</label>
                    <div class="div-input-icon-container">
                        <input id="edit_car_model" type="text" name="model">
                        <ion-icon name="car-sport"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="div-multi-input-containers grid-3-columns">
                <div class="div-input-container required-input-container span-2-columns">
                    <label for="edit_car_note">Note:</label>
                    <textarea id="edit_car_note" name="note"></textarea>
                </div>
                <div class="div-multi-input-containers">
                    <div class="div-input-container required-input-container">
                        <label for="edit_car_year">Year:</label>
                        <div class="div-input-icon-container">
                            <input id="edit_car_year" type="number" name="year">
                            <ion-icon name="calendar-clear"></ion-icon>
                        </div>
                    </div>
                    <div class="div-input-container required-input-container">
                        <label for="edit_car_fuel">Fuel:</label>
                        <div class="div-input-icon-container">
                            <select id="edit_car_fuel" name="fuel">
                                <option value="">&nbsp; Select Fuel</option>
                                <option value="Diesel">&nbsp; Diesel</option>
                                <option value="Gasoline">&nbsp; Gasoline</option>
                                <option value="Electric">&nbsp; Electric</option>
                            </select>
                            <ion-icon name="funnel"></ion-icon>
                        </div>
                    </div>
                    <div class="div-input-container required-input-container">
                        <label for="edit_car_shift">Shift:</label>
                        <div class="div-input-icon-container">
                            <select id="edit_car_shift" name="shift">
                                <option value="">&nbsp; Select Shift</option>
                                <option value="Manual">&nbsp; Manual</option>
                                <option value="Automatic">&nbsp; Automatic</option>
                            </select>
                            <ion-icon name="cog"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div-multi-input-containers grid-2-columns">
                <div class="div-input-container required-input-container">
                    <label for="edit_car_horse_power">Horse Power:</label>
                    <div class="div-input-icon-container">
                        <input id="edit_car_horse_power" type="number" name="horse_power">
                        <ion-icon name="construct"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="edit_car_color">Color:</label>
                    <input id="edit_car_color" type="color" name="color">
                </div>
            </div>
            <div class="div-multi-input-containers grid-3-columns">
                <div class="div-input-container required-input-container">
                    <label for="edit_car_mileage">Mileage:</label>
                    <div class="div-input-icon-container">
                        <input id="edit_car_mileage" type="number" name="mileage">
                        <ion-icon name="speedometer"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container">
                    <label for="edit_car_original_price">Original Price:</label>
                    <div class="div-input-icon-container">
                        <input id="edit_car_original_price" type="number" name="original_price">
                        <ion-icon name="pricetag"></ion-icon>
                    </div>
                </div>
                <div class="div-input-container required-input-container">
                    <label for="edit_car_final_price">Final Price:</label>
                    <div class="div-input-icon-container">
                        <input id="edit_car_final_price" type="number" name="final_price">
                        <ion-icon name="pricetag"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="div-grid-btn-container grid-2-columns">
                <button class="btn btn-secondary btn-cancel" type="button">Cancel</button>
                <button class="btn btn-primary btn-form-submit" type="submit">&nbsp;</button>
            </div>
            <div class="div-hidden-inputs-container">
                <input id="edit_car_id" type="hidden" name="id">
            </div>
        </form>
    </div>

    <!-- DELETE POPUP -->
    <div class="div-popup popup-delete">
        <div>
            <button class="btn-close-popup">
                <ion-icon name="close-outline"></ion-icon>
            </button>
            <header class="popup-header">
                <h2 class="heading-secondary">Delete <span class="span-item-upper">&nbsp;</span></h2>
                <p>Are you sure about deleting the <span class="span-item-lower">&nbsp;</span> with the id <span class="span-item-id">&nbsp;</span>?</p>
            </header>
            <form 
                class="form" 
                action="<?php echo SERVER; ?>/api/profile.php" 
                method="DELETE"
            >
                <div class="div-grid-btn-container grid-2-columns">
                    <button class="btn btn-secondary btn-cancel" type="button">Cancel</button>
                    <button class="btn btn-primary btn-delete" type="submit">Delete</button>
                </div>
                <div class="div-hidden-inputs-container">
                    <input id="item_delete_id" type="hidden" name="id">
                    <input id="item_delete_type" type="hidden" name="type">
                </div>
            </form>
        </div>
    </div>
    <?php } ?>

    <!-- MODIFY IMAGE POPUP -->
    <div class="div-popup popup-modify-img">
        <div>
            <button class="btn-close-popup">
                <ion-icon name="close-outline"></ion-icon>
            </button>
            <header class="popup-header">
                <h2 class="heading-secondary">Edit <span class="span-item-upper">&nbsp;</span> Image</h2>
                <p>You're editing the <span class="span-item-lower">&nbsp;</span> image with the id <span class="span-item-id">&nbsp;</span>.</p>
            </header>
            <form 
                class="form" 
                action="<?php echo SERVER; ?>/api/image.php" 
                enctype="multipart/form-data" 
                method="POST"
            >
                <div class="div-input-container">
                    <div class="div-input-img-container div-modify-img-container" data-content="Select new image.">
                        <label class="label-img-upload" for="{}" data-img-type="{}">Choose</label>
                        <input id="{}" type="file" name="image" accept="image/*">
                    </div>
                </div>
                <div class="div-grid-btn-container grid-2-columns">
                    <button class="btn btn-secondary btn-cancel" type="button">Cancel</button>
                    <button class="btn btn-primary btn-img-submit" type="submit">Edit</button>
                </div>
                <div class="div-hidden-inputs-container">
                    <input id="img_edit_id" type="hidden" name="id">
                    <input id="img_edit_type" type="hidden" name="type">
                </div>
            </form>
        </div>
    </div>

    <?php if ($roleID === 3) { ?>
    <!-- MODIFY COMMISSION POPUP -->
    <div class="div-popup popup-modify-commission">
        <div>
            <button class="btn-close-popup">
                <ion-icon name="close-outline"></ion-icon>
            </button>
            <header class="popup-header">
                <h2 class="heading-secondary">Edit Commission</h2>
                <p>You're editing your <span>commission</span> value.</p>
            </header>
            <form 
                class="form" 
                action="<?php echo SERVER; ?>/api/commission.php" 
                method="PUT"
            >
                <div class="div-input-container">
                    <input id="commission" type="number" name="commission" value="<?php echo $commission['commission']; ?>">
                </div>
                <div class="div-grid-btn-container grid-2-columns">
                    <button class="btn btn-secondary btn-cancel" type="button">Cancel</button>
                    <button class="btn btn-primary btn-commission-submit" type="submit">Edit</button>
                </div>
                <div class="div-hidden-inputs-container">
                    <input id="commission_edit_id" type="hidden" name="id" value="<?php echo $userID; ?>">
                </div>
            </form>
        </div>
    </div>
    <?php } ?>
