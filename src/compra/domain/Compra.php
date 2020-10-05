<?php


namespace src\compra\domain;

use src\shared\inventario\Inventario;
use src\shared\producto\domain\ProductoSimple;

class Compra
{
    private $numeroCompra;

    private $detalles = [];

    public function __construct(string $numeroCompra)
    {
        $this->numeroCompra = $numeroCompra;
    }

    public function addDetalle(string $sku,int $cantidad,float $costo){
        $detalle = new DetalleCompra($sku,$cantidad,$costo);
        $this->detalles[] = $detalle;
    }

    public function darDeAlta(array $inventario) : string {
        foreach ($this->detalles  as $detalle){
            foreach ($inventario  as $item){
                if($item->getSku() == $detalle->getSku()){
                    $item->entrada($detalle->getCantidad());
                }
            }
        }

        return 'Las entradas de los productos se ha almacenando correctamente';
    }

}