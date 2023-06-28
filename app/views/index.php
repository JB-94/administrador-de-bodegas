<!DOCTYPE html>
<html lang="en">

<head>
  <title>Persona</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

  <ul class="nav justify-content-center">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="../views/index.php">Registrar Bodega</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../views/lista.bodega.php">Lista Bodega</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../views/editar.bodega.php">Editar Bodega</a>
    </li>
  </ul>

  </ul>

</head>

<body>
  <div class="container">
    <div class="row justify-content-center p-5">
      <div class="col-sm-8">
        <h5>Formulario Para Ingresar Bodega</h5>
        <hr />
        <form onsubmit="app.guardar()">
          <input type="hidden" id="id" />
          <div class="mb-3">
            <label for="id_bodega" class="form-label">ID Bodega</label>
            <input type="text" class="form-control" id="id_bodega" placeholder="Alfanumérico de máximo 5 caracteres" required />
          </div>
          <div class="mb-3">
            <label for="id_comuna" class="form-label">ID Comuna</label>
            <select class="form-select" id="id_comuna" required>
              <option value="" disabled selected>Seleccionar</option>
              <?php
              require_once "../models/bodega.model.php";
              $comunas = bodega::mostrarComunas();
              foreach ($comunas as $comuna) {
                echo "<option value='" . $comuna['id_comuna'] . "'>" . $comuna['nombre_comuna'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="nombre_bodega" class="form-label">Nombre de la Bodega</label>
            <input type="text" class="form-control" id="nombre_bodega" placeholder="Ingrese Nombre" required />
          </div>
          <div class="mb-3">
            <label for="direccion_bodega" class="form-label">Dirección Bodega</label>
            <input type="text" class="form-control" id="direccion_bodega" placeholder="Ingrese Dirección" required />
          </div>
          <div class="mb-3">
            <label for="dotacion_bodega" class="form-label">Cantidad de personas que trabajan en la Bodega</label>
            <input type="number" class="form-control" id="dotacion_bodega" placeholder="Ingrese Cantidad" required />
          </div>
          
          <div class="mb-3">
            <label for="bodega_encargados" class="form-label">Seleccione Encargados</label>
            <?php
            require_once "../models/bodega.model.php";
            $usuarios = bodega::mostrarUsuarios();
            foreach ($usuarios as $usuario) {
              echo "<br/><input type='checkbox' class='form-check-input' name='encargados[]' value='" . $usuario['id_usuario'] . "'>" . $usuario['nombre_usuario'] . "</input>";
            }
            ?>
          </div>


          <div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
          </div>
        </form>
        <br />
        <h5>Listado De Bodegas</h5>
        <hr />
        <table class="table">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nombre</th>
              <th>Dirección</th>
              <th>Dotación</th>
              <th>Encargado(S)</th>
              <th>Estado</th>
              <th>Fecha creación</th>
            </tr>
          </thead>
          <tbody id="tbody"></tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="../assets/code.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>