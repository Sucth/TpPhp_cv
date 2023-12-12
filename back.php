<?php
$db = new SQLite3('cv_database.db');

$db->exec("CREATE TABLE IF NOT EXISTS cv (
    id INTEGER PRIMARY KEY,
    nom TEXT,
    prenom TEXT,
    email TEXT,
    telephone TEXT,
    adresse TEXT,
    experience TEXT,
    education TEXT,
    langue TEXT,
    hobbies TEXT
)");

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];
$experience = $_POST['experience'];
$education = $_POST['education'];
$langue = $_POST['langue'];
#$niveau = $_POST['niveau'];
$hobbies = $_POST['hobbies'];

$insert = $db->prepare("INSERT INTO cv (nom, prenom, email, telephone, adresse, experience, education, langue, hobbies) VALUES (:nom, :prenom, :email, :telephone, :adresse, :experience, :education, :langue, :hobbies)");
$insert->bindValue(':nom', $nom, SQLITE3_TEXT);
$insert->bindValue(':prenom', $prenom, SQLITE3_TEXT);
$insert->bindValue(':email', $email, SQLITE3_TEXT);
$insert->bindValue(':telephone', $telephone, SQLITE3_TEXT);
$insert->bindValue(':adresse', $adresse, SQLITE3_TEXT);
$insert->bindValue(':experience', $experience, SQLITE3_TEXT);
$insert->bindValue(':education', $education, SQLITE3_TEXT);
$insert->bindValue(':langue', $langue, SQLITE3_TEXT);
#$inser->bindValue(':niveau', $niveau, SQLITE3_INTEGER);
$insert->bindValue(':hobbies', $hobbies, SQLITE3_TEXT);

$result = $insert->execute();

if ($result) {
    echo "CV enregistré avec succès !";
} else {
    echo "Erreur lors de l'enregistrement du CV.";
}
?>
