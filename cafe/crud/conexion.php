<?php
   
    //Conectamos con el servidor
    //Creamos la base de datos si no existe
    $conexion=new mysqli("localhost", "damian", "Murcia2022");
        $consulta="CREATE DATABASE IF NOT EXISTS h0122u0007_damian;";
        $bd="h0122u0007_damian";
    $conexion->query($consulta);

    //Seleccionamos la base de datos y creamos la tabla si no existe
    $conexion->select_db($bd);
    $consulta="CREATE TABLE IF NOT EXISTS categoria (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        imagen VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      );";
    /*$consulta="CREATE TABLE IF NOT EXISTS producto (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        imagen VARCHAR(255) NOT NULL,
        categoria INT(11) NOT NULL ,
        precio INT(11) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      );";*/
    $conexion->query($consulta);

    //Si la tabla está vacía, añadimos datos de ejemplo
    $consulta="SELECT nombre FROM producto";
    $resultado=$conexion->query($consulta);    
       
    /*if($resultado->num_rows<1){
        
        $consulta="INSERT INTO alumnosimg (nombre, apellido, email, edad, imagen, created_at, updated_at) 
        VALUES ('María', 'Martínez Sánchez', 'maria@alumnos.com', 3,'avatar.jpg', '2022-10-27 04:01:14', '2022-10-27 04:01:14');";
        
        $conexion->query($consulta);

    };*/

    function escapar($html) {
        return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    }

    function csrf() {
        session_start();
      
        if (empty($_SESSION['csrf'])) {
          if (function_exists('random_bytes')) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
          } else if (function_exists('mcrypt_create_iv')) {
            $_SESSION['csrf'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
          } else {
            $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
          }
        }
    }
?>