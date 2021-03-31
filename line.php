<?php
    include_once './BDConn.php';

    header('Access-Control-Allow-Origin: *');

    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id_credi_client_line'])){
            $query = "SELECT * FROM credi_client_line WHERE id_credi_client_line=".$_GET['id_credi_client_line'];
            $resultado = metodoGet($query);
            echo json_decode($resultado->fetch(PDO::FETCH_ASSOC));

        }else{
            $query="select * from credi_client_line";
            $resultado = metodoGet($query);
            echo json_encode($resultado->fetchAll());
        }
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='POST'){
        unset($_POST['METHOD']);
        $client_line = $_POST['client_line'];
        $query="insert into credi_client_line(client_line) values ('$client_line')";
        $queryAutoIncrement="select MAX(id_credi_clientline) as id_credi_client_line from credi_client_line";
        $resultado=metodoPost($query, $queryAutoIncrement);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='PUT'){
        unset($_POST['METHOD']);
        $id_credi_client_line = $_GET['id_credi_client_line'];
        $client_line = $_POST['client_line'];
        $query = "UPDATE credi_client_line set client_line = '$client_line";
        $resultado=metodoPut($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='DELETE'){
        unset($_POST['METHOD']);
        $id_credi_loan=$_GET['id_credi_client_line'];
        $query="DELETE FROM credi_client_line WHERE id_credi_client_line='$id_credi_client_line'";
        $resultado=metodoDelete($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }
    header("HTTP/1.1 400 Bad Request");
?>