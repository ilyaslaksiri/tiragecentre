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
$desc_bl=$_POST['desc_bl'];
$etat_bl=$_POST['etat_bl'];


$requete="update bl set 
					`ETAT_BL`='$etat_bl'
					where `ID_BL`='$id_bl'";
					
	$result = @mysql_query($requete, $idcom);
	
	

redirige("carnet_bl.php");


?>
