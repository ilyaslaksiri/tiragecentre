<?php
include_once("connex.inc.php");
$idcom = connex("tirage_centre_db", "myparam");

if ($idcom) {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $sql = "UPDATE conges SET STATUT_CONGE = 'Rejeté' WHERE ID_CONGE = $id";
        $result = mysql_query($sql, $idcom);
        if ($result) {
            echo "success";
        } else {
            echo "Erreur d'exécution : " . mysql_error($idcom);
        }
    } else {
        echo "Erreur : ID non fourni";
    }
    mysql_close($idcom);
} else {
    echo "Erreur : Connexion à la base de données échouée";
}
?>
