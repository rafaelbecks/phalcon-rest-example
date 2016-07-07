<?php 

class UsuariosService{
    
    public function listar(){

      $usuarios=Usuarios::find();        
      foreach($usuarios as $us){
           $users[]=array(
                "id" => $us->id,
                "email" => $us->email,
                "seudonimo" => $us->seudonimo,
                "pagina_web" => $us->pagina_web,
                "nombre_completo" => $us->nombre_completo,
                "pais" => Paises::findFirst($us->pais),
                "nivel" => $us->nivel,
                "primera_vez" => $us->primera_vez,
                "token" => $us->token,
                "autorizacion" => $us->autorizacion
            );
        }
        if(count($users)>0){
            return $users;
        }else{
            return array("status" => 404, "mensaje" => "No hay registros de usuarios");
        }
    }

        public function nuevo($us){

            $usuarios=new Usuarios();
    
            $data=array(
                "email" => $us->email,
                "password" => md5($us->password),
                "seudonimo" => $us->seudonimo,
                "pagina_web" => $us->pagina_web,
                "nombre_completo" => $us->nombre_completo,
                "pais" => $us->pais,
                "nivel" => $us->nivel,
                "primera_vez" => 1,
                "token" => md5($us->email.$us->password),
                "autorizacion" => 0
            );

            if($usuarios->save($data)){
                    return array("status" => 201, "mensaje" => "Usuario craeado existosamente","data" => $data);
            }else{
                $errors = array();
                foreach ($usuarios->getMessages() as $message) {
                    $errors[] = $message->getMessage();
                }
                return array("status" => 400, "mensajes" =>$errors);
            }
        }

        public function modificar($id,$us){
            $modificar=Usuarios::find($id);
            if(count($modificar)>0){
                if(isset($us->password) && $us->password !== '' && $us->password !== null && $us->password !== 'undefined'){
                    $pass = md5($us->password);
                }else{
                    $pass = $modificar[0]->password;
                }
                $data=array(
                    
                    "email" => $us->email,
                    "password" => $pass,
                    "seudonimo" => $us->seudonimo,
                    "pagina_web" => $us->pagina_web,
                    "nombre_completo" => $us->nombre_completo,
                    "pais" => $us->pais,
                    "nivel" => $us->nivel,
                    "primera_vez" => $us->primera_vez,
                    "token" => md5($us->email.$pass),
                    "autorizacion" => $us->autorizacion
                );

                if($modificar->update($data))
                        return array("status" => 200, "mensaje" => "Usuario modificado existosamente","data" => $data);
                else{
                     $errors = array();
                    foreach ($usuarios->getMessages() as $message) {
                        $errors[] = $message->getMessage();
                    }
                    return array("status" => 400, "mensaje" =>$errors);               
                }
            }else{
                return array("status" => 404, "mensaje" =>"El registro que intenta modificar no existe");               
            }
        }

        public function eliminar($id){
            $Usuario=Usuarios::find($id);
            if(count($Usuario)){
            $Usuario->delete();
                return array("status" => 200, "mensaje" => 'Usuario Eliminado');
            }else{
                return array("status"=>404, "mensaje"=> "El registro intenta modificar no existe");
            }
       }

        public function solicitarToken($credentials){

        if(isset($credentials->email) && isset($credentials->password)){
            
            $user=Usuarios::find(array("email='".utf8_encode($credentials->email)."' AND password ='".md5($credentials->password)."' AND autorizacion=1"));
            if(count($user)==0){
                    $mensaje=array(
                    "email"=>$credentials->email,
                    "error"=>"Credenciales incorrectas"
                    );      
                    $datos=array("status"=>401, "data" => $mensaje);
                }else{
                    $datos=array(
                    "status" => 200,
                    "id"=>$user[0]->id,
                    "email"=>$user[0]->email,
                    "hash_mail"=>md5($user[0]->email),
                    "seudonimo"=>$user[0]->seudonimo,
                    "token"=> $user[0]->token,
                    "nombre_completo" => $user[0]->nombre_completo,
                    "pais" => $user[0]->pais,
                    "nivel" => $user[0]->nivel,
                    "primera_vez" => $user[0]->primera_vez,
                    "autorizacion" => $user[0]->autorizacion
                    );          
                }

                return $datos;
        }else{
            return array("status" => 300, "mensaje" => "Debes incluir tus credenciales");
        }

         }



}
?>


