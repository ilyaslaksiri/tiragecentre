

<?php include "template/header.php";   
include "template/left.php";   
?>

<section id="main" class="column">
<h4 class="titre_info">Liste des Clients</h4><br/><br/>




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
//echo "<a href=ajouter_client.php><img src=images/nouveau_client.png height=70px width=120px></img></a>";
?>




        <!--Tableau debut -->
        
        
     <div id="container">
		 
		 
		  <form>
			<div id="demo">
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		
			
			<th>Client</th>
			<th>Telephone</th>
			<th>Mail</th>
			<th>Adresse</th>
			<th>Devis</th>
			<th></th>
			<th></th>
	</thead>
	
	<tbody>

<?php 
$requete = mysql_query("select * from CLIENT");
while($ligne = mysql_fetch_array($requete)) {

$requete4 = mysql_query("SELECT count(`ID_DEVIS`) nb FROM `devis` WHERE `ID_CLIENT`=".$ligne["ID_CLIENT"]." and `ID_EXERCICE`=".$_SESSION["annee"]);
$ligne4 = mysql_fetch_array($requete4);


   print "<tr>
		
		<td align=left>".$ligne["NOM_CLIENT"]."</td>
		<td align=left>".$ligne["TEL_CLIENT"]."</td>
		<td align=left>".$ligne["MAIL_CLIENT"]."</td>
		<td align=left>".$ligne["ADRESSE_CLIENT"]."</td>
		
		
		<td align=center><a href=list_devis.php?id_client=$ligne[ID_CLIENT] title=Consulter>($ligne4[nb])</a></td>
		
		<td align=center><a href=modifier_client.php?id_client=$ligne[ID_CLIENT] title=Modifier><img src=images/icn_edit.png></a></td>
		<td align=center><a href=supprimer_client.php?id_client=$ligne[ID_CLIENT] OnClick=\"return confirm( 'Voulez-vous vraiment supprimer?');\" title=Supprimer><img src=images/icn_trash.png></a></td>


   </tr> ";  
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
