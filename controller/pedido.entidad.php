<?php
class Pedido
{
	private $intidstock;
	private $inidproducto;
	private $nvchcantidad;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>