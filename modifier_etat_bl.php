<?php include "template/header.php";?>
<?php include "template/left.php";?>

<?php 

$id_bl=$_GET['id_bl'];
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete="select * from bl where ID_BL='$id_bl'";

$result=@mysql_query($requete, $idcom);
$ligne=mysql_fetch_array($result);
	
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
<h4 class="titre_info">Etat BL Num: <?php echo $ligne["NUM_BL"];?></h4><br/><br/>
<fieldset>
<form action="modifier_etat_bl_exec.php" method="post">


 <input type="hidden" name="id_bl" value="<?php echo $id_bl;?>"/>
 
  
  <table  width="90%" >
	
	

	
	<tr>	
			<td align="right"> Etat		<span style="color:#FF0000">(*)</span>&nbsp;:</td>
			<td> 
					<select name="etat_bl">
    <option value="OUVERT" <?php if($ligne["ETAT_BL"]=="OUVERT") echo "selected";?> >OUVERT</option>
    <option value="Arreté" <?php if($ligne["ETAT_BL"]=="Arreté") echo "selected";?> >Arreté</option>
    <option value="Facturé" <?php if($ligne["ETAT_BL"]=="Facturé") echo "selected";?>  >Facturé</option>
	<option value="Annulé" <?php if($ligne["ETAT_BL"]=="Annulé") echo "selected";?> >Annulé</option>
</select>
			</td>
	</tr>
	
	
	<tr>
			<td align="right"> Description &nbsp;: </td><td><input type="text" id="foo" onkeyup="format(this)" name="desc_bl" value="" /></td>
	</tr>
	
	
  
  </br>
				
   </table>
  
  </fieldset>
 
  <div align="center">
    <h3><input name="submit" type="submit" value="Enregistrer" />
    </h3>
  </div>

  
</form>

</section>



