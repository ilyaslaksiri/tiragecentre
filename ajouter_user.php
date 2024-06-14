<?php 

include "template/header.php";
include "template/left.php";

function redirige($url) {
    die('<meta http-equiv="refresh" content="0;URL='.$url.'">');
}
?>

<script type="text/javascript">
    function format(obj){
        var str=obj.value.replace(/-|\./g,'')
        switch(true){
            case (str.length<10) : break;
            case (str.length==10):
                tel=str.replace(/^(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/,"$1-$2.$3.$4.$5")
                obj.value=tel
                break;
            case (str.length>10) :
                obj.value=str.substr(0,9).replace(/^(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/,"$1-$2.$3.$4.$5")
        }
    }
</script>

<?php
// Vos paramètres de connexion à la base de données
$serveur = "localhost";
$user = "root";
$mot_de_passe = "";
$base_de_donnees = "tirage_centre_db";

// Se connecter à la base de données
$connexion = mysqli_connect($serveur, $user, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if (!$connexion) {
    die("La connexion à la base de données a échoué: " . mysqli_connect_error());
}

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;
$nom_user = $prenom_user = $login_user = $mot_de_passe_user = $email_user = $access_level_user = "";

if ($id_user) {
    $requete = "SELECT * FROM users WHERE ID_USER = $id_user";
    $resultat = mysqli_query($connexion, $requete);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        $row = mysqli_fetch_assoc($resultat);
        $civilite = $row['CIVILITE_USER'];
        $nom_user = $row['NOM_USER'];
        $prenom_user = $row['PRENOM_USER'];
        $login_user = $row['LOGIN_USER'];
        $mot_de_passe_user = $row['MOT_DE_PASSE_USER'];
        $email_user = $row['EMAIL_USER'];
        $access_level_user = $row['ACCESS_LEVEL_USER'];
    }
}
?>

<section id="main" class="column">
    <h4 class="titre_info"><?php echo $id_user ? 'Modifier' : 'Ajouter'; ?> utilisateur</h4><br/><br/>
    <fieldset>
        <form action="" method="post">
            <table width="90%">
                <tr>
                    <td align="right">Civilité <span style="color:#FF0000">*</span>&nbsp;:</td>
                    <td>
                        <input type="radio" name="civilite" value="Monsieur" <?php echo (isset($civilite) && $civilite == 'Monsieur') ? 'checked' : ''; ?>> Monsieur
                        <input type="radio" name="civilite" value="Madame" <?php echo (isset($civilite) && $civilite == 'Madame') ? 'checked' : ''; ?>> Madame
                        <input type="radio" name="civilite" value="Mademoiselle" <?php echo (isset($civilite) && $civilite == 'Mademoiselle') ? 'checked' : ''; ?>> Mademoiselle
                    </td>
                </tr>
                <tr>
                    <td align="right">Nom <span style="color:#FF0000">(*)</span>&nbsp;:</td>
                    <td><input type="text" name="nom_user" value="<?php echo $nom_user; ?>" id="zone_input" class="required"/></td>
                </tr>
                <tr>
                    <td align="right">Prénom <span style="color:#FF0000">(*)</span>&nbsp;:</td>
                    <td><input type="text" name="prenom_user" value="<?php echo $prenom_user; ?>" id="zone_input" class="required"/></td>
                </tr>
                <tr>
                    <td align="right">Login <span style="color:#FF0000">(*)</span>&nbsp;:</td>
                    <td><input type="text" name="login_user" value="<?php echo $login_user; ?>" id="zone_input" class="required"/></td>
                </tr>
                <tr>
                    <td align="right">Mot de passe <span style="color:#FF0000">(*)</span>&nbsp;:</td>
                    <td><input type="password" name="mot_de_passe_user" value="<?php echo $mot_de_passe_user; ?>" id="zone_input" class="required"/></td>
                </tr>
                <tr>
                    <td align="right">Adresse e-mail&nbsp;:</td>
                    <td><input type="text" name="email_user" value="<?php echo $email_user; ?>"/></td>
                </tr>
                <tr>
                    <td align="right">Niveau d'accès <span style="color:#FF0000">(*)</span>&nbsp;:</td>
                    <td>
                        <input type="radio" name="access_level_user_main" value="admin" <?php echo in_array('admin', explode(',', $access_level_user)) ? 'checked' : ''; ?>> Administrateur
                        <input type="radio" name="access_level_user_main" value="user" <?php echo in_array('user', explode(',', $access_level_user)) ? 'checked' : ''; ?>> Utilisateur
                        <input type="radio" name="access_level_user_main" value="adminRH" <?php echo in_array('adminRH', explode(',', $access_level_user)) ? 'checked' : ''; ?>> Admin RH
                    </td>
                </tr>
                <tr>
                    <td align="right">Modules <span style="color:#FF0000">(*)</span>&nbsp;:</td>
                    <td>
                        <input type="checkbox" name="access_level_user[]" value="clients_mod" <?php echo in_array('clients_mod', explode(',', $access_level_user)) ? 'checked' : ''; ?>> Clients
                        <input type="checkbox" name="access_level_user[]" value="facture_mod" <?php echo in_array('facture_mod', explode(',', $access_level_user)) ? 'checked' : ''; ?>> Factures
                        <input type="checkbox" name="access_level_user[]" value="bl_mod" <?php echo in_array('bl_mod', explode(',', $access_level_user)) ? 'checked' : ''; ?>> Bon de livraison
                        <input type="checkbox" name="access_level_user[]" value="devis_mod" <?php echo in_array('devis_mod', explode(',', $access_level_user)) ? 'checked' : ''; ?>> Devis
                        <input type="checkbox" name="access_level_user[]" value="admin_mod" <?php echo in_array('admin_mod', explode(',', $access_level_user)) ? 'checked' : ''; ?>> Admin
                        <input type="checkbox" name="access_level_user[]" value="users_mod" <?php echo in_array('users_mod', explode(',', $access_level_user)) ? 'checked' : ''; ?>> Gestion des utilisateurs
                        <input type="checkbox" name="access_level_user[]" value="conge_mod" <?php echo in_array('conge_mod', explode(',', $access_level_user)) ? 'checked' : ''; ?>> Registre des congés
                    </td>
                </tr>
            </table>
    </fieldset>

    <div align="center">
        <h3><input name="submit" type="submit" value="<?php echo $id_user ? 'Modifier' : 'Ajouter'; ?>" /></h3>
    </div>
</form>

<?php
if (isset($_POST['submit'])) {
    // Récupérer les valeurs du formulaire
    $civilite = mysqli_real_escape_string($connexion, $_POST['civilite']);
    $nom_user = mysqli_real_escape_string($connexion, $_POST['nom_user']);
    $prenom_user = mysqli_real_escape_string($connexion, $_POST['prenom_user']);
    $login_user = mysqli_real_escape_string($connexion, $_POST['login_user']);
    $mot_de_passe_user = mysqli_real_escape_string($connexion, $_POST['mot_de_passe_user']);
    $email_user = mysqli_real_escape_string($connexion, $_POST['email_user']);
    
    // Récupérer et combiner le niveau d'accès principal et les modules
    $access_level_user_main = isset($_POST['access_level_user_main']) ? $_POST['access_level_user_main'] : '';
    $access_level_user_modules = isset($_POST['access_level_user']) ? implode(',', $_POST['access_level_user']) : '';
    
    // Combiner les deux pour obtenir une seule chaîne
    $access_level_user = $access_level_user_main;
    if (!empty($access_level_user_modules)) {
        $access_level_user .= ',' . $access_level_user_modules;
    }

    if ($id_user) {
        // Préparer la requête SQL de mise à jour
        $requete = "UPDATE users SET CIVILITE_USER='$civilite',NOM_USER='$nom_user', PRENOM_USER='$prenom_user', LOGIN_USER='$login_user', MOT_DE_PASSE_USER='$mot_de_passe_user', EMAIL_USER='$email_user', ACCESS_LEVEL_USER='$access_level_user' WHERE ID_USER=$id_user";
    } else {
        // Préparer la requête SQL d'insertion
        $requete = "INSERT INTO users (CIVILITE_USER,NOM_USER, PRENOM_USER, LOGIN_USER, MOT_DE_PASSE_USER, EMAIL_USER, ACCESS_LEVEL_USER) VALUES ('$civilite','$nom_user', '$prenom_user', '$login_user', '$mot_de_passe_user', '$email_user', '$access_level_user')";
    }

    // Exécuter la requête
    if (mysqli_query($connexion, $requete)) {
        // Mettre à jour la session après la requête réussie
        //$_SESSION["access_level"] = $access_level_user;
        echo "<script type='text/javascript'>
                window.location.href = 'list_users.php';
              </script>";
    } else {
        echo "Erreur: " . $requete . "<br>" . mysqli_error($connexion);
    }

    // Fermer la connexion
    mysqli_close($connexion);
}
?>

</section>
