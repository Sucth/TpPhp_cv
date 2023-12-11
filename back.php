<?php
// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];

try {
    $db = new SQLite3('Cv.db');

    if (!$db) {
        die("Connexion à la base de données échouée.");
    }

    $insertQuery = "INSERT INTO cv (nom, prenom, email, telephone, adresse) VALUES (:nom, :prenom, :email, :telephone, :adresse)";
    $statement = $db->prepare($insertQuery);

    $statement->bindParam(':nom', $nom);
    $statement->bindParam(':prenom', $prenom);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':telephone', $telephone);
    $statement->bindParam(':adresse', $adresse);

    $result = $statement->execute();

    if ($result) {
        echo "Les données ont été enregistrées avec succès dans la base de données.";
    } else {
        echo "Erreur lors de l'enregistrement des données.";
    }

    $db = null;
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
