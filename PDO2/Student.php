<?php
require_once 'CnxDB.php';

class Student {
    public $id;
    public $name;
    public $birthday;
    public $image;
    public $section_designation;

    public function __construct($id = null, $name = '', $birthday = '', $image = '', $section_designation = '') {
        $this->id = $id;
        $this->name = $name;
        $this->birthday = $birthday;
        $this->image = $image;
        $this->section_designation = $section_designation;
    }
    public function create() {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->prepare("INSERT INTO students (name, birthday, image, section_designation) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$this->name, $this->birthday, $this->image, $this->section_designation]);
    }
    public static function getAll($limit = 10, $offset = 0) {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM students LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function update() {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->prepare("UPDATE students SET name = ?, birthday = ?, image = ?, section_designation = ? WHERE id = ?");
        return $stmt->execute([$this->name, $this->birthday, $this->image, $this->section_designation, $this->id]);
    }

    public static function delete($id) {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public static function getById($id) {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);
        $student = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($student) {
            return new self($student->id, $student->name, $student->birthday, $student->image, $student->section_designation);
        }
        
        return null; 
    }
}
?>
