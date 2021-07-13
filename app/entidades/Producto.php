<?php
    class Producto {
        public $nombre;
        public $desc;         
        public $precio;
        public $categoria;
        public $imagenPath;


        public function __construct(){
            
        }


        public function setNombre($nombre){
            
            $this->nombre = $nombre;
        }

        public function setDesc($desc){
            
            $this->desc = $desc;
        }

        public function setPrecio($precio){
            
            $this->precio = $precio;
        }

        public function setCategoria($categoria){
            
            $this->categoria = $categoria;
        }
       

        public function getNombre(){
            
            return $this->nombre;
        }

        public function getDesc(){
            
            return $this->desc;
        }

        public function getPrecio(){
            
            return $this->precio;
        }

        public function getCategoria(){
            
            return $this->categoria;
        }


        public static function guardarProducto($producto){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO producto(nombre, descrip, precio, categoria) VALUES (?,?,?,?)");
            $consulta->execute(array($producto->getNombre(), $producto->getDesc(), $producto->getPrecio(), $producto->getCategoria()));
        }

        public static function obtenerProductos(){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM producto");
            $consulta->execute();
    
            return $consulta->fetchAll(PDO::FETCH_CLASS, 'Producto');
        }

    }

?>