<?php
if(isset($_GET['id'])) {
    $db = new SQLite3('cv_database.db');
    $cv_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_prenom = $_POST['prenom'];
        $new_nom = $_POST['nom'];
        $new_email = $_POST['email'];
        $new_telephone = $_POST['telephone'];
        $new_adresse = $_POST['adresse'];
        $new_experience = $_POST['experience'];
        $new_education = $_POST['education'];
        $new_hobbies = $_POST['hobbies'];

        $query = $db->prepare('UPDATE cv SET prenom = :prenom, nom = :nom, email = :email, telephone = :telephone, adresse = :adresse, experience = :experience, education = :education, hobbies = :hobbies WHERE id = :id');
        $query->bindValue(':prenom', $new_prenom, SQLITE3_TEXT);
        $query->bindValue(':nom', $new_nom, SQLITE3_TEXT);
        $query->bindValue(':email', $new_email, SQLITE3_TEXT);
        $query->bindValue(':telephone', $new_telephone, SQLITE3_TEXT);
        $query->bindValue(':adresse', $new_adresse, SQLITE3_TEXT);
        $query->bindValue(':experience', $new_experience, SQLITE3_TEXT);
        $query->bindValue(':education', $new_education, SQLITE3_TEXT);
        $query->bindValue(':hobbies', $new_hobbies, SQLITE3_TEXT);
        $query->bindValue(':id', $cv_id, SQLITE3_INTEGER);
        $result = $query->execute();

        if ($result) {
            echo "Les informations ont été mises à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour des informations.";
        }
    }

    $query = $db->prepare('SELECT * FROM cv WHERE id = :id');
    $query->bindValue(':id', $cv_id, SQLITE3_INTEGER);
    $result = $query->execute();

    if($row = $result->fetchArray(SQLITE3_ASSOC)) {
        ?>
        <form action="" method="post">
            <label for="prenom">Prénom:</label><br>
            <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>"><br>
            
            <label for="nom">Nom:</label><br>
            <input type="text" name="nom" value="<?php echo $row['nom']; ?>"><br>

            <label for="email">Email:</label><br>
            <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>

            <label for="telephone">Téléphone:</label><br>
            <input type="text" name="telephone" value="<?php echo $row['telephone']; ?>"><br>

            <label for="adresse">Adresse:</label><br>
            <input type="text" name="adresse" value="<?php echo $row['adresse']; ?>"><br>

            <label for="experience">Expérience professionnelle:</label><br>
            <textarea name="experience"><?php echo $row['experience']; ?></textarea><br>

            <label for="education">Parcours académique:</label><br>
            <textarea name="education"><?php echo $row['education']; ?></textarea><br>

            <label for="hobbies">Hobbies:</label><br>
            <textarea name="hobbies"><?php echo $row['hobbies']; ?></textarea><br>
            
            <input type="submit" value="Enregistrer">
        </form>
        <?php
    } else {
        echo "Aucun CV trouvé avec cet ID.";
    }

    $db->close();
} else {
    echo "ID du CV non spécifié.";
}
?>
