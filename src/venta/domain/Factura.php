<?php

declare(strict_types=1);

namespace src\venta\domain;

use src\shared\producto\domain\ProductoCompuesto;
use src\shared\producto\domain\ProductoSimple;

class Factura {

    private $numeroFactura;
    private $facturasdetalles = [];

    public function __construct(string $numeroFactura)
    {
        $this->numeroFactura = $numeroFactura;
    }
    public function addDetalle(?ProductoSimple $simple,?ProductoCompuesto $compuesto, int $cantidad, float $precioUnitario){
        $detalle = new FacturaDetalle($simple,$compuesto,$cantidad,$precioUnitario);
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
                if($detalle->getProductoSimple() != null){
                    foreach ($inventario as $item){
                        if($item->getSku() == $detalle->getSku()){
                            $item->salida($detalle->getCantidad());
                            break;
                        }
                    }
                }else{

                    $productoCompuesto = $detalle->getProdcutoCompuestos();

                    foreach ($productoCompuesto->getProductos() as $producto){
                        $ingredientes = $producto->getIngredientes();
                        foreach ($ingredientes as $ingrediente){
                            foreach ($inventario as $item){
                                if($item->getSku() == $ingrediente->getSku()){
                                    $item->salida($detalle->getCantidad());
                                    break;
                                }
                            }
                        }
                    }

                    foreach ($productoCompuesto->getIngredientes() as $ingrediente){
                        foreach ($inventario as $item){
                            if($item->getSku() == $ingrediente->getSku()){
                                $item->salida($detalle->getCantidad());
                                break;
                            }
                        }
                    }
                }
            }
            return 'Las salidas de los productos se ha almacenado correctamente';
    }

}