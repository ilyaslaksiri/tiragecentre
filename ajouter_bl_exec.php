
<div align="center">
<img src="images/loading.gif"></img>
</div>

<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>

<?php
	include_once("connex.inc.php");
	$idcom=connex("tirage_centre_db", "myparam");
	
	
//-------info BL ---------



$date_bl=$_POST['date_bl'];
$num_bl=$_POST['num_bl'];
$id_client=$_POST['id_client'];



//--------detail BL ----
$designation=$_POST['ChampDesign'];
$nombre=$_POST['ChampNombre'];
$longeur=$_POST['ChampLongeur'];
$largeur=$_POST['ChampLargeur'];
$prixht=$_POST['ChampPrixHT'];

//$totalHT=$_POST['ChampResult'];

$compteur=0;
foreach( $designation as $i => $design ) {
			if($design!="")
				$compteur++;
}
if($compteur==0){
redirige("ajouter_bl.php?id_client=$id_client");
}

$requete="insert into bl (`ID_CLIENT`,`NUM_BL`,`DATE_BL`,`ETAT_BL`) 
							values('$id_client','$num_bl','$date_bl','OUVERT')";
	$result = @mysql_query($requete, $idcom);
	$id_bl=mysql_insert_id();



	$total_bl=0;


	foreach( $designation as $i => $design ) {
			
			if($design!=""){
				$design=addslashes($design);
			$requete="insert into ligne_bl (`ID_BL`,`NOMBRE`,`DESIGNATION_LIGNE_BL`,`LONGEUR`,`LARGEUR`,`PRIX_HT`) 
							values('$id_bl','$nombre[$i]','$design','$longeur[$i]','$largeur[$i]','$prixht[$i]')";
	
			
			
			$result = @mysql_query($requete, $idcom);
			$total=$prixht[$i] * $nombre[$i] * $longeur[$i]*$largeur[$i];
			$total_bl+=$total;
				}
				
	
}
$requete="update bl set TOTAL_BL='$total_bl' where `ID_BL`='$id_bl'";
	$result = @mysql_query($requete, $idcom);

redirige("list_bl.php?id_client=$id_client");


?>
