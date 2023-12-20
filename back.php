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

    public function insertCV($data) {
        $insert = $this->db->prepare("INSERT INTO cv (nom, prenom, email, telephone, adresse, experience, education, langue, hobbies, photo_path, diplome, posteA) VALUES (:nom, :prenom, :email, :telephone, :adresse, :experience, :education, :langue, :hobbies, :photoPath, :diplome, :posteA)");

        // Bind values
        $insert->bindValue(':nom', $data['nom'], SQLITE3_TEXT);
        $insert->bindValue(':prenom', $data['prenom'], SQLITE3_TEXT);
        // ... Bind other values similarly

        $result = $insert->execute();

        return $result ? true : false;
    }
}

// Usage
$db = new CVDatabase('cv_database.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... Your file validation and data retrieval code

    $cvData = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        // ... Other data fields
    ];

    $result = $db->insertCV($cvData);

    if ($result) {
        echo "CV enregistré avec succès !";
    } else {
        echo "Erreur lors de l'enregistrement du CV.";
    }
}
?>
