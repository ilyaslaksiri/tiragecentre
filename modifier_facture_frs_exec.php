<?php include "template/header.php";?>
<?php include "template/left.php";?>


<section id="main" class="column">
<div align="center">
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
Modification en cours...</br>
<img src="images/loading2.gif"></img>

</div>

</section>

<?php       function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}
?>

<?php
if(!empty($_POST['num_facture_frs']))

{
include_once("connex.inc.php");
	$idcom=connex("tirage_centre_db", "myparam");
	
	$id_facture_frs =  $_POST["id_facture_frs"];
	$num_facture_frs= addslashes(strtoupper($_POST['num_facture_frs']));
	
	$date_facture_frs= addslashes(ucfirst($_POST['date_facture_frs']));
	
	$etat_facture_frs=addslashes($_POST['etat_facture_frs']);
	
	$montant_ttc_frs= addslashes($_POST['montant_ttc_frs']);
	$montant_ht_frs = addslashes($_POST['montant_ht_frs']);
	$tva_frs = addslashes($_POST['tva_frs']);
	
	$mois_facture_frs=explode ("/",$date_facture_frs);
	$id_frs=$_POST['id_frs'];
	$annee_facture=explode ("/",$date_facture_frs);
	
	$date_payement_frs=addslashes($_POST['date_payement_frs']);
	
	$mode_payement_frs=addslashes($_POST['mode_payement_frs']);
	
	
	

$requete="update facture_frs set 
						NUM_FACTURE_FRS='$num_facture_frs',
						DATE_FACTURE_FRS='$date_facture_frs', 
						MOIS_FACTURE_FRS='$mois_facture_frs[1]',
						MONTANT_TTC_FRS='$montant_ttc_frs',
						MONTANT_HT_FRS='$montant_ht_frs',
						TVA_FRS='$tva_frs',
						ETAT_FACTURE_FRS='$etat_facture_frs',
						DATE_PAYEMENT_FRS='$date_payement_frs',
						MODE_PAYEMENT_FRS='$mode_payement_frs',
						ID_EXERCICE='$annee_facture[2]'
						
					where ID_FACTURE_FRS='$id_facture_frs'";
		$result=@mysql_query($requete, $idcom);
		redirige("list_facture_frs.php?id_frs=".$id_frs);


		
		
		}
	
	
	
	

	
	
?>