<?php 

class PublicacionesController{
    
    public function listar($query)
    {
        $publicaciones = Publicaciones::find(array(
            Configuracion::arrayToSQLQuery($query),
             "bind" => $query
        ));
        if(count($publicaciones)>0)
        {
            return $publicaciones->toArray();
        }else
        {
            return "No existen registro de publicaciones";
        }
    }

    public function registrar($data)
    {
     
     $publicacion = new Publicaciones();

     if($publicacion->save($data))
     {
        return array("resultado" => "OK", "data" =>$data);
     }else
     {
        $errors = array();
        foreach ($publicacion->getMessages() as $message) {
                $errors[] = $message->getMessage();
        }
        return array("resultado" => "error", "data" =>$errors);

     }

    }

    public function modificar($id,$data)
    {
        $publicacion = Publicaciones::findFirst($id);

        if(is_object($publicacion)>0)
        {
            if($publicacion->save($data))
            {
                return array("resultado" => "OK", "data" =>$data);
            }
            else
            {
                $errors = array();
                foreach ($publicacion->getMessages() as $message) {
                        $errors[] = $message->getMessage();
                }
                return array("resultado" => "error", "data" =>$errors);                
            }
        }else
        {
            return array("resultado" => "error", "data" => "El registro que $id no existe");
        }
    }

    public function eliminar($id)
    {
        
        $publicacion = Publicaciones::findFirst($id);
        if(is_object($publicacion)>0)
        {
            if($publicacion->delete())
            {
                return array("resultado" => "OK", "data" => "El registro fue eliminado satisfacatoriamente");
            }
            {
                return array("resultado" => "error", "data" => "Ocurrió un error al eliminar el registro");
            }
        }else
        {
            return array("resultado" => "error", "data" => "El registro que $id no existe");
        }

    }

    public function customQuery($query)
    {
        
    }

}
?>


