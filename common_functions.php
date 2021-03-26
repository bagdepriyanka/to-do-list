<?php

function connect()
{

    // $servername = "localhost";
    // $username = "root";
    // $password = "";

    //for production
    $servername = "sql106.epizy.com";
    $username = "epiz_28188441";
    $password = "Et7CNq7SEji";


    try {
        // $conn = new PDO("mysql:host=$servername;dbname=todo_list", $username, $password);
        $conn = new PDO("mysql:host=$servername;dbname=epiz_28188441_XXX", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        $msg = "Connection to database failed. Please try again later";
        return $msg;
    }
}
