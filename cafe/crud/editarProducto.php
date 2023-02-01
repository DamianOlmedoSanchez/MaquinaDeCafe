<?php
    include "conexion.php";    

    //Cuando mostramos la página con el formulario y los datos del alumno
    if (!isset($_GET['id'])) { //Si no nos pasan el id del alumno        
        echo "El alumno no existe";        
    }else{
        $id = $_GET['id'];
        $consultaSQL = "SELECT * FROM producto WHERE id =" . $id;
    
        $sentencia = $conexion->query($consultaSQL);            
        $alumno = $sentencia->fetch_object();    
        if ($alumno) {            
            $nombre = $alumno->nombre;
            $categoria = $alumno->categoria;
            $precio = $alumno->precio;
        }else{            
            echo 'No se ha encontrado el alumno';
        }
        
    }
    
    //Cuando nos envían los datos del alumno desde el formulario y tenemos que actualizarlo
    if (isset($_POST['submit'])) {    
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $precio = $_POST['precio'];
        
        $consultaSQL = "UPDATE producto SET  nombre = '$nombre', categoria = $categoria,  precio = $precio, ";
        $consultaSQL .= "updated_at = NOW() WHERE id = $id";
        
        $consulta = $conexion->query($consultaSQL);        
        header("Status: 301 Moved Permanently");
        header("Location: indexProducto.php");
        exit;
    }    
?>

<?php require "templates/header.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Editando el producto <?= escapar($nombre)   ?></h2>
        <hr>
        <form method="post">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= escapar($nombre) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="categoria">Categoria</label>
            <input type="number" name="categoria" id="categoria" value="<?= escapar($categoria) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" value="<?= escapar($precio) ?>" class="form-control">
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