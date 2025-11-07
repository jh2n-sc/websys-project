-- Schema for Kabalayan (matches current PHP code)
CREATE DATABASE IF NOT EXISTS `project_db`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `project_db`;

-- Accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `account_password` VARCHAR(255) NOT NULL,
  `firstname` VARCHAR(100) NULL,
  `lastname` VARCHAR(100) NULL,
  `birthdate` DATE NULL,
  `gender` VARCHAR(20) NULL,
  `email` VARCHAR(150) NULL,
  `phone_number` VARCHAR(20) NULL,
  `photo` VARCHAR(255) NULL,
  `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` DATETIME NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `uq_accounts_username` (`username`),
  UNIQUE KEY `uq_accounts_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listings (includes columns used in upload.php, buy.php, image.php)
CREATE TABLE IF NOT EXISTS `listings` (
  `listing_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_account_id` INT UNSIGNED NOT NULL,
  `property_name` VARCHAR(255) NOT NULL,
  `property_type` VARCHAR(50) NOT NULL,
  `property_dimension` DECIMAL(10,2) NULL,
  `price` DECIMAL(12,2) NOT NULL,
  `property_description` TEXT NULL,
  `property_details` VARCHAR(255) NULL,
  `property_status` VARCHAR(50) NULL,
  `property_location` VARCHAR(255) NULL,
  `property_photo` LONGBLOB NULL,
  `listing_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`listing_id`),
  KEY `idx_listings_seller` (`seller_account_id`),
  CONSTRAINT `fk_listings_accounts`
    FOREIGN KEY (`seller_account_id`) REFERENCES `accounts` (`account_id`)
    ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Additional details table referenced by buy.php & upload.php
CREATE TABLE IF NOT EXISTS `property_more_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_listing_id` INT UNSIGNED NOT NULL,
  `bed_no` VARCHAR(10) NULL,
  `room_no` VARCHAR(10) NULL,
  `bath_no` VARCHAR(10) NULL,
  `size_msq` INT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmd_listing` (`ref_listing_id`),
  CONSTRAINT `fk_pmd_listing`
    FOREIGN KEY (`ref_listing_id`) REFERENCES `listings` (`listing_id`)
    ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
