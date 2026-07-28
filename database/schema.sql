CREATE DATABASE IF NOT EXISTS awesome_group
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE awesome_group;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS clients (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(120) NOT NULL,
    contact_person VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(30) DEFAULT NULL,
    service_type ENUM('Information Systems', 'Data Management', 'Digital Advisory', 'Support') NOT NULL,
    status ENUM('Lead', 'Active', 'Inactive') NOT NULL DEFAULT 'Lead',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO clients (company_name, contact_person, email, phone, service_type, status) VALUES
('Cape Coast Trading Ltd', 'Ama Mensah', 'ama@example.com', '+233 24 000 0001', 'Information Systems', 'Active'),
('Coastal Insights', 'Kwame Boateng', 'kwame@example.com', '+233 20 000 0002', 'Data Management', 'Lead'),
('Heritage Works', 'Akosua Owusu', 'akosua@example.com', '+233 27 000 0003', 'Digital Advisory', 'Inactive');
