<?php
include_once 'conexion.php';

if (isset($_GET['Id'])) {
    $Id = (int) $_GET['Id'];
    $buscar_id = $con->prepare('SELECT * FROM cliente WHERE Id = :Id');
    $buscar_id->execute(array(
        ':Id'=>$Id
    ));
    $resultado = $buscar_id->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Id = $_POST['Id'] ?? null;
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ciudad = $_POST['ciudad'];
    
    if (!empty($Id)) {
        $consulta_update = $conexion->prepare('
            UPDATE cliente 
            SET nombre = :nombre, apellido = :apellido, id_ciudad = :id_ciudad, genero = :genero
            WHERE Id = :Id
        ');
        $consulta_update->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':id_ciudad' => $id_ciudad,
            ':genero' => $genero,
            ':Id' => $Id
        ]);
    } else {

        $consulta_insert = $conexion->prepare('INSERT INTO cliente (nombre, apellido, id_ciudad, genero) 
            VALUES (:nombre, :apellido, :id_ciudad, :genero)
        ');
        $consulta_insert->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':ciudad_id' => $id_ciudad,
            ':genero' => $genero
        ]);
    }

    header('Location: index_cliente.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Informacion</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="contenedor">
        <h2>Editar Informacion</h2>
        <form action="" method="post">
            <div class="form-group">
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
                    <option value="Ibagué">Ibagué</option>
                    <option value="Barranquilla">Barranquilla</option>
                    <option value="Bucaramanga">Bucaramanga</option>
                    <option value="Pasto">Pasto</option>
                    <option value="Cucuta">Cucuta</option>
                    <option value="Valledupar">Valledupar</option>
                    <option value="Santa Marta">Santa Marta</option>
                </select>
            </div>
            
            <div class="btn_group">
                <a href="index_cliente.php" class="btn btn_danger">Cancelar</a>
                <input type="submit" name="guardar" value="Guardar" class="btn btn_primary">
            </div>
        </form>
    </div>
</body>
</html>
