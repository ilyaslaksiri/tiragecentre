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
	
	
//-------info devis ---------
$id_devis=$_POST['id_devis'];
$calcule=$_POST['calcule'];
$totalHT=$_POST['total'];
$totalTTC=$_POST['totalTTC'];
$somme=$_POST['somme'];
$date_devis=$_POST['date_devis'];

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

$requete="update devis set 
						
						CALCULE='$calcule',
						DATE_DEVIS='$date_devis', 
						MONTANT_HT='$totalHT',
						TVA='$TVA',
						MONTANT_TTC='$totalTTC',
						MONTANT_LETTRE='$somme',
						MOIS_DEVIS=$mois_devis[1],
						ID_EXERCICE=$annee_devis[2]
						
					where id_devis='$id_devis'";
	$result = @mysql_query($requete, $idcom);
	
	
	


$requete="delete  from ligne_devis where `ID_DEVIS`='$id_devis'";
$result = @mysql_query($requete, $idcom);


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
