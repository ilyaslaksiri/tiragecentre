
	<aside id="sidebar" class="column" style="height: 750px;">
	
	<div align="center">
	<?php //<embed src="http://www.clocklink.com/clocks/0006-gray.swf?TimeZone=GMT00&"  width="150" height="150" wmode="transparent" type="application/x-shockwave-flash">?>
	<img src="images/lg.png" width="100%"/>
	</div> 
		
		

		
		<?php if($_SESSION["user"]=="admin"){ ?>
		<hr/>
		<h3>Clients</h3>
		<ul class="toggle">
			<li class="icn_add_user"><a href="ajouter_client.php">Nouveau client</a></li>
			<li class="icn_view_users"><a href="list_client.php">Clients / Facutres</a></li>
			
		</ul>
		<?php } ?>
		
		<?php if($_SESSION["user"]=="admin"){ ?>
		<h3>Factures</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="list_client.php">Nouvelle Facutre</a></li>
			<li class="icn_categories"><a href="registre_facture.php">Registre des Facutres</a></li>
		</ul>
		<?php } ?>
		
		<h3>Bon de Livraison</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="list_client_bl.php">Bon de livraison</a></li>
			<li class="icn_new_article"><a href="carnet_bl.php">Carnet de Bon</a></li>
		</ul>
		
		<?php if($_SESSION["user"]=="admin"){ ?>
		<h3>Devis</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="list_client_devis.php">Devis</a></li>
		</ul>
		<?php } ?>
		
		<?php if($_SESSION["user"]=="admin"){ ?>
		<h3>Sauvegardes</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="BackupCode/backup.php">Sauvegarder</a></li>
			<li class="icn_categories"><a href="list_sauvegarde.php">Liste des sauvegardes</a></li>
		</ul>
		<?php } ?>
		
		<?php if($_SESSION["user"]=="admin"){ ?>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="graphique_CA_loader.php">Graphique C.A</a></li>
			<li class="icn_security"><a href="ajouter_frs.php">Nouveau fournisseur</a></li>
			<li class="icn_security"><a href="list_frs.php">Fournisseurs</a></li>
			<li class="icn_jump_back"><a href="#logout.php">Deconnexion</a></li>
			
		</ul>
		<?php } ?>
		
		<?php if($_SESSION["user"]=="user"){ ?>
		
		<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		<?php } ?>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2014 Ilyas LAKSIRI</strong></p>
			<p><strong>Version 4.0 Update 2016</strong></p>
			<p>Use right : <a href="#"> TirageCentre </a> 
				
<?php
//-----------------------------------------------------//
// Compteur v1 //
// © Nicolas Picot //
// toophp@free.fr //
//-----------------------------------------------------//
$fp = fopen("template/compteur.txt","r+");
$nbvisites = fgets($fp,10);
if ($nbvisites=="") $nbvisites = 0;
$nbvisites++;
fseek($fp,0);
fputs($fp,$nbvisites);
fclose($fp);
echo "</br>Total Acc&egrave;s : $nbvisites";
?> 
			</p>
		</footer>
	</aside><!-- end of sidebar -->
	