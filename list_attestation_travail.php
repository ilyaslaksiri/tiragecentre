<?php
include "template/header.php";
include "template/left.php";
include_once("connex.inc.php");

$idcom = connex("tirage_centre_db", "myparam");
$id_user = $_SESSION["id_user"];

// Requête SQL pour récupérer les demandes d'attestations avec les informations des utilisateurs
$requete = "SELECT *
            FROM attestations a
            JOIN USERS u ON a.ID_USER = u.ID_USER";

$result = mysql_query($requete, $idcom);

?>

<section id="main" class="column">
    <h4 class="titre_info">Attestations de travail</h4><br/><br/>

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
    </script>

    <div id="container">
        <div align="center">
            <b><a href="javascript:void(0)" onclick="openDemandeAttestation()">Nouvelle demande</a></b>
        </div>
        <script>
            function openDemandeAttestation() {
                var screenWidth = window.screen.width;
                var screenHeight = window.screen.height;
                var left = (screenWidth - 800) / 2;
                var top = (screenHeight - 800) / 2;
                window.open("demande_attestation.php", "Demande d'attestation", "width=800,height=800,left=" + left + ",top=" + top + ",toolbar=no");
            }
        </script>

        <form>
            <div id="demo">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th>Demandeur</th>
                            <th>Date de demande</th>
                            <th>Motif</th>
							<?php if (in_array('adminRH', $access_levels) || in_array('admin', $access_levels)) { ?>
                            <th>Attestation</th>
                        <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    while ($ligne = mysql_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$ligne["PRENOM_USER"]." ".$ligne["NOM_USER"]."</td>";
                        echo "<td>".date('d/m/Y', strtotime($ligne["DATE_DEMANDE_ATTESTATION"]))."</td>";
                        echo "<td>".$ligne["MOTIF_ATTESTATION"]."</td>";
						
						
    
					if (in_array('adminRH', $access_levels) || in_array('admin', $access_levels)) {
						echo "<td>";
						echo "<a href=# OnClick=\"window.open('imprimer_attestation_travail.php?id_attestation=$ligne[ID_ATTESTATION]','width=400','height=630','left=20','top=30');\"  title=Voir><img src=images/pdf.gif /></a>";
						echo "</td>";
					}
					else {
						print"
						<td></td>";
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

