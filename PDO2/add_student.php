<?php
require_once 'Student.php';
require_once 'Section.php';

$sections = Section::getAll();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $birthday = $_POST['birthday'];
    $section_designation = $_POST['section_designation'];

    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); 
        }
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
    }

    $student = new Student(null, $name, $birthday, $image, $section_designation);
    if ($student->create()) {
        $message = "Étudiant ajouté avec succès.";
    } else {
        $message = "Erreur lors de l'ajout.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un étudiant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ajouter un étudiant</h1>
    <a href="admin_dashboard.php">Retour au dashboard</a>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form action="add_student.php" method="post" enctype="multipart/form-data">
        <label>Nom :</label>
        <input type="text" name="name" required><br>

        <label>Date de naissance :</label>
        <input type="date" name="birthday" required><br>

        <label>Section :</label>
        <select name="section_designation" required>
            <?php foreach($sections as $sec): ?>
                <option value="<?= htmlspecialchars($sec->designation) ?>"><?= htmlspecialchars($sec->designation) ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Image :</label>
        <input type="file" name="image"><br>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
