<?php
include "template/header_popin.php";

$access_levels = isset($_SESSION["access_level"]) ? 
	explode(',', $_SESSION["access_level"]) : array();

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

// Récupérer les utilisateurs
$sql = "SELECT ID_USER, NOM_USER, PRENOM_USER FROM USERS";
$result = $conn->query($sql);

// Traiter la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $demandeur = (in_array('adminRH', $access_levels) || in_array('admin', $access_levels)) ? $_POST["demandeur"] : $_SESSION["ID_USER"];

    $date_debut = DateTime::createFromFormat('d/m/Y', $_POST["date_debut"])->format('Y-m-d');
    $date_fin = DateTime::createFromFormat('d/m/Y', $_POST["date_fin"])->format('Y-m-d');
    $message = $_POST["Message"];
    $nbJoursConge = $_POST["nombre_jours"];

    $statut = "En attente de validation";
    $date_demande = date('Y-m-d'); // Date actuelle

    $sql = "INSERT INTO CONGES (ID_USER, DATE_DEMANDE_CONGE, DATE_DEBUT_CONGE, DATE_FIN_CONGE, MESSAGE_CONGE, STATUT_CONGE, NB_JRS_CONGE)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssi", $demandeur, $date_demande, $date_debut, $date_fin, $message, $statut, $nbJoursConge);

    if ($stmt->execute()) {
        echo "Demande de congé envoyée avec succès.";
        echo '<script>window.opener.location.reload(); window.close();</script>'; // Actualise la page parent et ferme la pop-up
        exit(); // Assurez-vous qu'aucun code ne s'exécute après la redirection
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

<script>
    // Liste des jours fériés
    var holidays = [
            "2024-01-01", // Nouvel An
            "2024-04-21", // Fête nationale
            "2024-06-13", // Fête du Travail
            // Ajoutez d'autres jours fériés ici
        ];

    $(document).ready(function() {
        // Fonction pour vérifier si une date est un jour férié
        function isHoliday(date) {
            var dateString = $.datepicker.formatDate('yy-mm-dd', date);
            return holidays.indexOf(dateString) !== -1;
        }

        // Initialiser les date pickers
        $('#date_debut').datepicker({
            dateFormat: 'dd/mm/yy', // Format de date
            changeMonth: true, // Permet de changer le mois
            changeYear: true, // Permet de changer l'année
            defaultDate: new Date(), // Date par défaut
            beforeShowDay: function(date) {
                var day = date.getDay();
                // Griser les dimanches
                if (day === 0) {
                    return [false, 'ui-state-disabled', 'Dimanche'];
                }
                if (isHoliday(date)) {
                    return [false, 'holiday', 'Jour férié'];
                }
                return [true, '', ''];
            },
            onSelect: function(selectedDate) {
                // Définir minDate de date_fin lorsque date_debut est sélectionnée
                $('#date_fin').datepicker('option', 'minDate', selectedDate);
                calculateDays(); // Recalcule le nombre de jours
                $(this).datepicker("hide"); // Fermer le datepicker après sélection
            }
        });

        $('#date_fin').datepicker({
            dateFormat: 'dd/mm/yy', // Format de date
            changeMonth: true, // Permet de changer le mois
            changeYear: true, // Permet de changer l'année
            defaultDate: new Date(), // Date par défaut
            beforeShowDay: function(date) {
                var day = date.getDay();
                // Griser les dimanches
                if (day === 0) {
                    return [false, 'ui-state-disabled', 'Dimanche'];
                }
                if (isHoliday(date)) {
                    return [false, 'holiday', 'Jour férié'];
                }
                return [true, '', ''];
            },
            onSelect: function(selectedDate) {
                calculateDays(); // Recalcule le nombre de jours lorsque date_fin est sélectionnée
                $(this).datepicker("hide"); // Fermer le datepicker après sélection
            }
        });

        // Ajouter des gestionnaires d'événements pour recalculer les jours lorsque les dates changent
        $('#date_debut, #date_fin').change(calculateDays);
    });

    function calculateDays() {
        var date_debut = $('#date_debut').val();
        var date_fin = $('#date_fin').val();

        if (date_debut && date_fin) {
            var start = $.datepicker.parseDate('dd/mm/yy', date_debut);
            var end = $.datepicker.parseDate('dd/mm/yy', date_fin);

            // Calculer la différence en jours
            var diffTime = Math.abs(end - start);
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Ajouter 1 pour inclure le premier jour

            // Nombre de jours fériés
            var nbJrF = 0;
            // Nombre de dimanches
            var nbDim = 0;
            // Nombre de samedis en demi-journée
            var nbSamediDemiJournee = 0;

            // Boucle pour compter les jours fériés, les dimanches et les samedis en demi-journée
            var currentDate = new Date(start);
            while (currentDate <= end) {
                var dayOfWeek = currentDate.getDay();
                var dateString = $.datepicker.formatDate('yy-mm-dd', currentDate);

                if (dayOfWeek === 0) { // Dimanche
                    nbDim++;
                } else if (dayOfWeek === 6) { // Samedi
                    nbSamediDemiJournee += 0.5; // Ajouter une demi-journée
                } else if (holidays.indexOf(dateString) !== -1) { // Jour férié
                    nbJrF++;
                }

                currentDate.setDate(currentDate.getDate() + 1);
            }

            // Retirer les jours fériés, les dimanches et les samedis en demi-journée du résultat
            var totalDays = diffDays - nbJrF - nbDim - nbSamediDemiJournee;

            // Afficher le nombre de jours
            $('#nombre_jours').val(totalDays);
        } else {
            $('#nombre_jours').val('');
        }
    }
</script>

<style>
    .holiday .ui-state-default {
        background-color: #ffcccc;
        border: 1px solid #ff6666;
        color: #ff0000;
    }
</style>

<fieldset style="background-color: #b5e5ef; width: 80%; margin-left: auto; margin-right: auto;">
    <h3 class="titre_info" align="center">Nouvelle demande de congé</h3>
</fieldset>

<fieldset style="width: 80%; margin-left: auto; margin-right: auto;">
    <form action="" method="post">
        <table width="70%" align="center">
            <tr>    
                <td align="left">Demandeur <span style="color:#FF0000">(*)</span>&nbsp;:</td>
                <td>
                    <?php if (in_array('adminRH', $access_levels) ||
                                in_array('admin', $access_levels)) { ?>
                        <select name="demandeur" required>
                            <?php
                            if ($result->num_rows > 0) {
                                // Afficher chaque utilisateur dans la liste déroulante
                                while ($row = $result->fetch_assoc()) {
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
                <td align="left">Date de demande <span style="color:#FF0000">(*)</span> :</td>
                <td>
                    <b><?php echo date('d/m/Y'); ?></b>
                </td>
            </tr>
            <tr>
                <td align="left">Date de début <span style="color:#FF0000">(*)</span> :</td>
                <td><input type="text" name="date_debut" id="date_debut" class="datepicker" value="" required style="width:30%" autocomplete="off" /></td>
            </tr>
            <tr>
                <td align="left">Date de fin <span style="color:#FF0000">(*)</span> :</td>
                <td><input type="text" name="date_fin" id="date_fin" class="datepicker" value="" required style="width:30%" autocomplete="off" /></td>
            </tr>
            <tr>
                <td align="left">Nombre de jours :</td>
                <td><input type="text" id="nombre_jours" name="nombre_jours" readonly style="width:30%" /></td>
            </tr>
            <tr>
                <td align="left">Message <span style="color:#FF0000"></span> :</td>
                <td><textarea name="Message" id="Message" style="width:100%; height:100px;"></textarea></td>
            </tr>
        </table>
        <div align="center">
            <h3><input name="submit" type="submit" value="Envoyer la demande" /></h3>
        </div>
    </form>
</fieldset>

<?php
$conn->close();
?>
