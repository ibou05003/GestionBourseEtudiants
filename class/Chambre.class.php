<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class Chambre
{
    private $nom;
    private $batiment;
    public function __construct($nom="")
    {
        $this->nom=$nom;
    }
    

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
    public function add($nom,$id){
        RequetesChambre::insererChambre($nom,$id);
    }
    public function lister(){
        RequetesChambre::afficherChambres();
    }
}
