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


		
<section id="main" class="column">
<h4 class="titre_info">Nouveau Fournisseur</h4><br/><br/>
<fieldset>
<form action="ajouter_frs_exec.php" method="post">


 
 
  
  <table  width="90%" >
	
	
	
	
	<tr>	
			<td align="right"> Nom  		<span style="color:#FF0000">(*)</span>&nbsp;:</td><td>  <input type="text" name="nom_frs" value="" id="zone_input" class="required"/> </td>
	</tr>
	
	<tr>
			<td align="right"> Telephone &nbsp;: </td><td><input type="text" id="foo" onkeyup="format(this)" name="tel_frs" value="" /></td>
	</tr>
	
	<tr>
			<td align="right"> E-mail <span style="color:#FF0000"></span>&nbsp;: </td><td><input type="text" name="mail_frs" value="" /></td>
	</tr>
	<tr>
			<td align="right">	  Adresse   : </td><td><input type="text" name="adresse_frs" value="" /></td>	
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



