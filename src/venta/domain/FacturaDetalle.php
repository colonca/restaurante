<?php

declare(strict_types=1);

namespace src\venta\domain;

use src\shared\producto\domain\ProductoCompuesto;
use src\shared\producto\domain\ProductoSimple;

class FacturaDetalle {

    private $productoSimple;
    private $productoCompuesto;
    private $cantidad;
    private $precioUnitario;


    public function __construct(?ProductoSimple $simple,?ProductoCompuesto $compuesto,int $cantidad, float $precioUnitario)
    {
        $this->productoSimple = $simple;
        $this->productoCompuesto = $compuesto;
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
        return $this->productoSimple != null ? $this->productoSimple->getSku() : $this->productoCompuesto->getSku();
    }

    public function subTotal() : float{

        return $this->precioUnitario * $this->cantidad;
    }

    public function getProductoSimple() :  ?ProductoSimple{
        return $this->productoSimple;
    }

    public function getProdcutoCompuestos() : ?ProductoCompuesto{
       return $this->productoCompuesto;
    }

}