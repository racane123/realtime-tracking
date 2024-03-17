<?php
$host = "localhost";
$username = 'root';
$password = '';
$dbname = 'testdb';
$port = 3308;

$conn = new mysqli($host,$username,$password,$dbname,$port);

if(!$conn){
    die('Error : Could not connect to database.');
}
