<?php
require_once 'Autoloader.class.php';
Autoloader::register();
Database::connect();
$et = new EtudiantService();
$bourse=new TypeBourse('Demi',20000);
$etudiant=new Loger('m55','guisszo','ibrahima','ibou@ibou',774545214,'1999-10-10',$bourse,1);
EtudiantService::add($etudiant);
/*$et->add($et);
$et->lister();
*/
//$ret=Batiment::getIdByNom('a2');
// $id=RequetesEtudiant::trouveType('Demi');
// echo $id;
