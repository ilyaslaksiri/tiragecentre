<?php include "template/header.php";?>
<?php include "template/left.php";?>

<?php function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>
<section id="main" class="column">
<div align="center">
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
Déconnexion en cours...</br>
<img src="images/loading2.gif"></img>

</div>

</section>



<?php

	
		session_destroy();
		redirige("index.php");


?>