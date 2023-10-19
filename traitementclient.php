<?php
include "Classe/Database.php";
include "Classe/Client.php";

$database = new Database();
$db = $database->getConnection();
$client = new Client($db);
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
        $client->nom = $_POST['nom'];
        $client->prenom = $_POST['prenom'];
        $client->email = $_POST['email'];
        $client->ajouter();
        $message = "Client ajouté avec succès!";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>





<!DOCTYPE html>
<html>
<head>
    <title>Formulaire Client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="traitementclient.php">
        ID: <input type="text" name="clientId"><br>
        Nom: <input type="text" name="nom"><br>
        Prénom: <input type="text" name="prenom"><br>
        Email: <input type="text" name="email"><br>
        Mot de passe: <input type="password" name="mot_de_passe"><br>
        <input type="submit" name="action" value="Ajouter">
        <input type="submit" name="action" value="Mettre à jour">
        <input type="submit" name="action" value="Supprimer">
    </form>
</body>
</html>
