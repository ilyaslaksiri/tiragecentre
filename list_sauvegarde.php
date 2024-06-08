

<?php include "template/header.php";   
include "template/left.php";   
?>

<section id="main" class="column">
<h4 class="titre_info">Sauvegardes</h4><br/><br/>




<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table_jui.css";
			@import "media/css/jquery-ui-1.8.4.custom.css";
			@import "media/css/ColVis.css";
			.ColVis {
				float: left;
				margin-bottom: 0
			}
			.dataTables_length {
				width: auto;
			}
		</style>
		<script type="text/javascript" charset="utf-8" src="media/js/jquery.js"></script>
		<script type="text/javascript" charset="utf-8" src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="media/js/ColVis.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				$('#example').dataTable( {
					"sDom": '<"H"Cfr>t<"F"ip>',
					"bJQueryUI": true
				} );
			} );
		</script>


        <!--Tableau debut -->
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
			<th>Fichier de sauvegarde</th>
	</thead>
	<tbody>
	
    <?php
$dirname = './Backup_database/';
$dir = opendir($dirname); 




while($file = readdir($dir)) {
	if($file != '.' && $file != '..' && !is_dir($dirname.$file))
	{
		
		echo '<tr align=center><td><a href="'.$dirname.$file.'">'.$file.'</a></td></tr>';
	}
}
closedir($dir);
 ?>
    </tbody>
</table>
        
       <!-- Tableau Fin -->

</section>
