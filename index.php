<?php
/*
*	OpenQuery 0.1 Alpha
*	Nur-Magomed Dzhamiev, course work demo project
*	Science head: Osipov D.L.
*	04 Oct 2016
*/
define('STARTTIME', microtime(true));

define('OPENQUERY', true);
define('SITEURL', 'http://openquery.local');
define('SITEURL_SHORT', 'openquery.local');

session_start();
header('Content-Type: text/html; charset=utf-8');

error_reporting (E_ALL);

include('config.php');

//connecting to DB
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$dbObject->exec('SET CHARACTER SET utf8');

include (SITE_PATH . DS . 'core' . DS . 'core.php'); 

$router = new Router();
$router->setPath (SITE_PATH . 'controllers');

//Start!
$router->start();

?>