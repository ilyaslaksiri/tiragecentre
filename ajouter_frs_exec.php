<?php include "template/header.php";?>
<?php include "template/left.php";?>

<?php function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>
<section id="main" class="column">
<div align="center">
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
Ajout Fournisseur en cours...</br>
<img src="images/loading2.gif"></img>

</div>

</section>



<?php
if(!empty($_POST['nom_frs']))

{
	include_once("connex.inc.php");
	$idcom=connex("tirage_centre_db", "myparam");
	
	
	$nom_frs= addslashes(strtoupper($_POST['nom_frs']));
	
	$adresse_frs= addslashes(ucfirst($_POST['adresse_frs']));
	$tel_frs=addslashes($_POST['tel_frs']);
	
	$mail_frs= addslashes(strtolower($_POST['mail_frs']));
	
	
	
	
	$requete="
	insert into fournisseur 
	(`NOM_FRS`, `TEL_FRS`, `ADRESSE_FRS`,`MAIL_FRS`) 
			
	values('$nom_frs','$tel_frs','$adresse_frs','$mail_frs')";
	
	$result = @mysql_query($requete, $idcom);
	
echo "ok";
		redirige("list_frs.php");
echo "nok";
		
		
		}
	



?>