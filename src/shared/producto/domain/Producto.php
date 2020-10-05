<?php

declare(strict_types=1);

namespace src\shared\producto\domain;

abstract class Producto {

    private $sku;
    private $nombre;
    private $costo;
    private $precio;

    public function __construct(String $sku,String $nombre,float $costo,float $precio)
    {
        $this->sku = $sku;
        $this->nombre = $nombre;
        $this->costo = $costo;
        $this->precio = $precio;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getCosto(): float
    {
        return $this->costo;
    }

    public function setCosto(float $costo): void
    {
        $this->costo = $costo;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

}
