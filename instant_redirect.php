<?php include "template/header.php";?>
<?php include "template/left.php";?>


<section id="main" class="column">
<div align="center">
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
Chargement en cours...</br>
<img src="images/loading2.gif"></img>

</div>

</section>

<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
	
	$annee=$_GET["annee"];
	$url=$_GET["url"];
	$_SESSION["annee"]=$annee;
	$ex_url=explode ("/",$url);
	
	//echo $ex_url[0];
	redirige($ex_url[0]);
?>

