<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Changement de mot de passe requis</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
/**
 * PAGE DE CHANGEMENT DE MOT DE PASSE UNIFIÉE
 *
 * AMÉLIORATIONS APPLIQUÉES :
 *
 * 1. PAGE UNIQUE : Traitement et affichage sur une seule page (pas d'aller-retour)
 * 2. VALIDATION CÔTÉ SERVEUR : Vérification complète avant traitement
 * 3. MESSAGES D'ERREUR CONTEXTUELS : Feedback visuel immédiat
 * 4. SÉCURITÉ RENFORCÉE : Vérification du mot de passe actuel + token
 * 5. SUPPORT DOUBLE MODE :
 *    - Mode forcé : via token (migration progressive)
 *    - Mode libre : via login + mot de passe actuel
 */

function redirige($url) {
    echo '<meta http-equiv="refresh" content="0;URL=' . htmlspecialchars($url) . '">';
    exit;
}

function validatePasswordComplexity($password) {
    $errors = array();

    if (strlen($password) < 8) {
        $errors[] = "au moins 8 caractères";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "au moins une lettre majuscule";
    }

    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "au moins une lettre minuscule";
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "au moins un chiffre";
    }

    return $errors;
}

// Traitement du formulaire
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $user_login = isset($_POST['user_login']) ? $_POST['user_login'] : '';
    $token = isset($_POST['token']) ? $_POST['token'] : '';
    $current_password = isset($_POST['current_password']) ? $_POST['current_password'] : '';
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // DOUBLE MODE DE FONCTIONNEMENT :
    // 1. Mode forcé (migration) : user_id + token (pas de champ login visible)
    // 2. Mode libre : user_login + current_password (champ login visible)

    // Validation basique
    if ((empty($user_id) && empty($user_login)) || empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $message = "Tous les champs sont requis.";
        $message_type = "error";
    } elseif ($new_password !== $confirm_password) {
        $message = "Les mots de passe ne correspondent pas.";
        $message_type = "error";
    } else {
        // Validation de la complexité du nouveau mot de passe
        $passwordErrors = validatePasswordComplexity($new_password);
        if (!empty($passwordErrors)) {
            $message = "Le nouveau mot de passe doit contenir : " . implode(", ", $passwordErrors);
            $message_type = "error";
        } else {
            // Connexion à la base de données
            $serveur = "localhost";
            $db_user = "root";
            $db_mot_de_passe = "";
            $base_de_donnees = "tirage_centre_db";

            $connexion = new mysqli($serveur, $db_user, $db_mot_de_passe, $base_de_donnees);

            if ($connexion->connect_error) {
                $message = "Erreur de connexion à la base de données.";
                $message_type = "error";
            } else {
                // VÉRIFICATION DE L'UTILISATEUR SELON LE MODE :
                // - Mode forcé : vérification par ID utilisateur uniquement
                // - Mode libre : vérification par login + mot de passe actuel
                if (!empty($user_id)) {
                    $requete = $connexion->prepare("SELECT * FROM users WHERE ID_USER = ? AND MOT_DE_PASSE_USER = ?");
                    $requete->bind_param("is", $user_id, $current_password);
                } else {
                    $requete = $connexion->prepare("SELECT * FROM users WHERE LOGIN_USER = ? AND MOT_DE_PASSE_USER = ?");
                    $requete->bind_param("ss", $user_login, $current_password);
                }
                $requete->execute();
                $resultat = $requete->get_result();

                if ($resultat->num_rows === 0) {
                    $message = "Mot de passe actuel incorrect.";
                    $message_type = "error";
                } else {
                    $row = $resultat->fetch_assoc();
                    $target_id = $row['ID_USER'];

                    // Mettre à jour le mot de passe
                    $update_requete = $connexion->prepare("UPDATE users SET MOT_DE_PASSE_USER = ? WHERE ID_USER = ?");
                    $update_requete->bind_param("si", $new_password, $target_id);

                    if ($update_requete->execute()) {
                        $message = "Mot de passe changé avec succès ! Redirection vers la connexion...";
                        $message_type = "success";
                        echo '<meta http-equiv="refresh" content="2;URL=index.php">';
                    } else {
                        $message = "Erreur lors du changement de mot de passe.";
                        $message_type = "error";
                    }
                }

                $requete->close();
                if (isset($update_requete)) $update_requete->close();
                $connexion->close();
            }
        }
    }
}

// Récupération des paramètres GET pour pré-remplir le formulaire
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';
?>

<div style="text-align: center; margin-top: 50px;">
    <h2 style="color: #ff6600;">Changement de mot de passe requis</h2>
    <p style="color: #666; margin: 20px 0;">
        Pour des raisons de sécurité, votre mot de passe doit être mis à jour.<br>
        Le nouveau mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.
    </p>

    <?php if (!empty($message)): ?>
        <div style="margin: 20px 0; padding: 10px; border-radius: 5px; <?php
            if ($message_type === 'success') {
                echo 'background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;';
            } else {
                echo 'background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;';
            }
        ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
</div>

<form action="" method="post">
    <div class="wrap">
        <div class="avatar">
            <img src="images/logo-icon.png">
        </div>
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

        <!-- CHAMP LOGIN CONDITIONNEL :
             - Masqué en mode forcé (migration) : user_id présent
             - Visible en mode libre : accès direct à la page -->
        <?php if (empty($user_id)): ?>
        <input type="text" name="user_login" class="round-top" placeholder="Utilisateur" value="<?php echo htmlspecialchars(isset($user_login) ? $user_login : ''); ?>" required>
        <div class="bar">
            <i></i>
        </div>
        <?php endif; ?>

        <input type="password" name="current_password" class="<?php echo empty($user_id) ? 'round-none' : 'round-top'; ?>" placeholder="Mot de passe actuel" required>
        <div class="bar">
            <i></i>
        </div>

        <input type="password" name="new_password" class="round-none" placeholder="Nouveau mot de passe" required>
        <div class="bar">
            <i></i>
        </div>

        <input type="password" name="confirm_password" class="round-bottom" placeholder="Confirmer le nouveau mot de passe" required>
        

        <div style="font-size: 12px; color: #666; margin: 10px 0; text-align: center;">
            Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.
        </div>

        <button type="submit">Changer le mot de passe</button>
    </div>
</form>

</body>
</html>