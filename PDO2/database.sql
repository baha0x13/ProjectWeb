CREATE DATABASE IF NOT EXISTS gestion_etudiant;
USE gestion_etudiant;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

CREATE TABLE sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    birthday DATE NOT NULL,
    image VARCHAR(255),
    section_designation VARCHAR(100),
    FOREIGN KEY (section_designation) REFERENCES sections(designation) ON DELETE SET NULL
);

INSERT INTO users (username, email, password, role) VALUES 
('baha', 'baha@example.com', 'bahaadmin', 'admin'),
('jed', 'jed@example.com', 'jeduser', 'user');

INSERT INTO sections (designation, description) VALUES 
('GL', 'Génie Logiciel'),
('RT', 'Réseaux Informatiques et Télécommunications'),
('IIA', 'Informatique Industrielle et Automate'),
('IMI', 'Instrumentation et Maintenance Industrielle');
