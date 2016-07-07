<?php

class PublicacionesRoutes
{

    public function __construct($app)
    {

        $publicacionesController = new PublicacionesController();

        $app->get("/publicaciones",function() use ($app,$publicacionesController) {

            $data = $publicacionesController->listar();

            if(is_array($data))
            {
                Configuracion::response($app,["data" => $data],200);                
            }else
            {
                Configuracion::response($app,["data" => $data],404);                
            }


        });

        $app->post("/publicaciones",function() use ($app,$publicacionesController) {
            
            $data = (array) json_decode($app->request->getRawBody());
            
            $return = $publicacionesController->registrar($data);
            
            if($return["resultado"] == "OK")
            {
              Configuracion::response($app,$return,201);                              
            }else
            {
              Configuracion::response($app,$return,400);                                              
            }
        });

        $app->put("/publicaciones/{id:[0-9]+}",function($id) use ($app,$publicacionesController) {
            $data = (array) json_decode($app->request->getRawBody());
            $return = $publicacionesController->modificar($id,$data);

             Configuracion::response($app,$return,200);                              
        });

        $app->delete("/publicaciones/{id:[0-9]+}",function($id) use ($app) {
            echo "Eliminar publicacion numero $id";
        });

    }

}

?>