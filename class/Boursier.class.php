<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class Boursier extends Etudiant
{
    private $bourse;
    public function __construct($matE = '', $nomE = '', $prenomE = '', $mailE = '', $telE = '', $datNaissE = '',TypeBourse $bourse)
    {
        parent::__construct($matE,$nomE,$prenomE,$mailE,$telE,$datNaissE);
        $this->bourse=$bourse;
    }

    /**
     * Get the value of bourse
     */ 
    public function getBourse()
    {
        return $this->bourse;
    }

    /**
     * Set the value of bourse
     *
     * @return  self
     */ 
    public function setBourse($bourse)
    {
        $this->bourse = $bourse;

        return $this;
    }
}
