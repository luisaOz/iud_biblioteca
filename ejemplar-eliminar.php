<?php
  require_once("libs/ConexionMySQL.php");

  $instance = ConexionMySQL::getInstance();
  
  // datos de la url

  $ejemplarId;
  $ubicacion;
  $idlibro;
  $titulo;

  if (isset($_GET["id"])) {
    $ejemplarId = $_GET["id"];
  }

  if (isset($_GET["ubicacion"])) {
    $ubicacion = $_GET["ubicacion"];
  }

  if (isset($_GET["idlibro"])) {
    $idlibro = $_GET["idlibro"];
  }

  
  if (isset($_GET["titulo"])) {
    $titulo = $_GET["titulo"];
  }


  // datos del activo post
  if (isset($_POST["btnEliminar"])) {
    $sql = "delete from ejemplar ejemplar_id = " . $_POST["ejemplarId"] . "" ;
    $result = $instance->ejecutarSQL($sql);
    $instance->cerrarConexion();
    header("Location: ejemplar.php");
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
        <h5>Editar Registro</h5>
        <hr />
        <form action="ejemplar-editar.php" method="POST">
            <div class="row mb-3">
            <div class="col">
                <label class="form-label">Código</label>
                <input value="<?= $ejemplarId?>" type="text" 
                  class="form-control" name="ejemplarId" required readonly >
              </div>
              <div class="col">
                <label class="form-label">Ubicacion</label>
                <input value="<?= $ubicacion?>" type="text" 
                  class="form-control" name="ubicacion" required>
              </div>
              <div class="col">
                <label class="form-label">Id Libro</label>
                <input value="<?= $idlibro?>" type="text" 
                  class="form-control" name="idlibro" required>
              </div>
              <div class="col">
                <label class="form-label">Titulo</label>
                <input value="<?= $titulo?>" type="text" 
                  class="form-control" name="titulo" required>
              </div>
            </div>
            <div class="row">
                <div class="col">
                 <button type="submit" class="btn btn-primary" name="btnEditar">Eliminar</button>
              </div>
            </div>
        </form>
    </div>
</body>
</html>