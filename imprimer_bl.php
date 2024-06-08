

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

require('invoice_bl.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();

/*$pdf->addSociete( "Tirage Centre S.A.R.L",
                  "Tel : 06.61.40.06.97 \n" .
                  "Fix : 05.37.68.03.81\n".
				   "E-mail : tirage.centre@gmail.com " );*/
				   
				   
$pdf->fact_dev( "Bon de livraison  ", $num_bl );

//$pdf->temporaire( "Devis temporaire" );
$pdf->addDate( $date_bl);
//$pdf->addClient("Ihsane laksiri");
//$pdf->addPageNumber("1");
//$pdf->addClientAdresse("33 Res yassine apt 3 Av des FAR Meknes VN");
//$pdf->addReglement("Chèque à réception de bl");
//$pdf->addEcheance("03/12/2003");
//$pdf->addNumTVA("FR888777666");

$pdf->Image('images/entete.png',0,0,210);
//$pdf->Image('images/pied.png',62,270,90); 

$pdf->addReference($nom_client);
$cols=array( //"REFERENCE"    => 23,
             "QUANTITE"     => 20,
			 "DESIGNATION"  => 110,
             "Prix HT"      => 25,
             "Total HT" 	=> 35);
			
$pdf->addCols( $cols);
$cols=array( //"REFERENCE"    => "L",
			 //"REF"     => "C",
			"QUANTITE"      => "R",
			"DESIGNATION"  => "L",
			"Prix HT" => "R",
            "Total HT"=> "R" );

$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

$y    = 79;

//------------------- debut ligne bl ------------------------------

$total_bl=0;

$requete3 = mysql_query("select * from ligne_bl where ID_BL='$id_bl'");

while($ligne3 = mysql_fetch_array($requete3)) {
		
		$designation="".$ligne3['DESIGNATION_LIGNE_BL']." (".$ligne3['LONGEUR']." x ".$ligne3['LARGEUR']." fois ".$ligne3['NOMBRE'].")";
		$qte=$ligne3['LONGEUR']*$ligne3['NOMBRE']*$ligne3['LARGEUR'];
//ligne Calculable		
if($ligne3['LONGEUR']!=0 && $ligne3['LARGEUR'] ){
$line = array( 
               //"REF"     => $ligne3['REF_PRODUIT'],
			   "QUANTITE"      => sprintf("%.02f", $ligne3['LONGEUR']*$ligne3['NOMBRE']*$ligne3['LARGEUR']),
               "DESIGNATION"  => " ".utf8_decode($designation),
			    
			   "Prix HT" => sprintf("%.02f", $ligne3['PRIX_HT']),
			   "Total HT" => sprintf("%.02f", $qte*$ligne3['PRIX_HT'])
               );
			   $total_bl+=$qte*$ligne3['PRIX_HT'];
			   }
//Ligne Titre
  else{
$line = array( 
               //"REF"     => $ligne3['REF_PRODUIT'],
			   "QUANTITE"      => " ",
               "DESIGNATION"  => " ".utf8_decode($designation),
			    
			   "Prix HT" => " ",
			   "Total HT" => " "
               );
}
			   
			   
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
}






//$pdf->addRemarque("somme");
$total_ht=$total_bl;
$tva=0;
$total_ttc=0;

$pdf->addTVAs( $total_ht, $tva, $total_ttc);
//$pdf->addTVAs( $totalht, $tva, $total_cmd);
$pdf->addCadreEurosFrancs();
$pdf->Output();

?>
