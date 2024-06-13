<?php include "template/header.php";   
include "template/left.php";   
?>



<?php
$id_client=$_GET['id_client'];
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete="select * from client where ID_CLIENT='$id_client'";

$result=@mysql_query($requete, $idcom);
$ligne=mysql_fetch_array($result);

?>

<section id="main" class="column">
<h4 class="titre_info">Client : <?php echo $ligne['NOM_CLIENT'];?> </h4><br/><br/>

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
		  
		  <input type="hidden" name="id_client" value="<?php echo $id_client ?>" />
		  
		  
		<div align="center">
		  <?php echo "<a href=ajouter_devis.php?id_client=$id_client><img src=images/nouveau_devis.jpg ></img></a>";?>
		</div>
		  
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		
			<th>Num Devis</th>
			<th>Date </th>
			<th>Total HT</th>
			<th>Total TTC</th>
			<th>Calculable</th>
			<th>Modifier</th>
			<?php if(in_array('devis_mod', $access_levels)){ ?>
			<th>Detail</th>
			<?php } ?>
			<th>Facturer</th>
	</thead>
	
	<tbody>

<?php 


include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete2 = mysql_query("select * from devis where ID_CLIENT=$id_client and ID_EXERCICE=".$_SESSION["annee"] );
while ($ligne = mysql_fetch_array($requete2)) {

   print "<tr>
  
		<td align=center>".$ligne["NUM_DEVIS"]."</td>
		<td align=center>".$ligne["DATE_DEVIS"]."</td>
		<td align=center>".$ligne["MONTANT_HT"]."</td>
		<td align=center>".$ligne["MONTANT_TTC"]."</td>
		<td align=center>".$ligne["CALCULE"]."</td>
	
		
		<td align=center><a href=modifier_devis.php?id_devis=$ligne[ID_DEVIS] title=Modifier><img src=images/icn_edit.png></a></td>
		";
	
		if(in_array('devis_mod', $access_levels)){
		print "
		
		<td align=center><a href=# OnClick=\"window.open('imprimer_devis.php?id_devis=$ligne[ID_DEVIS]','width=400','height=630','left=20','top=30');\"  title=Voir><img src=images/pdf.gif /></a></td>
		";}
		
		if(in_array('facture_mod', $access_levels)){
			print "<td align=center><a href=facturer_devis.php?id_client=$id_client&id_devis=$ligne[ID_DEVIS]>facturer</a></td>
				</tr> ";  }
		else{
			print"<td align=center>-</td>";
		}
				
				
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