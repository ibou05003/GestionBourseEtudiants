<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class RequetesChambre
{
    public static function insererChambre(Chambre $chambre)
    {
        Database::connect();
        try
        {
            $nom = $chambre->getNom();
            $num = $chambre->getNum();
            $id = $chambre->getBatiment();
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->prepare('INSERT INTO chambre (num,nomChambre,idBat) VALUES(?,?,?)');
            $retour->execute(array($num, $nom, $id));
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        Database::deconnect();
    }
    public static function selectChambre()
    {
        $req = 'SELECT chambre.idChambre, chambre.num, chambre.nomChambre, batiment.nomBat as bat FROM chambre LEFT JOIN batiment ON chambre.idBat=batiment.idBat';
        $retour = Database::executeSelect($req);
        return $retour;
    }
    public static function selectBat()
    {
        $req = 'SELECT * FROM batiment';
        $retour = Database::executeSelect($req);
        return $retour;
    }
    public static function afficherChambres1($retour)
    {
        $i = 1;
        echo '<h1>LISTE DES CHAMBRES</h1>';
        echo '<table>
                    <thead>';
        Tableau::th('#');
        Tableau::th('Numero');
        Tableau::th('Nom');
        Tableau::th('Batiment');
        echo '</thead>';
        while ($data = $retour->fetch()) {
            echo '<tr>';
            Tableau::td($i);
            Tableau::td($data['num']);
            Tableau::td($data['nomChambre']);
            Tableau::td($data['bat']);
            echo '</tr>';
            $i++;
        }
        echo '</table>';
    }
    public static function afficheChambres($requete,$page,$table){
        $sql="SELECT COUNT(idChambre) as nb FROM $table";
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
        Tableau::th('Numero');
        Tableau::th('Nom');
        Tableau::th('Batiment');
        echo '</thead>';
        while ($data = $req->fetch()) {
            echo '<tr>';
            Tableau::td($i);
            Tableau::td($data['num']);
            Tableau::td($data['nomChambre']);
            Tableau::td($data['bat']);
            echo '</tr>';
            $i++;
        }
        echo '</table>';
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
}
