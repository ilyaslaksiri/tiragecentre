<?php
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

if( isset($_GET['annee']))
$annee=$_GET['annee'];
else 
$annee="";

if( isset($_GET['num_facture']))
$num_facture=$_GET['num_facture'];
else 
$num_facture="";

if( isset($_GET['client']))
$client=$_GET['client'];
else 
$client="";

if( isset($_GET['mois_facture']))
$mois_facture=$_GET['mois_facture'];
else 
$mois_facture="";

if( isset($_GET['etat_facture']))
$etat_facture=$_GET['etat_facture'];
else 
$etat_facture="";



$sql="select * from FACTURE f,client c where f.ID_CLIENT=c.ID_CLIENT"." and `ID_EXERCICE`=".$annee."";
if($num_facture!="")
	$sql=$sql." and `NUM_FACTURE` like '$num_facture'"; 
if($client!="")
	$sql=$sql." and `NOM_CLIENT` like '$client'"; 
if($mois_facture!="")
	$sql=$sql." and `MOIS_FACTURE` like '%$mois_facture%'"; 

if($etat_facture!="")
	$sql=$sql." and `ETAT_FACTURE` like '%$etat_facture%'"; 

$requete2 = mysql_query($sql);




$excel = "";
$excel .=  "NumFacture\tClient\tDateFacture\t TotalTTC\t Etat \t ModeReglement \t DateReglement \n";

while ($row = mysql_fetch_array($requete2)) {
    $excel .= "'$row[NUM_FACTURE]'\t$row[NOM_CLIENT]\t$row[DATE_FACTURE]\t$row[MONTANT_TTC]\t$row[ETAT_FACTURE]\t$row[MODE_PAYEMENT]\t$row[DATE_PAYEMENT]\n";
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=liste-clients.xls");

print $excel;
exit;

?>