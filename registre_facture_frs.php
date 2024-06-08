<?php include "template/header.php";   
include "template/left.php";   
?>




<section id="main" class="column">
<h4 class="titre_info">Registre des factures Fournisseurs</h4><br/><br/>

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






        <!--Tableau debut 1-->
        
        
         <div id="container">
		 
		 
		  <form>
		  
		  
		  
		  
		
		  
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		
			<th>Num Facture</th>
			<th>Client</th>
			<th>Date</th>
			<th>Total TTC</th>
			<th>Etat</th>
			<th>Mode reglement</th>
			<th>Date Reglement</th>
			<?php if($_SESSION["user"]=="admin"){ ?>
			<th>Detail</th>
			<?php } ?>
	</thead>
	
	<tbody>

<?php 


include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete2 = mysql_query("select * from FACTURE_FRS f,fournisseur frs where f.ID_FRS=frs.ID_FRS"." and `ID_EXERCICE`=".$_SESSION["annee"] );

while ($ligne = mysql_fetch_array($requete2)) {

   print "<tr>
  
		<td align=center>".$ligne["NUM_FACTURE_FRS"]."</td>
		<td align=center>".$ligne["NOM_FRS"]."</td>
		<td align=center>".$ligne["DATE_FACTURE_FRS"]."</td>
		<td align=center>".$ligne["MONTANT_TTC_FRS"]."</td>
		<td align=center>".$ligne["ETAT_FACTURE_FRS"]." <a href=modifier_facture_frs.php?id_facture_frs=$ligne[ID_FACTURE_FRS] title=Modifier><img src=images/icn_edit.png></a></td>
		<td align=center>".$ligne["MODE_PAYEMENT_FRS"]."</td>
		<td align=center>".$ligne["DATE_PAYEMENT_FRS"]."</td>
	";
	
	 if("$_SESSION[user]"== "admin"){
		print "<td align=center><a href=# title=Voir><img src=images/pdf.gif /></a></td>
	 ";}
   print "</tr> ";  
}
//ajouter l'id client pour la modification de la facture !! non ce n'est pas obligatoire 
?>

</tbody>
</table>
			</div>
		</form>
			<div class="spacer"></div>
	</div>	  	
        
       <!-- Tableau Fin -->

</section>