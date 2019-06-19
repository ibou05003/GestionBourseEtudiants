<?php
require_once 'Autoloader.class.php';
Autoloader::register();
$et = new Chambre();
//$et->add('a4',1);
$et->lister();
