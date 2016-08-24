<?php
function conectar($servidor, $user, $pass, $name)
{
	$con = @mysql_connect($servidor, $user, $pass);
	@mysql_select_db($name, $con);
}
?>