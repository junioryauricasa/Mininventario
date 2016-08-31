<?php
require_once 'controller/pedido.entidad.php';
require_once 'model/pedido.model.php';
require_once 'functionall.php';
include_once('connection.php');
include('panelheader.php');
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
			$model->Actualizar($per);
			header('Location: ingreso.php');
			break;

		case 'registrar':
			$per->__SET('intidstock',$_REQUEST['intidstock']);
			$per->__SET('inidproducto',$_REQUEST['inidproducto']);
			$per->__SET('nvchcantidad',$_REQUEST['nvchcantidad']);
			

			$model->Registrar($per);
			echo "<script>alert('Registro exitoso..!!');</script>";
			header('Location: ingreso.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['intidstock']);
			header('Location: ingreso.php');
			break;

		case 'editar':
			$per = $model->Obtener($_REQUEST['intidstock']);
			break;
	}


}

include_once('connection.php');
include('panelheader.php');
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
					<li class="active">Ingreso de Productos</li>
				</ol>
			</div><!--/.row-->
			<br>

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Ingreso de productos</div>
						<div class="panel-body">
							<div class="col-md-6">
								<form action="?action=<?php echo $per->intidstock > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
				                    <input class="form-control" type="hidden" name="intidstock" value="<?php echo $per->__GET('intidstock'); ?>" />
				                    <label for="">Producto (Producto/distribuidor)</label>
				                    <!--select persona-->
				                    <select name="inidproducto" style='text-transform:uppercase' class="form-control" id="">
                                          <?php dameproducto(); ?>
                                    </select>
                                    <!--END select persona-->
                                    <br>
				                    <label for="">Cant. pedido (unidades)</label>
				                    <input class="form-control" type="number"  value='' min="1" name="nvchcantidad" value="<?php echo abs ($per->__GET('nvchcantidad')); ?>" style="width:100%;" placeholder='Ingresa cantidad' required/>
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
						<div class="panel-heading">Inventario actual</div>
						<div class="panel-body">
							<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							    <thead>
							    <tr>
							        <th>Pedido</th>
							        <th>Producto</th>
							        <th>Descripción</th>
							        <th>Distribuidor</th>
							        <th>STOCK</th>
							        <th>Estado</th>
							        <!--th>Opciones</th-->
							    </tr>
							    </thead>
								<?php tableprod(); ?>
							</table>
						</div>
					</div>
				</div>
			</div><!--/.row-->	
	</div><!--/.main-->

<?php include_once('panelfooter.php'); ?>
