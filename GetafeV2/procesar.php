<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}
?>
<?php
$usuario = $_POST["usuario"];
$nombre = $_POST["nombre"];
$apellido1 = $_POST["apellido1"];
$apellido2 = $_POST["apellido2"];
$correo = $_POST["correo"];
$edad = $_POST["edad"];

$entrada = $_POST["entrada"];

$dias = $_POST["dias"];

$metodo = $_POST["metodo"];

$comentario = $_POST["comentario"];

$foto = $_FILES["foto"];
?>

<?php
if ($edad < 18) {
    echo "Acceso no permitido. el evento es exclusivo para mayores de edad.";
    exit;
}
?>
<?php
if ($foto["error"] !== UPLOAD_ERR_OK) {
    echo "Error al subir la fotografía.";
    exit;
}
/*basename te da el nombre base del archivo, no la ruta entera solo el nombre */
$extension = pathinfo(basename($foto["name"]), PATHINFO_EXTENSION);
if (!is_dir("uploads")) {
    mkdir("uploads");
}
$ruta = "uploads/user_" . uniqid() . "." . $extension;

$resultado = move_uploaded_file($foto["tmp_name"], $ruta);

if (!$resultado) {
    echo "No se ha podido guardar la fotografía.";
    exit;
}
?>
<?php
$precioTotal = 0;
foreach ($dias as $dia) {
    $precioTotal += 10;
}
if ($entrada == "general") {
    $precioTotal += 50;
} elseif ($entrada == "vip") {
    $precioTotal += 120;
} elseif ($entrada == "super-vip") {
    $precioTotal += 180;
}

$nombresEntrada = ["general" => "General", "vip" => "VIP", "super-vip" => "Super VIP"];
$nombresDias = ["viernes" => "Viernes", "sabado" => "Sábado", "domingo" => "Domingo"];
$nombresMetodo = ["tarjeta-de-credito" => "Tarjeta de Crédito", "bizum" => "Bizum", "paypal" => "PayPal"];

$diasTexto = [];
foreach ($dias as $dia) {
    $diasTexto[] = $nombresDias[$dia];
}

$linea = date("Y-m-d H:i:s") . "|" . $nombre . "|" . $correo . "|" . $edad . "|" . $nombresEntrada[$entrada] . "|" . implode(", ", $diasTexto) . "|" . $nombresMetodo[$metodo] . "|" . $precioTotal . "€" . "|" . $ruta . "|" . $comentario . "\n";
file_put_contents("reservas.txt", $linea, FILE_APPEND);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Getafest</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php include "header.php"; ?>
<div>
    <h2>TICKET</h2>
    <fieldset class="info-ticket">
        <div class="texto-info">
            <h3>Nombre:</h3>
            <?php echo "<p>" . $nombre . "</p>" ?>
            <h3>Apellidos:</h3>
            <?php echo "<p>" . $apellido1 . " " . $apellido2 . "</p>" ?>
            <h3>Correo de Contacto:</h3>
            <?php echo "<p>" . $correo . "</p>" ?>
            <h3>Edad:</h3>
            <?php echo "<p>" . $edad . "</p>" ?>
            <h3>Entrada:</h3>
            <?php echo "<p>" . $entrada . "</p>" ?>
            <h3>Dias:</h3>
            <?php foreach ($dias as $dia) {
                echo "<p>" . $dia . "</p>";
            } ?>
        </div>
        <div class="info-ticket2">
            <div class="foto-guardada">
                <img src="<?php echo $ruta; ?>" alt="Imagen" class="foto-ticket">
            </div>


            <h3>Metodo de Pago:</h3>
            <?php echo "<p>" . $metodo . "</p>" ?>
            <h3>Precio Total:</h3>
            <?php echo "<p>" . $precioTotal . "€" . "</p>" ?>
        </div>
    </fieldset>
    <form class="form-inline acciones-ticket" action="ver_reservas.php" method="POST">
        <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
        <button type="submit">Ver Reservas</button>
    </form>
</div>
</body>