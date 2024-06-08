<?php include "template/header.php";   
include "template/left.php";   
?>



<?php

include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");



?>

<section id="main" class="column">
<h4 class="titre_info">Client :  </h4><br/><br/>

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
		 
		 
		  <form action="page_calcule.php" method="post">
		  
		  <input type="hidden" name="id_client" value="<?php echo $id_client ?>" />
		  
		  
		
		  
			
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
			<th></th>
			<th>Client</th>
			<th>Num BL</th>
			<th>Date </th>
			<th>Etat</th>
			<th>Modifier</th>
			<th>Detail</th>
			
	</thead>
	
	<tbody>

<?php 


include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete2 = mysql_query("SELECT *, `NOM_CLIENT` FROM `bl` , client c WHERE c.`ID_CLIENT`=bl.`ID_CLIENT`  " );

while ($ligne = mysql_fetch_array($requete2)) {

   print "<tr>
		
		<td align=center><input type=checkbox name=selected[] value=".$ligne["ID_BL"]."></td>
		<td align=left>".$ligne["NOM_CLIENT"]."</td>
		<td align=center>".$ligne["NUM_BL"]."</td>
		<td align=center>".$ligne["DATE_BL"]."</td>
		
		<td align=center><a href=modifier_etat_bl.php?id_bl=$ligne[ID_BL] title=Modifier>".$ligne["ETAT_BL"]."</td>
		
		<td align=center><a href=modifier_bl.php?id_bl=$ligne[ID_BL] title=Modifier><img src=images/icn_edit.png></a></td>
		<td align=center><a href=# OnClick=\"window.open('imprimer_bl.php?id_bl=$ligne[ID_BL]','width=400','height=630','left=20','top=30');\"  title=Voir><img src=images/pdf.gif /></a></td>
		
   </tr> ";  
}

?>

</tbody>
</table>
			
			
	<?php if($_SESSION["user"]=="admin"){ ?>		
		<div align="center">
		   <input name="submit" type="submit" value="Calculer" />
			
		</div>
	<?php } ?>
  
		</form>
			<div class="spacer"></div>
	</div>	  	
        
       <!-- Tableau Fin -->

</section>