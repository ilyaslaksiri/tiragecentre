

<?php 
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete="select count(*) total from facture where ETAT_FACTURE='ECHEANCE' && DATE_PAYEMENT like '".date("d/m/Y")."'";

$result=@mysql_query($requete, $idcom);
$ligne=mysql_fetch_array($result);

if($ligne["total"]==0)
	include "template/header.php";   
else
	include "template/headerNote.php";  

include "template/left.php";   

?>

<section id="main" class="column">
<h4 class="titre_info">Liste des utilisateurs</h4><br/><br/>




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

//echo "<a href=ajouter_client.php><img src=images/nouveau_client.png height=70px width=120px></img></a>";
?>




        <!--Tableau debut -->
        
        
     <div id="container">
		 
		 <div align="center"><b><a href="ajouter_user.php" >Ajouter utilisateur</a></b></div>
		  <form>
			<div id="demo">
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		
			
			<th>Nom</th>
			<th>Prénom</th>
			<th>Email</th>
			<th>Login</th>
			<th>Type d'accès</th>
			<th></th>
	
	</thead>
	
	<tbody>

<?php 
$requete = mysql_query("select * from USERS");
while($ligne = mysql_fetch_array($requete)) {



   print "<tr>
		
		<td align=left>".$ligne["NOM_USER"]."</td>
		<td align=left>".$ligne["PRENOM_USER"]."</td>
		<td align=left>".$ligne["EMAIL_USER"]."</td>
		<td align=left>".$ligne["LOGIN_USER"]."</td>
		<td align=left>".$ligne["ACCESS_LEVEL_USER"]."</td>
		
		<td align=center><a href=ajouter_user.php?id_user=$ligne[ID_USER] title=Modifier><img src=images/icn_edit.png></a></td>
		

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
