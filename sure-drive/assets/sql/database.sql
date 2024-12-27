DROP DATABASE IF EXISTS car_dealership;

CREATE DATABASE car_dealership;

USE car_dealership;


DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
    `car_id` INT NOT NULL AUTO_INCREMENT,
    `make` VARCHAR(50) NOT NULL,
    `model` VARCHAR(50) NOT NULL,
    `year` INT NOT NULL,
    PRIMARY KEY (`car_id`)
);

INSERT INTO `car` VALUES 
(1, 'Toyota', 'Camry', 2022),
(2, 'Honda', 'Civic', 2021),
(3, 'Ford', 'Mustang', 2023),
(4, 'Chevrolet', 'Malibu', 2020),
(5, 'BMW', 'X5', 2024);

-- SELECT * FROM `car`;


DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
    `role_id` INT NOT NULL,
    `role_name` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`role_id`)
);

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1,	'Administrator'),
(2,	'Buyer'),
(3,	'Seller'),
(4,	'Owner');


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `user_id` INT NOT NULL AUTO_INCREMENT,
    `role_id` INT NOT NULL,
    `username` VARCHAR(50) NOT NULL,
    `password` CHAR(32) NOT NULL,
    `user_email` VARCHAR(75) NOT NULL,
    `user_phone` VARCHAR(20) NULL DEFAULT "+123 45 678 9101",
    `location` VARCHAR(50) NULL DEFAULT "City, Country",
    `user_image` LONGBLOB NULL DEFAULT NULL,
    `member_since` DATETIME NULL DEFAULT NOW(),
    PRIMARY KEY (`user_id`),
    FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE
);

INSERT INTO `user` VALUES
(1,	1, 'User1', '21232f297a57a5a743894a0e4a801fc3', "user1@gmail.com", "+123 45 678 9101", "Budva, Montenegro", LOAD_FILE(''), '2024-01-15'),
(2,	2, 'User2', '794aad24cbd58461011ed9094b7fa212', "user2@gmail.com", "+123 45 678 9101", "Dubrovnik, Croatia", LOAD_FILE(''), '2024-01-15'),
(3,	3, 'User3', '64c9ac2bb5fe46c3ac32844bb97be6bc', "user3@gmail.com", "+123 45 678 9101", "Dallas, United States", LOAD_FILE(''), '2024-01-15'),
(4,	4, 'User4', '72122ce96bfec66e2396d2e25225d70a', "user4@gmail.com", "+123 45 678 9101", "Berlin, Germany", LOAD_FILE(''), '2024-01-15');

-- SELECT * FROM `user`;


DROP TABLE IF EXISTS `description`;
CREATE TABLE `description` (
    `desc_id` INT NOT NULL AUTO_INCREMENT,
    `car_id` INT NOT NULL,
    `seller_id` INT NOT NULL,
    `owner_id` INT NOT NULL,
    `note` VARCHAR(100) DEFAULT NULL,
    `car_image` LONGBLOB NULL DEFAULT NULL,
    `mileage` INT NOT NULL,
    `horse_power` INT NOT NULL,
    `fuel` VARCHAR(20) NOT NULL,
    `color` VARCHAR(50) NOT NULL,
    `shift` VARCHAR(20) NOT NULL,
    `original_price` FLOAT NULL DEFAULT 0,
    `final_price` FLOAT NOT NULL,
    `date_added` DATETIME NULL DEFAULT NOW(),
    PRIMARY KEY (`desc_id`),
    FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE,
    FOREIGN KEY (`seller_id`) REFERENCES `user` (`user_id`) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE,
    FOREIGN KEY (`owner_id`) REFERENCES `user` (`user_id`) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE
);

INSERT INTO `description` VALUES 
(1, 1, 3, 4, 'Reliable and fuel-efficient sedan.', LOAD_FILE(''), 15000, 203, 'Gasoline', '#f8f9fa', 'Automatic', 28000.00, 26500.00, '2024-01-15'),
(2, 2, 3, 4, 'Compact, efficient, perfect for city driving.', LOAD_FILE(''), 18000, 158, 'Gasoline', '#dee2e6', 'Manual', 22000.00, 21000.00, '2024-02-10'),
(3, 3, 3, 4, 'Powerful and stylish sports car.', LOAD_FILE(''), 8000, 450, 'Gasoline', '#f03e3e', 'Automatic', 55000.00, 53000.00, '2024-03-20'),
(4, 4, 3, 4, 'Spacious sedan with comfortable interior.', LOAD_FILE(''), 20000, 250, 'Gasoline', '#1c7ed6', 'Automatic', 27000.00, 25500.00, '2024-04-05'),
(5, 5, 3, 4, 'Luxury SUV with modern features.', LOAD_FILE(''), 5000, 335, 'Diesel', '#ffd43b', 'Automatic', 65000.00, 63000.00, '2024-05-25');

-- SELECT * FROM `description`;


DROP TABLE IF EXISTS `cars_bought`;
CREATE TABLE `cars_bought` (
    `car_id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `year` INT NOT NULL,
    `make` VARCHAR(50) NOT NULL,
    `model` VARCHAR(50) NOT NULL,
    `car_image` LONGBLOB NULL DEFAULT NULL,
    `mileage` INT NOT NULL,
    `shift` VARCHAR(20) NOT NULL,
    `final_price` FLOAT NOT NULL,
    PRIMARY KEY (`car_id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE
);

-- SELECT * FROM `cars_bought`;


DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale` (
    `sale_id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT DEFAULT NULL,
    `car_name` VARCHAR(100) NOT NULL,
    `seller` VARCHAR(50) NOT NULL,
    `buyer` VARCHAR(50) NOT NULL,
    `owner` VARCHAR(50) NOT NULL,
    `commission` FLOAT NOT NULL,
    `total_price` FLOAT NOT NULL,
    `date` DATETIME NULL DEFAULT NOW(),
    PRIMARY KEY (`sale_id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) 
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

-- SELECT * FROM `sale`;


DROP TABLE IF EXISTS `shipment`;
CREATE TABLE `shipment` (
    `shipment_id` INT NOT NULL AUTO_INCREMENT,
    `sale_id` INT NOT NULL,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `order_email` VARCHAR(100) NOT NULL,
    `order_phone` VARCHAR(20) NOT NULL,
    `shipping_address` VARCHAR(100) NOT NULL,
    `payment_type` VARCHAR(25) NULL DEFAULT "Card Payment",
    `apt_number` VARCHAR(50) NULL DEFAULT NULL,
    `country` VARCHAR(50) NOT NULL,
    `city` VARCHAR(50) NOT NULL,
    `zip` INT NOT NULL,
    PRIMARY KEY (`shipment_id`),
    FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE
);

-- SELECT * FROM `order`;


DROP TABLE IF EXISTS `buyer`;
CREATE TABLE `buyer` (
    `buyer_id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `funds_spent` FLOAT NULL DEFAULT 0,
    `cars_bought` INT NULL DEFAULT 0,
    PRIMARY KEY (`buyer_id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE
);

INSERT INTO `buyer` (`buyer_id`, `user_id`) VALUES (1, 2);


DROP TABLE IF EXISTS `seller`;
CREATE TABLE `seller` (
    `seller_id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `commission` FLOAT DEFAULT 0,
    `funds_made` FLOAT DEFAULT 0,
    `cars_sold` INT DEFAULT 0,
    PRIMARY KEY (`seller_id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE
);

INSERT INTO `seller` (`seller_id`, `user_id`, `commission`) VALUES (1, 3 , 5);


DROP TABLE IF EXISTS `owner`;
CREATE TABLE `owner` (
    `owner_id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `funds_made` FLOAT DEFAULT 0,
    `cars_owned` INT DEFAULT 0,
    PRIMARY KEY (`owner_id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE
);

INSERT INTO `owner` (`owner_id`, `user_id`) VALUES (1, 4);


DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE `newsletter` (
    `email_id` INT NOT NULL AUTO_INCREMENT,
    `newsletter_email` VARCHAR(75) NOT NULL,
    PRIMARY KEY (`email_id`)
);


DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
    `log_id` INT NOT NULL,
    `log_type` VARCHAR(25) NOT NULL,
    `message` VARCHAR(350) NOT NULL,
    `timestamp` DATETIME NOT NULL,
    PRIMARY KEY (`log_id`)
);
