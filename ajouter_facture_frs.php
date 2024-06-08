<?php include "template/header.php";?>
<?php include "template/left.php";

$id_frs=$_GET['id_frs'];
?>


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


		
<section id="main" class="column">
<h4 class="titre_info">Nouvelle Facture Fournisseur</h4><br/><br/>
<fieldset>
<form action="ajouter_facture_frs_exec.php" method="post">

<input type="hidden" name="id_frs" value="<?php echo $id_frs;?>" />
 
  
  <table  width="90%" >
	
	
	
	
	<tr>	
			<td align="right"> Num Facture 		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  <input type="text" name="num_facture_frs" value="" id="zone_input" class="required"/> </td>
	
			<td align="right"> Date Facture <span style="color:#FF0000">(*)</span> :</td><td><input type="text" id="foo" onkeyup="format(this)" name="date_facture_frs" value="" /></td>
	</tr>
	
	<tr>
			
			<td align="right"> Montant HT <span style="color:#FF0000">(*)</span>&nbsp;: </td><td><input type="text" name="montant_ht_frs" value="" /></td>
			
			<td align="right"> Tva <span style="color:#FF0000">(*)</span>&nbsp;: </td><td><input type="text" name="tva_frs" value="" /></td>
	</tr>
	<tr>
			<td align="right"> Montant TTC <span style="color:#FF0000">(*)</span>&nbsp;: </td><td><input type="text" name="montant_ttc_frs" value="" /></td>
	</tr>
  
  



  <tr>	
			<td align="right"> Etat Facture :  		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  
			
			<select name="etat_facture_frs">
			
				<option value="NP"  "selected">  Non Payé</option>
				<option value="PAYE"  > Payé</option>
				<option value="ANNULEE"  > Annulée</option>
			
			</select>
			 </td>
	
			<td align="right"> Date Payement <span style="color:#FF0000">(*)</span>&nbsp;: </td><td><input type="text" name="date_payement_frs" value="" /></td>
			
	</tr>
	<tr>
	<td align="right"> Mode de Payement <span style="color:#FF0000">(*)</span>&nbsp;: </td><td><input type="text" name="mode_payement_frs" value="" /></td>
	<td></td>
	</tr>
	
	
	
  </br>
				
   </table>
  
  </fieldset>
 
  <div align="center">
    <h3><input name="submit" type="submit" value="Ajouter" />
    </h3>
  </div>

  
</form>

</section>



