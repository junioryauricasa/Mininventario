<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Inventario - 'El Shunior'</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Inventario</a>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group center" style="text-align:center">
				<!--input type="text" class="form-control" placeholder="Search"-->
				<img src="junior.png" alt="" data-toggle='tooltip' data-placement="bottom" title='Junior Yauricasa' style='width:150px; height: 150px; border-radius:50%'>
				<br>
				<!--Usuario-->
				<div class="fb-follow" style='margin-top:7px'  data-placement="top" data-toggle='tooltip' title='Junior Yauricasa' data-href="https://www.facebook.com/JuniorYauricasa" data-layout="button" data-size="small" data-show-faces="false"></div>
			</div>
		</form>
		<ul class="nav menu">
			<li class="">
				<a href="index.php"><span class="glyphicon glyphicon-list-alt"></span>Registrar Producto</a>
			</li>
			<li>
				<a href="pedido.php"><span class="glyphicon glyphicon-list-alt"></span>Registrar Pedido</a>
			</li>
			<li>
				<a href="ingreso.php"><span class="glyphicon glyphicon-list-alt"></span>Registrar Ingreso</a>
			</li>
			<li>
				<a href="reportepdf.php"><span class="glyphicon glyphicon-download-alt"></span>Lista Productos</a>
			</li>
			<li role="presentation" class="divider"></li>
		</ul>
		
	</div><!--/.sidebar-->