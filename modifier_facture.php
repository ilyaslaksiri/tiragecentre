<?php include "template/header.php";?>
<?php include "template/left.php";?>
<?php include "chiffre_lettre.php";?>

<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>

<script type="text/javascript" src="js/facture.js"></script>

<?php

$id_facture=$_GET['id_facture'];

include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");


$requete2="select * from facture where ID_FACTURE=$id_facture";
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

<form  action="modifier_facture_exec.php" method="post">

<input type="hidden" name="id_client" value="<?php echo $ligne['ID_CLIENT'];?>" />
<h4 class="titre_info">Client : <?php echo $ligne['NOM_CLIENT'];?></h4>
 
<input type="hidden" name="id_facture" value="<?php echo $ligne2['ID_FACTURE']; ?>" />
 
 <fieldset>
 
<table  width="90%" >
	<tr>			
			<td align="right"> Num Facture  		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  <input type="text" name="num_facture" value="<?php echo $ligne2['NUM_FACTURE'];?>" id="zone_input" class="required"/> </td>
			<td align="right"> Date 	<span style="color:#FF0000">(*)</span>&nbsp;:</td> <td> <input type="text" name="date_facture" value="<?php echo $ligne2['DATE_FACTURE'];?>" class="required" />  </td>
	</tr>
	<tr>			
			<td align="right"> BL  :</td><td>  <input type="text" name="BL" value="<?php echo $ligne2['BL'];?>" id="zone_input" /> </td>
			
	</tr>
</table> 
    
        <!--Tableau debut -->
   
<table>
		<th>D&eacute;signation</th>
		<th>Prix U HT</th>
		<th>Qt&eacute;</th>
		<th>Total</th> 
		<th>ref</th>
<div id="container">
<div id="demo">

<div id="ligneCalcul" style="clear:both"  >
		
		<?php
		
		$i=0;
		$requete3 = mysql_query("select * from ligne_facture where ID_FACTURE=$id_facture" );
		while ($ligne3 = mysql_fetch_array($requete3)) {
			
			$total=$ligne3["PRIX_HT"]*$ligne3["QTE"];
			print"
		<tr>
			<td><input type=text id=ChampDesign_$i 	name=ChampDesign[] value='$ligne3[DESIGNATION]' style=width:660px; text-align:left; /></td>
			<td><input type=text id=ChampTarifHT_$i 	name=ChampTarifHT[] value='$ligne3[PRIX_HT]' style=width:60px; onchange=calcul() /></td>
			<td><input type=text id=ChampQte_$i 		name=ChampQte[] value='$ligne3[QTE]' style=width:40px; onchange=calcul() /></td>
			<td><input type=text id=ChampResult_$i 	name=ChampResult[] value=$total style=width:60px; /></td>
			<td><input type=text id=ChampResult_$i 	name=ChampRef[] value='$ligne3[ref]' style=width:20px; /></td>
		</tr>
		";
			$i++;
				}

		
		for($j=$i;$j<20;$j++){
		print"
		<tr>
			<td><input type=text id=ChampDesign_$j 	name=ChampDesign[] value='' style=width:660px; text-align:left; /></td>
			<td><input type=text id=ChampTarifHT_$j 	name=ChampTarifHT[] value='' style=width:60px; onchange=calcul() /></td>
			<td><input type=text id=ChampQte_$j 		name=ChampQte[] value='' style=width:40px; onchange=calcul() /></td>
			<td><input type=text id=ChampResult_$j 	name=ChampResult[] value='' style=width:60px; /></td>
			<td><input type=text id=ChampResult_$i 	name=ChampRef[] value='' style=width:20px; /></td>
		</tr>
		";
		}
		?>
</div>

<div id="Total">
		<tr><td></td><td>Total HT : </td><td><input type="text" id="valueTotalHT" name="total" value="0" /></td></tr>
		<tr><td></td><td>TVA (%) : </td><td><input type="text" id="valueTVA" name="tva"value="" /></td></td></tr>
		<tr><td></td><td>Total TTC : </td><td><input type="text" id="valueTotalTTC" name="totalTTC"value="0" /></td></tr>
		
		<tr><td>Arreter la pr&eacute;sente facture a la somme de : </td></tr>
		<tr><td><input type="text" id="somme" name="somme"value="" style="width:660px; text-align:left;"/></td></tr>
		<div style="clear:both;"></div>
		
</div>

</table>
</fieldset>


		





	

			</div>
		
			<div class="spacer"></div>
	</div>	  	
        <div align="center"><input type="submit"  value="Enregistrer" /></div>
        
        
       <!-- Tableau Fin -->
</form>

</section>