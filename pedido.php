<?php
require_once 'controller/pedido.entidad.php';
require_once 'model/pedido.model.php';
// Logica
$per = new Pedido();
$model = new PedidoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$per->__SET('intidstock',$_REQUEST['intidstock']);
			$per->__SET('inidproducto',$_REQUEST['inidproducto']);
			$per->__SET('nvchcantidad',$_REQUEST['nvchcantidad']);
			
            //$alm->__SET('foto', $_REQUEST['foto']);
			$model->ActualizarPedido($per);
			header('Location: pedido.php');
			break;

		case 'registrar':
			$per->__SET('intidstock',$_REQUEST['intidstock']);
			$per->__SET('inidproducto',$_REQUEST['inidproducto']);
			$per->__SET('nvchcantidad',$_REQUEST['nvchcantidad']);

			$model->RegistrarPedido($per);
			echo "<script>alert('Registro exitoso..!!');</script>";
			header('Location: pedido.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['intidstock']);
			echo "<script>alert('Pedido Eliminado..!!');</script>";
			header('Location: pedido.php');
			break;

		case 'editar':
			$per = $model->Obtener($_REQUEST['intidstock']);
			break;
	}


}

include_once('connection.php');
	$servidor = 'localhost';
	$user = 'root';
	$pass = '';
	$name = 'db_tiendastock';
	conectar($servidor, $user, $pass, $name);


include('panelheader.php');
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
					<li class="active">Pedido de Productos</li>
				</ol>
			</div><!--/.row-->
			<br>

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Rol en videojuego</div>
						<div class="panel-body">
							<div class="col-md-6">
								<!--form action="registropedido.php" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data"-->
								<form action="?action=<?php echo $per->intidstock > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
				                    <input class="form-control" type="hidden" name="intidstock" value="<?php echo $per->__GET('intidstock'); ?>" />
				                    <label for="">Producto (Cod./Producto/distribuidor)</label>
				                    <!--select persona-->
				                    <select name="inidproducto" style='text-transform:uppercase' class="form-control" id="">
                                          <?php dameproducto(); ?>
                                    </select>
                                    <!--END select persona-->
                                    <br>
				                    <label for="">Cantidad pedido (unidades)</label>
				                    <input class="form-control" type="number" min="1" name="nvchcantidad" value="<?php echo abs($per->__GET('nvchcantidad')); ?>" style="width:100%;" required/>
				                    <br>
				                    <button type="submit" class="btn btn-primary">Guardar</button>
									<button type="reset" class="btn btn-danger">Limpiar</button>
				                </form>
							</div>
						</div>
					</div>
				</div><!-- /.col-->
			</div><!-- /.row -->

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Relacion de pedidos</div>
						<div class="panel-body">
							<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							    <thead>
							    <tr>
							        <th>Pedido</th>
							        <th>Producto</th>
							        <th>Descripción</th>
							        <th>Distribuidor</th>
							        <th>Cant.</th>
							        <th>Tipo</th>
							        <th>Opciones</th>
							    </tr>
							    </thead>
								<?php damelista(); ?>
							</table>
						</div>
					</div>
				</div>
			</div><!--/.row-->	
	</div><!--/.main-->

<?php include_once('panelfooter.php'); ?>