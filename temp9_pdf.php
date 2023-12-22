<?php
require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;

if (isset($_GET['id'])) {
    $db = new SQLite3('cv_database.db');
    $cv_id = $_GET['id'];

    $query = $db->prepare('SELECT * FROM cv WHERE id = :id');
    $query->bindValue(':id', $cv_id, SQLITE3_INTEGER);
    $result = $query->execute();

    if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $prenom = $row['prenom'];
        $nom = $row['nom'];
        $posteA = $row['posteA'];
        $email = $row['email'];
        $telephone = $row['telephone'];
        $adresse = $row['adresse'];
        $photo_path = $row['photo_path'];
        $experience = $row['experience'];
        $diplome = $row['diplome'];
        $education = $row['education'];
        $hobbies = $row['hobbies'];

        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Mon CV</title>
            <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background: linear-gradient(to bottom, #DA4453, #89216B);
                color: #333;
            }
        
            .container {
                width: 80%;
                margin: 20px auto;
                background-color: #FFE53B;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                border-radius: 5px;
            }

            .contact-info, .work-experience, .education, .skills  {
                background-color: #CCCCCC;
                margin-bottom: 20px;
                border-radius: 10px;
                padding: 10px;
            }
            
            .work-experience {
                background-color: #E0E0E0;
                margin-bottom: 20px;
            }

            .education {
                background-color: #CCCCCC;
                margin-bottom: 20px;
            }

            .skills {
                background-color: #B8B8B8;
                margin-bottom: 20px;
            }
        </style>

        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>' . htmlspecialchars($prenom . ' ' . $nom) . '</h1>
                    <p>Poste recherché : ' . htmlspecialchars($posteA) . '</p>
                </div>

                <div>
                    <img src="' . htmlspecialchars($photo_path) . '" alt="Photo" style="max-width: 200px;">
                </div>

                <div class="contact-info">
                    <h2>Coordonnées</h2>
                    <p>Email: ' . htmlspecialchars($email) . '</p>
                    <p>Téléphone: ' . htmlspecialchars($telephone) . '</p>
                    <p>Adresse: ' . htmlspecialchars($adresse) . '</p>';

        $html .= '</div>

                <div class="work-experience">
                    <h2>Expérience professionnelle</h2>
                    <ul>
                        <li>' . htmlspecialchars($experience) . '</li>
                    </ul>
                </div>

                <div class="education">
                    <h2>Formation</h2>
                    <p><strong>Diplôme obtenu: ' . htmlspecialchars($diplome) . '</strong></p>
                    <p>' . htmlspecialchars($education) . '</p>
                </div>

                <div class="skills">
                    <h2>Soft Skills</h2>
                    <ul>
                        <li>' . htmlspecialchars($hobbies) . '</li>
                    </ul>
                </div>
            </div>
        </body>
        </html>';

        $mpdf = new Mpdf(['mode' => 'utf-8']);
        $mpdf->WriteHTML($html);
        $mpdf->Output('cv.pdf', 'D');
    } else {
        echo "Aucun CV trouvé avec cet ID.";
    }

    $db->close();
} else {
    echo "ID du CV non spécifié.";
}
?>
