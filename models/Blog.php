<?php namespace Model;

use Intervention\Image\Image;

class Blog extends ActiveRecord
{
    protected static $tabla = 'blog';
    protected static $columnasDB = [
        'id',
        'titulo',
        'descripcionBreve',
        'descripcion',
        'fecha',
        'imagen',
        'id_vendedor'
    ];
    //argumentos
    public $id;
    public $titulo;
    public $descripcionBreve;
    public $descripcion;
    public $fecha;
    public $imagen;
    public $id_vendedor;
    //constructor
    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->descripcionBreve = $args['descripcionBreve'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->fecha = date('y/m/d');
        $this->imagen = $args['imagen'] ?? '';
        $this->id_vendedor = $args['id_vendedor'] ?? '';
    }
    public function validar()
    {
        if(!$this->titulo){
            self::$errores[] = 'Debe insertar un titulo';
        }
        if( strlen($this->descripcionBreve) < 20 ){
            self::$errores[] = 'Debe insertar una descripcion breve y esta debe ser mayor a 20 caracteres';
        }
        if (35 > strlen( $this->descripcionBreve)){
            self::$errores[] = 'La descripcion debe se menor a 25 caracteres';
        }
        if(strlen($this->descripcion) < 50){
            self::$errores[] = 'Debe insertar una descripcion esta debe ser mayor o igual 50 caracteres';
        }
        if(!$this->imagen){
            self::$errores[] = 'Debe seleccionar una imagen';
        }
        if(!$this->id_vendedor){
            self::$errores[] = 'Debe seleccionar un autor';
        }
        return self::$errores;
    }
}