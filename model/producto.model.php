<?php
class ProductoModel
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

			$stm = $this->pdo->prepare("SELECT * FROM tbproducto");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$gam = new Producto();
			
				$gam->__SET('intidproducto', $r->intidproducto);
				$gam->__SET('nvchproducto', $r->nvchproducto);
				$gam->__SET('nvchdescripcion', $r->nvchdescripcion);
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
			          ->prepare("SELECT * FROM tbproducto WHERE intidproducto = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$gam = new Producto();

			$gam->__SET('intidproducto', $r->intidproducto);
			$gam->__SET('nvchproducto', $r->nvchproducto);
			$gam->__SET('nvchdescripcion', $r->nvchdescripcion);
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
			          ->prepare("DELETE FROM tbproducto WHERE intidproducto = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Producto $data)
	{
		try 
		{
			$sql = "UPDATE tbproducto SET 
						nvchproducto = ?,
						nvchdescripcion  = ?,
						nvchcantidad  = ?
				    WHERE intidproducto = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nvchproducto'), 
					$data->__GET('nvchdescripcion'), 
					$data->__GET('nvchcantidad'),
					$data->__GET('intidproducto')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Producto $data)
	{

		try 
		{
		$sql = "INSERT INTO tbproducto (nvchproducto,nvchdescripcion,nvchcantidad) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nvchproducto'), 
				$data->__GET('nvchdescripcion'), 
				$data->__GET('nvchcantidad')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

