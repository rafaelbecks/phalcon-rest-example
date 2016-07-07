<?php

/* Entidad Publicaciones */

use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness,
    Phalcon\Mvc\Model\Validator\PresenceOf;

class Publicaciones extends Model{
     public function initialize()
    {
        $this->hasMany("id_publicacion", "Ofertas", "id");
    }

 /* Validaciones */
 public function validation()
    {
       $this->validate(new PresenceOf(
            array(
                "field"  => "titulo",
                "message" => "Debes incluir el titulo de la publicacion"
            )
        ));

       $this->validate(new PresenceOf(
            array(
                "field"  => "descripcion",
                "message" => "Debes incluir el contenido de la publicacion"
            )
        ));

        $this->validate(new PresenceOf(
            array(
                "field"  => "horario",
                "message" => "El idioma es requerido"
            )
        ));


       $this->validate(new PresenceOf(
            array(
                "field"  => "monto_min",
                "message" => "Debes incluir el id del autor de la publicacion"
            )
        ));

       $this->validate(new PresenceOf(
            array(
                "field"  => "intervalo",
                "message" => "Debes incluir el status de la publicación"
            )
        ));
        
       $this->validate(new PresenceOf(
            array(
                "field"  => "fecha_inicio",
                "message" => "Debes incluir el status de la publicación"
            )
        ));

        if ($this->validationHasFailed() == true) {
            return false;
        }

    }

}