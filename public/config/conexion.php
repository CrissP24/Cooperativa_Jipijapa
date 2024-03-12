<?php
 $servidor = "localhost";
 $base_datos = "registro";
 $usuario = "root";
 $clave = "";// Crear conexiòn
 $conn = new mysqli($servidor, $usuario, $clave , $base_datos);
  if (!$conn) 
 {
 die("Connectciòn Fallida: " . mysqli_connect_error());
 }
?>