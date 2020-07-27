<?php
require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
//obteniedo el metodo http
$method = $_SERVER['REQUEST_METHOD'];

if($method == "GET") {
    if(!empty($_GET['id'])){
       $id = $_GET['id'];
       $json = null;
       $api = new Api();
       $vector = $api->getLibro($id);
       $json = json_encode($vector);
       echo $json; 
    }else{
       $vector = array();
       $api = new Api();
       $vector = $api->getLibros();
       $json = json_encode($vector);
       echo $json;
    }
   
}

if($method == "POST"){
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $nombre = $data['nombre'];
    $edicion = $data['edicion'];
    $api = new Api();
    $json = $api->addLibro($nombre, $edicion);
    echo $json;
}

if($method=="DELETE"){
    $json = null;
    $id = $_REQUEST['id'];
    $api = new Api();
    $json = $api->deleteLibro($id);
    echo $json;
}

if($method == "PUT"){
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $nombre = $data['nombre'];
    $edicion = $data['edicion'];
    $api = new Api();
    $json = $api->updateLibro($id, $nombre, $edicion);
    echo $json;
}



?>