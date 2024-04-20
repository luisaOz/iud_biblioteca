<?php
require_once("libs/ConexionMySQL.php");

$instance = ConexionMySQL::getInstance();

// datos de la url
$nombre;
$idprestamo;
$idusuario;
$fechaInicio;
$fechadev;
$localizacion;
$ejemplar;

if (isset($_GET["nombre"])) {
  $nombre = $_GET["nombre"];
}

if (isset($_GET["prestamo"])) {
  $idprestamo = $_GET["prestamo"];
}

if (isset($_GET["id"])) {
  $idusuario = $_GET["id"];
}

if (isset($_GET["fechaInicio"])) {
  $fechaInicio = $_GET["fechaInicio"];
}

if (isset($_GET["fechaDevolucion"])) {
  $fechadev = $_GET["fechaDevolucion"];
}

if (isset($_GET["localizacion"])) {
  $localizacion = $_GET["localizacion"];
}

if (isset($_GET["ejemplar"])) {
  $ejemplar = $_GET["ejemplar"];
}



// datos del activo post
if (isset($_POST["btnEliminar"])) {
  $sql = "  delete from prestamos where id_prestamo = " . $_POST["idprestamo"] . "" ;
  $result = $instance->ejecutarSQL($sql);
  $instance->cerrarConexion();
  header("Location: prestamos.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prestamo</title>
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
        <form action="prestamos-eliminar.php" method="POST">
            <div class="row mt-3">
            
                <label class="form-label">Usuario</label>
                <input value="<?= $nombre?>" type="text" 
                  class="form-control" name="nombre" required readonly >
              </div>
              <div class="col">
                <label class="form-label">Prestamo</label>
                <input value="<?= $idprestamo?>" type="text" 
                  class="form-control" name="idprestamo" required readonly>
              </div>
              <div class="col">
                <label class="form-label">Id Usuario</label>
                <input value="<?= $idusuario?>" type="text" 
                  class="form-control" name="id" required readonly>
              </div>
              
              <div class="col">
                <label class="form-label">Localización</label>
                <input value="<?= $localizacion?>" type="text" 
                  class="form-control" name="autor_libro" required readonly>
              </div>
              <hr />
              <h5>Grabar fecha de prestamo</h5>
              <hr />
              <div class="col">
                <label class="form-label">Fecha Inicio</label>
                <input value="<?= $fechaInicio?>" type="text" 
                  class="form-control" name="fechaInicio" required>
              </div>
              <div class="col">
                <label class="form-label">Fecha devolucion</label>
                <input value="<?= $fechadev?>" type="text" 
                  class="form-control" name="fechadev" required>
              </div>
            </div>
            <hr />
            <div class="row">
                <div class="col">
                 <button type="submit" class="btn btn-primary" name="btnEliminar">Eliminar</button>
              </div>
            </div>
        </form>
    </div>
</body>
</html>