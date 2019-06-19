<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class Etudiant
{
    private $matricule = null;
    private $nom = null;
    private $prenom = null;
    private $mail = null;
    private $tel = null;
    private $datNaiss = null;

    public function __construct($matE = '', $nomE = '', $prenomE = '', $mailE = '', $telE = '', $datNaissE = '')
    {
        $this->matricule = $matE;
        $this->nom = $nomE;
        $this->prenom = $prenomE;
        $this->mail = $mailE;
        $this->tel = $telE;
        $this->dateNaiss = $datNaissE;
    }
    public function getMatricule()
    {
        return $this->matricule;
    }
    /*public function setMatricule($matE){
    $this->matricule=$matE;
    }*/
    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nomE)
    {
        $this->nom = $nomE;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenomE)
    {
        $this->prenom = $prenomE;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function setMail($mailE)
    {
        $this->mail = $mailE;
    }
    public function getTel()
    {
        return $this->tel;
    }
    public function setTel($telE)
    {
        $this->tel = $telE;
    }
    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }
    public function setDateNaiss($datNaissE)
    {
        $this->dateNaiss = $datNaissE;
    }
    public function add($matE,$nomE,$prenomE,$mailE,$telE,$datNaissE){
RequetesEtudiant::insererEtudiant($matE,$nomE,$prenomE,$mailE,$telE,$datNaissE);
}
}
