<?php

    class ProductoController{

        public function CrearProducto($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $nombre = $listaDeParametros['nombre'];
            $desc = $listaDeParametros['desc'];
            $precio = $listaDeParametros['precio'];
            $categoria = $listaDeParametros['categoria'];

            $producto = new Producto();
            
            $producto->setNombre($nombre);
            $producto->setTipoTurismo($tipoTurismo);
            $producto->setPais($pais);
            $producto->setProvincia($provincia);

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