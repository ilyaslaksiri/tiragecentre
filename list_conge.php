<?php 
include "template/header.php";
include "template/left.php";
include_once("connex.inc.php");
$idcom = connex("tirage_centre_db", "myparam");
$id_user=$_SESSION["id_user"];
// Initialiser la variable de requête selon le niveau d'accès
if (in_array('admin', $access_levels) || in_array('adminRH', $access_levels)) {
    $requete = "SELECT conges.*, users.NOM_USER, users.PRENOM_USER 
                FROM conges 
                INNER JOIN users ON conges.ID_USER = users.ID_USER";
} else {
    $requete = "SELECT conges.*, users.NOM_USER, users.PRENOM_USER 
                FROM conges 
                INNER JOIN users ON conges.ID_USER = users.ID_USER 
                WHERE conges.ID_USER = $id_user";
}

$result = mysql_query($requete, $idcom);


?>

<section id="main" class="column">
    <h4 class="titre_info">Liste des congés</h4><br/><br/>

    <style type="text/css" title="currentStyle">
        @import "media/css/demo_page.css";
        @import "media/css/demo_table_jui.css";
        @import "media/css/jquery-ui-1.8.4.custom.css";
        @import "media/css/ColVis.css";
        .ColVis {
            float: left;
            margin-bottom: 0
        }
        .dataTables_length {
            width: auto;
        }
    </style>
    <script type="text/javascript" charset="utf-8" src="media/js/jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" src="media/js/ColVis.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#example').dataTable({
                "sDom": '<"H"Cfr>t<"F"ip>',
                "bJQueryUI": true
            });
        });

        function changeStatus(id, action) {
            var url = action === 'valider' ? 'valider_conge.php' : 'rejeter_conge.php';
            $.ajax({
                url: url,
                type: 'GET',
                data: { id: id },
                success: function(response) {
                    if (response === "success") {
                        
                        location.reload(); // Recharger la page pour afficher les nouvelles données
                    } else {
                        alert("Erreur lors de la mise à jour du statut : " + response);
                    }
                },
                error: function(xhr, status, error) {
                    alert("Erreur AJAX : " + error);
                }
            });
        }
    </script>

    <div id="container">
        <div align="center">
            <b><a href="javascript:void(0)" onclick="openDemandeConge()">Nouvelle demande</a></b>
        </div>
        <script>
            function openDemandeConge() {
                var screenWidth = window.screen.width;
                var screenHeight = window.screen.height;
                var left = (screenWidth - 800) / 2;
                var top = (screenHeight - 800) / 2;
                window.open("demande_conge.php", "Demande de congé", "width=800,height=800,left=" + left + ",top=" + top + ",toolbar=no");
            }
        </script>

        <form>
            <div id="demo">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <th>Demandeur</th>
                        <th>Date de demande</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Message</th>
                        <th>Jours</th>
                        <th>Statut</th>
                        <?php if (in_array('adminRH', $access_levels) || in_array('admin', $access_levels)) { ?>
                            <th>Actions</th>
                        <?php } ?>
                        <th>Attestation</th>
                    </thead>
                    <tbody>
					<?php 
while ($ligne = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$ligne["NOM_USER"]." ".$ligne["PRENOM_USER"]."</td>";
    echo "<td>".date('d/m/Y', strtotime($ligne["DATE_DEMANDE_CONGE"]))."</td>";
    echo "<td>".date('d/m/Y', strtotime($ligne["DATE_DEBUT_CONGE"]))."</td>";
    echo "<td>".date('d/m/Y', strtotime($ligne["DATE_FIN_CONGE"]))."</td>";
    echo "<td>".$ligne["MESSAGE_CONGE"]."</td>";
    echo "<td>".$ligne["NB_JRS_CONGE"]."</td>";
    
    // Afficher le cercle de couleur en fonction du statut
    $statut = $ligne["STATUT_CONGE"];
    $circle_class = '';
    switch ($statut) {
        case 'En attente de validation':
            $circle_class = 'orange';
            break;
        case 'Validé':
            $circle_class = 'green';
            break;
        case 'Rejeté':
            $circle_class = 'red';
            break;
        default:
            $circle_class = '';
    }
    echo "<td><span class='circle ".$circle_class."'></span>".$statut."</td>";
    
    if (in_array('adminRH', $access_levels) || in_array('admin', $access_levels)) {
        echo "<td>";
        echo "<a href='javascript:void(0)' onclick='changeStatus(".$ligne["ID_CONGE"].", \"valider\")'>Valider</a> | ";
        echo "<a href='javascript:void(0)' onclick='changeStatus(".$ligne["ID_CONGE"].", \"rejeter\")'>Rejeter</a>";
        echo "</td>";
    }   
    // Afficher le lien d'impression uniquement si le statut est "Validé"
    if ($statut == "Validé") {
        print"
        <td align=center>
        <a href=# OnClick=\"window.open('imprimer_attestation_conge.php?id_conge=$ligne[ID_CONGE]','width=400','height=630','left=20','top=30');\"  title=Voir><img src=images/pdf.gif /></a>
        <a href=# OnClick=\"window.open('imprimer_demande_conge.php?id_conge=$ligne[ID_CONGE]','width=400','height=630','left=20','top=30');\"  title=Voir><img src=images/icn_categories.png /></a>
        </td>";
    } else {
        print"
        <td align=center>
         <img src=images/pdf-gris.gif />
        <a href=# OnClick=\"window.open('imprimer_demande_conge.php?id_conge=$ligne[ID_CONGE]','width=400','height=630','left=20','top=30');\"  title=Voir><img src=images/icn_categories.png /></a>
        </td>";
    }
    echo "</tr>";
}
?>

                    </tbody>
                </table>
            </div>
        </form>
        <div class="spacer"></div>
    </div>
</section>
