<?php
    include_once 'conexion.php';

    $sentencia_select=$con->prepare('SELECT * FROM cliente ORDER BY Id DESC');

    $sentencia_select->execute();
    $resultado=$sentencia_select->fetchAll();

    if(isset($_POST['btn_buscar'])){
        $buscar_text=$_POST['buscar'];
        $select_buscar=$con->prepare('
            SELECT * FROM cliente WHERE nombre LIKE :campo OR Id LIKE :campo ;'
        );
        
        $select_buscar->execute(array(':campo' =>"%".$buscar_text."%"));
        $resultado=$select_buscar->fetchAll();
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Cliente</title>
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <div class="contenedor">
            <h2>CLIENTE</h2>
            <div class="barra_buscador">
                <form action="" class="formulario" method="post">
                    <input type="text" name="buscar" placeholder="Buscar Cliente" 
                    value="<?php if(isset($buscar_text)) echo $buscar_text; ?> class="input_text">
                    <input type="submit" class="btn" name="btn_buscar" value="Buscar">
                    <a href="insert_cliente.php" class="btn btn_nuevo">Nuevo</a>
</form>
</div>
<table>
<tr class="head">
    <td>documentos</td>
    <td>Nombre</td>
    <td>Apellidos</td>

    <td colspan="2">Accion</td>
</tr>
<?php foreach($resultado as $fila):?>
    <tr>
        <td><?php echo $fila['Id']; ?></td>
        <td><?php echo $fila['nombre']; ?></td>
        <td><?php echo $fila['apellido']; ?></td>

        <td><a href="update_cliente.php?Id=<?php echo $fila['Id']; ?>" class="btn_update" >Editar</a></td>
        <td><a href="delete_cliente.php?Id=<?php echo $fila['Id']; ?>" class="btn_delete">Eliminar</a></td>
        </tr>

<?php endforeach ?>

</table>
</div>
    </body>
    </html>
