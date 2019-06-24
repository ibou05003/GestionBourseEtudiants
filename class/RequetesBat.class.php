<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class RequetesBat
{
    public static function insererBat(Batiment $nom)
    {
       Database::connect();
        try
        {
            $req = 'INSERT INTO batiment (nomBat) VALUES(?)';
            $val = array($nom->getNom());
            Database::executeUpdate($req, $val);
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        //Database::deconnect();
    }
    public static function afficherBats()
    {
        //Database::connect();
        try
        {
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->query('SELECT * FROM batiment');
            $i = 1;
            echo '<h1>LISTE DES BATIMENTS</h1>';
            echo '<table>
                    <thead>';
                        Tableau::th('#');
                        Tableau::th('Nom');
                    echo '</thead>';
            while ($data = $retour->fetch()) {
                echo '<tr>';
                Tableau::td($i);
                Tableau::td($data['nomBat']);
                echo '</tr>';
                $i++;
            }
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
       // Database::deconnect();
    }
    public static function afficherUnBat($id)
    {
       // Database::connect();
        try
        {
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->prepare('SELECT nomBat FROM batiment WHERE idBat=?');
            $retour->execute(array($id));
            while ($data = $retour->fetch()) {
                echo $data['nomBat'];
            }

        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        //Database::deconnect();
    }
    public static function afficheBatiments($requete,$page,$table){
        $sql="SELECT COUNT(idBat) as nb FROM $table";
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
                    Tableau::th('Nom');
                echo '</thead>';
        while ($data = $req->fetch()) {
            echo '<tr>';
            Tableau::td($i);
            Tableau::td($data['nomBat']);
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
