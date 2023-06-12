<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

if ($_SESSION["login"] !== "admin") {
    // Redirection vers la page d'accueil si l'utilisateur n'est pas l'administrateur
    header("Location: index.php");
    exit();
}

// Connexion à la base de données
$conn = new mysqli("localhost", "admin", "admin", "moduleconnexion");

// Vérification des erreurs de connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Requête pour récupérer les informations des utilisateurs
$sql = "SELECT * FROM utilisateurs";

// Exécution de la requête
$result = $conn->query($sql);

// Vérification si des utilisateurs sont présents dans la base de données
if ($result->num_rows > 0) {
    echo "<h1>Liste des utilisateurs</h1>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Login</th><th>Prénom</th><th>Nom</th><th>Mot de passe</th></tr>";

    // Affichage des informations des utilisateurs
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["login"] . "</td>";
        echo "<td>" . $row["prenom"] . "</td>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Aucun utilisateur trouvé.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Administration</title>
    <link id="style" rel="stylesheet" type="text/css" href="style6.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap');
  </style>
</head>
<body class="bodyadmin">
    <h1>Administration</h1>
    <!-- Affichage des informations des utilisateurs -->
</body>
</html>

