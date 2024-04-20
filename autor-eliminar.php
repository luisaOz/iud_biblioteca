<?php
  require_once("libs/ConexionMySQL.php");

  $instance = ConexionMySQL::getInstance();
  
  // datos de la url
  $autorId;
  $nombreAutor;

  if (isset($_GET["id"])) {
    $autorId = $_GET["id"];
  }

  if (isset($_GET["nombreAutor"])) {
    $nombreAutor = $_GET["nombreAutor"];
  }

  // datos del action post
  if (isset($_POST["btnEliminar"])) {

    $sql = "select * from libro where autor_id = " . $_POST["autor_id"] . "";
    $result = $instance->ejecutarSQL($sql);

    // Verificar si hay resultados
    if ($result && $result->num_rows > 0) {
      header("Location: autor.php?error=true");
      //echo "No puede eliminar el Autor por que tiene un libro creado con este autor";
    }else{
      $sql = "delete from autor where autor_id = " . $_POST["autor_id"] . "";
      $result = $instance->ejecutarSQL($sql);
      $instance->cerrarConexion();
      header("Location: autor.php");
    }


    
 
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>
<body>
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Biblioteca-IUD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./autor.php">Autor</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./libro.php">Libro</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./usuario.php">Usuario</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./ejemplar.php">Ejemplar</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
        <h5>Eliminar Registro</h5>
        <hr />
        <form action="autor-eliminar.php" method="POST">
            <div class="row mb-3">
            <div class="col">
                <label class="form-label">Código</label>
                <input value="<?= $autorId?>" type="text" 
                  class="form-control" name="autor_id" required readonly >
              </div>
              <div class="col">
                <label class="form-label">Nombre</label>
                <input value="<?= $nombreAutor?>" type="text" 
                  class="form-control" name="nombre_autor" required>
              </div>
            </div>
            <div class="row">
                <div class="col">
                 <button type="submit" class="btn btn-dark" name="btnEliminar">Eliminar</button>
              </div>
            </div>
        </form>
    </div>
</body>
</html>