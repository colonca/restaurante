<?php


namespace src\shared\producto\domain;


class TipoProducto
{

    private $nombre;

    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

}