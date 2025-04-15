CREATE TABLE `users` (
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50)  NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `address` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(10) UNIQUE NOT NULL
);



CREATE TABLE `categories` (
    `category_name` VARCHAR(50) PRIMARY KEY
);

CREATE TABLE `equipment_ava` (
    `equip_id` INT AUTO_INCREMENT PRIMARY KEY,
    `equip_name` VARCHAR(100) NOT NULL,
    `category_name` VARCHAR(50),
    `quantity` INT,
    FOREIGN KEY (`category_name`) REFERENCES `categories`(`category_name`)
);

CREATE TABLE `transactions` (
    `transaction_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `equip_id` INT,
    `quantity` INT,
    `transaction_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `status` ENUM('borrowed', 'returned') DEFAULT 'borrowed',
    FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`),
    FOREIGN KEY (`equip_id`) REFERENCES `equipment_ava`(`equip_id`)
);

CREATE TABLE `equipment_nava` (
    `equip_id` INT,
    `qnt_b` INT,
    FOREIGN KEY (`equip_id`) REFERENCES `equipment_ava`(`equip_id`)
);

-- Insert entries into the categories table
INSERT INTO `categories` (`category_name`) VALUES
('Cricket'),
('Football'),
('Basketball'),
('Tennis'),
('Swimming'),
('Badminton');

-- Insert entries into the equipment table
INSERT INTO `equipment_ava` (`equip_name`, `category_name`, `quantity`) VALUES
('Bat', 'Cricket', 20),
('Ball', 'Cricket', 50),
('Gloves', 'Cricket', 50),
('Helmet', 'Cricket', 50),
('Football', 'Football', 30),
('Studs', 'Football', 25),
('Basketball', 'Basketball', 15),
('Hoop', 'Basketball', 5),
('Racket', 'Tennis', 20),
('Tennis Ball', 'Tennis', 50),
('Goggles', 'Swimming', 40),
('Cap', 'Swimming', 30),
('Kickboard', 'Swimming', 15),
('Nose Clip', 'Swimming', 20),
('Racket','Badminton' , 40),
('Shuttle','Badminton', 60);
