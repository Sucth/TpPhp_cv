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

            echo "<style>";
            echo "button {
                color: white;
                background-color: #2a2f42;
                border: none;
                border-radius: 4px;
                padding: 8px 20px;
                cursor: pointer;
            }";
            echo "</style>";

            echo "<form action='update_cv.php' method='GET'>";
            echo "<input type='hidden' name='id' value='" . $cv['id'] . "'>";
            echo "<button type='submit'>Modifier</button>";
            echo "</form>";

            echo "<form action='delete_cv.php' method='POST'>";
            echo "<input type='hidden' name='id' value='" . $cv['id'] . "'>";
            echo "<button type='submit'>Supprimer ce CV</button>";
            echo "</form>";

            echo "<form action='allTemplate.php' method='GET'>";
            echo "<input type='hidden' name='id' value='" . $cv['id'] . "'>";
            echo "<button type='submit'>Afficher les templates</button>";
            echo "</form>";
            echo "<hr>";
        }
    }
}

$db = new CVDatabase('cv_database.db');
$cvRenderer = new CVRenderer();

$cvs = $db->getAllCVs();
echo "<body style='background-color: #080f25; color: white; padding: 20px;'>";
$cvRenderer->renderCVs($cvs);
echo "</body>";
?>
