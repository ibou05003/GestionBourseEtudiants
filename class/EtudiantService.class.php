<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class EtudiantService
{
    public function __construct()
    {
        Database::connect();
    }
    public static function add(Etudiant $etudiant)
    {
        RequetesEtudiant::insererEtudiant($etudiant);
        $id = RequetesEtudiant::trouveId();
        if (get_class($etudiant) == 'NonBoursier') {
            RequetesEtudiant::inserer('nonBoursier', 'adresseNB', $etudiant->getAdresse(), $id);
        } elseif (get_class($etudiant) == 'Boursier' || get_class($etudiant) == 'Loger') {
            $idType = RequetesEtudiant::trouveType($etudiant->getBourse()->getLibelle());
            RequetesEtudiant::inserer('boursier', 'idType', $idType, $id);
            if (get_class($etudiant) == 'Loger') {
                $chambre=$etudiant->getChambre();
                RequetesEtudiant::inserer('loger', 'idChambre', $chambre, $id);
            }
        }
    }
    public static function find($page,$recherche){
        $requete="SELECT * FROM etudiant WHERE matEtudiant LIKE '%$recherche%' OR nomEtudiant LIKE '%$recherche%' OR prenomEtudiant LIKE '%$recherche%' OR mailEtudiant LIKE '%$recherche%' OR telEtudiant LIKE '%$recherche%' OR naissEtudiant LIKE '%$recherche%' LIMIT ";
        RequetesEtudiant::afficheEtudiant($requete,$page,'etudiant');
    }
    public static function findAll($page){
        $requete="SELECT * FROM etudiant LIMIT ";
        RequetesEtudiant::afficheEtudiant($requete,$page,'etudiant');
    }
    public static function findBoursier($page,$recherche){
        $requete="SELECT DISTINCT * FROM etudiant,boursier,typeBourse WHERE etudiant.idEtudiant=boursier.idEtudiant AND boursier.idType=typeBourse.idType AND (matEtudiant LIKE '%$recherche%' OR nomEtudiant LIKE '%$recherche%' OR prenomEtudiant LIKE '%$recherche%' OR mailEtudiant LIKE '%$recherche%' OR telEtudiant LIKE '%$recherche%' OR naissEtudiant LIKE '%$recherche%') LIMIT ";
        RequetesEtudiant::afficheBoursier($requete,$page,'etudiant');
    }
    public static function findAllBoursier($page){
        $requete="SELECT DISTINCT * FROM etudiant,boursier,typeBourse WHERE etudiant.idEtudiant=boursier.idEtudiant AND boursier.idType=typeBourse.idType LIMIT ";
        RequetesEtudiant::afficheBoursier($requete,$page,'etudiant');
    }
    public static function findLoger($page,$recherche){
        $requete="SELECT DISTINCT * FROM etudiant,boursier,typeBourse,loger,chambre,batiment WHERE etudiant.idEtudiant=boursier.idEtudiant AND boursier.idEtudiant=loger.idEtudiant AND boursier.idType=typeBourse.idType AND loger.idchambre=chambre.idChambre AND chambre.idBat=batiment.idBat AND (matEtudiant LIKE '%$recherche%' OR nomEtudiant LIKE '%$recherche%' OR prenomEtudiant LIKE '%$recherche%' OR mailEtudiant LIKE '%$recherche%' OR telEtudiant LIKE '%$recherche%' OR naissEtudiant LIKE '%$recherche%') LIMIT ";
        RequetesEtudiant::afficheLoger($requete,$page,'etudiant');
    }
    public static function findAllLoger($page){
        $requete="SELECT DISTINCT * FROM etudiant,boursier,typeBourse,loger,chambre,batiment WHERE etudiant.idEtudiant=boursier.idEtudiant AND boursier.idEtudiant=loger.idEtudiant AND boursier.idType=typeBourse.idType AND loger.idchambre=chambre.idChambre AND chambre.idBat=batiment.idBat LIMIT ";
        RequetesEtudiant::afficheLoger($requete,$page,'etudiant');
    }
    public static function findNonBoursier($page,$recherche){
        $requete="SELECT DISTINCT * FROM etudiant,nonBoursier WHERE etudiant.idEtudiant=nonBoursier.idEtudiant AND (matEtudiant LIKE '%$recherche%' OR nomEtudiant LIKE '%$recherche%' OR prenomEtudiant LIKE '%$recherche%' OR mailEtudiant LIKE '%$recherche%' OR telEtudiant LIKE '%$recherche%' OR naissEtudiant LIKE '%$recherche%') LIMIT ";
        RequetesEtudiant::afficheNonBoursier($requete,$page,'etudiant');
    }
    public static function findAllNonBoursier($page){
        $requete="SELECT DISTINCT * FROM etudiant,nonBoursier WHERE etudiant.idEtudiant=nonBoursier.idEtudiant LIMIT ";
        RequetesEtudiant::afficheNonBoursier($requete,$page,'etudiant');
    }
    // public static function findNonLoger($page,$recherche){
    //     $requete="SELECT DISTINCT * FROM etudiant,boursier,typeBourse WHERE etudiant.idEtudiant=boursier.idEtudiant AND boursier.idEtudiant=loger.idEtudiant AND boursier.idType=typeBourse.idType AND (matEtudiant LIKE '%$recherche%' OR nomEtudiant LIKE '%$recherche%' OR prenomEtudiant LIKE '%$recherche%' OR mailEtudiant LIKE '%$recherche%' OR telEtudiant LIKE '%$recherche%' OR naissEtudiant LIKE '%$recherche%') LIMIT ";
    //     RequetesEtudiant::afficheLoger($requete,$page,'etudiant');
    // }
    public static function listeChambre($page){
        $requete="SELECT chambre.idChambre, chambre.num, chambre.nomChambre, batiment.nomBat as bat FROM chambre LEFT JOIN batiment ON chambre.idBat=batiment.idBat LIMIT ";
        RequetesChambre::afficheChambres($requete,$page,'chambre');
    }
    public static function listeBatiment($page){
        $requete="SELECT * FROM batiment LIMIT ";
        RequetesBat::afficheBatiments($requete,$page,'batiment');
    }
}
