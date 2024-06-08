

<?php include "template/header.php";   
include "template/left.php";   
?>

<section id="main" class="column">
<h4 class="titre_info">Bon de Commande Fournisseurs</h4><br/><br/>




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
			$(document).ready( function () {
				$('#example').dataTable( {
					"sDom": '<"H"Cfr>t<"F"ip>',
					"bJQueryUI": true
				} );
			} );
		</script>

<?php
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");
echo "<div align=center><a href=ajouter_frs.php >Nouveau Fournisseur</a></div>";
?>




        <!--Tableau debut -->
        
        
     <div id="container">
		 
		 
		  <form>
			<div id="demo">
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		
			
			<th>Fournisseur</th>
			<th>Telephone</th>
			<th>Mail</th>
			<th>Adresse</th>
			<th>Bon de commande</th>
			<th></th>
			<th></th>
	</thead>
	
	<tbody>

<?php 
$requete = mysql_query("select * from fournisseur");
while($ligne = mysql_fetch_array($requete)) {

$requete4 = mysql_query("SELECT count(`ID_BC`) nb FROM `bc` WHERE `ID_FRS`=".$ligne["ID_FRS"]);

$ligne4 = mysql_fetch_array($requete4);


   print "<tr>
		
		<td align=left>".$ligne["NOM_FRS"]."</td>
		<td align=left>".$ligne["TEL_FRS"]."</td>
		<td align=left>".$ligne["MAIL_FRS"]."</td>
		<td align=left>".$ligne["ADRESSE_FRS"]."</td>
		<td align=center><a href=list_bc.php?id_frs=$ligne[ID_FRS] title=Consulter>($ligne4[nb])</a></td>
		<td align=center><a href=modifier_frs.php?id_frs=$ligne[ID_FRS] title=Modifier><img src=images/icn_edit.png></a></td>
		<td align=center><a href=supprimer_frs.php?id_frs=$ligne[ID_FRS] OnClick=\"return confirm( 'Voulez-vous vraiment supprimer?');\" title=Supprimer><img src=images/icn_trash.png></a></td>

		</tr> ";  
		/*
		<td align=center><a href=list_facture.php?id_frs=$ligne[ID_frs] title=Consulter>($ligne4[nb])</a></td>
		
		
*/
   
}
?>

</tbody>
</table>
			</div>
		</form>
			<div class="spacer"></div>
	</div>	  	
        
        
        
       <!-- Tableau Fin -->

</section>
