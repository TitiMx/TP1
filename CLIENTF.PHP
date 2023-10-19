<?php
include 'database.php';


if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $stmt = $pdo->prepare("INSERT INTO clients (nom, adresse) VALUES (?, ?)");
    $stmt->execute([$nom, $adresse]);
}

$query = $pdo->query("SELECT * FROM clients");
$clients = $query->fetchAll();
?>

<form action="client.php" method="post">
    Nom : <input type="text" name="nom">
    Adresse : <input type="text" name="adresse">
    <input type="submit" name="ajouter" value="Ajouter">
</form>

<h2>Liste des clients</h2>
<ul>
<?php foreach ($clients as $client): ?>
    <li><?= $client['nom'] . " - " . $client['adresse']; ?></li>
<?php endforeach; ?>
</ul>
