<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->role === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: user_dashboard.php");
    }
} else {
    header("Location: login.php");
}
?>
