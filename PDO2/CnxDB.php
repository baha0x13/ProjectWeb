<?php
class CnxDB {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = 'localhost';
        $dbname = 'gestion_etudiant';
        $user = 'root';
        $pass = '';

        try {
            $this->pdo = new PDO("mysql:host={$host};charset=utf8", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
            $this->pdo->exec("USE $dbname");
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
                email VARCHAR(100) NOT NULL,
                password VARCHAR(255) NOT NULL,
                role ENUM('admin', 'user') DEFAULT 'user'
            ) ENGINE=InnoDB");

            $this->pdo->exec("CREATE TABLE IF NOT EXISTS sections (
                id INT AUTO_INCREMENT PRIMARY KEY,
                designation VARCHAR(100) NOT NULL UNIQUE,
                description TEXT
            ) ENGINE=InnoDB");

            $this->pdo->exec("CREATE TABLE IF NOT EXISTS students (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                birthday DATE NOT NULL,
                image VARCHAR(255),
                section_designation VARCHAR(100),
                FOREIGN KEY (section_designation) 
                    REFERENCES sections(designation) ON DELETE SET NULL
            ) ENGINE=InnoDB");
            $this->pdo->exec("INSERT IGNORE INTO users 
                (username, email, password, role) VALUES 
                ('baha', 'baha@example.com', 'bahaadmin', 'admin'),
                ('jed', 'jed@example.com', 'jeduser', 'user')");

            $this->pdo->exec("INSERT IGNORE INTO sections 
                (designation, description) VALUES 
                ('GL', 'Génie Logiciel'),
                ('RT', 'Réseaux Informatiques et Télécommunications'),
                ('IIA', 'Informatique Industrielle et Automate'),
                ('IMI', 'Instrumentation et Maintenance Industrielle')");

        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new CnxDB();
        }
        return self::$instance->pdo;
    }
}
?>