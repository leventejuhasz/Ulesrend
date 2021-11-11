<?php

require_once 'Kijeloltfelhasznalok.php';

class Hianyzo extends Kijeloltfelhasznalok {
    
    function __construct() {
        $this->tablaNev = 'hianyzok';
    }
}


//remove_id metódus elkészítése





function remove_id($id){

    $lista = array();
    

    unset(lista($id));
    return $lista;
}


?>