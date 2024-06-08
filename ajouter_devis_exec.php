<?php include "template/header.php";?>
<?php include "template/left.php";?>
<div align="center">
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
Création en cours...</br>
<img src="images/loading2.gif"></img>

</div>

</section>

<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>

<?php
	include_once("connex.inc.php");
	$idcom=connex("tirage_centre_db", "myparam");
	
	
//-------info devis ---------
$totalHT=$_POST['total'];
$totalTTC=$_POST['totalTTC'];
$somme=$_POST['somme'];
$date_devis=$_POST['date_devis'];
$num_devis=$_POST['num_devis'];
$id_client=$_POST['id_client'];
$TVA=$_POST['tva'];

$mois_devis=explode ("/",$date_devis);
$annee_devis=explode ("/",$date_devis);

//--------detail devis ----
$designation=$_POST['ChampDesign'];
$prixHT=$_POST['ChampTarifHT'];
$qte=$_POST['ChampQte'];
//$totalHT=$_POST['ChampResult'];

$compteur=0;
foreach( $designation as $i => $design ) {
			if($design!="")
				$compteur++;
}
if($compteur==0){
redirige("ajouter_devis.php?id_client=$id_client");
}

$requete="insert into devis (`ID_CLIENT`,`NUM_DEVIS`,`DATE_DEVIS`,`MONTANT_HT`,`TVA`,`MONTANT_TTC`,`MONTANT_LETTRE`,`MOIS_DEVIS`,`ID_EXERCICE`) 
							values('$id_client',
							'$num_devis',
							'$date_devis',
							'$totalHT','$TVA',
							'$totalTTC','$somme',
							'$mois_devis[1]',
							'$annee_devis[2]')";
	$result = @mysql_query($requete, $idcom);
	$id_devis=mysql_insert_id();






	foreach( $designation as $i => $design ) {
			
			if($design!=""){
				$design=addslashes($design);
			$requete="insert into ligne_devis (`ID_DEVIS`,`QTE`,`DESIGNATION`,`PRIX_HT`) 
							values('$id_devis','$qte[$i]','$design','$prixHT[$i]')";
	
			$result = @mysql_query($requete, $idcom);
				}
}

redirige("list_devis.php?id_client=$id_client");


?>
