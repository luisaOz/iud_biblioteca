<?php
  require_once("libs/ConexionMySQL.php");

  function getEditorial() {
    $instance = ConexionMySQL::getInstance();
    $sql = "select * from editorial";
    $result = $instance->ejecutarSQL($sql);
    $instance->cerrarConexion();
    return $result;
  }

  $editoriales = getEditorial();
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
              <li class="nav-item">
            <a class="nav-link" href="./prestamos.php">Prestamos</a>
          </li>
            </ul>
          </div>
        </div>
      </nav>
        <div class="row mb-3">
          <div class="col">
            <a href="editorial-crear.php" class="btn btn-primary">Nuevo registro</a>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Código</th>
                  <th scope="col">Nombre</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if (!empty($editoriales)) { // diferente de vacio
                    foreach ($editoriales as $editorial) {
                ?>
                <tr>
                  <td><?=$editorial["editorial_id"]?></td>
                  <td><?=$editorial["nombre"]?></td>
                  <td>
                    <a href="editorial-editar.php?id=<?=$editorial["editorial_id"]?>&nombreEditorial=<?=$editorial["nombre"]?>" 
                      class="btn btn-dark btn-sm">Editar</a>
                    <a href="editorial-eliminar.php?id=<?=$editorial["editorial_id"]?>&nombreEditorial=<?=$editorial["nombre"]?>" 
                    class="btn btn-dark btn-sm">Eliminar</a>
                  </td>
                </tr>
                <?php 
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
</body>
</html>