<?php 


	include_once('connection.php');
	$servidor = 'localhost';
	$user = 'root';
	$pass = '';
	$name = 'db_tiendastock';
	conectar($servidor, $user, $pass, $name);

	
	$codprod = $_POST['inidproducto'];
	$cantped = $_POST['nvchcantidad'];
	$cantidadpedido = '-'.$cantped;

		$consul = "INSERT INTO `tbstock` (`intidstock`, `inidproducto`, `nvchcantidad`) VALUES (NULL, $codprod, $cantidadpedido);";
		mysql_query($consul); 
		if($consul)
			{
				/*echo "<script>
						alert('Pedido Exitoso!! :)');
					</script>";
					*/
				echo "<script>window.location='pedido.php'</script>";

			}else 
				/*echo "<script>
						alert('upss!!! Algo sucedio mal, intentalo de nuevo :)');
					</script>";	*/
				echo "<script>window.location='pedido.php'</script>";

 ?>