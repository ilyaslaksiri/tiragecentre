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
	
	
//-------info bc ---------
$id_bc=$_POST['id_bc'];

$totalHT=$_POST['total'];
$totalTTC=$_POST['totalTTC'];
$somme=$_POST['somme'];
$date_bc=$_POST['date_bc'];

$id_frs=$_POST['id_frs'];

$TVA=$_POST['tva'];

$mois_bc=explode ("/",$date_bc);
$annee_bc=explode ("/",$date_bc);
//--------detail bc ----
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

$requete="update bc set 
						
						
						DATE_BC='$date_bc', 
						MONTANT_HT='$totalHT',
						TVA='$TVA',
						MONTANT_TTC='$totalTTC',
						MONTANT_LETTRE='$somme',
						MOIS_BC=$mois_bc[1],
						ID_EXERCICE=$annee_bc[2]
						
					where id_bc='$id_bc'";
	$result = @mysql_query($requete, $idcom);
	
	
	


$requete="delete  from ligne_bc where `ID_BC`='$id_bc'";
$result = @mysql_query($requete, $idcom);


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
