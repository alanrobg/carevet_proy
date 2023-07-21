<?php

class vacuna {
    
    private $id_vac;
    private $nom_vac;
    private $des_vac;
    
    function __construct($id_vac,$nom_vac,$des_va) {
       $this->$id_vac = $id_vac;
       $this->$nom_vac = $nom_vac;
       $this->$des_va = $des_va;
    }
    
    function getId_vac() {
        return $this->id_vac;
    }

    function getNom_vac() {
        return $this->nom_vac;
    }

    function getDes_vac() {
        return $this->des_vac;
    }

    function setId_vac($id_vac) {
        $this->id_vac = $id_vac;
    }

    function setNom_vac($nom_vac) {
        $this->nom_vac = $nom_vac;
    }

    function setDes_vac($des_vac) {
        $this->des_vac = $des_vac;
    }


    
}