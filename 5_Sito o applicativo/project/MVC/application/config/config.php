<?php

/**
 * Configurazione di : Error reporting
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configurazione di : URL del progetto
 */
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$dir = str_replace('\\','/',getcwd().'/');
$final = $actual_link.str_replace($documentRoot,'',$dir);
define('URL', $final);

/**
 * Configurazione di : connessione al database del progetto
 */
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lavoro_temporaneo";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
	die("Database connection non ok: " . $conn->connect_error);
}
*/

?>