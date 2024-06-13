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
        $this->Cell(30,30,utf8_decode('Attestation de congé'),0,1,'C');
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

// Récupération de l'identifiant de congé passé en GET
$id_conge = isset($_GET['id_conge']) ? $_GET['id_conge'] : null;

if($id_conge) {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root"; // Mettez votre nom d'utilisateur MySQL ici
    $password = ""; // Mettez votre mot de passe MySQL ici
    $dbname = "tirage_centre_db"; // Mettez le nom de votre base de données ici

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Requête pour récupérer les données du congé en fonction de l'identifiant passé en GET
    $sql_conge = "SELECT c.*, u.NOM_USER,u.CIVILITE_USER, u.PRENOM_USER FROM conges c INNER JOIN users u ON c.ID_USER = u.ID_USER WHERE c.ID_CONGE = $id_conge";
    $result_conge = $conn->query($sql_conge);
    
    if ($result_conge->num_rows > 0) {
        // Récupération des données du congé
        $row_conge = $result_conge->fetch_assoc();

        // Variables pour remplir les champs de l'attestation
        $civilite = $row_conge['CIVILITE_USER'];
        $nom = strtoupper($row_conge['NOM_USER']);
        $prenom = ucfirst(strtolower($row_conge['PRENOM_USER'])); // Convertit le prénom en minuscules puis met la première lettre en majuscule
        $employeeName = $nom .' '.$prenom;
        $date = date('d/m/Y', strtotime($row_conge['DATE_DEMANDE_CONGE']));
        $leaveStartDate = date('d/m/Y', strtotime($row_conge['DATE_DEBUT_CONGE']));
        $leaveEndDate = date('d/m/Y', strtotime($row_conge['DATE_FIN_CONGE']));

        // Contenu de l'attestation
        $content = "Meknès le $date\n\nObjet : Attestation de congé.\n\n";

        $content .= "Par la présente, nous attestons que ";

        if ($civilite == 'Monsieur') {
            $content .= "M. $employeeName, employé chez Tirage Centre SARL, sera en congé du $leaveStartDate au $leaveEndDate inclus.\n\n";
        } elseif ($civilite == 'Madame') {
            $content .= "Mme. $employeeName, employée chez Tirage Centre SARL, sera en congé du $leaveStartDate au $leaveEndDate inclus.\n\n";
        } elseif ($civilite == 'Mademoiselle') {
            $content .= "Mme. $employeeName, employée chez Tirage Centre SARL, sera en congé du $leaveStartDate au $leaveEndDate inclus.\n\n";
        } else {
            // Gestion du cas où la civilité n'est pas définie ou n'est pas gérée
            $content .= "$employeeName, employé(e) chez Tirage Centre SARL, sera en congé du $leaveStartDate au $leaveEndDate inclus.\n\n";
        }

        $content .= "Ce document est délivré à l'intéressé pour valoir ce que de droit.\n\n\n\n\n\n\n";

        $content .= "Signature :\n\n\n\n";

        // Affichage du contenu
        $pdf->SetLeftMargin(20);
        $pdf->SetRightMargin(20);
        $pdf->MultiCell(0,7,utf8_decode($content)); // Ajustement de la hauteur de cellule pour réduire les sauts de ligne
    } else {
        echo "Aucun congé trouvé avec l'identifiant spécifié.";
    }

    // Fermeture de la connexion
    $conn->close();
} else {
    echo "L'identifiant de congé n'est pas spécifié.";
}

// Génération du PDF
$pdf->Output();
?>
