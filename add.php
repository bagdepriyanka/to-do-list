<?php
require("db_data.php");
//print_r($_REQUEST);
$item = $_REQUEST['task'];
$due_date = $_REQUEST['due_date'];
$date = date("Y-m-d H:i:s", strtotime($due_date));

$data = [
    'item' => $item,
    'due_date' => $date
];
//print_r($data);
$res = addTask($data);
if ($res){
    echo 'Task Add!';
}else {
    echo 'Something went wrong while adding the task. Please try again later';
}