<?php include "template/header.php";?>
<?php include "template/left.php";?>

<?php function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>
<section id="main" class="column">
<div align="center">
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
Ajout Facture fournisseur en cours...</br>
<img src="images/loading2.gif"></img>

</div>

</section>



<?php
if(!empty($_POST['num_facture_frs']))

{
	include_once("connex.inc.php");
	$idcom=connex("tirage_centre_db", "myparam");
	
	
	$num_facture_frs= addslashes(strtoupper($_POST['num_facture_frs']));
	
	$date_facture_frs= addslashes(ucfirst($_POST['date_facture_frs']));
	
	$etat_facture_frs=addslashes($_POST['etat_facture_frs']);
	
	$montant_ttc_frs= addslashes(strtolower($_POST['montant_ttc_frs']));
	$montant_ht_frs = addslashes(strtolower($_POST['montant_ht_frs']));
	$tva_frs = addslashes(strtolower($_POST['tva_frs']));
	
	$mois_facture_frs=explode ("/",$date_facture_frs);
	$id_frs=$_POST['id_frs'];
	$annee_facture=explode ("/",$date_facture_frs);
	
	$date_payement_frs=addslashes($_POST['date_payement_frs']);
	
	$mode_payement_frs=addslashes($_POST['mode_payement_frs']);
	
	$requete="
	insert into facture_frs 
	(`NUM_FACTURE_FRS`,`ID_FRS`, `DATE_FACTURE_FRS`,`MOIS_FACTURE_FRS`, `MONTANT_TTC_FRS`,`MONTANT_HT_FRS`,`TVA_FRS`,`ETAT_FACTURE_FRS`,`DATE_PAYEMENT_FRS`,`MODE_PAYEMENT_FRS`,`ID_EXERCICE`) 
			
	values('$num_facture_frs','$id_frs','$date_facture_frs','$mois_facture_frs[1]','$montant_ttc_frs','$montant_ht_frs','$tva_frs','$etat_facture_frs','$date_payement_frs','$mode_payement_frs','$annee_facture[2]')";
	
	$result = @mysql_query($requete, $idcom);
	

		redirige("list_facture_frs.php?id_frs=".$id_frs);

		
		
		}
	



?>