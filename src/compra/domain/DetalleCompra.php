<?php

namespace src\compra\domain;

use src\shared\producto\domain\ProductoSimple;

class DetalleCompra {

    private $sku;
    private $cantidad;
    private $costo;

    public function __construct(string $sku,int $cantidad,float $costo)
    {
        $this->sku = $sku;
        $this->cantidad = $cantidad;
        $this->costo = $costo;
    }

    public function getSku() : string {
        return $this->sku;
    }

    public function getCantidad() : int {
        return $this->cantidad;
    }

}
