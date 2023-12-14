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
      <div>
        <button><a href="index-carrito">Carrito</a></button>
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
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Precio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $relojes = new Relojes();
            $reloj = $relojes -> findAll()->fetchAll();
                # Cargamos las filas con los datos a la tabla
                //https://developer.mozilla.org/es/docs/Web/HTML/Element/input/hidden
                foreach ($reloj as $key => $value) {
                    echo "<tr>";
                    echo    "<td>" . $value['nombre'] ."</td>";
                    echo    "<td>" . $value['marca'] ."</td>";
                    echo    "<td>" . $value['precio'] ."</td>";
                    echo    "<td>
                                <form action='agregarProducto?id=" . $value['id'] . "' method='post'> 
                                <input type='hidden' name='id' value='" . $value['id'] . "'>
                                <input type='hidden' name='nombre' value='" . $value['nombre'] . "'>
                                <input type='hidden' name='precio' value='" . $value['precio'] . "'>
                                <input type='number' name='cantidad' value='1' min='1'>
                                <button type='submit'>COMPRAR</button>
                                </form>
                             </td>";
                    echo "</tr>";
                }
            ?>
            
        </tbody>
    </table>
  </main>
</body>
</html>
