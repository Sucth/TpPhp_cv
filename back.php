<?php

class CVDatabase {
    private $db;

    public function __construct($databaseName) {
        $this->db = new SQLite3($databaseName);

        $this->createTable();
    }

    private function createTable() {
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

        $insert->bindValue(':nom', $data['nom'], SQLITE3_TEXT);
        $insert->bindValue(':prenom', $data['prenom'], SQLITE3_TEXT);
        $insert->bindValue(':email', $data['email'], SQLITE3_TEXT);
        $insert->bindValue(':telephone', $data['telephone'], SQLITE3_TEXT);
        $insert->bindValue(':adresse', $data['adresse'], SQLITE3_TEXT);
        $insert->bindValue(':experience', $data['experience'], SQLITE3_TEXT);
        $insert->bindValue(':education', $data['education'], SQLITE3_TEXT);
        $insert->bindValue(':langue', $data['langue'], SQLITE3_TEXT);
        $insert->bindValue(':hobbies', $data['hobbies'], SQLITE3_TEXT);
        $insert->bindValue(':photoPath', $data['photoPath'], SQLITE3_TEXT);
        $insert->bindValue(':diplome', $data['diplome'], SQLITE3_TEXT);
        $insert->bindValue(':posteA', $data['posteA'], SQLITE3_TEXT);

        $result = $insert->execute();

        return $result;
    }
}

$database = new CVDatabase('cv_database.db');

$data = [
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email' => $_POST['email'],
    'telephone' => $_POST['telephone'],
    'adresse' => $_POST['adresse'],
    'experience' => $_POST['experience'],
    'education' => $_POST['education'],
    'langue' => $_POST['langue'],
    'hobbies' => $_POST['hobbies'],
    'diplome' => $_POST['diplome'],
    'posteA' => $_POST['posteA'],
    'photoPath' => ''
];

$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

if ($_FILES["photo"]["name"] !== '') {
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
}

if ($_FILES["photo"]["size"] > 5000000) {
    echo "Désolé, votre fichier est trop volumineux.";
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
    $uploadOk = 0;
}

$photoPath = '';

if ($_FILES["photo"]["name"] !== '') {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        $photoPath = $targetFile;
    } else {
        echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
    }
}

if ($photoPath === '' && isset($_POST['existing_photo_path'])) {
    $photoPath = $_POST['existing_photo_path'];
}

$data['photoPath'] = $photoPath;

$result = $database->insertCV($data);

if ($result) {
    echo "<body style='background-color: #2a2f42; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;'>
    <div style='text-align: center; color: white;'>
        <h1>CV enregistré avec succès !</h1>
        <a href='listCv.php'>Liste des CV</a>
    </div>
    </body>";
} else {
    echo "<div style='text-align: center; color: white;'>
    <h1>Erreur lors de l'enregistrement du CV.</h1>
</div>";
}
?>
