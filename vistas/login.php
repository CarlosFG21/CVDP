<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app/AdminLTE-3.2.0/dist/css/login.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />
    <title>Document</title>
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="active"> Iniciar Session </h2>

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="../app/AdminLTE-3.2.0/dist/img/logo.png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form action="../clases/Validacion.php" id="form-login" method="post" name="form-login">
                <input type="text" id="usuario" class="fadeIn second" name="usuario" placeholder="Usuario">
                <input type="password" id="contraseña" class="fadeIn third" name="contraseña" placeholder="Contraseña">
                <input type="submit" class="fadeIn fourth" value="Ingresar">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#"></a>
            </div>

        </div>
    </div>

</body>

</html>