<?php

/* Entidad Usuarios */

use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness,
    Phalcon\Mvc\Model\Validator\PresenceOf,
    Phalcon\Mvc\Model\Validator\Email;

class Usuarios extends Model{
    public function initialize()
    {
    }
 /* Validaciones */
 public function validation()
    {

        $this->validate(new PresenceOf(
            array(
                "field" => "email",
                "message" => "El campo email es obligatorio"
                )
            ));
            
        $this->validate(new PresenceOf(
            array(
                "field" => "password",
                "message" => "El campo password es obligatorio"
                )
            ));
            
        $this->validate(new PresenceOf(
            array(
                "field" => "seudonimo",
                "message" => "El campo seudonimo es obligatorio"
                )
            ));
            
        $this->validate(new PresenceOf(
            array(
                "field" => "nombre_completo",
                "message" => "El campo nombre_completo es obligatorio"
                )
            ));
            
        $this->validate(new PresenceOf(
            array(
                "field" => "pais",
                "message" => "El campo pais es obligatorio"
                )
            ));
            
        $this->validate(new PresenceOf(
            array(
                "field" => "nivel",
                "message" => "El campo nivel es obligatorio"
                )
            ));
            
        $this->validate(new PresenceOf(
            array(
                "field" => "primera_vez",
                "message" => "El campo primera_vez es obligatorio"
                )
            ));
            
        $this->validate(new PresenceOf(
            array(
                "field" => "token",
                "message" => "El campo token es obligatorio"
                )
            ));
            
        $this->validate(new PresenceOf(
            array(
                "field" => "autorizacion",
                "message" => "El campo autorizacion es obligatorio"
                )
            ));
            
       $this->validate(new Uniqueness(
            array(
                "field"  => "email",
                "message" => "El email ya está registrado"
            )
        ));

      $this->validate(new Email(
            array(
                "field"  => "email",
                "message" => "El email debe ser válido"
            )
        ));

        if ($this->validationHasFailed() == true) {
            return false;
        }


    }

}