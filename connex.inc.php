<?php
function connex($base,$param)
{
include_once($param.".inc.php");
$idcom=@mysql_connect(MYHOST,MYUSER,MYPASS);
$idbase=@mysql_select_db($base);
mysql_query("SET NAMES UTF8"); 
if(!$idcom | !$idbase)
{
echo "<script type=text/javascript>";
echo "alert('Connexion Impossible à la base $base')</script>";
}
return $idcom;
}
?>
