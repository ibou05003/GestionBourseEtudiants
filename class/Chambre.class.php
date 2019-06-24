<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class Chambre
{
    private $nom;
    private $num;
    private $batiment;
    public function __construct($num = "",$nom = "", $batiment = "")
    {
        $this->nom = $nom;
        $this->num = $num;
        $this->batiment = $batiment;
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
    /**
     * Get the value of num
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set the value of num
     *
     * @return  self
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get the value of batiment
     */
    public function getBatiment()
    {
        return $this->batiment;
    }

    /**
     * Set the value of batiment
     *
     * @return  self
     */
    public function setBatiment($batiment)
    {
        $this->batiment = $batiment;

        return $this;
    }
    public function add(Chambre $chambre)
    {
        Database::connect();
        $req = 'INSERT INTO chambre (num,nomChambre,idBat) VALUES(?,?,?)';
        $val = array($chambre->getNum(), $chambre->getNom(), $chambre->getBatiment());
        Database::executeUpdate($req, $val);
    }
    public function lister()
    {
        try {
            $req = 'SELECT chambre.num, chambre.nomChambre,batiment.nomBat as bat FROM chambre LEFT JOIN batiment ON chambre.idBat=batiment.idBat';
            $retour = Database::executeSelect($req);
            RequetesChambre::afficherChambres($retour);
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
    }
}
