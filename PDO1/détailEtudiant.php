<?php
$host = 'localhost';
$dbname = 'student_db';
$username = 'root';
$password = '';

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM student WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($student) {
            echo '<h1>Détails de l\'étudiant</h1>';
            echo '<p><strong>ID :</strong> ' . htmlspecialchars($student['id']) . '</p>';
            echo '<p><strong>Nom :</strong> ' . htmlspecialchars($student['name']) . '</p>';
            echo '<p><strong>Date de naissance :</strong> ' . htmlspecialchars($student['birthdate']) . '</p>';
            echo '<p><strong>Filière :</strong> ' . htmlspecialchars("RT") . '</p>';
        } else {
            echo '<p>Étudiant non trouvé.</p>';
        }
    } else {
        echo '<p>Aucun ID d\'étudiant fourni.</p>';
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
?>

<p><a href="index.php">Retour à la liste des étudiants</a></p>
