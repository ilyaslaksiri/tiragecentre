<?php include "template/header.php";?>
<?php include "template/left.php";?>

<script type="text/javascript">
function format(obj) {
    var str = obj.value.replace(/-|\./g, '')
    switch (true) {
        case (str.length < 10):
            break;
        case (str.length == 10):
            tel = str.replace(/^(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/, "$1-$2.$3.$4.$5")
            obj.value = tel
            break;
        case (str.length > 10):
            obj.value = str.substr(0, 9).replace(/^(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/, "$1-$2.$3.$4.$5")
    }
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

<script>
    $(document).ready(function() {
        // Initialiser les date pickers
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd', // Format de date
            changeMonth: true, // Permet de changer le mois
            changeYear: true, // Permet de changer l'année
            defaultDate: new Date() // Date par défaut
        });
    });
</script>

<section id="main" class="column">
    <h4 class="titre_info">Nouvelle demande de congé</h4><br/><br/>
    <fieldset>
        <form action="" method="post">
            <table width="70%" align="center">
                <tr>    
                    <td align="left">Demandeur <span style="color:#FF0000">(*)</span>&nbsp;:</td>
                    <td>  
                        <b><?php echo $_SESSION["prenom"]." ".$_SESSION["nom"]; ?></b>
                    </td>
                </tr>
                <tr>
                    <td align="left">Date de demande <span style="color:#FF0000">(*)</span> :</td>
                    <td>  
                        <b><?php echo date('Y-m-d'); ?></b>
                    </td>
                </tr>
                <tr>
                    <td align="left">Date de début <span style="color:#FF0000">(*)</span> :</td>
                    <td><input type="text" name="date_debut" id="date_debut" class="datepicker" value="<?php echo date('Y-m-d'); ?>" required style="width:30%"/></td>
                </tr>
                <tr>
                    <td align="left">Date de fin <span style="color:#FF0000">(*)</span> :</td>
                    <td><input type="text" name="date_fin" id="date_fin" class="datepicker" value="<?php echo date('Y-m-d'); ?>" required style="width:30%"/></td>
                </tr>
                <tr>
                    <td align="left">Message <span style="color:#FF0000"></span> :</td>
                    <td><textarea name="Message" id="Message" style="width:100%; height:100px;"></textarea></td>
                </tr>
            </table>
        </fieldset>
        <div align="center">
            <h3><input name="submit" type="submit" value="Envoyer la demande" /></h3>
        </div>
    </form>
</section>
