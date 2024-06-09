<?php include "template/header.php";?>
<?php include "template/left.php";?>

<?php
function redirige($url)
{
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
                        <select name="access_level_user">
                            <option value="admin" <?php echo $access_level_user == 'admin' ? 'selected' : ''; ?>>Administrateur</option>
                            <option value="user" <?php echo $access_level_user == 'user' ? 'selected' : ''; ?>>Utilisateur</option>
                        </select>
                    </td>
                </tr>
            </table>
    </fieldset>

    <div align="center">
        <h3><input name="submit" type="submit" value="<?php echo $id_user ? 'Modifier' : 'Ajouter'; ?>" /></h3>
    </div>
</form>

<?php
if(isset($_POST['submit'])){
    // Récupérer les valeurs du formulaire
    $nom_user = mysqli_real_escape_string($connexion, $_POST['nom_user']);
    $prenom_user = mysqli_real_escape_string($connexion, $_POST['prenom_user']);
    $login_user = mysqli_real_escape_string($connexion, $_POST['login_user']);
    $mot_de_passe_user = mysqli_real_escape_string($connexion, $_POST['mot_de_passe_user']);
    $email_user = mysqli_real_escape_string($connexion, $_POST['email_user']);
    $access_level_user = mysqli_real_escape_string($connexion, $_POST['access_level_user']);

    if ($id_user) {
        // Préparer la requête SQL de mise à jour
        $requete = "UPDATE users SET NOM_USER='$nom_user', PRENOM_USER='$prenom_user', LOGIN_USER='$login_user', MOT_DE_PASSE_USER='$mot_de_passe_user', EMAIL_USER='$email_user', ACCESS_LEVEL_USER='$access_level_user' WHERE ID_USER=$id_user";
    } else {
        // Préparer la requête SQL d'insertion
        $requete = "INSERT INTO users (NOM_USER, PRENOM_USER, LOGIN_USER, MOT_DE_PASSE_USER, EMAIL_USER, ACCESS_LEVEL_USER) VALUES ('$nom_user', '$prenom_user', '$login_user', '$mot_de_passe_user', '$email_user', '$access_level_user')";
    }

    // Exécuter la requête
    if (mysqli_query($connexion, $requete)) {
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
