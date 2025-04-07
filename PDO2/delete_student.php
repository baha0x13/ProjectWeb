<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    require_once 'Student.php';
    $id = $_POST['id'];
    $deleted = Student::delete($id);
}

header("Location: admin_dashboard.php");
exit;
?>
