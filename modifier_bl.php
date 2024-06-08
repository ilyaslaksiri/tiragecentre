<?php include "template/header.php";?>
<?php include "template/left.php";?>
<?php include "chiffre_lettre.php";?>

<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>

<script type="text/javascript" src="js/facture.js"></script>

<?php

$id_bl=$_GET['id_bl'];

include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");


$requete2="select * from bl where ID_BL=$id_bl";
$result2=@mysql_query($requete2, $idcom);
$ligne2=mysql_fetch_array($result2);

$requete="select * from client where ID_CLIENT='$ligne2[ID_CLIENT]'";
$result=@mysql_query($requete, $idcom);
$ligne=mysql_fetch_array($result);

?>

<link href="css/style.css" rel="stylesheet" type="text/css" />


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


<section id="main" class="column">

<form  action="modifier_bl_exec.php" method="post">
<h4 class="titre_info">Bon de Livraison : <?php echo $ligne['NOM_CLIENT'];?></h4>
 

 
 <fieldset>
 
<table  width="90%" >
	<tr>			
			<td align="right"> Num Bon de Livraison  		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  <input type="text" name="num_bl" value="<?php echo $ligne2['NUM_BL'];?>" id="zone_input" class="required"/> </td>
			<td align="right"> Date 	<span style="color:#FF0000">(*)</span>&nbsp;:</td> <td> <input type="text" name="date_bl" value="<?php echo $ligne2['DATE_BL'];?>" class="required" />  </td>
	</tr>
	
</table> 
    
        <!--Tableau debut -->

   
   
<table align="center">
		<th>Nombre</th>
		<th>D&eacute;signation</th>
		<th>Hauteur</th>
		<th>Largeur</th>
		<th>Prix HT</th>
<div id="container">
<div id="demo">

<div id="ligneCalcul" style="clear:both"  >
		
		<?php
		
		$i=0;
		$requete3 = mysql_query("select * from ligne_bl where ID_BL=$id_bl" );
		while ($ligne3 = mysql_fetch_array($requete3)) {
		$i++;
		
			print"
		<tr>
			<td><input type=text id=ChampNombre_$i 	name=ChampNombre[] value='$ligne3[NOMBRE]' style=width:60px; onchange=calcul() /></td>
			<td><input type=text id=ChampDesign_$i 	name=ChampDesign[] value='".$ligne3["DESIGNATION_LIGNE_BL"]."' style=width:660px; text-align:left; /></td>
			
			<td><input type=text id=ChampLongeur_$i 	name=ChampLongeur[] value='$ligne3[LONGEUR]' style=width:40px; onchange=calcul() /></td>
			<td><input type=text id=ChampLargeur_$i 	name=ChampLargeur[] value='$ligne3[LARGEUR]' style=width:40px; onchange=calcul() /></td>
			<td><input type=text id=ChampPrixHT_$i 		name=ChampPrixHT[] value='$ligne3[PRIX_HT]' style=width:40px; onchange=calcul() /></td>

		</tr>
		";
		}
		
		for($j=$i;$j<16;$j++){
		print"
		<tr>
			<td><input type=text id=ChampNombre_$i 	name=ChampNombre[] value='' style=width:60px; onchange=calcul() /></td>
			<td><input type=text id=ChampDesign_$i 	name=ChampDesign[] value='' style=width:660px; text-align:left; /></td>
			
			<td><input type=text id=ChampLongeur_$i 		name=ChampLongeur[] value='' style=width:40px; onchange=calcul() /></td>
			<td><input type=text id=ChampLargeur_$i 		name=ChampLargeur[] value='' style=width:40px; onchange=calcul() /></td>
			<td><input type=text id=ChampPrixHT_$i 			name=ChampPrixHT[] value='' style=width:40px; onchange=calcul() /></td>

		</tr>
		";
		}
		?>
</div>



</table>
</fieldset>

<input type="hidden" name="id_client" value="<?php echo $ligne2['ID_CLIENT'];?>" />
<input type="hidden" name="id_bl" value="<?php echo $ligne2['ID_BL'];?>" />		





	

			</div>
		
			<div class="spacer"></div>
	</div>	  	
        <div align="center"><input type="submit"  value="Modifier" /></div>
        
        
       <!-- Tableau Fin -->
</form>
</br></br></br></br>
</section>