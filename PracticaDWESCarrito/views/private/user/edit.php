<!DOCTYPE html>
<html>
<head>
  <title>Página web</title>
  <link rel="stylesheet" type="text/css" href="../asset/css/style.css">
  <link rel="stylesheet" type="text/css" href="../asset/css/private.css">

  <link rel="stylesheet" type="text/css" href="../asset/css/auth.css">
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
          <?php if($_SESSION['user']['rol_id'] == 2){
            echo '<a class="dropdown-item" href="destroy-perfil"><i class="fas fa-user-slash"></i> Eliminar cuenta</a>';
          }
          ?>
          <a class="dropdown-item" href="index-user"><i class="fas fa-users"></i> Ver usuarios</a>
          <a class="dropdown-item" href="logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
        </div>
      </div>
    </nav>
  </header>
  
  <main>
    <!-- Contenido de la página -->
    <div class="container">
    <form id="login-form" action="store-user" method="post">
      <h2>Email</h2>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" value="<?php echo $users['email']?>" name="email" id="email" >
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
      </div>
      <div class="form-group">
        <select name="rol_id">
            <?php
                // foreach ($roles as $key => $value) {
                //     echo "<option value='" . $value['id'] . "'>" . $value['nombre'] . "</option>";
                // }
            ?>
        </select>
        <button type="submit" id="login-button" >Crear</button>
      </div>
    </form>
  </div>
  </main>
</body>
</html>
