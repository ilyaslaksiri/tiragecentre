<?php
require('fpdf.php');

class PDF extends FPDF
{
    // En-tête
    function Header()
    {
        // Logo
        $this->Image('images/Entete.png', 0, 0, 210, 297);
        // Police Arial gras 15
        $this->SetFont('Arial','B',25);
        // Décalage à droite
		$this->Ln(50); // Déplacer de 3 cm vers le bas
        $this->Cell(80);
        // Titre
		
        $this->Cell(30,30,'Attestation de congé',0,1,'C');
        // Saut de ligne
        $this->Ln(10); // Réduction de la taille du saut de ligne
		

    }

    // Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

// Variables pour les informations
$companyName = 'Tirage Centre SARL';
$companyAddress = 'Adresse de l\'Entreprise';
$companyPhone = 'Téléphone';
$companyEmail = 'Email';
$companyWebsite = 'Site Web';
$employeeName = 'Ilyas LAKSIRI';
$employeeGender = 'M.';
$employeeAddress = 'Adresse de l\'Employé';
$employeeCity = 'Ville, Code Postal';
$date = date('d/m/Y');
$position = 'Titre du Poste';

$leaveStartDate = '01/01/2024';
$leaveEndDate = '15/01/2024';
$returnDate = '16/01/2024';

// Contenu de l'attestation
$content = "Meknès le $date\n\nObjet : Attestation de congé\n\n";

$content .= "Par la présente, nous attestons que ";
if ($employeeGender == 'M.') {
    $content .= "$employeeGender $employeeName, employé chez $companyName, sera en congé du $leaveStartDate au $leaveEndDate inclus.\n\n";
} elseif ($employeeGender == 'Mlle.' | $employeeGender == 'Mme.') {
    $content .= "$employeeGender $employeeName, employée de notre entreprise $companyName, sera en congé du $leaveStartDate au $leaveEndDate inclus.\n\n";
}

$content .= " Ce congé a été dûment autorisé par l'entreprise. La date de reprise est prévue le $returnDate.\n\n";


$content .= "Signature :\n\n\n\n";

// Affichage du contenu
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
$pdf->MultiCell(0,7,$content); // Ajustement de la hauteur de cellule pour réduire les sauts de ligne

// Génération du PDF
$pdf->Output();
?>
