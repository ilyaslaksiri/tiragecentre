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
$id_frs=$_GET['id_frs'];
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete="select * from fournisseur where ID_FRS='$id_frs'";

$result=@mysql_query($requete, $idcom);
$ligne=mysql_fetch_array($result);

?>
	
<section id="main" class="column">
<h4 class="titre_info">Fournisseur : <?php echo $ligne[1];?> </h4><br/><br/>
<fieldset>

<form action="modifier_frs_exec.php" method="post" >

<input type="hidden" name="id_frs" value="<?php echo $id_frs ?>" />




    <table  width="90%" >
	
	

	
	<tr>	
			<td align="right"> Nom  		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  <input type="text" name="nom_frs" value="<?php echo $ligne['NOM_FRS'];?>" id="zone_input" class="required"/> </td>
	</tr>
	
	<tr>
			<td align="right"> Telephone : </td><td><input type="text" name="tel_frs" id="foo" onkeyup="format(this)" value="<?php echo $ligne['TEL_FRS'];?>" /></td>
	</tr>
	
	<tr>
			<td align="right"> E-mail : </td><td><input type="text" name="mail_frs" value="<?php echo $ligne['MAIL_FRS'];?>" class="required"/></td>
	</tr>
	
	<tr>
			<td align="right">	  Adresse   : </td><td><input type="text" name="adresse_frs" value="<?php echo $ligne['ADRESSE_FRS'];?>" /></td>	
	</tr>
  
				
				</br>
				
  
   </table>
 </fieldset>
 
 
  <div align="center">
    <h3><input name="submit" type="submit" value="Modifier" />
    </h3>
  </div>

</form>
