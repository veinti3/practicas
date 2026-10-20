<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["usuario"])) {
    header("Location: login.php");
    exit;
}
$usuario = $_POST["usuario"];

if ($usuario !== "admin") {
    echo "Acceso denegado. Solo el administrador puede ver los pases.";
    exit;
}

$id = (int) $_POST["id"];
$datos = null;

if (file_exists("reservas.txt")) {
    $reservas = file("reservas.txt", FILE_IGNORE_NEW_LINES);
    if (isset($reservas[$id - 1]) && trim($reservas[$id - 1]) !== "") {
        $datos = explode("|", $reservas[$id - 1]);
    }
}

if ($datos === null) {
    echo "No se ha encontrado la reserva.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pase Digital - Getafest</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php include "header.php"; ?>
<div class="contenedor">
    <h2 class="centrado">Acreditación #<?php echo $id; ?> (Vista Administrador)</h2>

    <div class="pase-digital">
        <img src="<?php echo htmlspecialchars($datos[8]); ?>" alt="Foto del asistente">
        <h3><?php echo htmlspecialchars($datos[1]); ?></h3>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($datos[2]); ?></p>
        <p><strong>Edad:</strong> <?php echo htmlspecialchars($datos[3]); ?> años</p>
        <p><strong>Tipo de Entrada:</strong> <?php echo htmlspecialchars($datos[4]); ?></p>
        <p><strong>Días de asistencia:</strong> <?php echo htmlspecialchars($datos[5]); ?></p>
        <p><strong>Método de pago:</strong> <?php echo htmlspecialchars($datos[6]); ?></p>
        <p><em>"<?php echo htmlspecialchars($datos[9]); ?>"</em></p>
        <p class="total">Total: <?php echo htmlspecialchars($datos[7]); ?></p>
    </div>

    <form action="ver_reservas.php" method="POST" class="form-inline centrado">
        <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
        <button type="submit">← Volver al listado de reservas</button>
    </form>
</div>
</body>
</html>