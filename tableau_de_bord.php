<?php include "template/header.php";?>
<?php include "template/left.php";?>



<section id="main" class="column">
		
		
		
		<!-- end of stats article -->
		
		
		
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Tableau de bord</h3>
		<ul class="tabs">
   			<li><a href="#tab1">Graph C.A</a></li>
    		<li><a href="#tab2">C.A</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			</br>
				<?php include "graphique_CA.php";?>
				<img src="./tmp/imagefile2.png"   width="640px"  alt="./tmp/imagefile2.png" align="center"></img>
			</div>
		</div><!-- end of #tab1 -->
			
<?php
include_once("connex.inc.php");
$idcom=connex("forever_db", "myparam");
?>
			
			<div id="tab2" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th>Reference</th> 
    				<th>Designation</th> 
    				<th>Qte Vendue</th> 
    				<th>Mois</th> 
				</tr> 
			</thead> 
			<tbody> 
			
<?php 
$M=date("m");
$mois=$M-1;
if($mois==0) $mois=12;

$requete4 = mysql_query("SELECT sum(`QTE_CMD`) qte,lc.`ID_PRODUIT`,p.`REF_PRODUIT`,`DESIGNATION_PRODUIT`, `MOIS_CMD`
FROM `ligne_cmd` lc,`cmd` c,`produits` p

where c.`ID_CMD`=lc.`ID_CMD`

and lc.`ID_PRODUIT`=p.`ID_PRODUIT`

AND `MOIS_CMD`='$mois'
 group by lc.`ID_PRODUIT`
order by qte desc
limit 0,5
");

while($ligne4 = mysql_fetch_array($requete4)) {



		print("
				<tr> 
   					
    				<td>".$ligne4["REF_PRODUIT"]."</td> 
    				<td>".$ligne4["DESIGNATION_PRODUIT"]."</td> 
    				<td>".$ligne4["qte"]."</td> 
    				<td>".$mois."</td> 
				</tr> 
			");}
			?>			
			</tbody> 
			</table>

			</div><!-- end of #tab2 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
		<article class="module width_quarter">
			<header><h3>Messages</h3></header>
			<div class="message_list">
				<div class="module_content">
					<div class="message"><p>Vous n'avez Aucun Message.</p>
					<p><strong><?php echo date("d/M/Y"); ?></strong></p></div>
					
				</div>
			</div>
			<footer>
				<form class="post_message">
					<input type="text" value="Message" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
					<input type="submit" class="btn_post_message" value=""/>
				</form>
			</footer>
		</article><!-- end of messages article -->
		
		
		
		


</body>

</html>