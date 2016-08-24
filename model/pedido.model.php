<?php
class PedidoModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=db_tiendastock', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tbstock");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$gam = new Pedido();
			
				$gam->__SET('intidstock', $r->intidstock);
				$gam->__SET('inidproducto', $r->inidproducto);
				$gam->__SET('nvchcantidad', $r->nvchcantidad);

				$result[] = $gam;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tbstock WHERE intidstock = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$gam = new Pedido();

			$gam->__SET('intidstock', $r->intidstock);
			$gam->__SET('inidproducto', $r->inidproducto);
			$gam->__SET('nvchcantidad', $r->nvchcantidad);

			return $gam;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{

			$stm = $this->pdo
			          ->prepare("DELETE FROM tbstock WHERE intidstock = ?");          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Pedido $data)
	{
		try 
		{
			$sql = "UPDATE tbstock SET 
						inidproducto  = ?,
						nvchcantidad  = ? 
				    WHERE intidstock = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('inidproducto'), 
					$data->__GET('nvchcantidad'),
					$data->__GET('intidstock')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarPedido(Pedido $data)
	{
		try 
		{
			$sql = "UPDATE tbstock SET 
						inidproducto  = ?,
						nvchcantidad  = ? 
				    WHERE intidstock = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('inidproducto'), 
					'-'.$data->__GET('nvchcantidad'),
					$data->__GET('intidstock')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


	public function Registrar(Pedido $data)
	{

		try 
		{
		$sql = "INSERT INTO tbstock (inidproducto,nvchcantidad) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('inidproducto'), 
				$data->__GET('nvchcantidad')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarPedido(Pedido $data)
	{
		try 
		{
		$sql = "INSERT INTO tbstock (inidproducto,nvchcantidad) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('inidproducto'), 
				'-'.$data->__GET('nvchcantidad')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}


	//dame tareas para el combobox
	function dameproducto(){
	    $consulta_mysql="
		    SELECT 
				tbproducto.nvchproducto,
				tbproducto.intidproducto,
				tbproducto.nvchcantidad
			from 
			tbproducto
	    ";
	    $resultado_consulta_mysql=mysql_query($consulta_mysql);
	    while($registro = mysql_fetch_array($resultado_consulta_mysql)){
	        echo "
	              <option style='' value='".$registro['intidproducto']."'>
	              	PROD000".$registro['intidproducto']." - ".$registro['nvchproducto']." - distribuidor: ".$registro['nvchcantidad']."".$registro['inidproducto']."
	              </option>
	        ";
	    }
	}

	function damelista(){
		$consulta_mysql="
			SELECT
			  tbstock.intidstock,
			  tbproducto.intidproducto,
			  tbproducto.nvchproducto,
			  tbproducto.nvchdescripcion,
			  tbproducto.nvchcantidad AS proveedor,
			  tbstock.nvchcantidad
			FROM
			  tbproducto
			INNER JOIN
			  tbstock ON tbstock.inidproducto = tbproducto.intidproducto
	    ";
	    $resultado_consulta_mysql=mysql_query($consulta_mysql);
	    while($registro = mysql_fetch_array($resultado_consulta_mysql)){
	    	
	    	if($registro['nvchcantidad'] < 0){
	    		$tiporeg = "<span class='label label-danger'>Pedido Producto</span>";
	    	}else
	    	if($registro['nvchcantidad'] >= 0){
	    		$tiporeg = "<span class='label label-success'>Ingreso Producto</span>";
	    	}

	    	$tipo = 'UND.';
	        echo "
              	<tr>
					<td>REG000".$registro['intidstock']."</td>
					<td>".$registro['nvchproducto']."</td>
					<td>".$registro['nvchdescripcion']."</td>
					<td>".$registro['proveedor']."</td>
					<td>".abs($registro['nvchcantidad']).' '.$tipo."</td>
					<td>".$tiporeg."</td>
					<td>
		                <a href='?action=editar&intidstock=".$registro['intidstock']."' style='background-color: green; padding: 5px; border-radius: 5px;color: white; font-size:12px' data-toggle='tooltip' title='Editar Pedido'><span class='glyphicon glyphicon-edit'></span></a>
		                <a href='?action=eliminar&intidstock=".$registro['intidstock']."' style='background-color: red; padding: 5px; border-radius: 5px;color: white; font-size:12px' data-toggle='tooltip' title='Eliminar Pedido'><span class='glyphicon glyphicon-trash'></span></a>
					</td>
				</tr>
	        ";
	    }
	}

	function tableprod(){
		$consulta_mysql="
			SELECT
			  tbstock.intidstock,
			  tbproducto.intidproducto,
			  tbproducto.nvchproducto,
			  tbproducto.nvchdescripcion,
			  tbproducto.nvchcantidad AS proveedor,
			  sum(tbstock.nvchcantidad) as stocktotal
			FROM
			  tbproducto
			INNER JOIN
			  tbstock ON tbstock.inidproducto = tbproducto.intidproducto
              group by tbproducto.intidproducto
	    ";
	    $resultado_consulta_mysql=mysql_query($consulta_mysql);
	    while($registro = mysql_fetch_array($resultado_consulta_mysql)){
		
		//Estado del producto
		if($registro['stocktotal']<0){
			$cantproducto = '0';
			$nstock = '<span class="label label-danger"><b>'.abs($registro['stocktotal']).' UND.</b> Entregas Pendientes</span> ';

		}else
		if($registro['stocktotal']>=0 && $registro['stocktotal']<=12 ){
			$cantproducto = abs($registro['stocktotal']);
			$nstock = '<span class="label label-warning">Realizar Pedido</span>';
		}else
		if($registro['stocktotal']>=12){
			$cantproducto = abs($registro['stocktotal']);
			$nstock = '<span class="label label-success">STOCK suficiente</span>';
		}

	        echo "
              	<tr>
					<td> REG000".$registro['intidstock']."</td>
					<td>".$registro['nvchproducto']."</td>
					<td>".$registro['nvchdescripcion']."</td>
					<td>".$registro['proveedor']."</td>
					<td>".$cantproducto." UND.</td>
					<td>".$nstock."</td>
					<!--td>
                        <a href='?action=eliminar&intidstock=".$registro['intidstock']."' style='background-color: red; padding: 5px; border-radius: 5px;color: white; font-size:12px' data-toggle='tooltip' title='Eliminar Ingreso'><span class='glyphicon glyphicon-trash'></span></a>
					</td-->
				</tr>
	        ";
	    }
	}

?>