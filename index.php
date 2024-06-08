<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Connexion </title>
    
    
    <link rel="stylesheet" href="css/reset.css">

    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  
  <body>

  <form action="" method="post">
    <div class="wrap">
		<div class="avatar">
      <img src="images/logo-icon.png">
		</div>
		<input type="text" name="user" placeholder="Utilisateur" required>
		<div class="bar">
			<i></i>
		</div>
		<input type="password"  name="password" placeholder="Mot de passe" required>
		</br>
		Exercice : 
		<select name="exe">
			<option value="2017"  >2017</option>
			<option value="2018"  >2018</option>
			<option value="2019"  >2019</option>
			<option value="2020"  >2020</option>
			<option value="2021"  >2021</option>
			<option value="2022"  >2022</option>
			<option value="2023"  >2023</option>
			<option value="2024" selected >2024</option>
		</select>

		</br></br>
		
		<button>Se connecter</button>
	</div>
    
        <script src="js/index.js"></script>
</form>
    
    
    
  </body>
</html>

<?php

function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}


if(isset($_POST["user"]) && isset($_POST["password"]))
	
	{
		
		$user=$_POST["user"];
		$password=$_POST["password"];
		
		
		
		if($user=="admin" && $password=="1234")
		{
			session_start();
			$_SESSION["user"]=$user;
			$_SESSION["annee"]=$_POST["exe"];
			
			
			
			
			redirige("list_client.php");
			
			
			
		}
		elseif($user=="user" && $password=="2017")
		{
			session_start();
			$_SESSION["user"]=$user;
			$_SESSION["annee"]=$_POST["exe"];
			redirige("list_client_bl.php");
		}
		else
		{
			echo "<center>Login ou mot de passe incorrectes !</center>";
		}
		
	}


	
?>