<?php
require('fpdf.php');

class PDF extends FPDF
{
    // En-tête
    function Header()
    {
        // Logo
        $this->Image('images/Entete.png', 10, 10, 190); // Ajustement de la position et de la taille du logo
        $this->SetFont('Arial', 'B', 15);
        $this->Ln(40); // Déplacer de 4 cm vers le bas pour laisser de la place au logo
        $this->Cell(0, 10, utf8_decode('Demande de congé'), 0, 1, 'C');
        $this->Ln(10);
    }

    // Pied de page
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Récupération de l'identifiant de congé passé en GET
$id_conge = isset($_GET['id_conge']) ? $_GET['id_conge'] : null;

if ($id_conge) {
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "tirage_centre_db"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    $sql_conge = "SELECT c.*, u.NOM_USER, u.CIVILITE_USER, u.PRENOM_USER FROM conges c INNER JOIN users u ON c.ID_USER = u.ID_USER WHERE c.ID_CONGE = $id_conge";
    $result_conge = $conn->query($sql_conge);
    
    if ($result_conge->num_rows > 0) {
        $row_conge = $result_conge->fetch_assoc();

        $civilite = $row_conge['CIVILITE_USER'];
        $nom = strtoupper($row_conge['NOM_USER']);
        $prenom = ucfirst(strtolower($row_conge['PRENOM_USER']));
        $employeeName = $nom . ' ' . $prenom;
        $dateDebutConge = date('d/m/Y', strtotime($row_conge['DATE_DEBUT_CONGE']));
        $dateFinConge = date('d/m/Y', strtotime($row_conge['DATE_FIN_CONGE']));
        $dateRetourTravail = "TBD";

        $pdf->SetLeftMargin(20);
        $pdf->SetRightMargin(20);

        
        $pdf->Ln(5);
        $pdf->Cell(0, 10, utf8_decode('Demandeur : ') . utf8_decode($employeeName), 0, 1);
        $pdf->Ln(5);

        $pdf->Cell(0, 10, utf8_decode('Type de congé : '), 0, 1);
        $pdf->Cell(10);
        $pdf->Cell(0, 10, utf8_decode('[  ] Congé payé'), 0, 1);
        $pdf->Cell(10);
        $pdf->Cell(0, 10, utf8_decode('[  ] Congé maladie'), 0, 1);
        $pdf->Cell(10);
        $pdf->Cell(0, 10, utf8_decode('[  ] Congé sans solde'), 0, 1);
        $pdf->Cell(10);
        $pdf->Cell(0, 10, utf8_decode('[  ] Congé maternité/paternité'), 0, 1);
        $pdf->Cell(10);
        $pdf->Cell(0, 10, utf8_decode('[  ] Autre (préciser) : _______________________________'), 0, 1);
        $pdf->Ln(5);

        $pdf->Cell(0, 10, utf8_decode('Date de début : ') . $dateDebutConge .' (inclu)', 0, 1);
        $pdf->Ln(2);
        $pdf->Cell(0, 10, utf8_decode('Date de fin : ') . $dateFinConge.' (inclu)', 0, 1);
        $pdf->Ln(2);
        

        $pdf->Cell(0, 10, utf8_decode('Signature de l\'employé : _________________________________   Date : ________________'), 0, 1);
        $pdf->Ln(5);
        $pdf->Cell(0, 10, utf8_decode('Approbation de l\'entreprise : _______________________   Date : ________________'), 0, 1);
    } else {
        echo utf8_decode("Aucun congé trouvé avec l'identifiant spécifié.");
    }

    $conn->close();
} else {
    echo utf8_decode("L'identifiant de congé n'est pas spécifié.");
}

$pdf->Output();
?>
