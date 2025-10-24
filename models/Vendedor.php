<?php

namespace Model;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
     public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';

    }
     public function validar()
    {

        if (!$this->nombre) {
            self::$errores[] = 'El nombre es obligatorio';
        }
        if (!$this->apellido) {
            self::$errores[] = 'El apellido es obligatorio'; 
        }
        if (!$this->telefono) {
            self::$errores[] = 'El telefono es obligatorio';
        }
        //validar telefono
        //[Solo acenta numero de 0 a 9] y {es que debe tener un tamño de 10} 
        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = 'El telefono que intenta ingresar no es valido';
        }
        return self::$errores;
    }
}