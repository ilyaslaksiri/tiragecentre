

<?php      
	
	function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}

	$id_bl=$_GET['id_bl'];
	
?>

<?php

	include_once("connex.inc.php");
	$idcom=connex("tirage_centre_db", "myparam");
	
	
	//redirige("ajouter_bl.php?id_fournisseur=$id_fournisseur");
	

?>

<?php 

$requete1="select * from BL where ID_BL='$id_bl'";
$result1= @mysql_query($requete1, $idcom);
$ligne1=mysql_fetch_array($result1);

$id_client=$ligne1['ID_CLIENT'];
$num_bl=$ligne1['NUM_BL'];
$date_bl=$ligne1['DATE_BL'];





$requete2="select * from client where ID_CLIENT='$id_client'";
$result2= @mysql_query($requete2, $idcom);
$ligne2=mysql_fetch_array($result2);

$nom_client=$ligne2['NOM_CLIENT'];

require('invoice_attestation.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();

/*$pdf->addSociete( "Tirage Centre S.A.R.L",
                  "Tel : 06.61.40.06.97 \n" .
                  "Fix : 05.37.68.03.81\n".
				   "E-mail : tirage.centre@gmail.com " );*/
				   
				   
//$pdf->fact_dev( "Bon de livraison  ", $num_bl );

//$pdf->temporaire( "Devis temporaire" );
//$pdf->addDate( $date_bl);
//$pdf->addClient("Ihsane laksiri");
//$pdf->addPageNumber("1");
//$pdf->addClientAdresse("33 Res yassine apt 3 Av des FAR Meknes VN");
//$pdf->addReglement("Chèque à réception de bl");
//$pdf->addEcheance("03/12/2003");
//$pdf->addNumTVA("FR888777666");

$pdf->Image('images/entete.png',0,0,210);
//$pdf->Image('images/pied.png',62,270,90); 

$pdf->addReference($nom_client);

$body="Nous soussignée Sté. TIRAGE CENTRE, affiliée à la C.N.S.S sous le numéro  8436223  dont le siège social Imm 7 Res Zoubida Bureau N°2 Avenue des FAR- Meknès VN.";

$pdf->addBody($body);


$y    = 79;






$pdf->Output();

?>
