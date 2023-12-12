<?php
$db = new SQLite3('cv_database.db');

$query = $db->query('SELECT * FROM cv');

if ($query) {
    while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
        echo "<h2>CV de " . $row['prenom'] . " " . $row['nom'] . "</h2>";
        echo "<p>Email: " . $row['email'] . "</p>";
        echo "<p>Téléphone: " . $row['telephone'] . "</p>";
        echo "<p>Adresse: " . $row['adresse'] . "</p>";
        echo "<p>Expérience professionnelle: " . $row['experience'] . "</p>";
        echo "<p>Parcours académique: " . $row['education'] . "</p>";
        echo "<p>Hobbies: " . $row['hobbies'] . "</p>";
        echo "<hr>";
    }
} else {
    echo "Aucun CV enregistré.";
}

$db->close();
?>
