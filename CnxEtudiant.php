<?php
class CnxEtudiant {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $db = 'student_db';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        try {
            $this->pdo = new PDO("mysql:host=$host;charset=$charset", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS $db");
            $this->pdo->exec("USE $db");
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS student (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                birthdate DATE NOT NULL
            ) ENGINE=InnoDB");
            $this->pdo->exec("INSERT IGNORE INTO student (name, birthdate) VALUES
                ('Baha eddine YAHYAOUI', '2004-06-15'),
                ('Jed JMILI', '2000-03-22'),
                ('Ghaith AMDOUNI', '2002-11-05')");

        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function getAllStudents() {
        $stmt = $this->pdo->query("SELECT * FROM student");
        return $stmt->fetchAll();
    }
}
?>