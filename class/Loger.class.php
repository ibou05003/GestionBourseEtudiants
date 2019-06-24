<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class Loger extends Boursier
{
    private $chambre;
    public function __construct($matE = '', $nomE = '', $prenomE = '', $mailE = '', $telE = '', $datNaissE = '',TypeBourse $bourse,$chambre)
    {
        parent::__construct($matE,$nomE,$prenomE,$mailE,$telE,$datNaissE,$bourse);
        $this->chambre=$chambre;
    }
   

    /**
     * Get the value of chambre
     */ 
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * Set the value of chambre
     *
     * @return  self
     */ 
    public function setChambre($chambre)
    {
        $this->chambre = $chambre;

        return $this;
    }
}
