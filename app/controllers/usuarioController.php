<?php
 
 class UsuarioController{

    public function ValidarUsers($request,  $response,  $args){
        //fue una prueba
        //$usr=  new Usuario();
        //$usr->nombre = "Carla";
        //$usr->pass = "1234";
        //$response->getBody()->Write(json_encode($usr) );
    
        //funciona con la BD
        $listaDeParametros = $request->getParsedBody();
        $arrayUsers = Usuario::obtenerNombre($listaDeParametros['user']);
        
        if(count($arrayUsers)==1){
                $usersBD = new Usuario();
                foreach($arrayUsers as $objUsuario){
                    foreach ($objUsuario as $atr => $valueAtr) {
                        $usersBD->{$atr} = $valueAtr;
                    }
                }
                $passBD=$usersBD->pass;
                if($usersBD->compararPass($listaDeParametros['pass'] , $passBD)){
                    $response->getBody()->write("Acceso correcto");
                }
                else{
                    $response->getBody()->write("Contraseña incorrecta");
                }
        }
        else{
            $response->getBody()->write("Usuario incorrecto");
        }
  
    return $response;

    }
    
    

    public function RegistrarUser($request, $response, $args){
        $listaDeParametros = $request->getParsedBody();

        $MiUsuario = new Usuario();
        $MiUsuario -> setUser($listaDeParametros['user']);
        $MiUsuario -> setPass($listaDeParametros['pass']);
        
       Usuario::insertarUsuario($MiUsuario);

        $response->getBody()->Write(json_encode($MiUsuario));
        return $response;
        
        
    }
    

}

?>