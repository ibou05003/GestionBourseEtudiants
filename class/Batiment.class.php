<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class Batiment
{
    private $nom;

    public function __construct($nom = '')
    {
        $this->nom = $nom;
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
    public function add($nom)
    {
        RequetesBat::insererBat($nom);
    }
    public function lister()
    {
        RequetesBat::afficherBats();
    }
    public static function afficheUnBatiment($id)
    {
        RequetesBat::afficherUnBat($id);
    }
    /*public static function getIdByNom($nom)
    {
        $req = 'SELECT idBat FROM batiment WHERE nomBat='.$nom;
        $retour = Database::executeSelect($req);
        while ($data = $retour->fetch())
            echo $data['idBat'];
    }*/
}
