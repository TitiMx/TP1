<?php
include 'database.php';

if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $stmt = $pdo->prepare("INSERT INTO livres (titre, auteur) VALUES (?, ?)");
    $stmt->execute([$titre, $auteur]);
}

$query = $pdo->query("SELECT * FROM livres");
$livres = $query->fetchAll();
?>

<form action="livre.php" method="post">
    Titre : <input type="text" name="titre">
    Auteur : <input type="text" name="auteur">
    <input type="submit" name="ajouter" value="Ajouter">
</form>

<h2>Liste des livres</h2>
<ul>
<?php foreach ($livres as $livre): ?>
    <li><?= $livre['titre'] . " - " . $livre['auteur']; ?></li>
<?php endforeach; ?>
</ul>
