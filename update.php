<?php
require("db_data.php");
// print_r($_REQUEST);
$id = $_REQUEST['id'];
$item = $_REQUEST['task'];
$due_date = $_REQUEST['due_date'];
$date = date("Y-m-d H:i:s", strtotime($due_date));
$status = $_REQUEST['status'];

$data = [
    'id' => $id,
    'item' => $item,
    'due_date' => $date,
    'status' => $status,

];
// print_r($data);
$res = updateTask($data);
if ($res){
    echo 'Task updated!';
}else {
    echo 'not updated!';
}