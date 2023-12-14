<?php

if (!isset($_SESSION['carritos'][$_SESSION['user']['id']])) {
  $_SESSION['carritos'][$_SESSION['user']['id']] = [];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/style.css">
    <link rel="stylesheet" type="text/css" href="../asset/css/private.css">
</head>
<header>
    <nav class="navbar">
      <div class="navbar-brand">
        <a href="#">Logo</a>
      </div>
      <div>
        <button><a href="home">Inicio</a></button>
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
<body>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total (€)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
              $totalCarrito = 0;
                foreach ($_SESSION['carritos'][$_SESSION['user']['id']] as $id => $producto) {
                  echo "<tr>";
                  echo "<td>" . $producto['nombre'] . "</td>";
                  echo "<td>" . $producto['precio'] . "</td>";
                  echo "<td>" . $producto['cantidad'] . "</td>";
                  echo "<td>" . ($producto['precio'] * $producto['cantidad']) . "</td>";
                  echo "<td><a href='eliminarDelCarrito?id=" . $producto['id'] . "'>Eliminar</a></td>"; 
                  echo "</tr>";

                  $totalCarrito += ($producto['precio'] * $producto['cantidad']);

                }
            ?>
        </tbody>
    </table>
    <div class="total-carrito">
        <p>Total Carrito: 
          <?php 
            echo $totalCarrito; 
          ?>
        €</p>
    </div>        
</body>
</html>

