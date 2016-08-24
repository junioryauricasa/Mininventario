<?php
class Producto
{
	private $intidproducto;
	private $nvchproducto;
	private $nvchdescripcion;
	private $nvchcantidad;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>