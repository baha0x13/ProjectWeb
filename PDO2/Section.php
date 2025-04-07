<?php
require_once 'CnxDB.php';

class Section {
    public $id;
    public $designation;
    public $description;

    public function __construct($id = null, $designation = '', $description = '') {
        $this->id = $id;
        $this->designation = $designation;
        $this->description = $description;
    }

    public function create() {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->prepare("INSERT INTO sections (designation, description) VALUES (?, ?)");
        return $stmt->execute([$this->designation, $this->description]);
    }

    public static function getAll() {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->query("SELECT * FROM sections");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getStudents() {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM students WHERE section_id = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function update() {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->prepare("UPDATE sections SET designation = ?, description = ? WHERE id = ?");
        return $stmt->execute([$this->designation, $this->description, $this->id]);
    }

    public static function delete($id) {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->prepare("DELETE FROM sections WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
