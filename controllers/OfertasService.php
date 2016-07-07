<?php 

class OfertasService{
    
    public function listar(){
        $ofs=Ofertas::find();        
        foreach($ofs as $of){
          $ofertas[]=array(
            "id" => $of->id,
            "id_publicacion" => Publicaciones::findFirst($of->id_publicacion),
            "id_user" => Usuarios::findFirst($of->id_user),
            "monto" => $of->monto,
            "fecha_hora" => $of->fecha_hora,
            "ganador" => $of->ganador
          );
        }
    
        if(count($ofertas)>0){
            return $ofertas;
        }else{
            return array("status" => 404, "mensaje" => "No hay registros de ofertas");
        }
    }

    public function listarMax($id_publicacion){
        $ofsMax=Ofertas::maximum(array("column"=>"monto", "conditions"=>"id_publicacion=".$id_publicacion));
        $ofs = Ofertas::findFirst(array("conditions"=>'monto='.$ofsMax.' AND id_publicacion='.$id_publicacion));
        $ofs->id_publicacion = Publicaciones::findFirst($ofs->id_publicacion);
        $ofs->id_user = Usuarios::findFirst($ofs->id_user);
    
        if(count($ofs)>0){
            return $ofs;
        }else{
            return array("status" => 404, "mensaje" => "No hay registros de ofertas");
        }
    }

    public function buscarGanador($id_publicacion){
        $ganador=Ofertas::findFirst(array("conditions"=>"id_publicacion=".$id_publicacion." AND ganador=1"));
        if($ganador!=null){
            $ganador->id_publicacion = Publicaciones::findFirst($ganador->id_publicacion);
            $ganador->id_user = Usuarios::findFirst($ganador->id_user);
        }    
        if(count($ganador)>0 && $ganador!=null){
            return $ganador;
        }else{
            return array("status" => 404, "mensaje" => "No hay ofertas ganadoras para esta publicación");
        }
    }

        public function nuevo($of){

            $ofertas=new Ofertas();
        
            $fecha=new \DateTime("now");

            $data=array(
            "id_publicacion" => $of->id_publicacion,
            "id_user" => $of->id_user,
            "monto" => $of->monto,
            "ganador" => $of->ganador,
            "fecha_hora" => date("Y-m-d H:i:s")
            );

            if($ofertas->save($data)){
                    return array("status" => 201, "mensaje" => "Oferta creada existosamente","data" => $data);
            }else{
                $errors = array();
                foreach ($ofertas->getMessages() as $message) {
                    $errors[] = $message->getMessage();
                }
                return array("status" => 400, "mensajes" =>$errors);
            }
        }

        public function modificar($id,$of){
            $modificar=Ofertas::find($id);
            if(count($modificar)>0){

            $fecha=new \DateTime("now");

                $data=array(
                    "id_publicacion" => $of->id_publicacion,
                    "id_user" => $of->id_user,
                    "monto" => $of->monto,
                    "fecha_hora" => date("Y-m-d H:i:s"),
                    "ganador" => $of->ganador
                 );
                if($modificar->update($data))
                        return array("status" => 200, "mensaje" => "Oferta modificada existosamente","data" => $data);
                else{
                     $errors = array();
                    foreach ($ofertas->getMessages() as $message) {
                        $errors[] = $message->getMessage();
                    }
                    return array("status" => 400, "mensaje" =>$errors);               
                }
            }else{
                return array("status" => 404, "mensaje" =>"El registro que intenta modificar no existe");               
            }
        }

        public function eliminar($id){
            $oferta=Ofertas::find($id);
            if(count($oferta)){
            $oferta->delete();
                return array("status" => 200, "mensaje" => 'Oferta Eliminada');
            }else{
                return array("status"=>404, "mensaje"=> "La Oferta que intenta modificar no existe");
            }
    }


}
?>


