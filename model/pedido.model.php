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

?>