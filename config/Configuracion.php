<?php

class Configuracion
{

    public static function getDI()
    {

        $di = new \Phalcon\DI\FactoryDefault();

        $di->set('db', function(){
            return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
                "host" => "127.0.0.1",
                "username" => "root",
                "password" => "11235813",
                "dbname" => "subastas",
                'charset'     => 'utf8'
                ));
        });    

        return $di;
    }

    public static function response($app,$data,$status){

        $response = new \Phalcon\Http\Response();

        $response->setStatusCode($status);

        $response->setContentType('application/json');

        $response->setContent(json_encode($data,JSON_PRETTY_PRINT));

        $response->send();
    } 

    public static function arrayToSQLQuery($array){

    $sql = "";

    foreach ($array as $key => $value) {
        $sql.=$key."= :".$key.": AND ";
    }

    return substr($sql,0,strlen($sql)-4);
}    





}



 ?>