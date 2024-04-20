<?php
  require_once("libs/ConexionMySQL.php");

  $instance = ConexionMySQL::getInstance();
  
  $tituloLibro;
  $isbnLibro;
  $editorialLibro;
  $paginasLibro;
  $autorid;

//pregunto si esta definido el campo que fue definido en el formulario (abajo)
  if (isset($_POST["titulo_libro"])) {
    $tituloLibro = $_POST["titulo_libro"];
  }
  if (isset($_POST["isbn_libro"])) {
    $isbnLibro = $_POST["isbn_libro"];
  }
  if (isset($_POST["editorial_libro"])) {
    $editorialLibro = $_POST["editorial_libro"];
  }
  if (isset($_POST["paginas_libro"])) {
    $paginasLibro = $_POST["paginas_libro"];
  }

 if (isset($_POST["autor_libro"])) {
    $autorid = $_POST["autor_libro"];
  }

  if (isset($_POST["btnRegistrar"])) {
    $sql = "INSERT INTO libro (titulo, isbn, editorial_id, paginas, autor_id) 
    VALUES ('$tituloLibro', '$isbnLibro', '$editorialLibro', '$paginasLibro', '$autorid')";
    
    $result = $instance->ejecutarSQL($sql);
    $instance->cerrarConexion();
    header("Location: libro.php");
  }

  function getAutores() {
    $instance = ConexionMySQL::getInstance();
    $sql = "select * from autor";
    $result = $instance->ejecutarSQL($sql);
    $instance->cerrarConexion();
    return $result;
  }
  if (isset($_GET["error"])) {
    $error = $_GET["error"];
  }

  $autores = getAutores();

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
            </ul>
          </div>
        </div>
      </nav>

  <div class="container mb-3">
      <h5>Libro</h5>
      <hr />
      <div class="row">
        <div class="col-sm-6">
          <h5>Editorial</h5>
          <a href="editorial-crear.php" class="btn btn-primary">Crear</a>
        </div>
        <div class="col-sm-6">
          <a href="editorial.php" class="btn btn-primary">Consultar</a>
        </div>
      </div>
    </div>
  </div>
        <form action="libro-crear.php" method="POST" class ="container mb-3">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo_libro" required>
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">ISBN</label>
                  <input type="text" class="form-control" name="isbn_libro" required>
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Editorial</label>
                  <input type="text" class="form-control" name="editorial_libro" required>
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Páginas</label>
                  <input type="number" class="form-control" name="paginas_libro" required>
              </div>
              <div class="mb-3">
                <?php if (!empty($autores)) : ?>
                    <select class="form-select" name ="autor_libro">
                        <?php foreach ($autores as $autor) : ?>
                            <option value="<?= $autor["autor_id"]; ?>"><?= $autor["nombre"];?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
              </div>
              <button type="submit" class="btn btn-primary" name="btnRegistrar">Guardar</button>
         </form> 
  </div>
</body>
</html>