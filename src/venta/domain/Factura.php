<?php

declare(strict_types=1);

namespace src\venta\domain;

use src\shared\producto\domain\ProductoSimple;

class Factura {

    private $numeroFactura;
    private $facturasdetalles = [];

    public function __construct(string $numeroFactura)
    {
        $this->numeroFactura = $numeroFactura;
    }
    public function addDetalle(ProductoSimple $simple, int $cantidad, float $precioUnitario){
        $detalle = new FacturaDetalle($simple,$cantidad,$precioUnitario);
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

    public function facturar(array $inventario) : string {
            foreach ($this->facturasdetalles  as $detalle){
                foreach ($inventario  as $item){
                    if($item->getSku() == $detalle->getSku()){
                        $item->salida($detalle->getCantidad());
                    }
                }
            }
            return 'Las salidas de los productos se ha almacenado correctamente';
    }

}