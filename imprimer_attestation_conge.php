<?php
require('fpdf.php');

class PDF extends FPDF
{
    // En-t�te
    function Header()
    {
        // Logo
        $this->Image('images/Entete.png', 0, 0, 210, 297);
        // Police Arial gras 15
        $this->SetFont('Arial','B',25);
        // D�calage � droite
		$this->Ln(50); // D�placer de 3 cm vers le bas
        $this->Cell(80);
        // Titre
		
        $this->Cell(30,30,'Attestation de cong�',0,1,'C');
        // Saut de ligne
        $this->Ln(10); // R�duction de la taille du saut de ligne
		

    }

    // Pied de page
    function Footer()
    {
        // Positionnement � 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Num�ro de page
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation de la classe d�riv�e
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

// Variables pour les informations
$companyName = 'Tirage Centre SARL';
$companyAddress = 'Adresse de l\'Entreprise';
$companyPhone = 'T�l�phone';
$companyEmail = 'Email';
$companyWebsite = 'Site Web';
$employeeName = 'Ilyas LAKSIRI';
$employeeGender = 'M.';
$employeeAddress = 'Adresse de l\'Employ�';
$employeeCity = 'Ville, Code Postal';
$date = date('d/m/Y');
$position = 'Titre du Poste';

$leaveStartDate = '01/01/2024';
$leaveEndDate = '15/01/2024';
$returnDate = '16/01/2024';

// Contenu de l'attestation
$content = "Mekn�s le $date\n\nObjet : Attestation de cong�\n\n";

$content .= "Par la pr�sente, nous attestons que ";
if ($employeeGender == 'M.') {
    $content .= "$employeeGender $employeeName, employ� chez $companyName, sera en cong� du $leaveStartDate au $leaveEndDate inclus.\n\n";
} elseif ($employeeGender == 'Mlle.' | $employeeGender == 'Mme.') {
    $content .= "$employeeGender $employeeName, employ�e de notre entreprise $companyName, sera en cong� du $leaveStartDate au $leaveEndDate inclus.\n\n";
}

$content .= " Ce cong� a �t� d�ment autoris� par l'entreprise. La date de reprise est pr�vue le $returnDate.\n\n";


$content .= "Signature :\n\n\n\n";

// Affichage du contenu
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
$pdf->MultiCell(0,7,$content); // Ajustement de la hauteur de cellule pour r�duire les sauts de ligne

// G�n�ration du PDF
$pdf->Output();
?>
