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
            
            $this->validarRespuesta($return,$app);
        });

        $app->put("/publicaciones/{id:[0-9]+}",function($id) use ($app,$publicacionesController) {
            $data = (array) json_decode($app->request->getRawBody());
            $return = $publicacionesController->modificar($id,$data);

            $this->validarRespuesta($return,$app);
        });

        $app->delete("/publicaciones/{id:[0-9]+}",function($id) use ($app,$publicacionesController) {
            $return = $publicacionesController->eliminar($id);
            $this->validarRespuesta($return,$app);
        });

    }

    public function validarRespuesta($data,$app)
    {
        if($data["resultado"] == "OK")
        {
          Configuracion::response($app,$data,200);                              
        }else
        {
          Configuracion::response($app,$data,400);                                              
        }
    }

}

?>