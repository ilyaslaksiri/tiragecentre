<?php include "template/header.php";?>
<?php include "template/left.php";?>


<body>
<section id="main" class="column">
		
		<article class="module width_full" >
		<header><h3 class="tabs_involved">Tableau de comptabilit&eacute; :  Exercice <?php echo $_SESSION["annee"]?> </h3>
		<ul class="tabs">
   			
    		<li><a href="#tab1">1</a></li>
			<li><a href="#tab2">2</a></li>
			<li><a href="#tab3">3</a></li>
			<li><a href="#tab4">4</a></li>
			
		</ul>
		</header>

		<div class="tab_container">
			
<div id="tab1" class="tab_content" align="center">
			
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
			
   		 
    		<td>Num Facture</td> 
			<td>Date Facture</td>
			<td>Montant TTC</td>
			<td>TVA</td>
			<td>Etat</td>
			<td>Date Paiement</td>
			<td>Mode Paiement</td>
			
			</thead> 
			<tbody> 
				

				
<?php 


include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

for ($i = 1; $i <= 3; $i++) {

$mois = $i."/".$_SESSION["annee"];

if($i<10) $mois = "0".$mois;




$requete3 = mysql_query("SELECT *  FROM `facture` WHERE `DATE_PAYEMENT` LIKE '%".$mois."%' and `ETAT_FACTURE` = 'PAYE' ");





while($ligne3 = mysql_fetch_array($requete3)) {

   print "
  
   <tr bgcolor=#E6E6E6 align=center widht=50%>
   

   

<td  align=center> ".$ligne3["NUM_FACTURE"]."</td>
<td  align=center> ".$ligne3["DATE_FACTURE"]."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["MONTANT_TTC"])."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["TVA"])."</td>
<td  align=center> ".$ligne3["ETAT_FACTURE"]."</td>
<td  align=center> ".$ligne3["DATE_PAYEMENT"]."</td>
<td  align=center> ".$ligne3["MODE_PAYEMENT"]."</td>

</tr>
   ";  

	
}	
}



?>

			</tbody> 
			</table>
			
			
			</div>

			
			
<div id="tab2" class="tab_content" align="center">
			
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
			
   		 
    		<td>Num Facture</td> 
			<td>Date Facture</td>
			<td>Montant TTC</td>
			<td>TVA</td>
			<td>Etat</td>
			<td>Date Paiement</td>
			<td>Mode Paiement</td>
			
			</thead> 
			<tbody> 
				

				
<?php 




for ($i = 4; $i <= 6; $i++) {

$mois = $i."/".$_SESSION["annee"];

if($i<10) $mois = "0".$mois;




$requete3 = mysql_query("SELECT *  FROM `facture` WHERE `DATE_PAYEMENT` LIKE '%".$mois."%' and `ETAT_FACTURE` = 'PAYE' ");





while($ligne3 = mysql_fetch_array($requete3)) {

   print "
  
   <tr bgcolor=#E6E6E6 align=center widht=50%>
   

   

<td  align=center> ".$ligne3["NUM_FACTURE"]."</td>
<td  align=center> ".$ligne3["DATE_FACTURE"]."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["MONTANT_TTC"])."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["TVA"])."</td>
<td  align=center> ".$ligne3["ETAT_FACTURE"]."</td>
<td  align=center> ".$ligne3["DATE_PAYEMENT"]."</td>
<td  align=center> ".$ligne3["MODE_PAYEMENT"]."</td>

</tr>
   ";  

	
}	
}



?>

			</tbody> 
			</table>
			
			
			</div>
			
<div id="tab3" class="tab_content" align="center">
			
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
			
   		 
    		<td>Num Facture</td> 
			<td>Date Facture</td>
			<td>Montant TTC</td>
			<td>TVA</td>
			<td>Etat</td>
			<td>Date Paiement</td>
			<td>Mode Paiement</td>
			
			</thead> 
			<tbody> 
				

				
<?php 



for ($i = 7; $i <= 9; $i++) {

$mois = $i."/".$_SESSION["annee"];

if($i<10) $mois = "0".$mois;




$requete3 = mysql_query("SELECT *  FROM `facture` WHERE `DATE_PAYEMENT` LIKE '%".$mois."%' and `ETAT_FACTURE` = 'PAYE' ");





while($ligne3 = mysql_fetch_array($requete3)) {

   print "
  
   <tr bgcolor=#E6E6E6 align=center widht=50%>
   

   

<td  align=center> ".$ligne3["NUM_FACTURE"]."</td>
<td  align=center> ".$ligne3["DATE_FACTURE"]."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["MONTANT_TTC"])."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["TVA"])."</td>
<td  align=center> ".$ligne3["ETAT_FACTURE"]."</td>
<td  align=center> ".$ligne3["DATE_PAYEMENT"]."</td>
<td  align=center> ".$ligne3["MODE_PAYEMENT"]."</td>

</tr>
   ";  

	
}	
}



?>

			</tbody> 
			</table>
			
			
			</div>

<div id="tab4" class="tab_content" align="center">
			
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
			
   		 
    		<td>Num Facture</td> 
			<td>Date Facture</td>
			<td>Montant TTC</td>
			<td>TVA</td>
			<td>Etat</td>
			<td>Date Paiement</td>
			<td>Mode Paiement</td>
			
			</thead> 
			<tbody> 
				

				
<?php 


include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

for ($i = 10; $i <= 12; $i++) {

$mois = $i."/".$_SESSION["annee"];

if($i<10) $mois = "0".$mois;




$requete3 = mysql_query("SELECT *  FROM `facture` WHERE `DATE_PAYEMENT` LIKE '%".$mois."%' and `ETAT_FACTURE` = 'PAYE' ");





while($ligne3 = mysql_fetch_array($requete3)) {

   print "
  
   <tr bgcolor=#E6E6E6 align=center widht=50%>
   

   

<td  align=center> ".$ligne3["NUM_FACTURE"]."</td>
<td  align=center> ".$ligne3["DATE_FACTURE"]."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["MONTANT_TTC"])."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["TVA"])."</td>
<td  align=center> ".$ligne3["ETAT_FACTURE"]."</td>
<td  align=center> ".$ligne3["DATE_PAYEMENT"]."</td>
<td  align=center> ".$ligne3["MODE_PAYEMENT"]."</td>

</tr>
   ";  

	
}	
}



?>

			</tbody> 
			</table>
			
			
			</div>
		</div><!-- end of #tab1 -->
			</article>

</section>
</body>

</html>