-- tables
CREATE DATABASE `project_db` COLLATE utf8mb4_0900_ai_ci;
USE `project_db`;

CREATE TABLE accounts (
    account_id int NOT NULL AUTO_INCREMENT,
    username varchar(30) NOT NULL,
    account_password varchar(500) NOT NULL,
    firstname varchar(30) NOT NULL,
    lastname varchar(30) NOT NULL,
    birthdate date NOT NULL,
    gender char(1) NOT NULL,
    email varchar(30) NOT NULL,
    photo LONGBLOB, 
    phone_number varchar(30) NOT NULL,
    CONSTRAINT unique_username UNIQUE (username),
    CONSTRAINT chk_gender CHECK (gender IN('M', 'F', 'U')),
    CONSTRAINT pk_account_id PRIMARY KEY (account_id)
) DEFAULT CHARSET=UTF8MB4;

CREATE TABLE listings (
    listing_id int NOT NULL AUTO_INCREMENT,
    seller_account_id int NOT NULL,
    property_name varchar(50) NOT NULL,
    property_details varchar(200),
    price decimal(15, 2) NOT NULL,
    property_type varchar(50) NOT NULL,
    property_size varchar(100) NOT NULL,
    property_description varchar(200) NOT NULL,
    property_status varchar(20) NOT NULL,
    property_location varchar(100) NOT NULL,
    listing_date date NOT NULL,
    property_photo LONGBLOB NOT NULL,
    
    CONSTRAINT pk_listing_id PRIMARY KEY (listing_id),
    CONSTRAINT chk_price CHECK (price >= 0.0),
    CONSTRAINT fk_seller_account_id FOREIGN KEY (seller_account_id) REFERENCES accounts(account_id)
)DEFAULT CHARSET=utf8MB4;  


CREATE TABLE property_more_details (
    ref_listing_id int NOT NULL,
    bed_no varchar(30),
    room_no varchar(30),
    bath_no varchar(30),
    size_msq varchar(30),

    CONSTRAINT fk_ref_listing_id FOREIGN KEY (ref_listing_id) REFERENCES listings(listing_id)
)DEFAULT CHARSET=UTF8MB4;