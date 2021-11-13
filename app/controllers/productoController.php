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

        public function ModificarProductos($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $id = $args['id']; 
            $nombre = $listaDeParametros['nombre'];
            $descrip = $listaDeParametros['descrip'];
            $precio = $listaDeParametros['precio'];
            $categoria = $listaDeParametros['categoria'];

            $producto = new Producto();
            $producto->setId($id);
            $producto->setNombre($nombre);
            $producto->setDesc($descrip);
            $producto->setPrecio($precio);
            $producto->setCategoria($categoria);

            Producto::modificarProducto($producto);

            $response->getBody()->write( "Se actualizó producto correctamente" );

            return $response;
        }

        public function BorrarProductos($request, $response, $args){
            
            $id = $args['id']; 
            

            $producto = new Producto();
            $producto->setId($id);
            
            Producto::borrarProducto($producto);

            $response->getBody()->write( "Se borró producto correctamente" );

            return $response;
        }



    }







?>