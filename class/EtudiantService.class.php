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
}
