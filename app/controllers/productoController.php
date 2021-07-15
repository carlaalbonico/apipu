<?php

    class ProductoController{

        public function CrearProducto($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $nombre = $listaDeParametros['nombre'];
            $descrip = $listaDeParametros['descrip'];
            $precio = $listaDeParametros['precio'];
            $categoria = $listaDeParametros['categoria'];

            $producto = new Producto();
            
            $producto->setNombre($nombre);
            $producto->setDesc($descrip);
            $producto->setPrecio($precio);
            $producto->setCategoria($categoria);

            Producto::guardarProducto($producto);

            $response->getBody()->write( json_encode($producto) );

            return $response;
        }

        public function RetornarProductos($request, $response, $args){

            $arrayProd = Producto::obtenerProductos();
            $response->getBody()->write(json_encode($arrayProd));
   
            return $response->withHeader('Content-Type', 'application/json');
        }




    }







?>