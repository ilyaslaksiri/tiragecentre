

<?php
include_once("connex.inc.php");
$idcom=connex("tirage_centre_db", "myparam");

$requete = mysql_query("SELECT sum( `MONTANT_TTC` )  total, MOIS_FACTURE mois FROM `facture` 

where `ID_EXERCICE`='".$_SESSION["annee"]."'
and `ETAT_FACTURE` != 'ANNULEE'
GROUP BY `MOIS_FACTURE`");
$requete2 = mysql_query("SELECT sum( `MONTANT_TTC` ) total, MOIS_FACTURE mois FROM `facture` WHERE `ETAT_FACTURE` ='PAYE' 
and `ID_EXERCICE`='".$_SESSION["annee"]."' GROUP BY `MOIS_FACTURE`");


$mois=array();
$CA=array();
$PAYE=array();
$mois2 = array("Jan","Fév","Mar","Avr","Mai","Jui","Juil","Aou","Sep","Oct","Nov","Déc"); 

$i=0;
while($ligne = mysql_fetch_array($requete)){ 
if($ligne["mois"]!=NULL){
array_push($mois,$mois2[$ligne["mois"]-1]);
array_push($CA,$ligne["total"]);
$i++;
}
}
for($j=$i;$j<12;$j++)
{
array_push($mois,$mois2[$j]);
array_push($CA,0);
}

while($ligne2 = mysql_fetch_array($requete2)){ 
if($ligne2["mois"]!=NULL){
array_push($PAYE,$ligne2["total"]);

}

}

$pointeur=$CA;
array_push($pointeur,$CA);

$pointeur2=$PAYE;
array_push($pointeur2,$PAYE);
?>

<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_bar.php');

$data1y=$CA;
$data2y=$PAYE;

$size=30*14;

// Create the graph. These two calls are always required
$graph = new Graph(700,$size,'auto');
$graph->SetScale("textint");

//$graph->SetBackgroundImage("images/logo.jpg",BGIMG_FILLFRAME);

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->Set90AndMargin(0,0,-100,-150);
$graph->img->SetAngle(0); 

$graph->yaxis->SetTickPositions($pointeur);
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($mois);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($data1y);
$b2plot = new BarPlot($data2y);


// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot,$b2plot));
// ...and add it to the graPH
$graph->Add($gbplot);


$b1plot->SetColor("white");
$b1plot->SetFillColor("#007D1D");
$b1plot->SetLegend("Total");

$b2plot->SetColor("white");
$b2plot->SetFillColor("blue");
$b2plot->SetLegend("Payé");


//$graph->legend->SetFrameWeight(1);
//$graph->legend->SetColumns(2);
//$graph->legend->SetColor('#000000','#000000');

$graph->title->Set($_SESSION["annee"]);
// Display the graph


@unlink("./tmp/imagefile2.png"); 
$graph->Stroke("./tmp/imagefile2.png");

?>