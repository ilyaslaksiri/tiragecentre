<?php include "template/header.php";   
include "template/left.php";   
?>




<section id="main" class="column">
<h4 class="titre_info">Registre des factures</h4><br/><br/>

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
			<?php if(in_array('facture_mod', $access_levels)){ ?>
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

$sql="select * from FACTURE f,client c where f.ID_CLIENT=c.ID_CLIENT"." and `ID_EXERCICE`=".$_SESSION["annee"]."";
if($num_facture!="")
	$sql=$sql." and `NUM_FACTURE` like '$num_facture'"; 
if($client!="")
	$sql=$sql." and `NOM_CLIENT` like '%$client%'"; 
if($mois_facture!="")
	$sql=$sql." and `MOIS_FACTURE` like '%$mois_facture%'"; 

if($etat_facture!="")
	$sql=$sql." and `ETAT_FACTURE` like '%$etat_facture%'"; 

$requete2 = mysql_query($sql);


print "

<tr>
  
		<td align=center><input size='20' style='width:50px;' type=text name=num_facture value='$num_facture'  /></td>
		<td align=center><input size='20' style='width:300px;'type=text name=client value='$client'  /></td>
		<td align=center>
		
		<select name=mois_facture>
		<option value=$mois_facture >$mois_facture</option>
		<option value= >All</option>
			<option value=1 >1 - Janvier</option>
			<option value=2 >2 - Fevrier</option>
			<option value=3 >3 - Mars</option>
			<option value=4 >4 - Avril</option>
			<option value=5 >5 - Mai</option>
			<option value=6 >6 - Juin</option>
			<option value=7 >7 - Juillet</option>
			<option value=8 >8 - Aout</option>
			<option value=9 >9 - Septembre</option>
			<option value=10 >10 - Octobre</option>
			<option value=11 >11 - Novembre</option>
			<option value=12 >12 - Decembre</option>
		</select>
		
		</td>	
		<td align=center></td>	
		<td align=center>
		<select name=etat_facture>
		<option value=$etat_facture >$etat_facture</option>
			<option value= >All</option>
			<option value=paye >Payé</option>
			<option value=np >Non payé</option>
		</select>
		</td>	
		<td align=center><input size='20' style='width:70px;' type=text name=mode_paiement value=''  /></td>	
		<td align=center><input size='20' style='width:70px;' type=text name=date_paiement value=''  /></td>	
		<td>
			<button>Filtrer</button> 
			<a href=registre_facture.php   title=vider><img src=images/icn_trash.png /></a>
		</td>	
		
		</tr>

	";


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
	
	if(in_array('facture_mod', $access_levels)){
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