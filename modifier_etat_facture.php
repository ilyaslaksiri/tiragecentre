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

<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>

		
		
<?php
$id_facture=$_GET['id_facture'];
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete="select * from FACTURE f, client c where ID_FACTURE='$id_facture' and c.ID_CLIENT=f.ID_CLIENT";

$result=@mysql_query($requete, $idcom);
$ligne=mysql_fetch_array($result);

?>
	
<section id="main" class="column">
<h4 class="titre_info">Reglement Facture Num : <?php echo $ligne['NUM_FACTURE'];?> &nbsp;&nbsp; </br>Client : <?php echo $ligne['NOM_CLIENT'];?></h4><br/><br/>
<fieldset>

<form action="modifier_etat_facture_exec.php" method="post" >

<input type="hidden" name="id_facture" value="<?php echo $id_facture ?>" />




    <table  width="90%" >
	
	

	
	<tr>	
			<td align="right"> Etat Facture :  		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  
			
			<select name="etat_facture">
			
				<option value="NP"  <?php if ($ligne['ETAT_FACTURE']=='NP') echo "selected";?>  > Non Payé</option>
				<option value="PAYE" <?php if ($ligne['ETAT_FACTURE']=='PAYE') echo "selected";?> > Payé</option>
				<option value="ANNULEE" <?php if ($ligne['ETAT_FACTURE']=='ANNULEE') echo "selected";?> > Annulée</option>
				<option value="ECHEANCE" <?php if ($ligne['ETAT_FACTURE']=='ECHEANCE') echo "selected";?> > Échéance</option>

			</select>
			 </td>
	</tr>
	
	<tr>
			<td align="right"> Mode de Payement  : </td><td><input type="text" name="mode_payement"  value="<?php echo $ligne['MODE_PAYEMENT'];?>" /></td>
	</tr>
	
	<tr>
			<td align="right"> Date de payement : </td><td><input type="text" name="date_payement" value="<?php echo $ligne['DATE_PAYEMENT'];?>" class="required"/></td>
	</tr>
	
				</br>
				
  
   </table>
 </fieldset>
 
 
  <div align="center">
    <h3><input name="submit" type="submit" value="Modifier" />
    </h3>
  </div>

</form>
