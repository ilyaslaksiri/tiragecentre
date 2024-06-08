<?php include "template/header.php";?>
<?php include "template/left.php";?>


<script type="text/javascript">
 
function format(obj){
var str=obj.value.replace(/-|\./g,'')
switch(true){
 
 case (str.length<10) : break;
 case (str.length==10):
  tel=str.replace(/^(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/,"$1-$2.$3.$4.$5")
  obj.value=tel
  break;
 case (str.length>10) :
  obj.value=str.substr(0,9).replace(/^(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/,"$1-$2.$3.$4.$5")
  }
 
 }
 
</script>

		
<?php
$id_facture_frs=$_GET['id_facture_frs'];
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete="select * from facture_frs where ID_FACTURE_FRS='$id_facture_frs'";

$result=@mysql_query($requete, $idcom);
$ligne=mysql_fetch_array($result);

?>
		
<section id="main" class="column">
<h4 class="titre_info">Modification Facture Fournisseur</h4><br/><br/>
<fieldset>
<form action="modifier_facture_frs_exec.php" method="post">

<input type="hidden" name="id_frs" value="<?php echo $ligne["ID_FRS"];?>" />
<input type="hidden" name="id_facture_frs" value="<?php echo $id_facture_frs;?>" />
  
  <table  width="90%" >
	
	
	
	
	<tr>	
			<td align="right"> Num Facture 		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  <input type="text" name="num_facture_frs" value="<?php echo $ligne["NUM_FACTURE_FRS"];?>" id="zone_input" class="required"/> </td>
	
			<td align="right"> Date Facture <span style="color:#FF0000">(*)</span> :</td><td><input type="text" id="foo" " name="date_facture_frs" value="<?php echo $ligne["DATE_FACTURE_FRS"];?>" /></td>
	</tr>
	
	<tr>
			
	
			<td align="right"> Montant HT <span style="color:#FF0000">(*)</span>&nbsp;: </td><td><input type="text" name="montant_ht_frs" value="<?php echo $ligne["MONTANT_HT_FRS"];?>" /></td>
			<td align="right"> Tva <span style="color:#FF0000">(*)</span>&nbsp;: </td><td><input type="text" name="tva_frs" value="<?php echo $ligne["TVA_FRS"];?>" /></td>

	</tr>
  
	<tr>
			<td align="right"> Montant TTC <span style="color:#FF0000">(*)</span>&nbsp;: </td><td><input type="text" name="montant_ttc_frs" value="<?php echo $ligne["MONTANT_TTC_FRS"];?>" /></td>
	</tr>
  



  <tr>	
			<td align="right"> Etat Facture :  		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  
			
			<select name="etat_facture_frs">
			
				<option value="NP"  <?php if ($ligne['ETAT_FACTURE_FRS']=='NP') echo "selected";?>  > Non Payé</option>
				<option value="PAYE" <?php if ($ligne['ETAT_FACTURE_FRS']=='PAYE') echo "selected";?> > Payé</option>
				<option value="ANNULEE" <?php if ($ligne['ETAT_FACTURE_FRS']=='ANNULEE') echo "selected";?> > Annulée</option>
			
			</select>
			 </td>
	
			<td align="right"> Date Payement <span style="color:#FF0000">(*)</span>&nbsp;: </td><td><input type="text" name="date_payement_frs" value="<?php echo $ligne["DATE_PAYEMENT_FRS"];?>" /></td>
			
	</tr>
	<tr>
	<td align="right"> Mode de Payement <span style="color:#FF0000">(*)</span>&nbsp;: </td><td><input type="text" name="mode_payement_frs" value="<?php echo $ligne["MODE_PAYEMENT_FRS"];?>" /></td>
	<td></td>
	</tr>
	
	
	
  </br>
				
   </table>
  
  </fieldset>
 
  <div align="center">
    <h3><input name="submit" type="submit" value="Modifier" />
    </h3>
  </div>

  
</form>

</section>



