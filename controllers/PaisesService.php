<?php 

class PaisesService{
    
    public function listar(){

      $pais=Paises::find();        
      foreach($pais as $pa){
           $paises[]=array(
                "id" => $pa->id,
                "pais" => $pa->pais
            );
        }

        if(count($paises)>0){
            return $paises;
        }else{
            return array("status" => 404, "mensaje" => "No hay registros de usuarios");
        }
    }
}
?>


