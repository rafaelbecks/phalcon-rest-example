<?php

/* Entidad Ofertas */

use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\PresenceOf;

class Ofertas extends Model{

      public function initialize()
      {
        $this->setSource("ofertas");
        $this->hasOne("id_publicacion","Publicaciones","id");
        $this->hasOne("id_user","Usuarios","id");
      }

 /* Validaciones */

     public function validation()
        {

            $this->validate(new PresenceOf(
                array(
                    "field" => "id_publicacion",
                    "message" => "El campo id_publicacion es obligatorio"
                    )
                ));
            

        if ($this->validationHasFailed() == true) {
            return false;
        }

        }

}


Ofertas

