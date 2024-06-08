
<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>

<?php
	include_once("../connex.inc.php");
	$idcom=connex("tirage_centre_db", "myparam");

$requete="select * from facture where ETAT_FACTURE='ECHEANCE' && DATE_PAYEMENT like '".date("d/m/Y")."'";
echo $requete;die;
$result=@mysql_query($requete, $idcom);
$ligne=mysql_fetch_array($result);

echo $ligne['total'];
?>