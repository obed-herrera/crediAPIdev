<?php
    $pdo = null;
    $host = "credimarketnic.com";
    $user = "root";
    $password = "";
    $db = "db_credimarket";
    $port = "3306"

    function conn(){
        try{
            $GLOBALS['pdo']= new PDO("mysql:host=".$GLOBALS['host'].";dbname=".$GLOBALS['db']."",$GLOBALS['user'], $GLOBALS['password'].";port=",$GLOBALS['3306']);
            $GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            print "Error!: No se pudo conectar a la base de datos ".$db."<br/>";
            print "\nErro!: ".$e."<br/>"; 
            die();
        }
    }

    function cutconn(){
        $GLOBALS['pdo']=null;
    }

    function metodoGet($query){
        try{
            conn();
            $sentencia=$GLOBALS['pdo']->prepare($query);
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->execute();
            cutconn();
            return $sentencia;
        }catch(Exception $e){
            die("Error: ".$e);
        }
    }

    function metodoPost($query, $queryAutoIncrement){
        try{
            conn();
            $sentencia=$GLOBALS['pdo']->prepare($query);
            $sentencia->execute();
            $idAutoIncrement=metodoGet($queryAutoIncrement)->fetch(PDO::FETCH_ASSOC);
            $resultado=array_merge($idAutoIncrement, $_POST);
            $sentencia->closeCursor();
            cutconn();
            return $resultado;
        }catch(Exception $e){
            die("Error: ".$e);
        }
    }

    function metodoPut($query){
        try{
            conn();
            $sentencia=$GLOBALS['pdo']->prepare($query);
            $sentencia->execute();
            $resultado = array_merge($_GET, $_POST);
            $sentencia->closeCursos();
            cutconn();
            return $resultado;
        }catch(Exception $e){
            die("Error: ".$e);
        }
    }

    function metodoDelete($query){
        try{
            conn();
            $sentencia=$GLOBALS['pdo']->prepare($query);
            $sentencia->execute();
            $sentencia->closeCursos();
            cutconn();
            return $_GET['id_credi_client'];
        }catch(Exception $e){
            die("Error: ".$e);
        }
    }
?>