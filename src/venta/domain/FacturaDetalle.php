<?php

declare(strict_types=1);

namespace src\venta\domain;

class FacturaDetalle {

    private $codigo;
    private $nombre;
    private $cantidad;
    private $precioUnitario;

    public function __construct(string $codigo,int $cantidad, float $precioUnitario)
    {
        $this->codigo = $codigo;
        self::setCantidad($cantidad);
        self::setPrecio($precioUnitario);
    }

    public function setPrecio(float $precio): void{

        if($precio < 0){
            throw new NumeroInvalidoException('precio invalido');
        }

        $this->precioUnitario = $precio;

    }


    public function setCantidad(int $cantidad): void{

        if($cantidad <= 0){
            throw new NumeroInvalidoException('la cantidad debe ser mayor que cero');
        }

        $this->cantidad = $cantidad;

    }

    public function subTotal() : float{

        return $this->precioUnitario * $this->cantidad;
    }

}