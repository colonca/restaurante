<?php

declare(strict_types=1);

namespace src\venta\domain;

class Factura {

    private $numeroFactura;
    private $facturasdetalles = [];

    public function __construct(string $numeroFactura)
    {
        $this->numeroFactura = $numeroFactura;
    }
    public function addDetalle(string $codigo, int $cantidad, float $precioUnitario){
        $detalle = new FacturaDetalle($codigo,$cantidad,$precioUnitario);
        $this->facturasdetalles[] = $detalle;
    }

    public function total() : double
    {
        $total = 0;
        foreach ($this->facturasdetalles as $detalle) {
            $total += $detalle->subtotal();
        }

        return $total;
    }

    public function getDetalles(){
        return $this->facturasdetalles;
    }

}