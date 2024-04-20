<?php
  require_once("libs/ConexionMySQL.php");
  $error= false;

  function getLibros() {
    $instance = ConexionMySQL::getInstance();
    $sql = "select l.libro_id,
    l.titulo, 
    l.isbn,
    l.paginas,
    l.autor_id,
    e.nombre as nombre_editorial, 
    a.nombre as autor 
    from libro as l
    inner join editorial as e on l.editorial_id = e.editorial_id 
    inner join autor as a on l.autor_id = a.autor_id";

    $result = $instance->ejecutarSQL($sql);
    $instance->cerrarConexion();
    return $result;
  }
  if (isset($_GET["error"])) {
    $error = $_GET["error"];
  }

  
  $libros = getLibros();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="./style.css" rel="stylesheet" />
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
        <h3>Libro</h3>
        <hr />
        <div class="row mt-3">
          <div class="col">
          <?php if($error== true){
              ?>
          <div class="alert alert-danger" role="alert">
          No puede eliminar el libro
          </div>
          <?php 
            }
            ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">ISBN</th>
                <th scope="col">Editorial</th>
                <th scope="col">Páginas</th>
                <th scope="col">Id_Autor</th>
                <th scope="col">Autor</th>
                <th scope="col">Editar/Eliminar</th>
                
              </tr>
            </thead>
            <tbody>
              <?php
                    if (!empty($libros)) { // diferente de vacio
                      foreach ($libros as $libro) {
                  ?>

              <tr>
                <td><?=$libro["libro_id"]?></td>
                <td><?=$libro["titulo"]?></td>
                <td><?=$libro["isbn"]?></td>
                <td><?=$libro["nombre_editorial"]?></td>
                <td><?=$libro["paginas"]?></td>
                <td><?=$libro["autor_id"]?></td>
                <td><?=$libro["autor"]?></td>
                <td>
                    <a href="libro-editar.php?id=<?=$libro["libro_id"]?>&titulo=<?=$libro["titulo"]?>
                    &isbn=<?=$libro["isbn"]?>
                    &editorial=<?=$libro["nombre_editorial"]?>
                    &paginas=<?=$libro["paginas"]?>
                    &autorId=<?=$libro["autor_id"]?>
                    &autor=<?=$libro["autor"]?>" 
                    class="btn btn-dark btn-sm">Editar</a>

                    <a href="libro-eliminar.php?id=<?=$libro["libro_id"]?>&titulo=<?=$libro["titulo"]?>
                    &isbn=<?=$libro["isbn"]?>
                    &editorial=<?=$libro["nombre_editorial"]?>
                    &paginas=<?=$libro["paginas"]?>
                    &autorId=<?=$libro["autor_id"]?>
                    &autor=<?=$libro["autor"]?>" 
                    
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
        <div class="row mb-3">
          <div class="col">
            <a href="libro-crear.php" class="btn btn-primary">Nuevo registro</a>
          </div>
        </div>
</body>
</html>