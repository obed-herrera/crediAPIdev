<?php
    include_once './BDConn.php';

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');


    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id_employee'])){
            $query = "SELECT * FROM employee WHERE id_employee=".$_GET['id_employee'];
            $resultado = metodoGet($query);
            echo json_decode($resultado->fetch(PDO::FETCH_ASSOC));

        }else{
            $query="select * from employee";
            $resultado = metodoGet($query);
            echo json_encode($resultado->fetchAll());
        }
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='POST'){
        unset($_POST['METHOD']);
        $employee_first_name = $_POST['employee_first_name'];
        $employee_second_name = $_POST['employee_second_name'];
        $employee_middle_name = $_POST['employee_middle_name'];
        $employee_last_name = $_POST['employee_last_name'];
        $employee_national_id = $_POST['employee_national_id'];
        $employee_address = $_POST['employee_address'];
        $employee_state = $_POST['employee_state'];
        $employee_type = $_POST['employee_type'];
        $employee_created_by = $_POST['employee_created_by'];
        $employee_phone = $_POST['employee_phone'];
        $employee_email = $_POST['employee_email'];
        $employee_line = $_POST['employee_line'];
        /*$query = "INSERT INTO credi_client (client_first_name, client_second_name, client_middle_name, client_last_name
         client_national_id, client_sys_code, client_home_address, client_business_address, client_state, client_line) VALUES ('$client_first_name', '$client_second_name', '$client_middle_name', '$client_last_name'
         '$client_national_id', '$client_sys_code', '$client_home_address', '$client_business_address', '$client_state', '$client_line')";*/
        $query="insert into employee(employee_first_name, employee_second_name, employee_middle_name, employee_last_name,
        employee_national_id, employee_address, employee_state, employee_type, employee_created_by, employee_phone, employee_email, employee_line) values ('$employee_first_name', '$employee_second_name', '$employee_middle_name', '$employee_last_name',
        '$employee_national_id', '$employee_address','$employee_state', '$employee_type', '$employee_created_by', '$employee_phone', '$employee_email','$employee_line')";
        $queryAutoIncrement="select MAX(id_employee) as id_employee from employee";
        $resultado=metodoPost($query, $queryAutoIncrement);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='PUT'){
        unset($_POST['METHOD']);
        $employee_first_name = $_POST['employee_first_name'];
        $employee_second_name = $_POST['employee_second_name'];
        $employee_middle_name = $_POST['employee_middle_name'];
        $employee_last_name = $_POST['employee_last_name'];
        $employee_national_id = $_POST['employee_national_id'];
        $employee_address = $_POST['employee_address'];
        $employee_state = $_POST['employee_state'];
        $employee_type = $_POST['employee_type'];
        $employee_created_by = $_POST['employee_created_by'];
        $employee_phone = $_POST['employee_phone'];
        $employee_email = $_POST['employee_email'];
        $employee_line = $_POST['employee_line'];
        $query = "UPDATE employee set employee_first_name = '$employee_first_name,
        employee_second_name = '$employee_second_name',
        employee_middle_name = '$employee_middle_name',
        employee_last_name = '$employee_last_name',
        employee_state = '$employee_state',
        employee_type = '$employee_type',
        employee_created_by = '$employee_created_by',
        employee_phone = '$employee_phone',
        employee_email = '$employee_email',
        employee_line = '$employee_line' where id_employee = '$id_employee";
        $resultado=metodoPutEmployee($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='DELETE'){
        unset($_POST['METHOD']);
        $id_employee=$_GET['id_employee'];
        $query="DELETE FROM employee WHERE id_employee='$id_employee'";
        $resultado=metodoDelete($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }
    header("HTTP/1.1 400 Bad Request");
?>