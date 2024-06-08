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
$id_client=$_GET['id_client'];
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete="select * from client where ID_CLIENT='$id_client'";

$result=@mysql_query($requete, $idcom);
$ligne=mysql_fetch_array($result);

?>
	
<section id="main" class="column">
<h4 class="titre_info">Client : <?php echo $ligne[1];?> </h4><br/><br/>
<fieldset>

<form action="modifier_client_exec.php" method="post" >

<input type="hidden" name="id_client" value="<?php echo $id_client ?>" />




    <table  width="90%" >
	
	

	
	<tr>	
			<td align="right"> Client  		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  <input type="text" name="nom_client" value="<?php echo $ligne['NOM_CLIENT'];?>" id="zone_input" class="required"/> </td>
	</tr>

	<tr>	
			<td align="right"> ICE  		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  <input type="text" name="ice" value="<?php echo $ligne['ICE'];?>" id="zone_input" class="required"/> </td>
	</tr>
	
	<tr>
			<td align="right"> Telephone : </td><td><input type="text" name="tel_client" id="foo" onkeyup="format(this)" value="<?php echo $ligne['TEL_CLIENT'];?>" /></td>
	</tr>
	
	<tr>
			<td align="right"> E-mail : </td><td><input type="text" name="mail_client" value="<?php echo $ligne['MAIL_CLIENT'];?>" class="required"/></td>
	</tr>
	
	<tr>
			<td align="right">	  Adresse   : </td><td><input type="text" name="adresse_client" value="<?php echo $ligne['ADRESSE_CLIENT'];?>" /></td>	
	</tr>
  
				
				</br>
				
  
   </table>
 </fieldset>
 
 
  <div align="center">
    <h3><input name="submit" type="submit" value="Modifier" />
    </h3>
  </div>

</form>
