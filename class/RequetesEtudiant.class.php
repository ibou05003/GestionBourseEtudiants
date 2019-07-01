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
    //non logé
    public static function afficheStatut($requete1,$requete2,$requete3,$requete4,$recherche){
        
        //$sql="SELECT * FROM $table LIMIT ".(($pc-1)*$nbpp).",$nbpp";
        //Database::connect();
        $req1=Database::executeUpdate1($requete1,array($recherche));
        $req2=Database::executeUpdate1($requete2,array($recherche));
        $req3=Database::executeUpdate1($requete3,array($recherche));
        $req4=Database::executeUpdate1($requete4,array($recherche,$recherche));
        
       $nb1=$req1->rowCount();
        $nb2=$req2->rowCount();
        $nb3=$req3->rowCount();
        $nb4=$req4->rowCount();
        if($nb1!=0 || $nb2!=0 || $nb3!=0 || $nb4!=0){
            if($nb1!=0)
            {
                $req=$req1;
                $statut='Boursier Et Logé';
            }
            elseif($nb2!=0)
            {
                $req=$req2;
                $statut='Boursier';
            }                
            elseif($nb3!=0)
            {
                $req=$req3;
                $statut='Non Boursier';
            }
                
            elseif($nb4!=0)
            {
                $req=$req4;
                $statut='Boursier Non Logé';
            }
            $data=$req->fetch();
            ?>
            <div class="container">
                <div class="row">
                <div class="input-group mb-3 col-12 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-graduate"></i></span>
                    </div>
                    <input type="text" name="nom" value="<?php echo $data['nomEtudiant'] ?>" class="form-control">
                </div>
                <div class="input-group mb-3 col-12 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-graduate"></i></span>
                    </div>
                    <input type="text" name="prenom" value="<?php echo $data['prenomEtudiant'] ?>" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                    </div>
                    <input type="email" name="mail" value="<?php echo $data['mailEtudiant'] ?>" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-12 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="number" name="tel" value="<?php echo $data['telEtudiant'] ?>" class="form-control">
                </div>
                <div class="input-group mb-3 col-12 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" name="dateNaiss" value="<?php echo $data['naissEtudiant'] ?>" class="form-control">
                </div>
            </div>
            <?php 
                if($nb1!=0){
                    ?>
                    <div class="row">
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-bed"></i></span>
                            </div>
                            <input type="text" name="statut" value="<?php echo $statut ?>" class="form-control">
                        </div>
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-coins"></i></span>
                            </div>
                            <input type="text" name="statut" value="<?php echo $data['libelle']." : ".$data['montant']."F" ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-building"></i></span>
                            </div>
                            <input type="text" name="statut" value="<?php echo "Batiment :".$data['nomBat'] ?>" class="form-control">
                        </div>
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-bed"></i></span>
                            </div>
                            <input type="text" name="statut" value="<?php echo "Chambre n°:".$data['num'] ?>" class="form-control">
                        </div>
                    </div>
                    <?php 
                }
                elseif($nb2!=0){
                    ?>
                    <div class="row">
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-coins"></i></span>
                            </div>
                            <input type="text" name="statut" value="<?php echo $statut ?>" class="form-control">
                        </div>
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-coins"></i></span>
                            </div>
                            <input type="text" name="statut" value="<?php echo $data['libelle']." : ".$data['montant']."F" ?>" class="form-control">
                        </div>
                    </div>
                    <?php 
                }
                elseif($nb3!=0){
                    ?>
                    <div class="row">
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-coins"></i></span>
                            </div>
                            <input type="text" name="statut" value="<?php echo $statut ?>" class="form-control">
                        </div>
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                            </div>
                            <input type="text" name="statut" value="<?php echo $data['adresseNB'] ?>" class="form-control">
                        </div>
                    </div>
                    <?php 
                }
                elseif($nb4!=0){
                    ?>
                    <div class="row">
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-coins"></i></span>
                            </div>
                            <input type="text" name="statut" value="<?php echo $statut ?>" class="form-control">
                        </div>
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-coins"></i></span>
                            </div>
                            <input type="text" name="statut" value="<?php echo $data['libelle']." : ".$data['montant']."F" ?>" class="form-control">
                        </div>
                    </div>
                    <?php 
                }
            ?>
            </div>
            <?php
        }
    }
    //modif et suppression
    public static function modifEtudiant($requete1,$requete2,$requete3,$requete4,$recherche){
        
        //$sql="SELECT * FROM $table LIMIT ".(($pc-1)*$nbpp).",$nbpp";
        //Database::connect();
        $req1=Database::executeUpdate1($requete1,array($recherche));
        $req2=Database::executeUpdate1($requete2,array($recherche));
        $req3=Database::executeUpdate1($requete3,array($recherche));
        $req4=Database::executeUpdate1($requete4,array($recherche,$recherche));
        
       $nb1=$req1->rowCount();
        $nb2=$req2->rowCount();
        $nb3=$req3->rowCount();
        $nb4=$req4->rowCount();
        if($nb1!=0 || $nb2!=0 || $nb3!=0 || $nb4!=0){
            if($nb1!=0)
            {
                $req=$req1;
                $statut='Boursier Et Logé';
            }
            elseif($nb2!=0)
            {
                $req=$req2;
                $statut='Boursier';
            }                
            elseif($nb3!=0)
            {
                $req=$req3;
                $statut='Non Boursier';
            }
                
            elseif($nb4!=0)
            {
                $req=$req4;
                $statut='Boursier Non Logé';
            }
            $result=$req->fetch();
            ?>
            <div class="row text-center">
            <div class="col-12">
                <h1 class="titre">MODIFIER ETUDIANT</h1>
            </div>
        </div>
        <div id="erreur">
            <p>Vous n'avez pas rempli correctement les champs du formulaire !</p>
        </div>
    <form action="" method="POST">
        <input type="hidden" name="matricule" value="<?php echo $result['matEtudiant'] ?>">
        <div class="row">
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-graduate"></i></span>
                </div>
                <input type="text" id="nom" name="nom" class="form-control champ" value="<?php echo $result['nomEtudiant'] ?>" placeholder="Entrer le Nom">
            </div>
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-graduate"></i></span>
                </div>
                <input type="text" id="prenom" name="prenom" class="form-control champ" value="<?php echo $result['prenomEtudiant'] ?>" placeholder="Entrer le Prenom">
            </div>
        </div>
        <div class="row">
            <div class="input-group mb-3 col-12">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                </div>
                <input type="email" id="mail" name="mail" class="form-control" value="<?php echo $result['mailEtudiant'] ?>" placeholder="Entrer Email">
            </div>
        </div>
        <div class="row">
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                </div>
                <input type="number" id="tel" name="tel" min=300000000 value="<?php echo $result['telEtudiant'] ?>" class="form-control champ" placeholder="Entrer le Numéro de Téléphone">
            </div>
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="date" id="dateNaiss" max= <?php echo date('Y-m-d'); ?> name="dateNaiss" class="form-control" value="<?php echo $result['naissEtudiant'] ?>" placeholder="Entrer Date de Naissance">
                
            </div>
            <span id="age">L'âge doit être compris entre 18 et 30 ans </span>
        </div>
        <div class="row">
            
            <div class="col-12 col-md-6">
                <div class="form-check">
<input class="form-check-input" type="radio" <?php if($nb1!=0 || $nb2!=0 || $nb4!=0) { ?>checked <?php } ?> name="bourse" id="boursier" value="Boursier">
                    <label class="form-check-label" for="boursier">
                        Boursier
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" <?php if($nb3!=0) { ?>checked <?php } ?> name="bourse" id="nonboursier" value="NonBoursier">
                    <label class="form-check-label" for="nonboursier">
                        Non Boursier
                    </label>
                </div>
            </div>
            <span id="choixBourse">Vous devez choisir un type !</span>
        </div>
        <div class="cacher" id="cacher">
            <div class="row">
                    <div class="input-group mb-3 col-12 col-md-6" id="afficheBoursier">
                        <div class="input-group-append">
                            <label class="input-group-text" for="typeBourse"><i class="fas fa-coins"></i></label>
                        </div>
                        <select class="custom-select" id="typeBourse" name="typeBourse">
                            <!-- <option value="0">Choisir une Bourse</option> -->
                            <?php
                                Database::connect();
                                $retour = TypeBourse::selectType();
                                while ($data = $retour->fetch()) {
                                    ?>
                                    <option value="<?php echo $data['idType'] ?>" <?php $data['idType']==$result['idType'] ? 'selected': ''; ?>><?php echo $data['libelle'] . " - montant : " . $data['montant']; ?></option>
                                    <?php
                                    // echo "<option value=" . $data['idType'];
                                    // if($data['idType']==$result['idType'])
                                    //     echo "selected";
                                    // echo ">" . $data['libelle'] . " - montant : " . $data['montant'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <span id="montant">Vous devez Selectionner un type de bourse </span>
                    <div class="input-group mb-3 col-12 col-md-6" id="afficheNonBoursier">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" id="adresse" name="adresse" class="form-control champ" value="<?php if($nb3!=0) echo $result['adresseNB'] ?>" placeholder="Entrer l'adresse">
                    </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-12 col-md-6" id="afficheLoger">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" <?php if(isset($_POST['loger'])&&$_POST['loger']=='Loger') { ?>checked <?php } ?>  name="loger" value="Loger" id="loger">
                        <label class="form-check-label" for="loger">
                            Logé
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-12 col-md-6" id="afficheBatiment">
                    <div class="input-group-append">
                        <label class="input-group-text" for="batiment"><i class="far fa-building"></i></label>
                    </div>
                   
                        <?php
                        Database::connect();
                            $batiments = RequetesChambre::selectBat();
                            $chambres=Database::$base->query('SELECT * FROM chambre ORDER BY idBat ASC');
                            $chambresParBat=array();
                            while($chambre=$chambres->fetch()){
                                $chambresParBat[$chambre['idBat']][$chambre['idChambre']]=$chambre['nomChambre']." - n° ".$chambre['num'];
                            }
                            ?>
                         <select class="custom-select" name="batiment" id="batiment">
                         <option value="0">Choisir Un Batiment</option>
                        <?php
                            
                            while ($data = $batiments->fetch()) {
                                echo "<option value=" . $data['idBat'] . ">" . $data['nomBat'] . "</option>";
                            }
                        ?>
                    </select>
                    <span id="bat">Vous devez Selectionner un batiment </span>
                </div>
            </div>
            <div class="row" id="afficheChambre">
                <div class="input-group mb-3 col-12 col-md-6" id="AChambre">
                    
                    
                        <?php
                        
                           foreach ($chambresParBat as $idBat=>$chambres) { 
                        ?>
                        <div class="input-group" id="batiment-<?= $idBat; ?>">
                            <div class="input-group-append">
                            <label class="input-group-text" for="test"><i class="fas fa-bed"></i></label>
                             </div>
                            <select class="custom-select" name="chambre" id="chambre">;
                            <?php
                                foreach ($chambres as $idChambre => $num) {
                                    echo "<option value=" . $idChambre . ">" . $num . "</option>";
                                }
                            ?>
                            </select>
                        </div>
                            <?php
                           }
                        ?>
                    
                </div>
            </div>
        </div>
        <button type="submit" name="ajouter" id="ajouter" class="btn btn-primary">Modifier</button>
        <button type="submit" name="supprimer" id="supprimer" class="btn btn-primary">Supprimer</button>
    </form>
            <?php
            if (isset($_POST['supprimer'])){
                $mat=$_POST['matricule'];
                Database::connect();
                $sql="DELETE FROM etudiant WHERE matEtudiant=?";
                $val=array($mat);
                $retour=Database::$base->prepare($sql);
                $retour->execute($val);
            }
        }
    }
}

    
    
    
    
  