<?php include "template/header.php";   
include "template/left.php";   

?>

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
	
	
//-------info bl ---------
$id_bl=$_POST['id_bl'];



$date_bl=$_POST['date_bl'];
$num_bl=$_POST['num_bl'];
$id_client=$_POST['id_client'];



//--------detail bl ----
$designation=$_POST['ChampDesign'];
$nombre=$_POST['ChampNombre'];
$longeur=$_POST['ChampLongeur'];
$largeur=$_POST['ChampLargeur'];
$prixht=$_POST['ChampPrixHT'];

$compteur=0;
foreach( $designation as $i => $design ) {
			if($design!="")
				$compteur++;
}
if($compteur==0){
redirige("ajouter_bl.php?id_client=$id_client");
}

$requete="update bl set 
						`NUM_BL`='$num_bl',
						`DATE_BL`='$date_bl' 
						
					where `ID_BL`='$id_bl'";
	$result = @mysql_query($requete, $idcom);
	
	
	


$requete="delete  from ligne_bl where `ID_BL`='$id_bl'";
$result = @mysql_query($requete, $idcom);
$total_bl=0;

	foreach( $designation as $i => $design ) {
			
			if($design!=""){
				$design=addslashes($design);
			$requete="insert into ligne_bl (`ID_BL`,`NOMBRE`,`DESIGNATION_LIGNE_BL`,`LONGEUR`,`LARGEUR`,`PRIX_HT`) 
							values('$id_bl','$nombre[$i]','$design','$longeur[$i]','$largeur[$i]','$prixht[$i]')";
	
			
			$total=$prixht[$i] * $nombre[$i] * $longeur[$i]*$largeur[$i];
			$total_bl+=$total;
			$result = @mysql_query($requete, $idcom);
				}
}
$requete="update bl set TOTAL_BL='$total_bl' where `ID_BL`='$id_bl'";
	$result = @mysql_query($requete, $idcom);
redirige("list_bl.php?id_client=$id_client");


?>
