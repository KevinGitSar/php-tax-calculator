<?php

$host = "localhost";
$dbname = "tcdb";
$username = "root";
$password = "";

// Creating a connection without PDO.
// // Must be in the order of host, username, password, database name.
// $mysqli = new mysqli($host, $username, $password, $dbname);

// if ($mysqli->connect_errno){
//     die("Connection error: " . $mysqli->connect_error);
// }

// return $mysqli;

// PDO Connection.
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}

return $pdo;