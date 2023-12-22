<?php
/*
Ce script PHP supprime une entrée de la base de données pour un CV spécifique en utilisant la méthode deleteCV de la classe CVDatabase.

Classes :
- CVDatabase : Gère la connexion à la base de données SQLite et la suppression d'un CV par son ID.

Comportement :
- Vérifie si la méthode de requête est POST ($_SERVER["REQUEST_METHOD"] === "POST") et si l'ID du CV est défini ($_POST['id']).
- Si les conditions ci-dessus sont remplies, inclut la classe CVDatabase et crée une instance pour accéder à la base de données.
- Récupère l'ID du CV à supprimer depuis la requête POST.
- Utilise la méthode deleteCV pour supprimer l'entrée correspondante dans la base de données.
- Redirige vers index.php après la suppression du CV.
- Sinon, affiche un message d'erreur indiquant qu'une erreur s'est produite lors de la suppression du CV.
*/
class CVDatabase {
    private $db;

    public function __construct($database) {
        $this->db = new SQLite3($database);
    }

    public function deleteCV($id) {
        $stmt = $this->db->prepare('DELETE FROM cv WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    include 'CVDatabase.php';

    $db = new CVDatabase('cv_database.db');
    $cvIdToDelete = $_POST['id'];

    $db->deleteCV($cvIdToDelete);

    header("Location: index.php");
    exit;
} else {
    echo "Une erreur s'est produite lors de la suppression du CV.";
}
?>
