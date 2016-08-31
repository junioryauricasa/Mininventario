<?php
require_once 'controller/producto.entidad.php';
require_once 'model/producto.model.php';
// Logica
$gam = new Producto();
$model = new ProductoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$gam->__SET('intidproducto',$_REQUEST['intidproducto']);
			$gam->__SET('nvchproducto',$_REQUEST['nvchproducto']);
			$gam->__SET('nvchdescripcion',$_REQUEST['nvchdescripcion']);
            $gam->__SET('nvchcantidad', $_REQUEST['nvchcantidad']);
            //$alm->__SET('foto', $_REQUEST['foto']);
			$model->Actualizar($gam);
			header('Location: index.php');
			break;

		case 'registrar':
			$gam->__SET('intidproducto',$_REQUEST['intidproducto']);
			$gam->__SET('nvchproducto',$_REQUEST['nvchproducto']);
			$gam->__SET('nvchdescripcion',$_REQUEST['nvchdescripcion']);
            $gam->__SET('nvchcantidad', $_REQUEST['nvchcantidad']);

			$model->Registrar($gam);
			header('Location: index.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['intidproducto']);
			header('Location: index.php');
			break;

		case 'editar':
			$gam = $model->Obtener($_REQUEST['intidproducto']);
			break;
	}
}
include('panelheader.php');
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
					<li class="active">Registro de Productos</li>
				</ol>
			</div><!--/.row-->
			<br>
			
			<!--registro producto form-->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Registro producto</div>
						<div class="panel-body">
							<div class="col-md-6">
				                <form action="?action=<?php echo $gam->intidproducto > 0 ? 'actualizar' : 'registrar'; ?>" method="POST" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
				                    <input type="HIDDEN" name="intidproducto" value="<?php echo $gam->__GET('intidproducto'); ?>" />
				                    <label for="">Producto</label>
				                    <input class="form-control" type="text" name="nvchproducto" value="<?php echo $gam->__GET('nvchproducto'); ?>" style="width:100%;" placeholder='Ingrese el nombre del producto' required/>

				                    <label for="">Descripcón</label>
				                    <input class="form-control" type="text" name="nvchdescripcion" value="<?php echo $gam->__GET('nvchdescripcion'); ?>" style="width:100%;" placeholder='Ingrese descripcion del producto' required/>

				                    <label for="">Distribuidor</label>
				                    <input class="form-control" type="text" name="nvchcantidad" value="<?php echo $gam->__GET('nvchcantidad'); ?>" placeholder='Ingrese distribuidor' style="width:100%;" required/>
				                    <br>
									<button type="submit" class="btn btn-primary">Guardar</button>
									<button type="reset" class="btn btn-danger">Limpiar</button>
				                </form>
							</div>
						</div>
					</div>
				</div><!-- /.col-->
			</div><!-- /.row -->
			<!--end registro form-->

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Productos en almancen</div>
						<div class="panel-body">
							<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							    <thead>
								    <tr>
								        <th>Codigo Prod.</th>
								        <th style="text-transform: uppercase">Producto</th>
								        <th style="text-transform: uppercase">Descripción</th>
								        <th style="text-transform: uppercase">Distribuidor</th>
								        <th style="text-transform: uppercase">Opciones</th>
								    </tr>
							    </thead>
								<?php foreach($model->Listar() as $r): ?>
			                        <tr style="text-transform: uppercase">
			                            <td>
			                                PROD000<?php echo $r->__GET('intidproducto'); ?>
			                            </td>
			                            <td>
			                                <?php echo $r->__GET('nvchproducto'); ?>
			                            </td>
			                            <td>
			                                <?php echo $r->__GET('nvchdescripcion'); ?>
			                            </td>
			                            <td>
			                                <?php echo $r->__GET('nvchcantidad'); ?>
			                            </td>
			                            <td>
											<a href="?action=editar&intidproducto=<?php echo $r->intidproducto; ?>" style="background-color: green; padding: 5px; border-radius: 5px;color: white; font-size:12px" data-toggle="tooltip" title="Editar Producto"> <span class='glyphicon glyphicon-pencil'></span></a>
			                                <a href="?action=eliminar&intidproducto=<?php echo $r->intidproducto; ?>" style="background-color: red; padding: 5px; border-radius: 5px;color: white; font-size:12px" data-toggle="tooltip" title="Eliminar Producto"><span class="glyphicon glyphicon-trash"></span></a>
			                            </td>
			                        </tr>
			                    <?php endforeach; ?>
							</table>
						</div>
					</div>
				</div>
			</div><!--/.row-->	
                <form action="?action=<?php echo $gam->intidproducto > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
                    <input type="hidden" name="intidproducto" value="<?php echo $gam->__GET('intidproducto'); ?>" />
                </form> 
		</form>
	</div><!--/.main-->

<?php include_once('panelfooter.php'); ?>