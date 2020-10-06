<?php

declare(strict_types=1);

namespace src\venta\domain;

use src\shared\producto\domain\ProductoSimple;

class FacturaDetalle {

    private $productoSimple;
    private $cantidad;
    private $precioUnitario;


    public function __construct(ProductoSimple $productoSimple,int $cantidad, float $precioUnitario)
    {
        $this->productoSimple = $productoSimple;
        self::setCantidad($cantidad);
        self::setPrecio($precioUnitario);
    }

    public function setPrecio(float $precio): void{

        if($precio < 0){
            throw new NumeroInvalidoException('precio invalido');
        }

        $this->precioUnitario = $precio;

    }

    public function getCantidad() : int {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): void{

        if($cantidad <= 0){
            throw new NumeroInvalidoException('la cantidad debe ser mayor que cero');
        }

        $this->cantidad = $cantidad;

    }

    public function getSku():string {
        return $this->productoSimple->getSku();
    }

    public function subTotal() : float{

        return $this->precioUnitario * $this->cantidad;
    }

}