<?php
    include "conexion.php";
    include "templates/header.php"; 

    csrf();
    if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
        die();
    }
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="crearProducto.php"  class="btn btn-primary mt-4">Crear producto</a>
                <hr>
            </div>            
        </div>
        <div class="container">
            <div class="row">
                <form action="" method="post" class="form-inline">
                    <div class="form-group mr-3">
                    <input type="text" id="apellido" name="apellido" placeholder="Buscar por apellido" class="form-control">
                    </div>
                    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
                    <button type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
                </form>                
            </div>
        </div>
        <?php            
            if (isset($_POST['nombre']) ) {
                $nombre=$_POST['nombre'];
                $consultaSQL = "SELECT * FROM producto WHERE nombre LIKE '%$nombre%'";
                $titulo = ($nombre!="") ? 'Lista de alumnos (' . $_POST['nombre'] . ')': 'Lista de alumnos';
            } else {
                $consultaSQL = "SELECT * FROM producto";
                $titulo = 'Lista de productos';
            }   
            
            echo "<h1 class='mt-3'>$titulo</h1>";
        ?>        
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
        <?php     
            $consulta=$conexion->query($consultaSQL);    
            while($elemento=$consulta->fetch_object()){  
                $id=$elemento->id;
                $nombre=$elemento->nombre;
                $categoria=$elemento->categoria;
                $precio=$elemento->precio;
                $imagen=$elemento->imagen;
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$nombre</td>";
                echo "<td><img src='uploads/$imagen' style='width:100px'></td>";
                echo "<td>$categoria</td>";
                echo "<td>$precio</td>";
                //echo "<td><a href='borrar.php?id=$id ?'>🗑️Borrar</a>";
                echo "<td><form action='borrarProducto.php?id=$id' method='post' onSubmit='return confirm(\"Seguro?\")'><input type='submit' value='borrar'></form>";
                echo "<a href='editarProducto.php?id=$id'>✏️Editar</a></td>";
                echo "</tr>";
            }
        ?>
            </tbody>
        </table>
    </div>

    <p><a href="https://www.neoguias.com/tutorial-crud-php/">Inspirado parcialmente en el tutorial de esta URL</a></p>
<?php 
    include "templates/footer.php"; 
?>