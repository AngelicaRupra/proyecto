<?php

    include_once 'conexion.php';
    if(isset($_GET['Id'])){
        $Id=(int) $_GET['Id];
        $delete=$con->prepare('DELETE FROM cliente WHERE Id=:Id');
        $delete->execute(array(
            ':Id'=>$Id
        ));
        header('Location: index_cliente.php');
 }else{
    header('Location: index_cliente.php');
 }
 ?>