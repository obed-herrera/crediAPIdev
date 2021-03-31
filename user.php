<?php
    include_once './BDConn.php';

    header('Access-Control-Allow-Origin: *');

    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id_credi_user'])){
            $query = "SELECT * FROM credi_user WHERE id_credi_user=".$_GET['id_credi_user'];
            $resultado = metodoGet($query);
            echo json_decode($resultado->fetch(PDO::FETCH_ASSOC));

        }else{
            $query="select * from credi_user";
            $resultado = metodoGet($query);
            echo json_encode($resultado->fetchAll());
        }
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='POST'){
        unset($_POST['METHOD']);
        $username = $_POST['username'];
        $credi_password = $_POST['credi_password'];
        $user_role = $_POST['user_role'];
        $user_state = $_POST['user_state'];
        $query="insert into credi_user(username, credi_password, user_role, user_state) 
        values ('$username', '$credi_password', '$user_role','$user_state')";
        $queryAutoIncrement="select MAX(id_credi_user) as id_credi_user from credi_user";
        $resultado=metodoPost($query, $queryAutoIncrement);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='PUT'){
        unset($_POST['METHOD']);
        $username = $_POST['username'];
        $credi_password = $_POST['credi_password'];
        $user_role = $_POST['user_role'];
        $user_state = $_POST['user_state'];
        $query = "UPDATE credi_user set username = '$username',
        credi_password = '$password',
        user_role = '$user_role',
        user_state = '$user_state' where id_credi_user = '$id_credi_user'";
        $resultado=metodoPut($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='DELETE'){
        unset($_POST['METHOD']);
        $id_credi_user=$_GET['id_credi_user'];
        $query="DELETE FROM credi_user WHERE id_credi_user='$id_credi_user'";
        $resultado=metodoDelete($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }
    header("HTTP/1.1 400 Bad Request");
?>