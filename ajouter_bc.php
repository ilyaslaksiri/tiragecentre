<?php include "template/header.php";?>
<?php include "template/left.php";?>
<?php include "chiffre_lettre.php";?>

<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>

<script type="text/javascript" src="js/facture.js"></script>

<?php

$id_frs=$_GET['id_frs'];

include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete="select * from fournisseur where ID_FRS='$id_frs'";
$requete2="select * from bc";

$result=@mysql_query($requete, $idcom);
$ligne=mysql_fetch_array($result);

$result2=@mysql_query($requete2, $idcom);
$ligne2=mysql_fetch_array($result2);

$requete3="SELECT max(`ID_BC`) num FROM `bc`";
$result3=@mysql_query($requete3, $idcom);
$ligne3=mysql_fetch_array($result3);

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

<form  action="ajouter_bc_exec.php" method="post">
<h4 class="titre_info">Fournisseur : <?php echo $ligne['NOM_FRS'];?></h4>
 
 <?php $num_bc= 101+$ligne3["num"]."/".date("y"); ?>

 
 <fieldset>
 
<table  width="90%" >
	<tr>			
			<td align="right" >  Bon de commande N&deg;  		&nbsp;:</td><td width="55%"><?php echo $num_bc; ?> </td>
			<td align="right"> Date 	<span style="color:#FF0000">(*)</span>&nbsp;:</td> <td> <input type="text" name="date_bc" value="<?php echo date("d/m/Y");?>" class="required" />  </td>
	</tr>
	
</table> 
    
        <!--Tableau debut -->
   
<table>
		<th>D&eacute;signation</th>
		<th>Prix U HT</th>
		<th>Qt&eacute;</th>
		<th>Total</th> 
<div id="container">
<div id="demo">

<div id="ligneCalcul" style="clear:both"  >
		
		<?php
		
		for($i=0;$i<20;$i++){
		print"
		<tr>
			<td><input type=text id=ChampDesign_$i 	name=ChampDesign[] value='' style=width:660px; text-align:left; /></td>
			<td><input type=text id=ChampTarifHT_$i 	name=ChampTarifHT[] value='' style=width:60px; onchange=calcul() /></td>
			<td><input type=text id=ChampQte_$i 		name=ChampQte[] value='' style=width:40px; onchange=calcul() /></td>
			<td><input type=text id=ChampResult_$i 	name=ChampResult[] value='' style=width:60px; /></td>
		</tr>
		";
		}
		?>
</div>

<div id="Total">
		<tr><td></td><td>Total HT : </td><td><input type="text" id="valueTotalHT" name="total" value="0" /></td></tr>
		<tr><td></td><td>TVA (%) : </td><td><input type="text" id="valueTVA" name="tva"value="" /></td></td></tr>
		<tr><td></td><td>Total TTC : </td><td><input type="text" id="valueTotalTTC" name="totalTTC"value="0" /></td></tr>
		
		<tr><td>Arreter le pr&eacute;sent bon de commande a la somme de : </td></tr>
		<tr><td><input type="text" id="somme" name="somme"value="" style="width:660px; text-align:left;"/></td></tr>
		<div style="clear:both;"></div>
		
</div>

</table>
</fieldset>

<input type="hidden" name="id_frs" value="<?php echo $id_frs;?>" />
<input type="hidden" name="num_bc" value="<?php echo $num_bc;?>" />		





	

			</div>
		
			<div class="spacer"></div>
	</div>	  	
        <div align="center"><input type="submit"  value="Enregistrer" /></div>
        
        
       <!-- Tableau Fin -->
</form>
</br></br></br></br>
</section>