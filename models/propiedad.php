<?php

namespace Model;

class Propiedad extends ActiveRecord
{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = [
        'id',
        'titulo',
        'precio',
        'imagen',
        'descripcion', 
        'habitaciones',
        'WC',
        'estacionamientos',
        'creado',
        'vendedorId'
    ];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $WC;
    public $estacionamientos;
    public $creado;
    public $vendedorId;
     public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->WC = $args['WC'] ?? '';
        $this->estacionamientos = $args['estacionamientos'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }
      public function validar()
    {

        if (!$this->titulo) {
            self::$errores[] = 'Debe insertar un titulo';
        }
        if (!$this->precio) {
            self::$errores[] = 'Debe insertar un precio';
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'Debe insertar una descripcion y esta debe ser mayor o igual 50 caracteres';
        }
        if (!$this->habitaciones) {
            self::$errores[] = 'Debe insertar un numero de habitaciones';
        }
        if (!$this->WC) {
            self::$errores[] = 'Debe insertar un numero de baños';
        }
        if (!$this->estacionamientos) {
            self::$errores[] = 'Debe insertar un numero de estacionaminestos';
        }
        if (!$this->vendedorId) {
            self::$errores[] = 'Debe seleccionar un vendedor';
        }
        if (!$this->imagen) {
            self::$errores[] = 'Debe seleccionar una imagen para la propiedad';
        }
        return self::$errores;
    }
}
