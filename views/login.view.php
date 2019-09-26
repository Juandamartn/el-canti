<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>

<body>
    <div class="wrap">
        <header>
            <img src="img/cantinflas-logo.png" alt="Antojitos El Cantinflas">
        </header>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="login" id="login" method="POST">
            <div class="frmLog" id="frmLog">
                <i class="fas fa-user"></i>
                <input type="text" name="username" class="user" id="user" placeholder="Usuario" REQUIRED>
            </div>

            <div class="frmLog" id="frmLog">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="pass" id="pass" placeholder="Contraseña" REQUIRED>
            </div>

            <?php if (!empty($errors)): ?>

            <div class="errors" id="errors">
                <ul>
                    <?php echo $errors; ?>
                </ul>
            </div>

            <?php endif; ?>

            <div class="submit" id="submit">
                <button type=submit>
                    <i class="fas fa-sign-in-alt"></i> Ingresar
                </button>
            </div>
        </form>
    </div>
</body>

</html>
