<?php
	//connect.php
	$connect = new PDO("mysql:host=localhost;dbname=doctorcar_db", "root", "");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
?>