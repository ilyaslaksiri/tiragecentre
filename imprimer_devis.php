

<?php      
	
	function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}

	$id_devis=$_GET['id_devis'];
	
?>

<?php

	include_once("connex.inc.php");
	$idcom=connex("tirage_centre_db", "myparam");
	
	
	//redirige("ajouter_devis.php?id_client=$id_client");
	

?>

<?php 

$requete1="select * from DEVIS where ID_DEVIS='$id_devis'";
$result1= @mysql_query($requete1, $idcom);
$ligne1=mysql_fetch_array($result1);

$id_client=$ligne1['ID_CLIENT'];
$num_devis=$ligne1['NUM_DEVIS'];
$date_devis=$ligne1['DATE_DEVIS'];
$total_ttc=$ligne1['MONTANT_TTC'];
$total_ht=$ligne1['MONTANT_HT'];
$tva=$ligne1['TVA'];
$somme=$ligne1['MONTANT_LETTRE'];




$requete2="select * from client where ID_CLIENT='$id_client'";
$result2= @mysql_query($requete2, $idcom);
$ligne2=mysql_fetch_array($result2);

$nom_client=$ligne2['NOM_CLIENT'];

require('invoice_devis.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();

/*$pdf->addSociete( "Tirage Centre S.A.R.L",
                  "Tel : 06.61.40.06.97 \n" .
                  "Fix : 05.37.68.03.81\n".
				   "E-mail : tirage.centre@gmail.com " );*/
				   
				   
$pdf->fact_dev( "Devis  ", $num_devis );

//$pdf->temporaire( "Devis temporaire" );
$pdf->addDate( $date_devis);
//$pdf->addClient("Ihsane laksiri");
//$pdf->addPageNumber("1");
//$pdf->addClientAdresse("33 Res yassine apt 3 Av des FAR Meknes VN");
//$pdf->addReglement("Chèque à réception de devis");
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

//------------------- debut ligne devis ------------------------------



$requete3 = mysql_query("select * from ligne_devis where ID_DEVIS='$id_devis'");

while($ligne3 = mysql_fetch_array($requete3)) {
		
		$designation=$ligne3['DESIGNATION'];

//ligne Calculable		
if($ligne3['QTE']!=0 && $ligne3['PRIX_HT'] ){
$line = array( 
               //"REF"     => $ligne3['REF_PRODUIT'],
			   "QUANTITE"      => sprintf("%.02f", $ligne3['QTE']),
               "DESIGNATION"  => " ".utf8_decode($designation),
			    
			   "Prix HT" => sprintf("%.02f", $ligne3['PRIX_HT']),
			   "Total HT" => sprintf("%.02f", $ligne3['PRIX_HT']*$ligne3['QTE'])
               );
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




//-------------------- fin ligne devis


//$pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte



$pdf->addRemarque($somme);


$pdf->addTVAs( $total_ht, $tva, $total_ttc);
//$pdf->addTVAs( $totalht, $tva, $total_cmd);
$pdf->addCadreEurosFrancs();
$pdf->Output();

?>
