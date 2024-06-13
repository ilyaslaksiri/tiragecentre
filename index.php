<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<form action="" method="post">
    <div class="wrap">
        <div class="avatar">
            <img src="images/logo-icon.png">
        </div>
        <input type="text" name="user" placeholder="Utilisateur" required>
        <div class="bar">
            <i></i>
        </div>
        <input type="password" name="password" placeholder="Mot de passe" required>
        </br>
        Exercice :
        <select name="exe">
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024" selected>2024</option>
        </select>
        </br></br>
        <button>Se connecter</button>
    </div>
    <script src="js/index.js"></script>
</form>

</body>
</html>

<?php
function redirige($url) {
    echo '<meta http-equiv="refresh" content="0;URL=' . htmlspecialchars($url) . '">';
    exit;
}

if (isset($_POST["user"]) && isset($_POST["password"])) {
    $user = $_POST["user"];
    $password = $_POST["password"];

    // Connexion à la base de données
    $serveur = "localhost";
    $db_user = "root";
    $db_mot_de_passe = "";
    $base_de_donnees = "tirage_centre_db";

    $connexion = new mysqli($serveur, $db_user, $db_mot_de_passe, $base_de_donnees);

    if ($connexion->connect_error) {
        die("La connexion à la base de données a échoué: " . $connexion->connect_error);
    }

    // Requête pour vérifier le login et le mot de passe
    $requete = $connexion->prepare("SELECT * FROM users WHERE LOGIN_USER = ? AND MOT_DE_PASSE_USER = ?");
    $requete->bind_param("ss", $user, $password);
    $requete->execute();
    $resultat = $requete->get_result();

    if ($resultat->num_rows > 0) {
        session_start();
        $row = $resultat->fetch_assoc();
		$_SESSION["id_user"] = $row["ID_USER"];
        $_SESSION["nom"] = $row["NOM_USER"];
        $_SESSION["prenom"] = $row["PRENOM_USER"];
        $_SESSION["login"] = $row["LOGIN_USER"];
        $_SESSION["access_level"] = $row["ACCESS_LEVEL_USER"];
        $_SESSION["annee"] = $_POST["exe"];
        //if ($row["ACCESS_LEVEL_USER"] == "admin") {
            redirige("list_client.php");
        //} else {
          //  redirige("list_client_bl.php");
        //}
    } else {
        echo "<center>Login ou mot de passe incorrectes !</center>";
    }

    $requete->close();
    $connexion->close();
}
?>
