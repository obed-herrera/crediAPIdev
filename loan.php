<?php
    include_once './BDConn.php';

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');


    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id_credi_loan'])){
            $query = "SELECT * FROM credi_loan WHERE id_credi_loan=".$_GET['id_credi_loan'];
            $resultado = metodoGet($query);
            echo json_decode($resultado->fetch(PDO::FETCH_ASSOC));

        }else{
            $query="select * from credi_loan";
            $resultado = metodoGet($query);
            echo json_encode($resultado->fetchAll());
        }
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_SERVER['REQUEST_METHOD_CLIENTNAME']=='GET'){
        if(isset($_GET['id_credi_client'])){
            $query = "SELECT concat(client_first_name, ' ', client_middle_name), as Client_Name FROM credi_client WHERE id_credi_client=".$_GET['id_credi_client'];
            $resultado = metodoGet($query);
            echo json_decode($resultado->fetch(PDO::FETCH_ASSOC));

        }else{
            $query="select client_first_name from credi_client";
            $resultado = metodoGet($query);
            echo json_encode($resultado->fetchAll());
        }
        header("HTTP/1.1 200 OK");
        exit();
    }


    if($_POST['METHOD']=='POST'){
        unset($_POST['METHOD']);
        $client_name = $_POST['client_name'];
        $loan_term = $_POST['loan_term'];
        $loan_payment = $_POST['loan_payment'];
        $money_type = $_POST['money_type'];
        $loan_mount = $_POST['loan_mount'];
        $loan_interest = $_POST['loan_interest'];
        $loan_line = $_POST['loan_line'];
        $selectedDate = $_POST['selectedDate'];
        $selectedDatePayment = $_POST['selectedDatePayment'];
        $selectedDatePaymentEnding = $_POST['selectedDatePaymentEnding'];
        $credi_loan_code = $_POST['credi_loan_code'];
        $query="insert into credi_loan(client_name, loan_term, loan_payment, money_type,
        loan_mount, loan_interest, loan_line, selectedDate, selectedDatePayment, selectedDatePaymentEnding, credi_loan_code) values ('$client_name', '$loan_term', '$loan_payment', '$money_type',
        '$loan_mount', '$loan_interest','$loan_line', '$selectedDate', '$selectedDatePayment','$selectedDatePaymentEnding', '$credi_loan_code')";
        $queryAutoIncrement="select MAX(id_credi_loan) as id_credi_loan from credi_loan";
        $resultado=metodoPost($query, $queryAutoIncrement);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='PUT'){
        unset($_POST['METHOD']);
        $id_employee = $_GET['id_cemployee'];
        $employee_first_name = $_POST['employee_first_name'];
        $employee_second_name = $_POST['employee_second_name'];
        $employee_middle_name = $_POST['employee_middle_name'];
        $employee_last_name = $_POST['employee_last_name'];
        $employee_state = $POST['employee_state'];
        $query = "UPDATE employee set employee_first_name = '$employee_first_name,
        employee_second_name = '$employee_second_name',
        employee_middle_name = '$employee_middle_name',
        employee_last_name = '$employee_last_name',
        employee_state = '$employee_state' where id_employee = '$id_employee";
        $resultado=metodoPut($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='DELETE'){
        unset($_POST['METHOD']);
        $id_credi_loan=$_GET['id_credi_loan'];
        $query="DELETE FROM credi_loan WHERE id_credi_loan='$id_credi_loan'";
        $resultado=metodoDelete($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }
    header("HTTP/1.1 400 Bad Request");
?>