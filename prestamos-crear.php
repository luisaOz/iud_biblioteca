<?php
require_once("libs/ConexionMySQL.php");

$instance = ConexionMySQL::getInstance();

// datos de la url

$idusuario;
$fechaInicio;
$fechadev;
$ejemplar;



if (isset($_POST["usuario"])) {
  $idusuario = $_POST["usuario"];
}

if (isset($_POST["fechaInicio"])) {
  $fechaInicio = $_POST["fechaInicio"];
}

if (isset($_POST["fechadev"])) {
  $fechadev = $_POST["fechadev"];
}


if (isset($_POST["ejemplar"])) {
  $ejemplar = $_POST["ejemplar"];
}



// datos del activo post
if (isset($_POST["btnEditar"])) {
  $sql = "INSERT INTO prestamos (
    id_usuario,
    fecha_inicio,
    fecha_devolucion, 
    ejemplar_id
    ) VALUES (
    " . $_POST["usuario"] . ",
    '" . $_POST["fechaInicio"] . "',
    '" . $_POST["fechadev"] . "',
    '" . $_POST["ejemplar"] . "'

    )";
  $result = $instance->ejecutarSQL($sql);
  $instance->cerrarConexion();
  header("Location: prestamos.php");
}

function getUsuario(){

  $instance = ConexionMySQL::getInstance();
  $sql="select * from usuario";
  $result = $instance->ejecutarSQL($sql);
  $instance->cerrarConexion();
  return $result;
}
$usuarios=getUsuario();

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
        <h5>Nuevo Registro</h5>
        <hr />
        <form action="prestamos-crear.php" method="POST">
            <div class="row mt-3">
            <div class="mb-3">
                <?php if (!empty($usuarios)) : ?>
                    <select class="form-select" name="usuario">
                    <?php foreach ($usuarios as $usuario) : ?>
                            <option value="<?= $usuario["id_usuario"]; ?>"><?= $usuario["nombre"];?></option>
                    <?php endforeach; ?>
				            </select>
                <?php endif; ?>
              </div>
              <div class="col">
                <label class="form-label">Ejemplar</label>
                <input type="text" class="form-control" name="ejemplar" required>
              </div>
              <hr />
              <h5>Grabar fecha de prestamo</h5>
              <hr />
              <div class="col">
                <label class="form-label">Fecha Inicio</label>
                <input type="text" class="form-control" name="fechaInicio" required>
              </div>
              <div class="col">
                <label class="form-label">Fecha devolucion</label>
                <input type="text" class="form-control" name="fechadev" required>
              </div>
            </div>
            <div class="row">
                <div class="col">
                 <button type="submit" class="btn btn-primary" name="btnEditar">Guardar</button>
              </div>
            </div>
        </form>
    </div>
</body>
</html>