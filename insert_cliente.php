<?php
include_once 'conexion.php';

if (isset($_POST['guardar'])) {
    $Id = $_POST['Id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ciudad = $_POST['ciudad'];
    $genero = $_POST['genero'];

    if (!empty($document_v) && !empty($nombre) && !empty($apellido) && !empty($ciudad) && !empty($genero)) {
        $consulta_insert = $con->prepare('INSERT INTO cliente(Id, nombre, apellido, ciudad, genero) VALUES (:Id, :nombre, :apellido, :ciudad, :genero)');
        $consulta_insert->execute(array(
            ':Id' => $Id,
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':ciudad' => $ciudad,
            ':genero'=> $genero
        ));
        header('Location: index_cliente.php');  
    } 
    else {
        echo "<script> alert('Los campos estan vacios');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cliente</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="contenedor">
        <h2>Crear Cliente</h2>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="Id" placeholder="Documento" class="input_text">
                <input type="text" name="nombre" placeholder="Nombre" class="input_text">
            </div>
            <div class="form-group">
                <input type="text" name="apellido" placeholder="Apellido" class="input_text">
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <select name="ciudad" id="ciudad" required>
                    <option value="Bogotá">Bogotá</option>
                    <option value="Medellín">Medellín</option>
                    <option value="Cali">Cali</option>
                    <option value="Barranquilla">Barranquilla</option>
                    <option value="Bucaramanga">Bucaramanga</option>
                    <option value="Pasto">Pasto</option>
                    <option value="Manizales">Manizales</option>
                    <option value="Ibague">Ibagué</option>
                    <option value="Cucuta">Cucuta</option>
                    <option value="Valledupar">Valledupar</option>
                    <option value="Santa Marta">Santa Marta</option>
                </select>
            </div>
            <div class="form-group">
                <label>Género:</label><br>
                <input type="radio" name="genero" value="M" id="masculino" required>
                <label for="masculino">Masculino</label><br>
                <input type="radio" name="genero" value="F" id="femenino" required>
                <label for="femenino">Femenino</label><br>
            </div>
            <div class="btn_group">
                <a href="index_cliente.php" class="btn btn_danger">Cancelar</a>
                <input type="submit" name="guardar" value="Guardar" class="btn btn_primary">
            </div>
        </form>
    </div>
</body>
</html>
