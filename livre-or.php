<?php
session_start();

// Connexion à la base de données
$conn = new mysqli("localhost", "pma", "plomkiplomki", "livreor");
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

// Requête pour récupérer les commentaires du livre d'or (organisés du plus récent au plus ancien)
$sql = "SELECT * FROM commentaires ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!-- Affichage des commentaires du livre d'or -->
<h2>Livre d'or</h2>
<?php
// Vérification de l'authentification de l'utilisateur
if (isset($_SESSION['login'])) {
    echo '<a href="commentaire.php">Ajouter un commentaire</a><br>';
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $date = date('d/m/Y', strtotime($row['date']));
        $utilisateur = $row['id_utilisateur']; // Correction ici
        $commentaire = $row['commentaire'];

        echo "Posté le $date par $utilisateur:<br>";
        echo "$commentaire<br><br>";
    }
} else {
    echo "Aucun commentaire pour le moment.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>

