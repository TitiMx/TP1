<?php
include 'database.php';

if (isset($_POST['ajouter'])) {
    $numero = $_POST['numero'];
    $date = $_POST['date'];
    $stmt = $pdo->prepare("INSERT INTO commandes (numero, date) VALUES (?, ?)");
    $stmt->execute([$numero, $date]);
}

$query = $pdo->query("SELECT * FROM commandes");
$commandes = $query->fetchAll();
?>

<form action="commande.php" method="post">
    Numéro de commande : <input type="number" name="numero">
    Date : <input type="date" name="date">
    <input type="submit" name="ajouter" value="Ajouter">
</form>

<h2>Liste des commandes</h2>
<ul>
<?php foreach ($commandes as $commande): ?>
    <li><?= $commande['numero'] . " - " . $commande['date']; ?></li>
<?php endforeach; ?>
</ul>
