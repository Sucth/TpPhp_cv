<?php
/*
Ce script PHP est dédié à la gestion de l'édition des CVs stockés dans une base de données SQLite.

Classe :
- CVEditor : Gère la mise à jour des informations d'un CV dans la base de données, ainsi que l'affichage d'un formulaire pour éditer les détails du CV.

Comportement :
- CVEditor :
    - __construct() : Initialise la connexion à la base de données SQLite.
    - updateCV($cv_id) : Met à jour les informations du CV dans la base de données si une requête POST est reçue avec les champs modifiés.
    - displayCVForm($cv_id) : Affiche un formulaire pré-rempli avec les détails du CV à éditer.
    - closeDB() : Ferme la connexion à la base de données.

Le script vérifie d'abord si un ID de CV est spécifié dans les paramètres GET.
S'il est spécifié, une instance de CVEditor est créée avec le fichier de base de données spécifié.
Ensuite, il essaie de mettre à jour les informations du CV s'il reçoit une requête POST.
Enfin, il affiche le formulaire pré-rempli pour éditer les détails du CV.

Ce script ne garantit pas la sécurité contre les injections SQL. Une validation et une échappatoire des données d'entrée sont nécessaires pour éviter les attaques.
*/
class CVEditor {
    private $db;
    
    public function __construct($db_file) {
        $this->db = new SQLite3($db_file);
    }
    
    public function updateCV($cv_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fields = ['prenom', 'nom', 'email', 'telephone', 'adresse', 'experience', 'education', 'hobbies', 'posteA', 'diplome'];
            $values = [];
            foreach ($fields as $field) {
                $values[$field] = $_POST[$field];
            }
            $query = $this->db->prepare('UPDATE cv SET prenom = :prenom, nom = :nom, email = :email, telephone = :telephone, adresse = :adresse, experience = :experience, education = :education, hobbies = :hobbies WHERE id = :id');
            foreach ($values as $key => $value) {
                $query->bindValue(':' . $key, $value, SQLITE3_TEXT);
            }
            $query->bindValue(':id', $cv_id, SQLITE3_INTEGER);
            $result = $query->execute();

            if ($result) {
                echo "Les informations ont été mises à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour des informations.";
            }
        }
    }
    
    public function displayCVForm($cv_id) {
        $query = $this->db->prepare('SELECT * FROM cv WHERE id = :id');
        $query->bindValue(':id', $cv_id, SQLITE3_INTEGER);
        $result = $query->execute();

        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            ?>
            <html>
            <head>
                <style>
                    body {
                    background-color: #080f25;
                    color: white;
                    font-family: Arial, sans-serif;
                }

                .cv-form {
                    margin: 20px;
                }

                .cv-form label {
                    display: block;
                    margin-bottom: 6px;
                }

                .cv-form input[type="text"],
                .cv-form textarea {
                    color: white;
                    background-color: #2a2f42;
                    border: none;
                    border-radius: 4px;
                    padding: 8px;
                    margin-bottom: 10px;
                    width: 100%;
                    box-sizing: border-box;
                }

                .cv-form input[type="submit"] {
                    color: white;
                    background-color: #2a2f42;
                    border: none;
                    border-radius: 4px;
                    padding: 8px 20px;
                    cursor: pointer;
                }
                
                button{
                    color: white;
                    background-color: #2a2f42;
                    border: none;
                    border-radius: 4px;
                    padding: 8px 20px;
                    cursor: pointer;
                }
                </style>
            </head>
            <body>
                    <form action="" method="post" class="cv-form">
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

                    <label for="posteA">Poste Recherche:</label><br>
                    <textarea name="posteA"><?php echo $row['posteA']; ?></textarea><br>

                    <label for="diplome">Diplome:</label><br>
                    <textarea name="diplome"><?php echo $row['diplome']; ?></textarea><br>
                    
                    <input type="submit" value="Enregistrer">
                    
                </form>
                <button onclick="window.location.href = 'listCv.php';">
                    Retour
                </button>
            </body>
            </html>
            <?php
        } else {
            echo "Aucun CV trouvé avec cet ID.";
        }
    }
    
    public function closeDB() {
        $this->db->close();
    }
}

if (isset($_GET['id'])) {
    $cvEditor = new CVEditor('cv_database.db');
    $cv_id = $_GET['id'];

    $cvEditor->updateCV($cv_id);
    $cvEditor->displayCVForm($cv_id);

    $cvEditor->closeDB();
} else {
    echo "ID du CV non spécifié.";
}
?>
