<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des notes d'étudiants</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des notes d'étudiants</h1>
        
        <div class="students-container">
            <?php
            require_once 'Etudiant.php';
            $aymen = new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]);
            $skander = new Etudiant("Skander", [15, 9, 8, 16]);
            
            echo '<div class="student-column">';
            $aymen->afficherNotes();
            echo "<div class='result'>Moyenne: ".$aymen->calculerMoyenne()." - ".$aymen->estAdmis()."</div>";
            echo '</div>';
            
            echo '<div class="student-column">';
            $skander->afficherNotes();
            echo "<div class='result'>Moyenne: ".$skander->calculerMoyenne()." - ".$skander->estAdmis()."</div>";
            echo '</div>';
            ?>
        </div>
    </div>
</body>
</html>