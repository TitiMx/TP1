<?php
include "Classe/Database.php";
include "Classe/Commande.php";

$database = new Database();
$db = $database->getConnection();

$commande = new Commande($db);
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['client_id']) && !empty($_POST['livre_id'])) {
        $commande->client_id = $_POST['client_id'];
        $commande->livre_id = $_POST['livre_id'];
        $commande->ajouter();
        $message = "Commande ajoutée avec succès!";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Formulaire Commande</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="traitementcommande.php">
        ID: <input type="text" name="commandeId"><br>
        Client : <input type="text" name="client_id"><br>
        Livre : <input type="text" name="livre_id"><br>
        Quantité : <input type="number" name="quantite"><br>
        Date de commande: <input type="date" name="date_commande"><br>
        <input type="submit" name="action" value="Ajouter">
        <input type="submit" name="action" value="Mettre à jour">
        <input type="submit" name="action" value="Supprimer">
    </form>
</body>
</html>
