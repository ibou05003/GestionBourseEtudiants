<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class NonBoursier extends Etudiant
{
    private $adresse;
    public function __construct($matE = '', $nomE = '', $prenomE = '', $mailE = '', $telE = '', $datNaissE = '',$adresse="")
    {
        parent::__construct($matE,$nomE,$prenomE,$mailE,$telE,$datNaissE);
        $this->adresse=$adresse;
    }
   

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }
}
