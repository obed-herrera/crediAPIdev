<?php
    include_once './BDConn.php';

    header('Access-Control-Allow-Origin: *');

    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id_credi_client'])){
            $query = "SELECT * FROM credi_client WHERE id_credi_client=".$_GET['id_credi_client'];
            $resultado = metodoGet($query);
            echo json_decode($resultado->fetch(PDO::FETCH_ASSOC));

        }else{
            $query="select * from credi_client";
            $resultado = metodoGet($query);
            echo json_encode($resultado->fetchAll());
        }
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='POST'){
        unset($_POST['METHOD']);
        $client_first_name = $_POST['client_first_name'];
        $client_second_name = $_POST['client_second_name'];
        $client_middle_name = $_POST['client_middle_name'];
        $client_last_name = $_POST['client_last_name'];
        $client_national_id = $_POST['client_national_id'];
        $client_sys_code = $_POST['client_sys_code'];
        $client_home_address = $_POST['client_home_address'];
        $client_business_address = $_POST['client_business_address'];
        $client_state = $_POST['client_state'];
        $client_line = $_POST['client_line'];
        $client_phone = $_POST['client_phone'];
        /*$query = "INSERT INTO credi_client (client_first_name, client_second_name, client_middle_name, client_last_name
         client_national_id, client_sys_code, client_home_address, client_business_address, client_state, client_line) VALUES ('$client_first_name', '$client_second_name', '$client_middle_name', '$client_last_name'
         '$client_national_id', '$client_sys_code', '$client_home_address', '$client_business_address', '$client_state', '$client_line')";*/
        $query="insert into credi_client(client_first_name, client_second_name, client_middle_name, client_last_name,
        client_national_id, client_sys_code, client_home_address, client_business_address, client_state, client_line, client_phone) values ('$client_first_name', '$client_second_name', '$client_middle_name', '$client_last_name',
        '$client_national_id', '$client_sys_code', '$client_home_address', '$client_business_address', '$client_state', '$client_line', '$client_phone')";
        $queryAutoIncrement="select MAX(id_credi_client) as id_credi_client from credi_client";
        $resultado=metodoPost($query, $queryAutoIncrement);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='PUT'){
        unset($_POST['METHOD']);
        $id_credi_client = $_GET['id_credi_client'];
        $client_first_name = $_POST['client_first_name'];
        $client_second_name = $_POST['client_second_name'];
        $client_middle_name = $_POST['client_middle_name'];
        $client_last_name = $_POST['client_last_name'];
        $client_national_id = $_POST['client_national_id'];
        $client_sys_code = $_POST['client_sys_code'];
        $client_home_address = $_POST['client_home_address'];
        $client_business_address = $_POST['client_business_address'];
        $client_state = $_POST['client_state'];
        $client_line = $_POST['client_line'];
        $client_phone = $_POST['client_phone'];
        $query = "UPDATE credi_client set client_first_name = '$client_first_name,
        client_second_name = '$client_second_name',
        client_middle_name = '$client_middle_name',
        client_last_name = '$client_last_name',
        client_national_id = '$client_national_id',
        client_sys_code = '$client_sys_code',
        client_home_address = '$client_home_address',
        client_business_address = '$client_business_address',
        client_state = '$client_state',
        client_line = '$client_line',
        client_phone = '$client_phone' where id_credi_client = '$id_credi_client'";
        $resultado=metodoPut($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='DELETE'){
        unset($_POST['METHOD']);
        $id_credi_client=$_GET['id_credi_client'];
        $query="DELETE FROM credi_client WHERE id_credi_client='$id_credi_client'";
        $resultado=metodoDelete($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }
    header("HTTP/1.1 400 Bad Request");
?>