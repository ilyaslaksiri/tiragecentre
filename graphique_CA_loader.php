<?php include "template/header.php";?>
<?php include "template/left.php";?>


<body>
<section id="main" class="column">
		
		
		
		
		
		
		
		
		<article class="module width_full" >
		<header><h3 class="tabs_involved">Tableau de bord :  Exercice <?php echo $_SESSION["annee"]?> </h3>
		<ul class="tabs">
   			<li><a href="#tab1">Graphique</a></li>
    		<li><a href="#tab2">NP</a></li>
			<li><a href="#tab3">CA Reel</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content" align="center">
			</br>
				<?php include "graphique_CA.php";?>
				<img src="./tmp/imagefile2.png"   width="800px"  alt="./tmp/imagefile2.png" align="center"></img>
			</div>
			
			<div id="tab2" class="tab_content" align="center">
			
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
			
   				<td>Ordre</td> 	 
    		<td>Client</td> 
			<td>Montant TTC</td>
			
		
			</thead> 
			<tbody> 
				

				
<?php 
$requete2 = mysql_query("SELECT `NOM_CLIENT`, sum(`MONTANT_TTC`) MONTANT_TTC FROM `facture` f,`client` c where f.`ID_CLIENT`=c.`ID_CLIENT`
 AND`ETAT_FACTURE`='NP'
 AND ID_EXERCICE > 2013
group by f.`ID_CLIENT`
order by MONTANT_TTC desc");
$i=1;
$total=0;



while($ligne2 = mysql_fetch_array($requete2)) {

   print "
  
   <tr bgcolor=#E6E6E6 align=left widht=50%><td  >".$i."</td><td  >".$ligne2["NOM_CLIENT"]."</td>
<td  align=left> ".sprintf("%.02f", $ligne2["MONTANT_TTC"])."</td></tr>
   ";  
   $i++;
	$total+=$ligne2["MONTANT_TTC"];
}
echo "<tr  bgcolor=#FF4D4D align=left widht=50%><td colspan=2 align=right>Total</td><td>".$total."</td></tr>";


?>

			</tbody> 
			</table>
			
			
			</div>
			
			
			
			<div id="tab3" class="tab_content" align="center">
			
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
			
   		 
    		<td>Mois</td> 
			<td>Chifre d'affaire (1)</td>
			<td>Achat Frs (2)</td>
			<td>TVA</td>
			<td>Recup TVA</td>
			<td>Resultat tva</td>
			<td>(1) - (2)</td>
			</thead> 
			<tbody> 
				

				
<?php 

for ($i = 1; $i <= 12; $i++) {

$mois = $i."/".$_SESSION["annee"];

if($i<10) $mois = "0".$mois;

$requete3 = mysql_query("

SELECT sum(`MONTANT_TTC`) MONTANT_TTC , sum(`TVA`) TVA   FROM `facture` WHERE `DATE_PAYEMENT` LIKE '%".$mois."%' and `ETAT_FACTURE` = 'PAYE' ");





while($ligne3 = mysql_fetch_array($requete3)) {


if($i<10) $i = "0".$i;
$mois_frs = "%/".$i."/".$_SESSION["annee"]."";
$requete4="select sum(`TVA_FRS`) TVA_FRS, sum(`MONTANT_TTC_FRS`) MONTANT_TTC_FRS from facture_frs 

where `DATE_PAYEMENT_FRS` like '".$mois_frs."' 

and `ETAT_FACTURE_FRS` not like 'ANNULEE'

and `ID_EXERCICE`= ".$_SESSION["annee"]." ";

$result4=@mysql_query($requete4, $idcom);
$ligne4=mysql_fetch_array($result4);

$resultatNet = $ligne3["MONTANT_TTC"] - $ligne4["MONTANT_TTC_FRS"];


   print "
  
   <tr bgcolor=#E6E6E6 align=center widht=50%>
   

   
<td  >".$i."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["MONTANT_TTC"])."</td>
<td  align=center> ".sprintf("%.02f", $ligne4["MONTANT_TTC_FRS"])."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["TVA"])."</td>
<td  align=center> ".sprintf("%.02f", $ligne4["TVA_FRS"])."</td>
<td  align=center> ".sprintf("%.02f", $ligne3["TVA"] - $ligne4["TVA_FRS"])."</td>
";
if($resultatNet<0)
print "<td  align=center bgcolor=red> ".sprintf("%.02f", $resultatNet)."</td>";
else
print "<td  align=center > ".sprintf("%.02f", $resultatNet)."</td>";	

print "</tr>";
  

	
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