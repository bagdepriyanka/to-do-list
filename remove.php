<?php
require("db_data.php");
$id = $_REQUEST['id'];
$result = deleteTask($id);
if ($result){
    header ("Location: index.php?msg='Task deleted!'");
}else {
    header("Location: index.php?msg='Something went wrong while deleteing the record. Please try again later'");
}