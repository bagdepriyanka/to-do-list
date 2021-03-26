<?php
require("header.php");
$db_conn;


function getData()
{
    $where = "1=1";


    if (isset($_REQUEST['task']) && $_REQUEST['task'] != "") {
        $task = "%$_REQUEST[task]%";
        $where = $where . " AND `item_detail` like :item_detail";
    }

    if (isset($_REQUEST['status']) && $_REQUEST['status'] != "Select Status") {
        $status = $_REQUEST['status'];
        $where = $where . " AND `status` = :status ";
    }

    if (isset($_REQUEST['from']) && $_REQUEST['from'] != "") {
        $from_date = date("Y-m-d H:i:s", strtotime($_REQUEST['from']));
        $where = $where . " AND due_date > :from_date ";
    }

    if (isset($_REQUEST['to']) && $_REQUEST['to'] != "") {
        $to_date = date("Y-m-d H:i:s", strtotime($_REQUEST['to']));
        $where = $where . " AND due_date < :to_date ";
    }

    global $db_conn;
    // $sql = $db_conn->prepare("SELECT * FROM `items` WHERE `item_detail` like :item_detail AND `status` =:status AND due_date > :from_date AND due_date < :to_date " );
    $sql = $db_conn->prepare("SELECT * FROM `items` WHERE $where ORDER BY `added_date` DESC");

    if (isset($_REQUEST['task']) && $_REQUEST['task'] != "") $sql->bindParam('item_detail', $task);
    if (isset($status) && $status != "Select Status") $sql->bindParam('status', $status);
    if (isset($from_date) && $from_date != "") $sql->bindParam('from_date', $from_date);
    if (isset($to_date) && $to_date != "") $sql->bindParam('to_date', $to_date);

    $sql->execute();
    //$sql->debugDumpParams();
    $sql->setFetchMode(PDO::FETCH_ASSOC);

    $data = $sql->fetchAll();
    return $data;
}


function deleteTask($id)
{
    global $db_conn;

    $sql = $db_conn->prepare("DELETE FROM `items` WHERE id = ? ");
    $sql->bindParam(1, $id);
    $res = $sql->execute();
    return $res;
}


function addTask($data)
{
    $item = $data['item'];
    $due_date = $data['due_date'];

    global $db_conn;
    $sql = $db_conn->prepare("INSERT INTO `items` (`id`, `item_detail`, `due_date`, `status`, `added_date`, `updated_date`) 
    VALUES (NULL, ? , ? , 'new', NOW(), NOW());");
    $sql->bindParam(1, $item);
    $sql->bindParam(2, $due_date);
    $res = $sql->execute();
    return $res;
}


function updateTask($data)
{
    $id = $data['id'];
    $item = $data['item'];
    $due_date = $data['due_date'];
    $status = $data['status'];

    global $db_conn;
    $sql = $db_conn->prepare("UPDATE `items` SET `item_detail` = ? ,`due_date` = ?, `status`= ?, `updated_date`= NOW() WHERE `id` = ?");
    $sql->bindParam(1, $item);
    $sql->bindParam(2, $due_date);
    $sql->bindParam(3, $status);
    $sql->bindParam(4, $id);
    $res = $sql->execute();
    return $res;
}
