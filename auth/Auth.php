<?php 

Class Auth{

    /* Función Middleware para manejar la autenticación */

    public static function middlewareAuth($app){
        $app->before(function() use ($app) {
            $route=$app->request->getURI();
            $method=$app->request->getMethod();
            if($method=="POST" || $method=="PUT" || $method=="DELETE"){ // Se restringen los metodos POST Y PUT
                //Se definen las excepciones
                $allow=["/subastas/api/usuarios/token","/subastas/api/usuarios/nuevo","/subastas/api/paises"];
                if(!in_array($route,$allow)){
                    if(($app->request->getHeader("Token"))!="") {
                        return static::validarToken($app);
                    }else{
                        $response=array(
                        "status" => 401,
                        "mensaje" => "Debes incluir el token de autenticación"
                        );
                        response($app,$response,$response['status']);
                        return false;                       
                    }
                }else
                return true;
            }else
            return true;
        });
    }

    public static function validarToken($app){
        $token=$app->request->getHeader("Token");
            $user=Usuarios::find(
                array(
                    "conditions" => "token = :token_value:",
                    'bind' => array ('token_value' => $token)
                    ));
            if(count($user)>0){
                return true;            
            }
            else{
                $response=array(
                "status" => "Forbbiden",
                "mensaje" => "El token de autenticación es incorrecto"
                );
                echo json_encode($response,JSON_PRETTY_PRINT);
                return false;
            }
    }

}
?>