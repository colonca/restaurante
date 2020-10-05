<?php

namespace src\compra\domain;

class DetalleCompra {

    private $sku;
    private $cantidad;
    private $costo;

    public function __construct(string $sku,int $cantidad,float $costo)
    {
        $this->sku = $sku;
        $this->setCantidad($cantidad);
        $this->costo = $costo;
    }

    public function setCantidad(int $cantidad): void{

        if($cantidad <= 0){
            throw new NumeroInvalidoException('la cantidad debe ser mayor que cero');
        }

        $this->cantidad = $cantidad;

    }

    public function getSku() : string {
        return $this->sku;
    }

    public function getCantidad() : int {
        return $this->cantidad;
    }

}
