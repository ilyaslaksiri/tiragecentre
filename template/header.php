<!doctype html>
<!doctype html>
<html lang="en">
<?php session_start();?>
<head>
	<link rel="icon" type="image/png" href="images/logo-icon.png" />
	<meta charset="utf-8"/>
	<title>Tirage Centre</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="masque.saisie.telephone.js" type="text/javascript"></script>
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>



<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html"></a></h1>
			<h2 class="section_title">.: SmartApp :.</h2>
			<div class="btn_view_site">
			<a href="logout.php">Déconnexion</a>
			</div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Connceté :  <?php echo $_SESSION["user"]; ?> | <?php echo $_SESSION["annee"]; ?></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs">
				<a href="index.php">Exercice</a> 
					
				
				
				
				<?php  $page=basename($_SERVER['REQUEST_URI']); ?>
				
				<div class="breadcrumb_divider"></div> 
				<a  href="instant_redirect.php?annee=2017&&url=<?php echo $page; ?>" class="current" title="Changer l'exercice" >
					<input type="radio"  <?php if($_SESSION["annee"]==2017) echo "checked"?>  >2017
				</a>
				<a  href="instant_redirect.php?annee=2018&&url=<?php echo $page; ?>" class="current" title="Changer l'exercice" >
					<input type="radio"  <?php if($_SESSION["annee"]==2018) echo "checked"?>  >2018
				</a>
				<a  href="instant_redirect.php?annee=2019&&url=<?php echo $page; ?>" class="current" title="Changer l'exercice" >
					<input type="radio"  <?php if($_SESSION["annee"]==2019) echo "checked"?>  >2019
				</a>
				<a  href="instant_redirect.php?annee=2020&&url=<?php echo $page; ?>" class="current" title="Changer l'exercice" >
					<input type="radio"  <?php if($_SESSION["annee"]==2020) echo "checked"?>  >2020
				</a>
				<a  href="instant_redirect.php?annee=2021&&url=<?php echo $page; ?>" class="current" title="Changer l'exercice" >
					<input type="radio"  <?php if($_SESSION["annee"]==2021) echo "checked"?>  >2021
				</a>
				<a  href="instant_redirect.php?annee=2022&&url=<?php echo $page; ?>" class="current" title="Changer l'exercice" >
					<input type="radio"  <?php if($_SESSION["annee"]==2022) echo "checked"?>  >2022
				</a>
				<a  href="instant_redirect.php?annee=2023&&url=<?php echo $page; ?>" class="current" title="Changer l'exercice" >
					<input type="radio"  <?php if($_SESSION["annee"]==2023) echo "checked"?>  >2023
				</a>
				<a  href="instant_redirect.php?annee=2024&&url=<?php echo $page; ?>" class="current" title="Changer l'exercice" >
					<input type="radio"  <?php if($_SESSION["annee"]==2024) echo "checked"?>  >2024
				</a>

				<br/>
				<?php
				if(date("n")=="1")
					if(date("j")<3)
					echo "<h4 style=color:red>Attention au choix de l'exercice</h4>";?>
			</article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php
//-----------------------------------------------------//
// Compteur v1 //
// © Nicolas Picot //
// toophp@free.fr //
//-----------------------------------------------------//
function set_annee($a=NULL){
$fp = fopen("template/annee.txt","r+");
$annee = fgets($fp,10);
 $annee = $a;
fseek($fp,0);
fputs($fp,$annee);
fclose($fp);

}

function get_annee(){
$fp = fopen("template/annee.txt","r+");
$annee = fgets($fp,10);

fseek($fp,0);
fputs($fp,$annee);
fclose($fp);
return $annee;
}
?> 