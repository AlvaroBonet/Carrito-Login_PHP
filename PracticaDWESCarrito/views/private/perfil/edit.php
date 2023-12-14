<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../asset/css/auth.css">
  <link rel="stylesheet" type="text/css" href="../asset/css/style.css">
</head>
<body>
    <header>
        <?php
            if(isset($_SESSION['mensaje'])){
                echo "<h1 style='color:red;'>".$_SESSION['mensaje']."</h1>";
            }
        ?>
</header>
  <div class="container">
    <form id="login-form" action="update-perfil" method="post">
      <h2>Cambiar contraseña</h2>
      <div class="form-group">
        <label for="old-password">Contraseña actual:</label>
        <input type="password" name="old-password" id="old-password" required>
      </div>
      <div class="form-group">
        <label for="new-password">Contraseña nueva:</label>
        <input type="password" name="new-password" id="new-password" required>
      </div>
      <div class="form-group">
        <label for="password">Comprobacion contraseña:</label>
        <input type="password" name="password-verify" id="password" required>
      </div>
      <div class="form-group">
        <button type="submit" id="login-button">Actualizar</button>
      </div>
      <div>
        <a href="home">Atras</a>
      </div>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>
