<?php include "template/header.php";?>
<?php include "template/left.php";?>
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
	
	
//-------info facture ---------
$id_facture=$_POST['id_facture'];
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

$requete="update facture set 
						NUM_FACTURE='$num_facture',
						DATE_FACTURE='$date_facture', 
						MONTANT_HT='$totalHT',
						TVA='$TVA',
						MONTANT_TTC='$totalTTC',
						MONTANT_LETTRE='$somme',
						BL='$BL',
						MOIS_FACTURE=$mois_facture[1],
						ID_EXERCICE=$annee_facture[2]
						
					where id_facture='$id_facture'";
	$result = @mysql_query($requete, $idcom);
	
	
	


$requete="delete  from ligne_facture where `ID_FACTURE`='$id_facture'";
$result = @mysql_query($requete, $idcom);


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
