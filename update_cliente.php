<?php
    include_once 'conexion.php';
    if(isset($_GET['id'])){
        $id=(int) $_GET['id'];
        $consulta_cliente = $con->prepare('SELECT c.*, cd.nombre as ciudad FROM cliente as c JOIN ciudad as cd on c.id_ciudad=cd.id WHERE c.id=:id');
        $consulta_cliente->execute(array(':id' => $id));
        $clientes = $consulta_cliente->fetchAll();
        //print_r($clientes[0] );
    }
    $consulta_ciudades = $con->prepare('SELECT * FROM ciudad');
    $consulta_ciudades->execute();
    $ciudades = $consulta_ciudades->fetchAll();
    //print_r($ciudades);
    

    if(isset($_POST['guardar'])){
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $id_ciudad=$_POST['id_ciudad'];
        $genero=$_POST['genero'];

        $consulta_check = $con->prepare('SELECT * FROM cliente WHERE id = :id');
        $consulta_check->execute(array(':id' => $id));

        if ($consulta_check->rowCount() > 0) {
            if (!empty($id) && !empty($nombre) && !empty($apellido) && !empty($id_ciudad) && !empty($genero)) {
                $consulta_insert = $con->prepare('UPDATE cliente SET nombre=:nombre, apellido=:apellido, id_ciudad=:id_ciudad, genero=:genero WHERE id=:id');
                $consulta_insert->execute(array(':id' => $id, ':nombre' => $nombre, ':apellido' => $apellido, ':id_ciudad' => $id_ciudad, ':genero' => $genero));
                header('Location: index_cliente.php');
            } else {
                echo "<script> alert('El ID ya está registrado.');</script>";
            }
        } else {
            
            if (!empty($id) && !empty($nombre) && !empty($apellido) && !empty($id_ciudad) && !empty($genero)) {
                $consulta_insert = $con->prepare('INSERT INTO cliente(id, nombre, apellido, id_ciudad, genero) 
                    VALUES (:id, :nombre, :apellido, :id_ciudad, :genero)');
                $consulta_insert->execute(array(':id' => $id, ':nombre' => $nombre, ':apellido' => $apellido, ':id_ciudad' => $id_ciudad, ':genero' => $genero));
                header('Location: index_cliente.php');
            } else {
                echo "<script> alert('Los campos están vacíos.');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Cliente</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="contenedor">
        <h2>Crear Cliente</h2>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="id" placeholder="documento" class="input_text" value="<?php echo $clientes[0]['id']; ?>">
                <input type="text" name="nombre" placeholder="Nombre" class="input_text" value=<?php echo $clientes[0]['nombre']; ?>>
            </div>
            <div class="form-group">
                <input type="text" name="apellido" placeholder="apellido" class="input_text" value=<?php echo $clientes[0]['apellido']; ?>>
                <select name="id_ciudad" id="id_ciudad" class="input_text">                    
                    <?php foreach ($ciudades as $ciudad):
                        print_r($ciudad) ;
                        if ($clientes[0]['ciudad']!=$ciudad['nombre']){
                            echo '<option value="' . $clientes[0]['id_ciudad'] . '">' . $ciudad['nombre'] . '</option>';
                        } else {
                            echo '<option value="' . $clientes[0]['id_ciudad'] . '" selected>' . $ciudad['nombre'] . '</option>';
                        }
                        endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Género:</label>
                <div class="genero-group">
                    <label>
                        <input type="radio" name="genero" value="F" <?php echo (isset($resultado) && $resultado['genero'] == 'F') ? 'checked' : ''; ?>> Femenino
                    </label>
                    <label>
                        <input type="radio" name="genero" value="M" <?php echo (isset($resultado) && $resultado['genero'] == 'M') ? 'checked' : ''; ?>> Masculino
                    </label>
                </div>
            </div>

            <div class="btn_group">
                <a href="index_cliente.php" class="btn btn_danger">Cancelar</a>
                <input type="submit" name="guardar" value="Guardar" class="btn btn_primary">
            </div>
        </form>
    </div>
</body>
</html>