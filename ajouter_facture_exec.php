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
	
	
//-------info facture ---------
$totalHT=$_POST['total'];
$totalTTC=$_POST['totalTTC'];
$somme=$_POST['somme'];
$date_facture=$_POST['date_facture'];
$num_facture=$_POST['num_facture'];
$id_client=$_POST['id_client'];
$TVA=$_POST['tva'];
$BL=$_POST['BL'];
$mois_facture=explode ("/",$date_facture);
$annee_facture=explode ("/",$date_facture);

//--------detail facture ----
$designation=$_POST['ChampDesign'];
$prixHT=$_POST['ChampTarifHT'];
$qte=$_POST['ChampQte'];
$ref=$_POST['ChampRef'];
//$totalHT=$_POST['ChampResult'];

$compteur=0;
foreach( $designation as $i => $design ) {
			if($design!="")
				$compteur++;
}
if($compteur==0){
redirige("ajouter_facture.php?id_client=$id_client");
}

$requete="insert into facture (`ID_CLIENT`,`NUM_FACTURE`,`DATE_FACTURE`,`MONTANT_HT`,`TVA`,`MONTANT_TTC`,`MONTANT_LETTRE`,`BL`,`MOIS_FACTURE`,`ID_EXERCICE`) 
							values('$id_client',
							'$num_facture',
							'$date_facture',
							'$totalHT','$TVA',
							'$totalTTC','$somme',
							'$BL',
							'$mois_facture[1]',
							'$annee_facture[2]')";
	$result = @mysql_query($requete, $idcom);
	$id_facture=mysql_insert_id();






	foreach( $designation as $i => $design ) {
			
			if($design!=""){
				$design=addslashes($design);
			$requete="insert into ligne_facture (`ID_FACTURE`,`QTE`,`DESIGNATION`,`PRIX_HT`,`ref`) 
							values('$id_facture','$qte[$i]','$design','$prixHT[$i]','$ref[$i]')";
	
			$result = @mysql_query($requete, $idcom);
				}
}

redirige("list_facture.php?id_client=$id_client");


?>
