<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class User
{
    private $login;
    private $pwd;
    private $nom;
    private $tel;
    private $adresse;
    private $profil;
    public function __construct($login="",$pwd="",$nom="",$tel="",$adresse="",$profil="")
    {
        $this->login=$login;
        $this->pwd=$pwd;
        $this->nom=$nom;
        $this->tel=$tel;
        $this->adresse=$adresse;
        $this->profil=$profil;
    }

    /**
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of pwd
     */ 
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */ 
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
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
     * Get the value of tel
     */ 
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set the value of tel
     *
     * @return  self
     */ 
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
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

    /**
     * Get the value of profil
     */ 
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set the value of profil
     *
     * @return  self
     */ 
    public function setProfil($profil)
    {
        $this->profil = $profil;

        return $this;
    }
    public function add($user){
        $req = "INSERT INTO users (loginU,pwdU,nom,tel,adresse,profil)
        VALUES(?,?,?,?,?,?)";
        $val = array($user->getLogin(),
            $this->getPwd(),
            $this->getNom(),
            $this->getTel(),
            $this->getAdresse(),
            $this->getProfil());
        Database::executeUpdate($req, $val);
    }
    public static function connexion($login,$pwd){
        $req = 'SELECT * FROM users';
        $ok=false;
        $retour=Database::executeSelect($req);
        while($data=$retour->fetch()){
            if($data['loginU']==$login && $data['pwdU']==$pwd)
            {
                $_SESSION['nom']=$data['nom'];
                $_SESSION['profil']=$data['profil'];
                $ok=true;
            }
        }
        return $ok;
    }
}
