<?php
require_once 'etudiant.class.php';
require_once 'typeBourse.class.php';
require_once 'requetes.php';
class Boursier extends Etudiant
{
    private $bourse;
    public function __construct($matE = '', $nomE = '', $prenomE = '', $mailE = '', $telE = '', $datNaissE = '')
    {
        parent::__construct($matE,$nomE,$prenomE,$mailE,$telE,$datNaissE);
    }
    /*public function add($matE,$nomE,$prenomE,$mailE,$telE,$datNaissE){
Requetes::insererEtudiant($matE,$nomE,$prenomE,$mailE,$telE,$datNaissE);
}*/
}
