<?php
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	define('DB_NAME', 'sriss_samithi');
    define('DB_USER', 'sriss_samithi');
    define('DB_PASSWORD', 'o-;o$Tx4O.[q');
    define('DB_HOST', 'localhost');
    define('TITLE', 'Recruitment');
    $host = DB_HOST;
    $user = DB_USER;
    $password = DB_PASSWORD;
    $database = DB_NAME;
    $error = 'Could not connect';
   $json='';
   $name='';
   $time='';
   $date='';
   $venue='';
   $interviewer='';
   $mysqli = new mysqli($host, $user, $password, $database);
    $mysqli->query('SET character_set_results=utf8');
    $mysqli->set_charset("utf8");
?>