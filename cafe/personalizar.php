<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
    $conexion = new mysqli("localhost", "damian", "Murcia2022");
        if ($conexion->connect_errno > 0) {
     echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
     die ("Error: " . $conexion->connect_error);
    } else {
    //Elijo la base de datos a la que me conecto
    $conexion->select_db("h0122u0007_damian");
    $conexion->set_charset("utf8");

    $id=$_GET["id"];
        
        $consulta = $conexion->query("SELECT * FROM producto WHERE id=$id");
        echo "<body style='width:100%;'>";
        echo "<div style='display:flex;flex-direction: row; flex-wrap: wrap;width: 100%;justify-content: center;'>";
        while($categoria = $consulta->fetch_object()){
            echo "<div style='margin:5%;  width: 500px; text-align:center;'>";
            echo "<a href='detalle.php?id=" . $categoria->id . "'><img src='crud/uploads/" . $categoria->imagen . "' style='height:300px;'> <br>";
            echo "<h2>" . $categoria->nombre . "</h2></a><br>";
            //echo "<br><a href='detalle.php?id=" . $categoria->id . "'>Ver Detalles</a>";
            echo "</div>";
        }
        echo"</div>";
        echo "<body>";
    }
    
    echo "<form  action='tiket.php?id=$id' method='POST'>";
?>
  <div class="form-group row">
    <label class="col-4">Tamaño</label> 
    <div class="col-8">
      <div class="custom-control custom-radio custom-control-inline">
        <input name="tamaño" id="tamaño_0" type="radio" class="custom-control-input" value="Pequeño" required="required"> 
        <label for="tamaño_0" class="custom-control-label">Pequeño</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="tamaño" id="tamaño_1" type="radio" class="custom-control-input" value="Mediano" required="required"> 
        <label for="tamaño_1" class="custom-control-label">Mediano</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="tamaño" id="tamaño_2" type="radio" class="custom-control-input" value="Grande" required="required"> 
        <label for="tamaño_2" class="custom-control-label">Grande</label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">Azucar</label> 
    <div class="col-8">
      <div class="custom-control custom-radio custom-control-inline">
        <input name="azucar" id="azucar_0" type="radio" class="custom-control-input" value="Poca" required="required"> 
        <label for="azucar_0" class="custom-control-label">Poca</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="azucar" id="azucar_1" type="radio" class="custom-control-input" value="Normal" required="required"> 
        <label for="azucar_1" class="custom-control-label">Normal</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="azucar" id="azucar_2" type="radio" class="custom-control-input" value="Mucha" required="required"> 
        <label for="azucar_2" class="custom-control-label">Mucha</label>
      </div>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</body>
</html>