<?php
class Etudiant {
    private $nom;
    private $notes;
    
    public function __construct($nom, $notes) {
        $this->nom = $nom;
        $this->notes = $notes;
    }
    
    public function afficherNotes() {
        echo "<h3>Notes de $this->nom :</h3>";
        echo "<ul>";
        foreach ($this->notes as $note) {
            $class = '';
            if ($note < 10) {
                $class = 'red';
            } elseif ($note == 10) {
                $class = 'orange';
            } else {
                $class = 'green';
            }
            echo "<li class='$class'>$note</li>";
        }
        echo "</ul>";
    }

    public function calculerMoyenne() {
        return round(array_sum($this->notes) / count($this->notes), 7);
    }

    public function estAdmis() {
        return $this->calculerMoyenne() >= 10 ? "Admis" : "Non admis";
    }
}
?>
