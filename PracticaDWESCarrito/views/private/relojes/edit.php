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
    <form id="login-form" action="update-reloj?id=<?php echo $relojes['id']?>" method="post">
      <h2>EDITANDO <?php echo $relojes['nombre']?></h2>
      <div class="form-group">
        <label for="text">Nombre:</label>
        <input type="text" value="<?php echo $relojes['nombre']?>" name="nombre">
      </div>
      <div class="form-group">
        <label for="text">Marca:</label>
        <input type="text" value="<?php echo $relojes['marca']?>" name="marca">      
      </div>
      <div class="form-group">
        <label for="text">Precio:</label>
        <input type="text" value="<?php echo $relojes['precio']?>" name="precio">      
      </div>
      <button type="submit">EDITAR</button>
    </form>
  </div>
  </main>
</body>
</html>
