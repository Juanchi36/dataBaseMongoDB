<?php

require './vendor/autoload.php';
require 'Persona.php';

class dataBase
{
    private $collection;
    

    public function __construct()
    {
        $connection = new MongoDB\Client("mongodb://localhost:27017");
        $this->collection = $connection->dbPersonas->personas; 
            
    }
    public function get($dni)
    {
        /* $file = $this-> readFromDb();
        return $file[$id]; */
        if($this->collection->findOne(['dni' => $dni])){
            return $this->collection->findOne(['dni' => $dni]);
        }else{
            echo 'No existe el registro';
        }
        
               
    }
    public function insert(Persona $persona)
    {
        /* $file = $this->readFromDb();
        if(!isset($file[$id])){
            $file[$id] = $value;
            $this->writeOnDb();
        } */
        if($this->collection->findOne(['dni' => $persona->getDni()])){
            echo 'Ya existe este registro';
        }else{
            return $this->collection->insertOne($persona->serializador());
        }
    }
    public function update(Persona $persona, $campo, $valor)
    {
        /* $file = $this->readFromDb();
        if(isset($file[$id])){
            $file[$id] = $value;
            $this->writeOnDb();
        } */
        if($this->collection->findOne(['dni' => $persona->getDni()])){
            //if( aca validaria que el campo exista o no ?)
            echo 'Registro modificado';
            return $this->collection->updateOne(['dni' => $persona->getDni()], ['$set' => [$campo => $valor]]);
        }else{
            echo 'No se puede modificar el registro porque no existe';
        }
    }
    public function delete(Persona $persona)
    {
        /* $file = $this->readFromDb();
        if(isset($file[$id])){
            unset($file[$id]);
            $this->writeOnDb();
        } */
        if($this->collection->findOne(['dni' => $persona->getDni()])){
            echo 'Registro eliminado';
            return $this->collection->deleteOne(['dni' => $persona->getDni()]);
        }else{
            echo 'No se puede borrar, registro inexistente';
        }
    }
    /* private function readFromDb()
    {
        return json_decode(file_get_contents($this->db), true);
    }
    private function writeOnDb()
    {
        return file_put_contents($this->db, json_encode($this->readFromDb()));
    } */
}
$a = array('dni' => 23876903, 'nombre' => 'juan', 'apellido' => 'perez');
$b = array('dni' => 26556677, 'nombre' => 'carlos', 'apellido' => 'lopez');
$c = array('dni' => 26556678, 'nombre' => 'raul', 'apellido' => 'gomez');

$p = new Persona($a);
$p2 = new Persona($b);
$p3 = new Persona($c);
$db = new dataBase();
$db->insert($p3);

$db->update($p, 'nombre', 'Braulio');
echo "\n";
echo $db->get(23876903)['nombre'];
echo "\n";
echo $db->get(26556678)['nombre'];
echo "\n";
//$db->delete($p3);
echo $db->get(26556678)['nombre'];

