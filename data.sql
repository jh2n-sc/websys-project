USE `project_db`;


INSERT INTO accounts 
(account_id ,username,account_password ,firstname, lastname, birthdate, gender, email, photo, phone_number)
VALUES
(1,'jhansabanal', 'password123', 'Jhan', 'Sabanal', '2005-11-11', 'M','jhan@example.com', LOAD_FILE('/mnt/otherVolume/Projects/Websys/websys-project/property_test_images/profile.jpg'), '0991-123-4567'),
(2,'kevstamayo', 'password123', 'John Kevin', 'Tamayo', '2005-12-14', 'M','kevs@example.com', LOAD_FILE('/mnt/otherVolume/Projects/Websys/websys-project/property_test_images/profile.jpg'), '0991-123-4567'),
(3,'seanjerve', 'password123', 'Sean', 'Rebancos', '2005-11-21', 'M','seanjerve@example.com', LOAD_FILE('/mnt/otherVolume/Projects/Websys/websys-project/property_test_images/profile.jpg'), '0991-123-4567'),
(4, 'carlnathan', 'password123', 'Carl', 'Poot', '2004-9-21', 'M','carlpoot@example.com', LOAD_FILE('/mnt/otherVolume/Projects/Websys/websys-project/property_test_images/profile.jpg'), '0991-123-4567');


INSERT INTO listings 
(listing_id, seller_account_id, property_name,price, property_type, property_dimension, property_description, property_status, property_location, property_photo, listing_date)
VALUES
(1,1,'Sunnyview Cottage, Maplewood Residence', 1009245.99, 'real-estate', '100x95', 'House', 'listed','Mandaluyong, Laguna', LOAD_FILE('/mnt/otherVolume/Projects/Websys/websys-project/property_test_images/property1.jpg'), CURDATE()),
(2,2,'The Heights 301, Skyline Apartments', 6129245.99, 'real-estate', '100x96', 'Apartment', 'listed','Legazpi, Tabaco', LOAD_FILE('/mnt/otherVolume/Projects/Websys/websys-project/property_test_images/property2.jpg'), CURDATE()),
(3,3,'Sunset Bay Condo, Oceanview Heights', 5329245.99, 'real-estate', '100x92', 'Villa', 'listed','Polangui, Camalig' ,LOAD_FILE('/mnt/otherVolume/Projects/Websys/websys-project/property_test_images/property3.jpg'), CURDATE()),
(4,4,'Downtown Studio Loft, Cozy Artist Studio', 1439245.99, 'real-estate', '150x95', 'Studio', 'listed','Mapulang Daga, Manila', LOAD_FILE('/mnt/otherVolume/Projects/Websys/websys-project/property_test_images/property4.jpg'), CURDATE());

INSERT INTO property_more_details
(ref_listing_id, bed_no, room_no, bath_no, size_msq)
VALUES
(1, '3', '7', '2', '511'),
(2, '2', '3', '2', '76'),
(3, '2', '5', '1', '122'),
(4, '5', '7', '9', '56');
