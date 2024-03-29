<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de CV</title>
    <link rel="stylesheet" type="text/css" href="form.css" />
    <style>
        body {
    background-color: #080f25;
    color: white;
}

input, select, textarea {
    color: white;
    background-color: #2a2f42;
    border: none;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 10px;
}

#title {
    color: white;
}
.card.top-details {
    z-index: 1;
    grid-row-gap: 16px;
    border-radius: 8px;
    flex-direction: column;
    padding: 20px;
    display: flex;
    position: relative;
    color: white;
}

button{
    color: white;
    background-color: #2a2f42;
    border: none;
    border-radius: 4px;
    padding: 8px 20px;
    cursor: pointer;
}

.card {
    background-color: #101935;
    border: 0.6px solid #343b4f;
    border-radius: 12px;
    margin: 1%;
    box-shadow: 0 2px 7px rgba(20, 20, 43, .06);
    color: white;
}
    </style>
</head>
<body>
    <h1 id="title">Creer votre CV</h1>
    <form action="back.php" method="post" enctype="multipart/form-data">
        <div class="card top-details">
            <label id="cvinfo" for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>
        </div>

        <div class="card top-details">
            <label id="cvinfo" for="prenom">Prenom :</label>
            <input type="text" id="prenom" name="prenom" required><br><br>
        </div>

        <div class="card top-details">
            <label id="cvinfo" for="posteA">Poste Recherche :</label>
            <input type="text" id="posteA" name="posteA" required><br><br>
        </div>

        <div class="card top-details">
            <label id="cvinfo" for="diplome">Diplome :</label>
            <input type="text" id="diplome" name="diplome" required><br><br>
        </div>

        <div class="card top-details">
            <label id="cvinfo" for="email">Email :</label>
            <input type="email" id="email" name="email" required><br><br>
        </div>
        
        <div class="card top-details">
            <label id="cvinfo" for="telephone">Telephone :</label>
            <input type="tel" id="telephone" name="telephone" required><br><br>
        </div>

        <div class="card top-details">
            <label id="cvinfo" for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse"><br><br>
        </div>

        <div class="card top-details">
            <label id="cvinfo" for="experience">Expérience professionnelle :</label><br><br>
            <textarea id="experience" name="experience" rows="3" cols="50"></textarea><br><br>
        </div>

        <div class="card top-details">
            <label id="cvinfo" for="education">Parcours academique :</label><br><br>
            <textarea id="education" name="education" rows="3" cols="50"></textarea><br><br>
        </div>

        <div class="card top-details">
            <label id="cvinfo" for="langue">Langue :</label>
            <select id="langue" name="langue">
                <option value="francais">Francais</option>
                <option value="anglais">Anglais</option>
                <option value="espagnol">Espagnol</option>
            </select><br><br>
        </div>

        <div class="card top-details">
            <label id="cvinfo" for="hobbies">Hobbies :</label><br><br>
            <textarea id="hobbies" name="hobbies" rows="3" cols="50"></textarea><br><br>
        </div>

        <div class="card top-details">
            <label id="cvinfo" for="photo">Photo :</label>
            <input type="file" id="photo" name="photo" accept="image/*"><br><br>
        </div>

        <input type="submit" value="Enregistrer le CV">
    </form>
    <button onclick="window.location.href = 'listCv.php';">
            List CV
     </button>
</body>
</html>
