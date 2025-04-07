<?php
require_once 'Student.php';
require_once 'Section.php';

$message = '';
$student = null;
if (isset($_GET['id'])) {
    $student = Student::getById($_GET['id']);
    if (!$student) {
        header('Location: admin_dashboard.php');
        exit;
    }
} else {
    header('Location: admin_dashboard.php');
    exit;
}

$sections = Section::getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $birthday = $_POST['birthday'];
    $section_designation = $_POST['section_designation'];  
    $image = $student->image;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../uploads/';
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
    }

    $student->name = $name;
    $student->birthday = $birthday;
    $student->section_designation = $section_designation;  
    $student->image = $image;

    if ($student->update()) {
        $message = "Étudiant modifié avec succès.";
    } else {
        $message = "Erreur lors de la modification.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'étudiant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Modifier l'étudiant</h1>
    <a href="admin_dashboard.php">Retour au dashboard</a>

    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form action="edit_student.php?id=<?= $student->id ?>" method="post" enctype="multipart/form-data">
        <label>Nom :</label>
        <input type="text" name="name" value="<?= htmlspecialchars($student->name) ?>" required>
        <br>
        <label>Date de naissance :</label>
        <input type="date" name="birthday" value="<?= htmlspecialchars($student->birthday) ?>" required>
        <br>
        <label>Section :</label>
        <select name="section_designation" required>
            <?php foreach($sections as $sec): ?>
                <option value="<?= $sec->designation ?>" <?= $sec->designation == $student->section_designation ? 'selected' : '' ?>>
                    <?= htmlspecialchars($sec->designation) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <label>Image :</label>
        <input type="file" name="image">
        <br>
        <button type="submit">Sauvegarder les modifications</button>
    </form>
</body>
</html>
