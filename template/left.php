

<aside id="sidebar" class="column">
    <div align="center">
        <img src="images/lg.png" width="100%"/>
    </div> 
    <hr/>
    
    <?php if (in_array('clients_mod', $access_levels)) { ?>
        <h3>Clients</h3>
        <ul class="toggle">
            <li class="icn_add_user"><a href="ajouter_client.php">Nouveau client</a></li>
            <li class="icn_view_users"><a href="list_client.php">Clients / Factures</a></li>
        </ul>
    <?php } ?>

    <?php if (in_array('facture_mod', $access_levels)) { ?>
        <h3>Factures</h3>
        <ul class="toggle">
            <li class="icn_new_article"><a href="list_client.php">Nouvelle Facture</a></li>
            <li class="icn_categories"><a href="registre_facture.php">Registre des Factures</a></li>
            <li class="icn_categories"><a href="notification.php">Liste Échéances</a></li>
        </ul>
    <?php } ?>

    <?php if (in_array('bl_mod', $access_levels)) { ?>
        <h3>Bon de Livraison</h3>
        <ul class="toggle">
            <li class="icn_new_article"><a href="list_client_bl.php">Bon de livraison</a></li>
            <li class="icn_new_article"><a href="carnet_bl.php">Carnet de Bon</a></li>
        </ul>
    <?php } ?>

    <?php if (in_array('devis_mod', $access_levels)) { ?>
        <h3>Devis</h3>
        <ul class="toggle">
            <li class="icn_new_article"><a href="list_client_devis.php">Devis</a></li>
        </ul>
    <?php } ?>

    <?php if (in_array('admin_mod', $access_levels) || in_array('admin', $access_levels)) { ?>
        <h3>Sauvegardes</h3>
        <ul class="toggle">
            <li class="icn_folder"><a href="BackupCode/backup.php">Sauvegarder</a></li>
            <li class="icn_categories"><a href="list_sauvegarde.php">Liste des sauvegardes</a></li>
        </ul>
    <?php } ?>

    <?php if (in_array('users_mod', $access_levels)) { ?>
        <h3>Gestion des utilisateurs</h3>
        <ul class="toggle">
            <li class="icn_settings"><a href="ajouter_user.php">Ajouter utilisateur</a></li>
            <li class="icn_settings"><a href="list_users.php">Liste des utilisateurs</a></li>
        </ul>
    <?php } ?>

    <?php if (in_array('conge_mod', $access_levels)) { ?>
        <h3>Congés</h3>
        <ul class="toggle">
            <li class="icn_settings"><a href="list_conge.php">Liste des congés</a></li>
        </ul>
    <?php } ?>

    <?php if (in_array('user', $access_levels)) { ?>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <?php } ?>
    
    <footer>
        <hr />
        <p><strong>Copyright &copy; 2014 Ilyas LAKSIRI</strong></p>
        <p><strong>Version 3.2 Update 2016</strong></p>
        <p>Use right : <a href="#"> TirageCentre </a> 
            
        <?php
        //-----------------------------------------------------//
        // Compteur v1 //
        //-----------------------------------------------------//
        $fp = fopen("template/compteur.txt","r+");
        $nbvisites = fgets($fp,10);
        if ($nbvisites=="") $nbvisites = 0;
        $nbvisites++;
        fseek($fp,0);
        fputs($fp,$nbvisites);
        fclose($fp);
        echo "</br>Total Acc&egrave;s : $nbvisites";
        ?> 
        </p>
    </footer>
</aside>
