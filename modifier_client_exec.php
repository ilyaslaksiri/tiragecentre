<?php include "template/header.php";?>
<?php include "template/left.php";?>


<section id="main" class="column">
<div align="center">
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
Modification en cours...</br>
<img src="images/loading2.gif"></img>

</div>

</section>

<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>

<?php

include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

	$id_client=$_POST['id_client'];
	$nom_client= addslashes(strtoupper($_POST['nom_client']));
	$ice= addslashes($_POST['ice']);
	$adresse_client= addslashes(ucfirst($_POST['adresse_client']));
	$tel_client=addslashes($_POST['tel_client']);
	
	$mail_client= addslashes(strtolower($_POST['mail_client']));
	
$requete="update client set 
						NOM_CLIENT='$nom_client',
						ICE='$ice',
						TEL_CLIENT='$tel_client', 
						ADRESSE_CLIENT='$adresse_client',
						MAIL_CLIENT='$mail_client'
						
					where id_client='$id_client'";
$result=@mysql_query($requete, $idcom);

redirige("list_client.php");


?>