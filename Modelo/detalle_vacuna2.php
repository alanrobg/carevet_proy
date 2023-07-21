<?php


class detalle_vacuna2 {
    
    private $nomvacuna;
    private $desvacuna;
    private $fechadetalle;
    private $fechaproxdetalle;
    private $obsvacuna;
    
    function __construct($nomvacuna,$desvacuna,$fechadetalle,$fechaproxdetalle,$obsvacuna) {
        $this->nomvacuna=$nomvacuna;
        $this->desvacuna=$desvacuna;
        $this->fechadetalle=$fechadetalle;
        $this->fechaproxdetalle=$fechaproxdetalle;
        $this->obsvacuna=$obsvacuna;
    }
    
    function getNomvacuna() {
        return $this->nomvacuna;
    }

    function getDesvacuna() {
        return $this->desvacuna;
    }

    function getFechadetalle() {
        return $this->fechadetalle;
    }

    function getFechaproxdetalle() {
        return $this->fechaproxdetalle;
    }

    function getObsvacuna() {
        return $this->obsvacuna;
    }

    function setNomvacuna($nomvacuna) {
        $this->nomvacuna = $nomvacuna;
    }

    function setDesvacuna($desvacuna) {
        $this->desvacuna = $desvacuna;
    }

    function setFechadetalle($fechadetalle) {
        $this->fechadetalle = $fechadetalle;
    }

    function setFechaproxdetalle($fechaproxdetalle) {
        $this->fechaproxdetalle = $fechaproxdetalle;
    }

    function setObsvacuna($obsvacuna) {
        $this->obsvacuna = $obsvacuna;
    }


}
