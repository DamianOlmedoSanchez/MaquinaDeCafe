<?php
    include "conexion.php";    

    //Cuando mostramos la página con el formulario y los datos del alumno
    if (!isset($_GET['id'])) { //Si no nos pasan el id del alumno        
        echo "El alumno no existe";        
    }else{
        $id = $_GET['id'];
        $consultaSQL = "SELECT * FROM alumnos WHERE id =" . $id;
    
        $sentencia = $conexion->query($consultaSQL);            
        $alumno = $sentencia->fetch_object();    
        if ($alumno) {            
            $nombre = $alumno->nombre;
            $apellido = $alumno->apellido;
            $email = $alumno->email;
            $edad = $alumno->edad;
        }else{            
            echo 'No se ha encontrado el alumno';
        }
        
    }
    
    //Cuando nos envían los datos del alumno desde el formulario y tenemos que actualizarlo
    if (isset($_POST['submit'])) {    
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $edad = $_POST['edad'];
        
        $consultaSQL = "UPDATE alumnos SET  nombre = '$nombre', apellido = '$apellido', email = '$email',  edad = $edad, ";
        $consultaSQL .= "updated_at = NOW() WHERE id = $id";
        
        $consulta = $conexion->query($consultaSQL);        
        header("Status: 301 Moved Permanently");
        header("Location: index.php");
        exit;
    }    
?>

<?php require "templates/header.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Editando el alumno <?= escapar($nombre) . ' ' . escapar($apellido)  ?></h2>
        <hr>
        <form method="post">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= escapar($nombre) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="<?= escapar($apellido) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= escapar($email) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="edad">Edad</label>
            <input type="text" name="edad" id="edad" value="<?= escapar($edad) ?>" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php require "templates/footer.php"; ?>