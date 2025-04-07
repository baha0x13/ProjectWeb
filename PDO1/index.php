<?php
require_once 'CnxEtudiant.php';

$cnx = new CnxEtudiant();
$students = $cnx->getAllStudents();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Liste des étudiants</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Date de naissance</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student['id']) ?></td>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= htmlspecialchars($student['birthdate']) ?></td>
                <td><a href="détailEtudiant.php?id=<?= htmlspecialchars($student['id']) ?>">Détails</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
