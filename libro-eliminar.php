<?php
  require_once("libs/ConexionMySQL.php");

  $instance = ConexionMySQL::getInstance();
  
  // datos de la url
  $libroId;
  $nombreLibro;
  $isbn;
  $editorial;
  $paginas;
  $autorId;
  $autor;

  if (isset($_GET["id"])) {
    $libroId = $_GET["id"];
  }

  if (isset($_GET["titulo"])) {
    $nombreLibro = $_GET["titulo"];
  }

  if (isset($_GET["isbn"])) {
    $isbn = $_GET["isbn"];
  }

  if (isset($_GET["editorial"])) {
    $editorial = $_GET["editorial"];
  }

  if (isset($_GET["autorId"])) {
    $paginas = $_GET["paginas"];
  }

  if (isset($_GET["autor"])) {
    $autorId = $_GET["autorId"];
  }

  if (isset($_GET["autor"])) {
    $autor = $_GET["autor"];
  }




  // datos del activo post
  if (isset($_POST["btnEliminar"])) {    

    $sql = "select * from libro where autor_id = " . $_POST["autorId"] . "";
    $result = $instance->ejecutarSQL($sql);
  

  if ($result && $result->num_rows > 0) {
    header("Location: libro.php?error=true");
    echo "No puede eliminar el libro";
  }else{
    $sql = "delete from libro where libro_id = " . $_POST["libro_id"] . "" ;
    $result = $instance->ejecutarSQL($sql);
    $instance->cerrarConexion();
    header("Location: libro.php");
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro</title>
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
        <form action="libro-eliminar.php" method="POST">
            <div class="row mt-3">
            
                <label class="form-label">Código</label>
                <input value="<?= $libroId?>" type="text" 
                  class="form-control" name="libro_id" required readonly >
              </div>
              <div class="col">
                <label class="form-label">Nombre</label>
                <input value="<?= $nombreLibro?>" type="text" 
                  class="form-control" name="nombre_libro" required>
              </div>
              <div class="col">
                <label class="form-label">ISBN</label>
                <input value="<?= $isbn?>" type="text" 
                  class="form-control" name="isbn_libro" required>
              </div>
              <div class="col">
                <label class="form-label">Editorial</label>
                <input value="<?= $editorial?>" type="text" 
                  class="form-control" name="editorial_libro" required readonly>
              </div>
              <div class="col">
                <label class="form-label">Paginas</label>
                <input value="<?= $paginas?>" type="text" 
                  class="form-control" name="paginas_libro" required>
              </div>
              <div class="col">
                <label class="form-label">AutorID</label>
                <input value="<?= $autorId?>" type="text" 
                  class="form-control" name="autorId" required readonly>
              </div>
              <div class="col">
                <label class="form-label">Autor</label>
                <input value="<?= $autor?>" type="text" 
                  class="form-control" name="autor_libro" required readonly>
              </div>
            </div>
            <div class="row">
                <div class="col">
                 <button type="submit" class="btn btn-primary" name="btnEliminar">Eliminar</button>
              </div>
            </div>
        </form>
    </div>
</body>
</html>