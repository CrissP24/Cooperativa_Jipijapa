<?php
include("config/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de productos</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="css/bootstrap.css"/>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <a href="registro.html" class="btn btn-primary mt-3 mb-3">Agregar Nuevo Usuario</a>
            </div>
        </div>
    </div>

    <table id="tabla_datos" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID DE LA PERSONA</th>
                <th>Nombre del Usuario</th>
                <th>Correo electrónico del Usuario</th>
                <th>Contraseña</th>
            </tr>
        </thead>
        <?php
        include("config/conexion.php");
        $consulta = "SELECT * FROM datos";

        if ($resultado = $conn->query($consulta)) {
            echo "<tbody>";
            while ($filas = $resultado->fetch_assoc()) {
                $Cedula = $filas["Cedula"];
                $Nombre = $filas["Nombre"];
                $Email = $filas["Email"];
                $Contraseña = $filas["Contraseña"];
                
                echo '<tr>
                        <td>'.$Cedula.'</td>
                        <td>'.$Nombre.'</td>
                        <td>'.$Email.'</td>
                        <td>'.$Contraseña.'</td>
                      </tr>';
            }
            echo "</tbody>";
        } else {
            echo "<tr><td colspan='4'>No hay usuarios</td></tr>";
        }
        mysqli_close($conn);
        ?>
    </table>

    <script src="js/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#tabla_datos').DataTable();
        });
    </script>
</body>
</html>
