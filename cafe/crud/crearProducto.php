<?php 
  include "templates/header.php"; 
  include "conexion.php";
  if (isset($_POST['submit'])) {
    $nombre=escapar($_POST["nombre"]);
    $imagen = date("Y-m-d - H-i-s")."-".$_FILES['imagen']['name'];
 	    $file_loc = $_FILES['imagen']['tmp_name'];
      move_uploaded_file($file_loc,"uploads/".$imagen);
    $categoria=$_POST["categoria"];
    $precio=$_POST["precio"];
    $consulta=$conexion->query("INSERT INTO producto (nombre, imagen, categoria, precio) VALUES
      ('$nombre', '$imagen', $categoria, $precio)");
    echo "<p class='alert alert-success'>Registro del producto $nombre añadido</p>";
  }
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Crea un producto</h2>
      <hr>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label for="imagen">imagen</label>
          <input type="file" name="imagen" id="imagen" class="form-control">
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
           <select name="categoria" id="categoria">
            <?php
              $sql="SELECT * FROM categoria";

              $categoria=$conexion->query($sql);

              while($cat=$categoria->fetch_object()){

                $nombre=$cat->nombre;
                $id=$cat->id;

                $aux = ($categoria==$cat->nombre) ? "selected": "";

                echo "<option value='$id' $aux>$nombre</option>";

              }

            ?>

          </select>

          </div>
        <div class="form-group">
          <label for="precio">Precio</label>
          <input type="number" step="0.01" name="precio" id="precio" class="form-control">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
          <a class="btn btn-primary" href="indexProducto.php">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
  
</div>

<?php include "templates/footer.php"; ?>