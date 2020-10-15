<?php

declare(strict_types=1);

namespace src\movimiento\domain;

class Detalle_Movimiento
{
    private $cantidad;
    private $tipo;
    private $costo;
    private $precio;
    private $sku;

    public function __construct(string $sku,int $cantidad, float $costo,float $precio,string $tipo)
    {
       $this->setCantidad($cantidad);
       $this->tipo = $tipo;
       $this->costo = $costo;
       $this->precio = $precio;
       $this->sku = $sku;
    }


    public function equals(string $sku) : bool {
        return $this->sku == $sku;
    }

    public function getSku(): string
    {
        return $this->sku;
    }


    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }


    public function getCantidad()
    {
        return $this->cantidad;
    }


    public function setCantidad($cantidad): void
    {
        if($cantidad <= 0){
            throw  new \InvalidArgumentException('cantidad incorrecta');
        }
        $this->cantidad = $cantidad;
    }


    public function getTipo()
    {
        return $this->tipo;
    }


    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }


    public function getCosto()
    {
        return $this->costo;
    }


    public function setCosto($costo): void
    {
        $this->costo = $costo;
    }


    public function getPrecio()
    {
        return $this->precio;
    }


    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }



}