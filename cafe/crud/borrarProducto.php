<?php
    include "conexion.php";      

    if (isset($_GET['id'])) {            
        $id=$_GET['id'];        
        $consultaSQL = "DELETE FROM producto WHERE id = $id";        
        $consulta = $conexion->query($consultaSQL);                        
    }
    header("Status: 301 Moved Permanently");
    header("Location: indexProducto.php");
    exit;
?>