<?php
 
class Api{

public function getLibros(){
     $vector = array();
     $conexion = new Conexion();
     $db = $conexion->getConexion();
     $sql = "SELECT * FROM libro";
     $consulta = $db->prepare($sql);
     $consulta->execute();
     while($fila = $consulta->fetch()) {
        $vector[] = array(
          "id" => $fila['id'],
          "nombre" => $fila['nombre'],
          "edicion" =>  $fila['edicion']); }

     return $vector;
}

public function addLibro($nombre, $edicion){
  
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "INSERT INTO libro (nombre, edicion) VALUES (:nombre,:edicion)";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':nombre', $nombre);
  $consulta->bindParam(':edicion', $edicion);
  $consulta->execute();

  return '{"msg":"libro agregado"}';
}

public function deleteLibro($id){
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "DELETE FROM libro WHERE id=:id";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':id', $id); 
  $consulta->execute();

  return '{"msg":"libro eliminado"}';
}

public function getLibro($id){
  $vector = array();
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "SELECT id, nombre, edicion FROM libro WHERE id=:id";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':id', $id);
  $consulta->execute();
  while($fila = $consulta->fetch()) {
     $vector[] = array(
       "id" => $fila['id'],
       "nombre" => $fila['nombre'],
       "edicion" =>  $fila['edicion']); }

  return $vector[0];
}

public function updateLibro($id, $nombre, $edicion){
  
  $conexion = new Conexion();
  $db = $conexion->getConexion();
  $sql = "UPDATE libro SET nombre=:nombre, edicion=:edicion WHERE id=:id";
  $consulta = $db->prepare($sql);
  $consulta->bindParam(':id', $id);  
  $consulta->bindParam(':nombre', $nombre);
  $consulta->bindParam(':edicion', $edicion);
  $consulta->execute();

  return '{"msg":"libro actualizado"}';
}



}
?>