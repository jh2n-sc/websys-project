USE `project_db`;

-- Seed admin/test account
-- Note: Password is stored in plaintext intentionally for first login; Auth will auto-upgrade to a hash on successful login.
INSERT INTO `accounts` (`username`, `account_password`, `firstname`, `lastname`, `email`, `phone_number`, `is_admin`)
VALUES
('sean_admin', 'Password123!', 'Sean', 'Jerve', 'sean.admin@example.com', '09171234567', 1)
ON DUPLICATE KEY UPDATE username = username;

INSERT INTO `accounts` (`username`, `account_password`, `firstname`, `lastname`, `email`, `phone_number`, `is_admin`)
VALUES
('demo_user', 'DemoPass123!', 'Demo', 'User', 'demo.user@example.com', '09179876543', 0)
ON DUPLICATE KEY UPDATE username = username;
