

<?php      
	
	function redirige($url)
  	{ die('<meta http-equiv="refresh" content="0;URL='.$url.'">');}

	$id_bc=$_GET['id_bc'];
	
?>

<?php

	include_once("connex.inc.php");
	$idcom=connex("tirage_centre_db", "myparam");
	
	
	//redirige("ajouter_bc.php?id_fournisseur=$id_fournisseur");
	

?>

<?php 

$requete1="select * from BC where ID_BC='$id_bc'";
$result1= @mysql_query($requete1, $idcom);
$ligne1=mysql_fetch_array($result1);

$id_fournisseur=$ligne1['ID_FRS'];
$num_bc=$ligne1['NUM_BC'];
$date_bc=$ligne1['DATE_BC'];
$total_ttc=$ligne1['MONTANT_TTC'];
$total_ht=$ligne1['MONTANT_HT'];
$tva=$ligne1['TVA'];
$somme=$ligne1['MONTANT_LETTRE'];




$requete2="select * from fournisseur where ID_FRS='$id_fournisseur'";
$result2= @mysql_query($requete2, $idcom);
$ligne2=mysql_fetch_array($result2);

$nom_fournisseur=$ligne2['NOM_FRS'];

require('invoice_bc.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();

/*$pdf->addSociete( "Tirage Centre S.A.R.L",
                  "Tel : 06.61.40.06.97 \n" .
                  "Fix : 05.37.68.03.81\n".
				   "E-mail : tirage.centre@gmail.com " );*/
				   
				   
$pdf->fact_dev( "Bon de commande  ", $num_bc );

//$pdf->temporaire( "Devis temporaire" );
$pdf->addDate( $date_bc);
//$pdf->addClient("Ihsane laksiri");
//$pdf->addPageNumber("1");
//$pdf->addClientAdresse("33 Res yassine apt 3 Av des FAR Meknes VN");
//$pdf->addReglement("Chèque à réception de bc");
//$pdf->addEcheance("03/12/2003");
//$pdf->addNumTVA("FR888777666");

$pdf->Image('images/entete.png',0,0,210);
//$pdf->Image('images/pied.png',62,270,90); 

$pdf->addReference($nom_fournisseur);
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

//------------------- debut ligne bc ------------------------------



$requete3 = mysql_query("select * from ligne_bc where ID_BC='$id_bc'");

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






$pdf->addRemarque($somme);


$pdf->addTVAs( $total_ht, $tva, $total_ttc);
//$pdf->addTVAs( $totalht, $tva, $total_cmd);
$pdf->addCadreEurosFrancs();
$pdf->Output();

?>
