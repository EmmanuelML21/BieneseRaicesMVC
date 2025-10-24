<?php

namespace Model;

class ActiveRecord
{
    //DB
    protected static $db;
    //arregllo para BD
    protected static $columnasDB = [];
    protected static $tabla = '';
    //Errores
    protected static $errores = [];
    //instanias

    //definir la conexion a la BD
    public static function setBD($database)
    {
        self::$db = $database;
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            //actulizar
            $this->actulizar();
        } else {
            //insertando
            $this->crear();
        }
    }
    //insetar datos
    public function crear()
    {
        //sanitizar datos
        $atributos = $this->sanitizarAtributos();
        //Insertar en la BD
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ')";
        $resultado = self::$db->query($query);

        //verificar si se inserto
        if ($resultado) {
            //redireccionar al usuario
            header('location:/admin?resultado=1');
        }
    }
    public function actulizar()
    {
        //sanitizar datos
        $atributos = $this->sanitizarAtributos();
        //actulizar en la BD
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        //verificar si se inserto
        if ($resultado) {
            //redireccionar al usuario
            header('location:/admin?resultado=2');
        }
    }
    //eliminar propiedad
    public function eliminar()
    {
        // Primero borrar la imagen (si existe)
        $this->borrarImagen();

        // Luego eliminar el registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redirige si salió bien
            header('Location: /admin?resultado=3');
            exit; // siempre es buena práctica cortar la ejecución tras un header
        }
    }
    //Identificar y unir atributos de la BD
    /**
     * atributos()
     * ----------------------
     * Recorre las columnas definidas en $columnasDB y crea un array asociativo
     * donde la clave es el nombre de la columna y el valor es el contenido
     * de la propiedad del objeto.
     * 
     * Ejemplo de salida:
     * [
     *   'titulo' => 'Casa en la playa',
     *   'precio' => 250000,
     *   'habitaciones' => 3,
     *   ...
     * ]
     * 
     * Este array sirve como base para sanitizar datos o generar queries
     * sin tener que escribir manualmente cada campo.
     */
    public function  atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue; //ignore el id ya que es autoincrement
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    //funcion sanitizar datos
    /**
     * sanitizarAtributos()
     * ----------------------
     * - Llama al método atributos() para obtener todos los valores de la clase.
     * - Aquí normalmente deberías aplicar métodos de escape para proteger contra
     *   inyecciones SQL (ej. escape_string()).
     */
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        //array asociativo debe pasar el indice del arreglo y su valor 
        foreach ($atributos as $key => $value) {
            // No actualizar la fecha de creación si ya existe (solo insertar)
            if ($key === 'creado' && !empty($this->id)) {
                continue;
            }
            $sanitizado[$key] = self::$db->escape_string($value ?? '');
        }
        return $sanitizado;
    }
    public static function getErrores()
    {
        return static::$errores;
    }
    //validadcion
    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    //subir archivo
    public function setImagen($imagen)
    {
        //elimina la imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        //asignar al atributo imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }
    //elimar imagen
    public function borrarImagen()
    {
        //comprobar si existe el archivo
        $existeArchivo = file_exists(carperta_imagenes . $this->imagen);
        if ($existeArchivo) {
            unlink(carperta_imagenes . $this->imagen);
        }
    }
    //lsita de todas las propiedades
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla; //para que sepa de que clase va consultar la tabla
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //Obtener determinado numero de registros
     public static function get($limite)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limite; //para que sepa de que clase va consultar la tabla
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //buscar un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    public static function consultarSQL($query)
    {
        //consultar
        $resultado = self::$db->query($query);
        //iterar resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        //liberar la memoria
        $resultado->free();
        //retonar resultado
        return $array;
    }
    protected static function crearObjeto($registro)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    //SIncronizar el objeto en memoria con los cambios de usurio
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
