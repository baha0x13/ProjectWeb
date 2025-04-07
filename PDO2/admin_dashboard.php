<?php
require_once 'Student.php';
require_once 'Section.php';

$students = Student::getAll(10, 0);
$sections = Section::getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrateur</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
</head>
<body class="admin-dashboard">
    <h1>Dashboard Administrateur</h1>
    <a href="logout.php">Déconnexion</a>
    <select id="viewSelector">
        <option value="students">Liste des étudiants</option>
        <option value="sections">Liste des sections</option>
    </select>

    <div id="studentsList" style="display: block;">
        <h2>Liste des étudiants</h2>
        <input type="text" id="searchInput" placeholder="Filtrer par nom">
        <select id="sectionFilter">
            <option value="">Filtrer par section</option>
            <?php foreach($sections as $section): ?>
                <option value="<?= htmlspecialchars($section->designation) ?>"><?= htmlspecialchars($section->designation) ?></option>
            <?php endforeach; ?>
        </select>

        <table id="studentsTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date de naissance</th>
                    <th>Image</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $s): ?>
                <tr>
                    <td><?= htmlspecialchars($s->id) ?></td>
                    <td><?= htmlspecialchars($s->name) ?></td>
                    <td><?= htmlspecialchars($s->birthday) ?></td>
                    <td>
                        <?php if ($s->image): ?>
                            <img src="../uploads/<?= htmlspecialchars($s->image) ?>" alt="<?= htmlspecialchars($s->name) ?>" width="50">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($s->section_designation) ?></td>
                    <td>
                        <a href="edit_student.php?id=<?= $s->id ?>">Modifier</a>
                        <form action="delete_student.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $s->id ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="sectionsList" style="display: none;">
        <h2>Liste des sections</h2>
        <table id="sectionsTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Désignation</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sections as $section): ?>
                <tr>
                    <td><?= htmlspecialchars($section->id) ?></td>
                    <td><?= htmlspecialchars($section->designation) ?></td>
                    <td><?= htmlspecialchars($section->description) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script src="script.js"></script>

    <script>
        document.getElementById('viewSelector').addEventListener('change', function() {
            var selectedView = this.value;
            if (selectedView === 'students') {
                document.getElementById('studentsList').style.display = 'block';
                document.getElementById('sectionsList').style.display = 'none';
            } else if (selectedView === 'sections') {
                document.getElementById('studentsList').style.display = 'none';
                document.getElementById('sectionsList').style.display = 'block';
            }
        });
    </script>
</body>
</html>
