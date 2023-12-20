<?php

class CVDatabase {
    private $db;

    public function __construct($database) {
        $this->db = new SQLite3($database);
        $this->initializeDatabase();
    }

    private function initializeDatabase() {
        $this->db->exec("CREATE TABLE IF NOT EXISTS cv (
            id INTEGER PRIMARY KEY,
            nom TEXT,
            prenom TEXT,
            email TEXT,
            telephone TEXT,
            adresse TEXT,
            experience TEXT,
            education TEXT,
            langue TEXT,
            hobbies TEXT,
            photo_path TEXT,
            diplome TEXT,
            posteA TEXT
        )");
    }

    public function getAllCVs() {
        $query = $this->db->query('SELECT * FROM cv');

        $cvData = [];
        while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
            $cvData[] = $row;
        }

        return $cvData;
    }
}

class CVRenderer {
    public function renderCVs($cvs) {
        if (empty($cvs)) {
            echo "Aucun CV enregistré.";
            return;
        }

        foreach ($cvs as $cv) {
            echo "<h2>CV de " . $cv['prenom'] . " " . $cv['nom'] . "</h2>";
            echo "<p>Email: " . $cv['email'] . "</p>";
            echo "<p>Téléphone: " . $cv['telephone'] . "</p>";
            echo "<p>Adresse: " . $cv['adresse'] . "</p>";
            echo "<p>Expérience professionnelle: " . $cv['experience'] . "</p>";
            echo "<p>Parcours académique: " . $cv['education'] . "</p>";
            echo "<p>Poste actuel: " . $cv['posteA'] . "</p>";
            echo "<p>Diplôme: " . $cv['diplome'] . "</p>";
            echo "<p>Langue: " . $cv['langue'] . "</p>";
            echo "<p>Hobbies: " . $cv['hobbies'] . "</p>";

            if ($cv['photo_path']) {
                echo "<p>Photo:</p>";
                echo "<img src='" . $cv['photo_path'] . "' alt='Photo' style='max-width: 200px;'>";
            }

            echo "<a href='update_cv.php?id=" . $cv['id'] . "'>Modifier</a>";
            echo "<a href='template.php?id=" . $cv['id'] . "'>Afficher le cv</a>";
            echo "<a href='temp1_pdf.php?id=" . $cv['id'] . "'>Va dormir</a>";
            echo "<hr>";
        }
    }
}

// Usage
$db = new CVDatabase('cv_database.db');
$cvRenderer = new CVRenderer();

$cvs = $db->getAllCVs();
$cvRenderer->renderCVs($cvs);

?>
