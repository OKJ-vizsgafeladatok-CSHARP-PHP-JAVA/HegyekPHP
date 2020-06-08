<?php

class Hegyek {

    private $hegyNev;
    private $hegyseg;
    private $magassag;
    
    function __construct($hegyNev, $hegyseg, $magassag) {
        $this->hegyNev = $hegyNev;
        $this->hegyseg = $hegyseg;
        $this->magassag = $magassag;
    }

    function getHegyNev() {
        return $this->hegyNev;
    }

    function getHegyseg() {
        return $this->hegyseg;
    }

    function getMagassag() {
        return $this->magassag;
    }

    function setHegyNev($hegyNev): void {
        $this->hegyNev = $hegyNev;
    }

    function setHegyseg($hegyseg): void {
        $this->hegyseg = $hegyseg;
    }

    function setMagassag($magassag): void {
        $this->magassag = $magassag;
    }


}
