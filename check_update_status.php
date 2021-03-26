<?php
$servername = "localhost";
$username = "root";
$password = "";

// database connection
try {
    $db_conn = new PDO("mysql:host=$servername;dbname=todo_list", $username, $password);
    // set the PDO error mode to exception
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected";
} catch (PDOException $e) {
    $msg = "Connection to database failed. Please try again later";
    echo $msg;
}

//get all data
$sql = $db_conn->prepare("SELECT id, due_date, status FROM `items`");
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
$data = $sql->fetchAll();

$date = new DateTime(); 
$date->modify("-1 day");
$time = $date->format("Y-m-d H:i:s");

// updating task status to overdue after checking its due date and status
foreach($data as $rec){
    $id = $rec['id'];
    $due_date = $rec['due_date']; 
    if($time > $due_date && $rec['status'] != "done"){
        $sql = $db_conn->prepare("UPDATE `items` SET `status` = 'overdue' WHERE `id` = '$id' ");
        $sql->execute(); 
    } 
}

