<?php include "template/header.php";?>
<?php include "template/left.php";?>

<?php function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>
<section id="main" class="column">
<div align="center">
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
Ajout client en cours...</br>
<img src="images/loading2.gif"></img>

</div>

</section>



<?php
if(!empty($_POST['nom_client']))

{
	include_once("connex.inc.php");
	$idcom=connex("tirage_centre_db", "myparam");
	
	
	$nom_client= addslashes(strtoupper($_POST['nom_client']));
	$ice= addslashes(strtoupper($_POST['ice']));
	$adresse_client= addslashes(ucfirst($_POST['adresse_client']));
	$tel_client=addslashes($_POST['tel_client']);
	
	$mail_client= addslashes(strtolower($_POST['mail_client']));
	
	
	
	
	$requete="
	insert into client 
	(`NOM_CLIENT`, `TEL_CLIENT`, `ADRESSE_CLIENT`,`MAIL_CLIENT`,`ICE`) 
			
	values('$nom_client','$tel_client','$adresse_client','$mail_client','$ice')";
	
	$result = @mysql_query($requete, $idcom);
	
echo "ok";
		redirige("list_client.php");
echo "nok";
		
		
		}
	



?>