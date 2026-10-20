<?php
$error = "";
$acceso = false;
$usuarioLogin = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuarioLogin = $_POST["usuario"];
    $password = $_POST["password"];

    if (!file_exists("usuario.txt")) {
        $error = "Error: No existe el archivo usuario.txt";
    } else {
        $lineas = file("usuario.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lineas as $linea) {
            $partes = explode(":", $linea);
            if (trim($partes[0]) === $usuarioLogin && trim($partes[1]) === $password) {
                $acceso = true;
            }
        }
        if (!$acceso) {
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Getafest</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php include "header.php"; ?>

<?php if ($acceso) { ?>
    <form id="formAcceso" class="form-inline" action="index.php" method="POST">
        <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuarioLogin); ?>">
        <noscript><button type="submit">Entrar</button></noscript>
    </form>
    <script>
        document.getElementById("formAcceso").submit();
    </script>
<?php } else { ?>
    <form action="login.php" method="POST">

        <h2>Iniciar Sesión</h2>

        <?php if ($error !== "") { ?>
            <div class="error-login"><?php echo $error; ?></div>
        <?php } ?>

        <div class="informacion">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required placeholder="Ingresa tu usuario">
        </div>

        <div class="informacion">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required placeholder="Ingresa tu contraseña">
        </div>

        <button type="submit">Entrar al Sistema</button>

    </form>
<?php } ?>

</body>
</html>
