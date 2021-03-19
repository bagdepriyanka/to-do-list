<?php
require("header.php");
$id = $_REQUEST['id'];

$sql = $db_conn->prepare("SELECT * FROM `items` WHERE id = ?");
$sql->bindParam(1, $id);
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);

$data = $sql->fetch();
echo json_encode($data);
