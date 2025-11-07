USE `project_db`;

-- Resolve seller account IDs from usernames
SET @seller_admin := (SELECT account_id FROM accounts WHERE username='sean_admin' LIMIT 1);
SET @seller_demo  := (SELECT account_id FROM accounts WHERE username='demo_user' LIMIT 1);

-- Fallback to 1 if null (only for local dev if seeds were modified)
SET @seller_admin := IFNULL(@seller_admin, 1);
SET @seller_demo  := IFNULL(@seller_demo, 1);

-- Sample Listing 1 (House - Legazpi)
INSERT INTO listings (
  seller_account_id, property_name, property_details, price, property_type,
  property_dimension, property_description, property_status, property_location,
  listing_date, property_photo
) VALUES (
  @seller_admin, 'Mayon View Residence', '3BR family home with garden', 5200000.00, 'Residential',
  220.00, 'House', 'listed', 'Legazpi City, Albay', NOW(), NULL
);
SET @l1 := LAST_INSERT_ID();
INSERT INTO property_more_details (ref_listing_id, bed_no, room_no, bath_no, size_msq)
VALUES (@l1, '3', '7', '2', 220);

-- Listing 2 (Condo - Daraga)
INSERT INTO listings (seller_account_id, property_name, property_details, price, property_type,
  property_dimension, property_description, property_status, property_location, listing_date, property_photo)
VALUES (@seller_demo, 'Skyline Tower Condo', '2BR corner unit, high floor', 3750000.00, 'Condominium',
  85.00, 'Condo', 'listed', 'Daraga, Albay', NOW(), NULL);
SET @l2 := LAST_INSERT_ID();
INSERT INTO property_more_details (ref_listing_id, bed_no, room_no, bath_no, size_msq)
VALUES (@l2, '2', '4', '2', 85);

-- Listing 3 (Townhouse - Camalig)
INSERT INTO listings (seller_account_id, property_name, property_details, price, property_type,
  property_dimension, property_description, property_status, property_location, listing_date, property_photo)
VALUES (@seller_admin, 'Camalig Townhomes Block 3', 'Modern townhouse with carport', 2850000.00, 'Residential',
  120.00, 'Townhouse', 'listed', 'Camalig, Albay', NOW(), NULL);
SET @l3 := LAST_INSERT_ID();
INSERT INTO property_more_details (ref_listing_id, bed_no, room_no, bath_no, size_msq)
VALUES (@l3, '3', '5', '2', 120);

-- Listing 4 (Land - Guinobatan)
INSERT INTO listings (seller_account_id, property_name, property_details, price, property_type,
  property_dimension, property_description, property_status, property_location, listing_date, property_photo)
VALUES (@seller_demo, 'Guinobatan Farm Lot', 'Open titled lot near highway', 1950000.00, 'Land',
  450.00, 'Land', 'listed', 'Guinobatan, Albay', NOW(), NULL);
SET @l4 := LAST_INSERT_ID();
INSERT INTO property_more_details (ref_listing_id, bed_no, room_no, bath_no, size_msq)
VALUES (@l4, '0', '0', '0', 450);

-- Listing 5 (Apartment - Legazpi)
INSERT INTO listings (seller_account_id, property_name, property_details, price, property_type,
  property_dimension, property_description, property_status, property_location, listing_date, property_photo)
VALUES (@seller_admin, 'Legazpi Central Apartment', 'Newly renovated unit downtown', 2150000.00, 'Apartment',
  65.00, 'Apartment', 'listed', 'Legazpi City, Albay', NOW(), NULL);
SET @l5 := LAST_INSERT_ID();
INSERT INTO property_more_details (ref_listing_id, bed_no, room_no, bath_no, size_msq)
VALUES (@l5, '2', '3', '1', 65);

-- Listing 6 (House - Tabaco City)
INSERT INTO listings (seller_account_id, property_name, property_details, price, property_type,
  property_dimension, property_description, property_status, property_location, listing_date, property_photo)
VALUES (@seller_demo, 'Tabaco Subdivision Home', 'Quiet street, fenced yard', 3100000.00, 'Residential',
  180.00, 'House', 'listed', 'Tabaco City, Albay', NOW(), NULL);
SET @l6 := LAST_INSERT_ID();
INSERT INTO property_more_details (ref_listing_id, bed_no, room_no, bath_no, size_msq)
VALUES (@l6, '3', '6', '2', 180);

-- Listing 7 (Condo - Legazpi)
INSERT INTO listings (seller_account_id, property_name, property_details, price, property_type,
  property_dimension, property_description, property_status, property_location, listing_date, property_photo)
VALUES (@seller_admin, 'Bayview Residences', 'Sea-facing 1BR with balcony', 2750000.00, 'Condominium',
  48.00, 'Condo', 'listed', 'Legazpi City, Albay', NOW(), NULL);
SET @l7 := LAST_INSERT_ID();
INSERT INTO property_more_details (ref_listing_id, bed_no, room_no, bath_no, size_msq)
VALUES (@l7, '1', '2', '1', 48);

-- Listing 8 (Townhouse - Polangui)
INSERT INTO listings (seller_account_id, property_name, property_details, price, property_type,
  property_dimension, property_description, property_status, property_location, listing_date, property_photo)
VALUES (@seller_demo, 'Polangui Townhouse Row', 'End unit, extra windows', 2350000.00, 'Residential',
  100.00, 'Townhouse', 'listed', 'Polangui, Albay', NOW(), NULL);
SET @l8 := LAST_INSERT_ID();
INSERT INTO property_more_details (ref_listing_id, bed_no, room_no, bath_no, size_msq)
VALUES (@l8, '2', '4', '2', 100);
