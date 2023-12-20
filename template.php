<?php
if (isset($_GET['id'])) {
    $db = new SQLite3('cv_database.db');
    $cv_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "Les informations ont été mises à jour avec succès.";
    }

    $query = $db->prepare('SELECT * FROM cv WHERE id = :id');
    $query->bindValue(':id', $cv_id, SQLITE3_INTEGER);
    $result = $query->execute();

    if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mon CV</title>
            <style>
              body {
                      font-family: Arial, sans-serif;
                      margin: 0;
                      padding: 0;
                      background-color: #f4f4f4;
                      color: #333;
                  }
                  
                  .container {
                      width: 80%;
                      margin: 20px auto;
                      background-color: #fff;
                      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                      padding: 20px;
                      border-radius: 5px;
                  }
                  
                  .header {
                      text-align: center;
                      margin-bottom: 20px;
                  }
                  
                  .header h1 {
                      font-size: 28px;
                      margin: 5px 0;
                  }
                  
                  .header p {
                      font-size: 18px;
                      margin: 5px 0;
                      color: #666;
                  }
                  
                  .contact-info, .work-experience, .education, .skills {
                      margin-bottom: 20px;
                  }
                  
                  h2 {
                      font-size: 24px;
                      margin-bottom: 10px;
                  }
                  
                  strong {
                      font-weight: bold;
                  }
                  
                  em {
                      font-style: italic;
                      color: #555;
                  }
                  
                  ul {
                      list-style-type: none;
                      padding-left: 0;
                  }
                  
                  li {
                      margin-bottom: 5px;
                  }
            </style>
        </head>
        <body>
        <div class="container">
                <div class="header">
                    <h1><?php echo $row['prenom'] . ' ' . $row['nom']; ?></h1>
                    <p>Poste recherché : <?php echo $row['posteA']; ?></p>
                </div>

                <div class="contact-info">
                    <h2>Coordonnées</h2>
                    <p>Email: <?php echo $row['email']; ?></p>
                    <p>Téléphone: <?php echo $row['telephone']; ?></p>
                    <p>Adresse: <?php echo $row['adresse']; ?></p>
                    <?php if ($row['photo_path']) : ?>
                        <img src="<?php echo $row['photo_path']; ?>" alt="Photo" style="max-width: 200px;">
                    <?php endif; ?>
                </div>

                <div class="work-experience">
                    <h2>Expérience professionnelle</h2>
                    <ul>
                        <li><?php echo $row['experience']; ?></li>
                    </ul>
                </div>

                <div class="education">
                    <h2>Formation</h2>
                    <p><strong>Diplôme obtenu :<?php echo $row['diplome']; ?></strong></p>
                    <p><em>Nom de l'établissement - Ville, Pays</em></p>
                    <p><?php echo $row['education']; ?></p>
                    <!-- Ajoute d'autres éléments de la formation ici -->
                </div>

                <div class="skills">
                    <h2>Soft Skills</h2>
                    <ul>
                        <li><?php echo $row['hobbies']; ?></li>
                        <!-- Ajoute d'autres compétences ici -->
                    </ul>
                </div>
            </div>
        </body>
        </html>
<?php
    } else {
        echo "Aucun CV trouvé avec cet ID.";
    }

    $db->close();
} else {
    echo "ID du CV non spécifié.";
}
?>
