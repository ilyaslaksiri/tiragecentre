<?php include "template/header.php";?>
<?php include "template/left.php";?>


<section id="main" class="column">
<div align="center">
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
Supression en cours...</br>
<img src="images/loading2.gif"></img>

</div>

</section>
 

<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>
 
 <?php
 
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$id_client=$_GET['id_client'];
$requete="delete from CLIENT where ID_client='$id_client'";
$result=@mysql_query($requete, $idcom);



redirige("list_client.php");

?>
