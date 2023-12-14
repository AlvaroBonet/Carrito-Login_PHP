<!DOCTYPE html>
<html>
<head>
  <title>Página web</title>
  <link rel="stylesheet" type="text/css" href="../asset/css/style.css">
  <link rel="stylesheet" type="text/css" href="../asset/css/private.css">
  <!-- <link rel="stylesheet" type="text/css" href="../../asset/css/auth.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="navbar-brand">
        <a href="#">Logo</a>
      </div>
      <div class="user-profile">
        <img src="../asset/img/profile-pic.jpg" alt="Foto de perfil" class="profile-pic" id="dropdownMenuLink">
        <a href="#" class="username" id="dropdownMenuLink"><?php echo $_SESSION['user']['email']?> <i class="fas fa-caret-down"></i></a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="edit-perfil"><i class="fas fa-user"></i> Ver perfil</a>
          <a class="dropdown-item" href="destroy-perfil"><i class="fas fa-user-slash"></i> Eliminar cuenta</a>
          <a class="dropdown-item" href="logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
        </div>
      </div>
    </nav>
  </header>
  
  <main>
    <h2 style="margin-left: 50%; " >RELOJES</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $relojes = new Relojes();
            $reloj = $relojes -> findAll()->fetchAll();
                # Cargamos las filas con los datos a la tabla
                foreach ($reloj as $key => $value) {
                    echo "<tr>";
                    echo    "<td>" . $value['id'] ."</td>";
                    echo    "<td>" . $value['nombre'] ."</td>";
                    echo    "<td>" . $value['marca'] ."</td>";
                    echo    "<td>" . $value['precio'] ."</td>";
                    echo '<td>
                              <a href="edit-reloj?id='.$value['id'].'">Editar</a>
                              <a href="destroy-reloj?id='.$value['id'].'">Eliminar</a>
                          </td>';
                    echo "</tr>";
                }
            ?>
            
        </tbody>
    </table>
    <h2 style="margin-left: 50%; " >PEDIDOS</h2>
    <table style="margin: 20px; margin-right: 40px;">
        <thead>
            <tr>
                <th>ID_Usuario</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php
              $totalCarrito = 0;
                foreach ($_SESSION['carritos'] as $id => $producto) {              
                  foreach ($producto as $id2 => $producto2) {
                  echo "<tr>";
                  echo "<td>" . $id . "</td>";
                  echo "<td>" . $producto2['nombre'] . "</td>";
                  echo "<td>" . $producto2['precio'] . "</td>";
                  echo "<td>" . $producto2['cantidad'] . "</td>";
                  echo "<td>" . ($producto2['precio'] * $producto2['cantidad']) . "</td>";
                  echo "</tr>";
                }
              }
            ?>
        </tbody>
    </table>
  </main>
</body>
</html>
