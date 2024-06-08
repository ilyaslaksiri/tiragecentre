<?php
// Informations de connexion à la base de données
$host = 'localhost';
$database = 'tirage_centre_db';
$username = 'root';
$password = '';

// Chemin absolu vers le dossier de sauvegarde
$backupDir = 'D:/Program Files (x86)/EasyPHP-5.3.6.0/www/TirageCentre.old/Backup_database/Back 2024';

// Format du nom de fichier de sauvegarde
$backupFile = 'backup_database_' . date('Y-m-d') . '.sql';

// Commande de sauvegarde
$command = "mysqldump --host={$host} --user={$username} --password={$password} {$database} > {$backupDir}/{$backupFile}";

// Exécution de la commande
exec($command, $output, $result);

// Vérifier si la sauvegarde a réussi
if ($result === 0) {
    echo 'Sauvegarde réussie : ' . $backupFile;
} else {
    echo 'Erreur lors de la sauvegarde : ' . implode("\n", $output);
}
?>
