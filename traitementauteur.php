<?php
include "Classe/Database.php";
include "Classe/Auteur.php";

$database = new Database();
$db = $database->getConnection();

$auteur = new Auteur($db);
$message = "";


$id = isset($_POST['authorId']) ? $_POST['authorId'] : "";
$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$date_de_naissance = isset($_POST['date_de_naissance']) ? $_POST['date_de_naissance'] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($nom) && !empty($prenom)) {
        $auteur->nom = $nom;
        $auteur->prenom = $prenom;

        switch ($_POST['action']) {
            case 'Ajouter':
                $auteur->ajouter();
                $message = "Auteur ajouté avec succès!";
                break;
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

$query = $db->query("SELECT * FROM auteurs");
if ($query) {
    if ($query->rowCount() > 0) {
        echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de Naissance</th>
            </tr>";
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['nom'] . "</td>
                    <td>" . $row['prenom'] . "</td>
                    <td>" . $row['date_naissance'] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "Aucun auteur trouvé.";
    }
} else {
    echo "Erreur lors de la récupération des données.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulaire Auteur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="traitementauteur.php">
        ID: <input type="text" name="authorId" value="<?php echo $id; ?>"><br>
        Nom: <input type="text" name="nom" value="<?php echo $nom; ?>"><br>
        Prénom: <input type="text" name="prenom" value="<?php echo $prenom; ?>"><br>
        Date de naissance: <input type="date" name="date_de_naissance" value="<?php echo $date_de_naissance; ?>"><br>
        <input type="submit" name="action" value="Ajouter">
        <input type="date" name="date_naissance" required>
        <input type="submit" name="action" value="Mettre à jour">
        <input type="submit" name="action" value="Supprimer">
    </form>
</body>
</html>
