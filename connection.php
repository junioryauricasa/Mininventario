<?php
	
	$servidor = 'localhost';
	$user = 'root';
	$pass = '';
	$name = 'db_tiendastock';

		$con = @mysql_connect($servidor, $user, $pass);
		@mysql_select_db($name, $con);
	
?>