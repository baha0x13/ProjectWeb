<?php
require_once 'CnxDB.php';

class User {
    public $id;
    public $username;
    public $email;
    public $password; 
    public $role;

    public function __construct($id = null, $username = '', $email = '', $password = '', $role = 'user') {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public static function authenticate($username, $password) {
        $pdo = CnxDB::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if ($user && $password=== $user->password) {
            return $user;
        }
        return false;
    }

}
?>
