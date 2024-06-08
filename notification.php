<?php include "template/header.php";   
include "template/left.php";   
?>




<section id="main" class="column">
<h4 class="titre_info">Liste des échéances</h4><br/><br/>

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
		 
		 
		  <form  action="registre_facture.php" method="post">
		  
		  
		  
		  
		
		  
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
if( isset($_POST['num_facture']))
$num_facture=$_POST['num_facture'];
else 
$num_facture="";

if( isset($_POST['client']))
$client=$_POST['client'];
else 
$client="";

if( isset($_POST['mois_facture']))
$mois_facture=$_POST['mois_facture'];
else 
$mois_facture="";

if( isset($_POST['etat_facture']))
$etat_facture=$_POST['etat_facture'];
else 
$etat_facture="";

include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$sql="select * from FACTURE f,client c where f.ID_CLIENT=c.ID_CLIENT"." and ETAT_FACTURE='ECHEANCE' ";
if($num_facture!="")
	$sql=$sql." and `NUM_FACTURE` like '$num_facture'"; 
if($client!="")
	$sql=$sql." and `NOM_CLIENT` like '%$client%'"; 
if($mois_facture!="")
	$sql=$sql." and `MOIS_FACTURE` like '%$mois_facture%'"; 

if($etat_facture!="")
	$sql=$sql." and `ETAT_FACTURE` like '%$etat_facture%'"; 

$requete2 = mysql_query($sql);





while ($ligne = mysql_fetch_array($requete2)) {

   print "<tr>
  
		<td align=center>".$ligne["NUM_FACTURE"]."</td>
		<td align=center>".$ligne["NOM_CLIENT"]."</td>
		<td align=center>".$ligne["DATE_FACTURE"]."</td>
		<td align=center>".$ligne["MONTANT_TTC"]."</td>
		<td align=center>".$ligne["ETAT_FACTURE"]." <a href=modifier_etat_facture.php?id_facture=$ligne[ID_FACTURE] title=Modifier><img src=images/icn_edit.png></a></td>
		<td align=center>".$ligne["MODE_PAYEMENT"]."</td>
		<td align=center>".$ligne["DATE_PAYEMENT"]."</td>
	";
	
	 if("$_SESSION[user]"== "admin"){
		print "<td align=center><a href=# OnClick=\"window.open('imprimer_facture.php?id_facture=$ligne[ID_FACTURE]','width=400','height=630','left=20','top=30');\"  title=Voir><img src=images/pdf.gif /></a></td>
	 ";}
   print "</tr> ";  
}
//ajouter l'id client pour la modification de la facture !! non ce n'est pas obligatoire 
$client = urlencode($client);
print "<a href=export.php?num_facture=$num_facture&client=$client&mois_facture=$mois_facture&etat_facture=$etat_facture&annee=$_SESSION[annee]   title=Exporter><img width=15px src=images/excel.png />Exporter</a>";
?>

</tbody>
</table>


			</div>
		</form>
			<div class="spacer"></div>
	</div>	  	
        
       <!-- Tableau Fin -->

</section>