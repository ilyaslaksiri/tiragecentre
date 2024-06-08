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

	$id_facture=$_POST['id_facture'];
	$etat_facture= addslashes(strtoupper($_POST['etat_facture']));
	$mode_payement= addslashes(ucfirst($_POST['mode_payement']));
	$date_payement=addslashes($_POST['date_payement']);
	
	
	
$requete="update facture set 
						`ETAT_FACTURE`='$etat_facture',
						`MODE_PAYEMENT`='$mode_payement', 
						`DATE_PAYEMENT`='$date_payement'
					where ID_FACTURE=$id_facture";
					
$result=@mysql_query($requete, $idcom);

redirige("registre_facture.php");


?>