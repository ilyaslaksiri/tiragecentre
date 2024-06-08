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
$date_bc=$_POST['date_bc'];
$num_bc=$_POST['num_bc'];
$id_frs=$_POST['id_frs'];
$TVA=$_POST['tva'];

$mois_bc=explode ("/",$date_bc);
$annee_bc=explode ("/",$date_bc);

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
redirige("ajouter_bc.php?id_frs=$id_frs");
}

$requete="insert into bc (`ID_FRS`,`NUM_BC`,`DATE_BC`,`MONTANT_HT`,`TVA`,`MONTANT_TTC`,`MONTANT_LETTRE`,`MOIS_BC`,`ID_EXERCICE`) 
							values('$id_frs',
							'$num_bc',
							'$date_bc',
							'$totalHT','$TVA',
							'$totalTTC','$somme',
							'$mois_bc[1]',
							'$annee_bc[2]')";
	$result = @mysql_query($requete, $idcom);
	$id_bc=mysql_insert_id();






	foreach( $designation as $i => $design ) {
			
			if($design!=""){
				$design=addslashes($design);
			$requete="insert into ligne_bc (`ID_BC`,`QTE`,`DESIGNATION`,`PRIX_HT`) 
							values('$id_bc','$qte[$i]','$design','$prixHT[$i]')";
	
			$result = @mysql_query($requete, $idcom);
				}
}

redirige("list_bc.php?id_frs=$id_frs");


?>
