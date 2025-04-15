-- tables
CREATE DATABASE `project_db` COLLATE utf8_general_ci;
USE `project_db`;

CREATE TABLE accounts (
    account_id int NOT NULL AUTO_INCREMENT,
    username varchar(30) NOT NULL,
    account_password varchar(200) NOT NULL,
    firstname varchar(30) NOT NULL,
    lastname varchar(30) NOT NULL,
    birthdate date NOT NULL,
    gender char(1) NOT NULL,
    email varchar(30) NOT NULL,
    photo LONGBLOB, 
    phone_number varchar(30) NOT NULL,
    CONSTRAINT unique_phone_number UNIQUE (phone_number),
    CONSTRAINT unique_email UNIQUE (email),
    CONSTRAINT unique_username UNIQUE (username),
    CONSTRAINT chk_gender CHECK (gender IN('M', 'F')),
    CONSTRAINT pk_account_id PRIMARY KEY (account_id)
) DEFAULT CHARSET=utf8;

CREATE TABLE listings (
    listing_id int NOT NULL AUTO_INCREMENT,
    seller_account_id int NOT NULL,
    price float NOT NULL,
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
)DEFAULT CHARSET=utf8;  

-- TEST DATA

INSERT INTO accounts ( username,account_password ,firstname, lastname, birthdate, gender, email, photo, phone_number)
VALUES ('c2nagreen', 'HASHED_PASSWORD','John', 'Doe', '2003-07-13', 'F', 'johndoe@example.com', LOAD_FILE('D:/Projects/Websys/profile.jpg'), '09887678897');
 