<?php 

class UsuariosPublicacionesService{
    
    public function listar(){

      $users_pubs=UsuariosPublicaciones::find();
      $up = null;    
      foreach($users_pubs as $pa){
           $up[]=array(
                "id" => $pa->id,
                "id_user" => $pa->id_user,
                "id_publicacion" => $pa->id_publicacion
            );
        }

        if(count($up)>0){
            return $up;
        }else{
            return array("status" => 404, "mensaje" => "No hay registros de usuarios por publicaciones");
        }
    }

    public function buscar($id){
        $up = UsuariosPublicaciones::findFirst(array("conditions"=>"id=".$id));
        if(count($up)>0){
                  $users_pubs[]=array(
                    "id" => $up->id,
                    "id_user" => $up->id_user,
                    "id_publicacion" => $up->id_publicacion
                );
            return $users_pubs;
        }else{
            return array("status" => 404, "mensaje"=>"No existe el registro de usuario por publicacion");
        }
    }

    public function nuevo($us){

            $users_pubs=new UsuariosPublicaciones();
    
            $data=array(
                "id_user" => $us->id_user,
                "id_publicacion" => $us->id_publicacion
            );

            if($users_pubs->save($data)){
                    return array("status" => 201, "mensaje" => "UsuarioPublicacion creado existosamente","data" => $data);
            }else{
                $errors = array();
                foreach ($usuarios->getMessages() as $message) {
                    $errors[] = $message->getMessage();
                }
                return array("status" => 400, "mensajes" =>$errors);
            }
        }

    public function eliminar($id){
            $users_pubs=UsuariosPublicaciones::find($id);
            if(count($users_pubs)){
            $users_pubs->delete();
                return array("status" => 200, "mensaje" => 'Usuario por publicacion Eliminado');
            }else{
                return array("status"=>404, "mensaje"=> "El registro intenta modificar no existe");
            }
       }
}
?>


