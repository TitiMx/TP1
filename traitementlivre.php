<?php
include "Classe/Database.php";
include "Classe/Livre.php";

$database = new Database();
$db = $database->getConnection();

$livre = new Livre($db);
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['titre']) && !empty($_POST['prix'])) {
        $livre->titre = $_POST['titre'];
        $livre->prix = $_POST['prix'];
        $livre->ajouter();
        $message = "Livre ajouté avec succès!";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Formulaire Livre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="traitementlivre.php">
        ID: <input type="text" name="livreId"><br>
        Titre: <input type="text" name="titre"><br>
        Prix: <input type="text" name="prix"><br>
        <input type="submit" name="action" value="Ajouter">
        <input type="submit" name="action" value="Mettre à jour">
        <input type="submit" name="action" value="Supprimer">
    </form>
</body>
</html>
