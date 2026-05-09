<?php
include "template/header_popin.php";

$access_levels = isset($_SESSION["access_level"]) ? explode(',', $_SESSION["access_level"]) : array();

// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$dbname = "tirage_centre_db"; // Nom de votre base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les utilisateurs si l'utilisateur connecté a les droits nécessaires
$sql_users = "SELECT ID_USER, NOM_USER, PRENOM_USER FROM USERS";
$result_users = $conn->query($sql_users);

// Traiter la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $demandeur = $_POST["demandeur"];
    $date_demande = $_POST["date_demande"];
    $motif = $_POST["motif"];

    // Formater la date au format MySQL (YYYY-MM-DD)
    $date_demande_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $date_demande)));

    // Préparation de la requête SQL pour insérer une nouvelle demande d'attestation
    $sql_insert = "INSERT INTO attestations (ID_USER, DATE_DEMANDE_ATTESTATION, MOTIF_ATTESTATION)
                   VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql_insert);
    
    // Vérification de la préparation de la requête
    if ($stmt === false) {
        echo "Erreur de préparation de la requête : " . $conn->error;
        exit();
    }

    $stmt->bind_param("iss", $demandeur, $date_demande_mysql, $motif);

    if ($stmt->execute()) {
        echo "Demande d'attestation envoyée avec succès.";
        echo '<script>window.opener.location.reload(); window.close();</script>'; // Actualise la page parent et ferme la pop-up
        exit(); // Assurez-vous qu'aucun code ne s'exécute après la redirection
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

<script>
    $(document).ready(function() {
        // Initialiser les date pickers
        $('#date_demande').datepicker({
            dateFormat: 'dd/mm/yy', // Format de date
            changeMonth: true, // Permet de changer le mois
            changeYear: true, // Permet de changer l'année
            defaultDate: new Date(), // Date par défaut
            onSelect: function(selectedDate) {
                $(this).datepicker("hide"); // Fermer le datepicker après sélection
            }
        });
    });
</script>

<fieldset style="background-color: #b5e5ef; width: 80%; margin-left: auto; margin-right: auto;">
    <h3 class="titre_info" align="center">Nouvelle attestation</h3>
</fieldset>

<fieldset style="width: 80%; margin-left: auto; margin-right: auto;">
    <form action="" method="post">
        <table width="70%" align="center">
            <tr>
                <td align="left">Demandeur <span style="color:#FF0000">(*)</span>&nbsp;:</td>
                <td>
                    <?php if (in_array('adminRH', $access_levels) || in_array('admin', $access_levels)) { ?>
                        <select name="demandeur" required>
                            <?php
                            if ($result_users->num_rows > 0) {
                                // Afficher chaque utilisateur dans la liste déroulante
                                while ($row = $result_users->fetch_assoc()) {
                                    echo '<option value="' . $row["ID_USER"] . '">' . $row["PRENOM_USER"] . ' ' . $row["NOM_USER"] . '</option>';
                                }
                            } else {
                                echo '<option value="">Aucun utilisateur trouvé</option>';
                            }
                            ?>
                        </select>
                    <?php } else { ?>
                        <b><?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"]; ?></b>
                        <input type="hidden" name="demandeur" value="<?php echo $_SESSION["id_user"]; ?>" />
                    <?php } ?>
                </td>
            </tr>
            
            <tr>
                <td align="left">Date <span style="color:#FF0000">(*)</span> :</td>
                <td><input type="text" name="date_demande" id="date_demande" class="datepicker" value="" required style="width:30%" autocomplete="off" /></td>
            </tr>
            <tr>
                <td align="left">Motif <span style="color:#FF0000">(*)</span> :</td>
                <td><textarea name="motif" id="motif" style="width:100%; height:100px;" required></textarea></td>
            </tr>
        </table>
        <div align="center">
            <h3><input name="submit" type="submit" value="Envoyer la demande" /></h3>
        </div>
    </form>
</fieldset>
