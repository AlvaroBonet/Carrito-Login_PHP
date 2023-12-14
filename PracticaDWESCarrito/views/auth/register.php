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
    <form id="login-form" action="doRegister" method="post">
      <h2>Registrar</h2>
      <div class="form-group">
        <label for="username">Email:</label>
        <input type="text" name="email" id="username" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
      </div>
      <div class="form-group">
        <label for="password">Comprobacion contraseña:</label>
        <input type="password" name="password-verify" id="password" required>
      </div>
      <div class="form-group">
        <button type="submit" id="login-button">Registrar</button>
        <a href="login">Iniciar Sesion</a>
      </div>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>
