<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class RequetesEtudiant
{
    public static function insererEtudiant(Etudiant $etudiant)
    {
        $req = 'INSERT INTO etudiant (matEtudiant,nomEtudiant,prenomEtudiant,mailEtudiant,telEtudiant,naissEtudiant)
        VALUES(?,?,?,?,?,?)';
        $val = array($etudiant->getMatricule(),
            $etudiant->getNom(),
            $etudiant->getPrenom(),
            $etudiant->getMail(),
            $etudiant->getTel(),
            $etudiant->getDateNaiss());
        Database::executeUpdate($req, $val);
    }
    public static function inserer($table, $attribut, $para, $id)
    {
        $req = "INSERT INTO $table (idEtudiant,$attribut) VALUES(?,?)";
        $val = array($id, $para);
        Database::executeUpdate($req, $val);
    }
    public static function trouveId()
    {
        $req = "SELECT * FROM etudiant ORDER BY idEtudiant DESC LIMIT 1";
        $retour = Database::$base->query($req);
        while ($row = $retour->fetch()) {
            $id=$row['idEtudiant'];
            break;
        }
        return $id;
    }
    public static function trouveType($libelle){
        $req = 'SELECT * FROM typeBourse WHERE libelle=?';
        $val=array($libelle);
        $retour = Database::$base->prepare($req);
        $retour->execute($val);
        while ($row = $retour->fetch()) {
            $id=$row['idType'];
            break;
        }
        return $id;
    }

    public static function genereMatricule($nom,$prenom){
        $ch="";
        $req = "SELECT COUNT(*) as nb FROM etudiant";
        $retour = Database::$base->query($req);
        while ($row = $retour->fetch()) {
            $id=$row['nb'];
            break;
        }
        $ch=strtoupper(substr($nom,0,2)).strtoupper(substr($prenom,0,2))."-".$id;
        return $ch;
    }
    public static function genereType($id){
        $type=new TypeBourse();
        $retour=TypeBourse::selectType();
        while($data=$retour->fetch()){
            if($data['idType']==$id){
                $type->setLibelle($data['libelle']);
                $type->setMontant($data['montant']);
                break;
            }
        }
        return $type;
    }
    public static function afficheEtudiant($requete,$page,$table){
        $sql="SELECT COUNT(idEtudiant) as nb FROM $table";
        Database::connect();
        $req=Database::executeSelect($sql);
        $data=$req->fetch();

        $nb=$data['nb'];
        $nbpp=10;
        $nbpage=ceil($nb/$nbpp);
        if($nb<=10)
        $nbpage=1;

        if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
            $pc=$_GET['p'];
        }else{
            $pc=1;
        }

        
        $sql=$requete.(($pc-1)*$nbpp).",$nbpp";
        //$sql="SELECT * FROM $table LIMIT ".(($pc-1)*$nbpp).",$nbpp";
        $req=Database::executeSelect($sql);
        $i=1;
        echo '<table class="table table-striped table-hover">
                    <thead class="thead-dark">';
        Tableau::th('#');
        Tableau::th('Matricule');
        Tableau::th('Nom');
        Tableau::th('Prenom');
        Tableau::th('Email');
        Tableau::th('Telephone');
        Tableau::th('Date Naissance');
        echo '</thead>';
        while($data=$req->fetch()){
            echo '<tr>';
            Tableau::td($i);
            Tableau::td($data['matEtudiant']);
            Tableau::td($data['nomEtudiant']);
            Tableau::td($data['prenomEtudiant']);
            Tableau::td($data['mailEtudiant']);
            Tableau::td($data['telEtudiant']);
            Tableau::td($data['naissEtudiant']);
            echo '</tr>';
            $i++;
        }
        echo '<ul class="pagination">';
        for($j=1;$j<=$nbpage;$j++){
            if($j==$pc)
            {
                echo "<li class=\"page-item active\" aria-current=\"page\">
                <a class=\"page-link\" href=\"$page?p=$j\">".$j." <span class=\"sr-only\">(current)</span></a>
                </li>";
            }
            else{
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$page?p=$j\">".$j."</a></li>";
            }
            //echo "<a href=\"$page?p=$j\">".$j."</a>";
            //echo "<a href=\"../pages/listeEtudiants.php?p=$j\">".$j."</a>";
        }
        echo '</ul>';
    }
    //boursier
    public static function afficheBoursier($requete,$page,$table){
        $sql="SELECT COUNT(idEtudiant) as nb FROM $table";
        Database::connect();
        $req=Database::executeSelect($sql);
        $data=$req->fetch();

        $nb=$data['nb'];
        $nbpp=10;
        $nbpage=ceil($nb/$nbpp);
        if($nb<=10)
        $nbpage=1;

        if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
            $pc=$_GET['p'];
        }else{
            $pc=1;
        }

        
        $sql=$requete.(($pc-1)*$nbpp).",$nbpp";
        //$sql="SELECT * FROM $table LIMIT ".(($pc-1)*$nbpp).",$nbpp";
        $req=Database::executeSelect($sql);
        $i=1;
        echo '<table class="table table-striped table-hover">
                    <thead class="thead-dark">';
        Tableau::th('#');
        Tableau::th('Matricule');
        Tableau::th('Nom');
        Tableau::th('Prenom');
        Tableau::th('Email');
        Tableau::th('Telephone');
        Tableau::th('Date Naissance');
        Tableau::th('Bourse');
        Tableau::th('Montant');
        echo '</thead>';
        while($data=$req->fetch()){
            echo '<tr>';
            Tableau::td($i);
            Tableau::td($data['matEtudiant']);
            Tableau::td($data['nomEtudiant']);
            Tableau::td($data['prenomEtudiant']);
            Tableau::td($data['mailEtudiant']);
            Tableau::td($data['telEtudiant']);
            Tableau::td($data['naissEtudiant']);
            Tableau::td($data['libelle']);
            Tableau::td($data['montant']);
            echo '</tr>';
            $i++;
        }
        echo '<ul class="pagination">';
        for($j=1;$j<=$nbpage;$j++){
            if($j==$pc)
            {
                echo "<li class=\"page-item active\" aria-current=\"page\">
                <a class=\"page-link\" href=\"$page?p=$j\">".$j." <span class=\"sr-only\">(current)</span></a>
                </li>";
            }
            else{
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$page?p=$j\">".$j."</a></li>";
            }
            //echo "<a href=\"$page?p=$j\">".$j."</a>";
            //echo "<a href=\"../pages/listeEtudiants.php?p=$j\">".$j."</a>";
        }
        echo '</ul>';
    }
    //non boursier
    public static function afficheNonBoursier($requete,$page,$table){
        $sql="SELECT COUNT(idEtudiant) as nb FROM $table";
        Database::connect();
        $req=Database::executeSelect($sql);
        $data=$req->fetch();

        $nb=$data['nb'];
        $nbpp=10;
        $nbpage=ceil($nb/$nbpp);
        if($nb<=10)
        $nbpage=1;

        if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
            $pc=$_GET['p'];
        }else{
            $pc=1;
        }

        
        $sql=$requete.(($pc-1)*$nbpp).",$nbpp";
        //$sql="SELECT * FROM $table LIMIT ".(($pc-1)*$nbpp).",$nbpp";
        $req=Database::executeSelect($sql);
        $i=1;
        echo '<table class="table table-striped table-hover">
                    <thead class="thead-dark">';
        Tableau::th('#');
        Tableau::th('Matricule');
        Tableau::th('Nom');
        Tableau::th('Prenom');
        Tableau::th('Email');
        Tableau::th('Telephone');
        Tableau::th('Date Naissance');
        Tableau::th('Adresse');
        echo '</thead>';
        while($data=$req->fetch()){
            echo '<tr>';
            Tableau::td($i);
            Tableau::td($data['matEtudiant']);
            Tableau::td($data['nomEtudiant']);
            Tableau::td($data['prenomEtudiant']);
            Tableau::td($data['mailEtudiant']);
            Tableau::td($data['telEtudiant']);
            Tableau::td($data['naissEtudiant']);
            Tableau::td($data['adresseNB']);
            echo '</tr>';
            $i++;
        }
        echo '<ul class="pagination">';
        for($j=1;$j<=$nbpage;$j++){
            if($j==$pc)
            {
                echo "<li class=\"page-item active\" aria-current=\"page\">
                <a class=\"page-link\" href=\"$page?p=$j\">".$j." <span class=\"sr-only\">(current)</span></a>
                </li>";
            }
            else{
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$page?p=$j\">".$j."</a></li>";
            }
            //echo "<a href=\"$page?p=$j\">".$j."</a>";
            //echo "<a href=\"../pages/listeEtudiants.php?p=$j\">".$j."</a>";
        }
        echo '</ul>';
    }
    //logé
    public static function afficheLoger($requete,$page,$table){
        $sql="SELECT COUNT(idEtudiant) as nb FROM $table";
        Database::connect();
        $req=Database::executeSelect($sql);
        $data=$req->fetch();

        $nb=$data['nb'];
        $nbpp=10;
        $nbpage=ceil($nb/$nbpp);
        if($nb<=10)
        $nbpage=1;

        if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
            $pc=$_GET['p'];
        }else{
            $pc=1;
        }

        
        $sql=$requete.(($pc-1)*$nbpp).",$nbpp";
        //$sql="SELECT * FROM $table LIMIT ".(($pc-1)*$nbpp).",$nbpp";
        $req=Database::executeSelect($sql);
        $i=1;
        echo '<table class="table table-striped table-hover">
                    <thead class="thead-dark">';
        Tableau::th('#');
        Tableau::th('Matricule');
        Tableau::th('Nom');
        Tableau::th('Prenom');
        Tableau::th('Email');
        Tableau::th('Telephone');
        Tableau::th('Date Naissance');
        Tableau::th('Bourse');
        Tableau::th('Montant');
        Tableau::th('Chambre n°');
        Tableau::th('Batiment');
        echo '</thead>';
        while($data=$req->fetch()){
            echo '<tr>';
            Tableau::td($i);
            Tableau::td($data['matEtudiant']);
            Tableau::td($data['nomEtudiant']);
            Tableau::td($data['prenomEtudiant']);
            Tableau::td($data['mailEtudiant']);
            Tableau::td($data['telEtudiant']);
            Tableau::td($data['naissEtudiant']);
            Tableau::td($data['libelle']);
            Tableau::td($data['montant']);
            Tableau::td($data['num']);
            Tableau::td($data['nomBat']);
            echo '</tr>';
            $i++;
        }
        echo '<ul class="pagination">';
        for($j=1;$j<=$nbpage;$j++){
            if($j==$pc)
            {
                echo "<li class=\"page-item active\" aria-current=\"page\">
                <a class=\"page-link\" href=\"$page?p=$j\">".$j." <span class=\"sr-only\">(current)</span></a>
                </li>";
            }
            else{
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$page?p=$j\">".$j."</a></li>";
            }
            //echo "<a href=\"$page?p=$j\">".$j."</a>";
            //echo "<a href=\"../pages/listeEtudiants.php?p=$j\">".$j."</a>";
        }
        echo '</ul>';
    }
    //non logé
    public static function afficheNonLoger($requete,$page,$table){
        $sql="SELECT COUNT(idEtudiant) as nb FROM $table";
        Database::connect();
        $req=Database::executeSelect($sql);
        $data=$req->fetch();

        $nb=$data['nb'];
        $nbpp=10;
        $nbpage=ceil($nb/$nbpp);
        if($nb<=10)
        $nbpage=1;

        if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbpage){
            $pc=$_GET['p'];
        }else{
            $pc=1;
        }

        
        $sql=$requete.(($pc-1)*$nbpp).",$nbpp";
        //$sql="SELECT * FROM $table LIMIT ".(($pc-1)*$nbpp).",$nbpp";
        $req=Database::executeSelect($sql);
        $i=1;
        echo '<table class="table table-striped table-hover">
                    <thead class="thead-dark">';
        Tableau::th('#');
        Tableau::th('Matricule');
        Tableau::th('Nom');
        Tableau::th('Prenom');
        Tableau::th('Email');
        Tableau::th('Telephone');
        Tableau::th('Date Naissance');
        Tableau::th('Bourse');
        Tableau::th('Montant');
        echo '</thead>';
        while($data=$req->fetch()){
            echo '<tr>';
            Tableau::td($i);
            Tableau::td($data['matEtudiant']);
            Tableau::td($data['nomEtudiant']);
            Tableau::td($data['prenomEtudiant']);
            Tableau::td($data['mailEtudiant']);
            Tableau::td($data['telEtudiant']);
            Tableau::td($data['naissEtudiant']);
            Tableau::td($data['libelle']);
            Tableau::td($data['montant']);
            echo '</tr>';
            $i++;
        }
        echo '<ul class="pagination">';
        for($j=1;$j<=$nbpage;$j++){
            if($j==$pc)
            {
                echo "<li class=\"page-item active\" aria-current=\"page\">
                <a class=\"page-link\" href=\"$page?p=$j\">".$j." <span class=\"sr-only\">(current)</span></a>
                </li>";
            }
            else{
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$page?p=$j\">".$j."</a></li>";
            }
            //echo "<a href=\"$page?p=$j\">".$j."</a>";
            //echo "<a href=\"../pages/listeEtudiants.php?p=$j\">".$j."</a>";
        }
        echo '</ul>';
    }
    public static function checkStatut($recherche){
        $requete="SELECT DISTINCT * FROM etudiant,boursier,typeBourse,loger,chambre,batiment WHERE etudiant.idEtudiant=boursier.idEtudiant AND boursier.idEtudiant=loger.idEtudiant AND boursier.idType=typeBourse.idType AND loger.idchambre=chambre.idChambre AND chambre.idBat=batiment.idBat AND (matEtudiant LIKE '%$recherche%' OR nomEtudiant LIKE '%$recherche%' OR prenomEtudiant LIKE '%$recherche%' OR mailEtudiant LIKE '%$recherche%' OR telEtudiant LIKE '%$recherche%' OR naissEtudiant LIKE '%$recherche%') LIMIT ";
        
    }
}

    
    
    
    
  