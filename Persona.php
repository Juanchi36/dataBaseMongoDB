<?php

class Persona
{
    private $dni;
    private $nombre;
    private $apellido;

    public function __construct($array)
    {
        $this->dni = $array['dni'];
        $this->nombre = $array['nombre'];
        $this->apellido = $array['apellido'];

    }
    public function getDni()
    {
        return $this->dni;
    }

    public function serializador(){
        // es para agarrar una persona y converirlo en array para poder guardar en la base
        /* return "['dni'=>$this->dni,'nombre'=>$this->nombre,'apellido'=>$this->apellido
        ]"; */
        $arr = array('dni' => $this->dni, 'nombre' => $this->nombre, 'apellido' => $this->apellido);
        return $arr;
    }
    
}
/* $a = array('dni' => 23876903, 'nombre' => 'juan', 'apellido' => 'perez');
$p = new Persona($a);
echo( $p->serializador()); */