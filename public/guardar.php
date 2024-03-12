<?php
// Include the database connection file
include("config/conexion.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $Cedula = $_POST["cedula"];
    $Nombre = $_POST["nombre"]; // Corregido el nombre del campo
    $Email = $_POST["email"];
    $Contraseña = $_POST["contraseña"];
   

    // SQL query to insert data into the database
    $insertQuery = "INSERT INTO datoos (Cedula, Nombre, Email, Contraseña)
                    VALUES ('$Cedula', '$Nombre', '$Email', '$Contraseña')";

    // Check if the query was successful
    if ($conn->query($insertQuery) === TRUE) {
        echo "Usuario ingresado correctamente.";
    } else {
        // Display more detailed error information
        echo "Error al ingresar los datos del Usuario: " . $conn->error . "<br>";
        echo "Query: " . $insertQuery; // Display the actual query for debugging
    }

    // Retrieve all data from the 'producto' table
    $selectQuery = "SELECT * FROM datoos";
    $result = $conn->query($selectQuery);

    // Display the data in a table
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                  
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["Cedula"]."</td>
                    <td>".$row["Nombre"]."</td>
                    <td>".$row["Email"]."</td>
                    <td>".$row["Contraseña"]."</td>
                  
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No hay datos en la tabla.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

