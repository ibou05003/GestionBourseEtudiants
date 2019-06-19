<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class TypeBourse
{
    private $libelle;
    private $montant;

    public function __construct($lib = '', $mt = '')
    {
        $this->libelle = $lib;
        $this->montant = $mt;
    }
    public function getLibelle()
    {
        return $this->libelle;
    }
    public function setLibelle($lib)
    {
        $this->libelle = $lib;
    }
    public function getMontant()
    {
        return $this->montant;
    }
    public function setMontant($mt)
    {
        $this->montant = $mt;
    }

}
