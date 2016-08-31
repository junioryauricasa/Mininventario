<?php 
//('connection.php');
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