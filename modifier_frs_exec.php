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

	$id_frs=$_POST['id_frs'];
	$nom_frs= addslashes(strtoupper($_POST['nom_frs']));
	$adresse_frs= addslashes(ucfirst($_POST['adresse_frs']));
	$tel_frs=addslashes($_POST['tel_frs']);
	
	$mail_frs= addslashes(strtolower($_POST['mail_frs']));
	
$requete="update fournisseur set 
						NOM_FRS='$nom_frs',
						TEL_FRS='$tel_frs', 
						ADRESSE_FRS='$adresse_frs',
						MAIL_FRS='$mail_frs'
						
					where ID_FRS='$id_frs'";
$result=@mysql_query($requete, $idcom);

redirige("list_frs.php");


?>