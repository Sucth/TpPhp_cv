<?php
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
