

<?php include "template/header.php";   
include "template/left.php";   

$selected=$_POST['selected'];
?>

<section id="main" class="column">

<h4 class="titre_info">Somme des BL N&deg; :  <?php foreach( $selected as $i => $select ) {echo $select." - ";} ?> </h4><br/><br/>



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
			<th>Designation</th>
			<th>Total</th>
	</thead>
	
	
	
	
	<tbody>

<?php 

$chaine="SELECT `DESIGNATION_LIGNE_BL` designation ,sum(`NOMBRE`*`LONGEUR`) total FROM `ligne_bl` L ";

$count=0;
foreach( $selected as $i => $select ) {

if($count==0)
$chaine= $chaine." where L.ID_BL='$select'";

$chaine= $chaine." or L.ID_BL='$select'";

$count++;
}
$chaine=$chaine." group by `DESIGNATION_LIGNE_BL`";


$requete = mysql_query("".$chaine);
while($ligne = mysql_fetch_array($requete)) {


   print "<tr>
		
		<td align=left>".$ligne["designation"]."</td>
		<td align=left>".$ligne["total"]."</td>
		
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
