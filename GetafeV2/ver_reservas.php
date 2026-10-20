<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["usuario"])) {
    header("Location: login.php");
    exit;
}
$usuario = $_POST["usuario"];

$reservas = [];
if (file_exists("reservas.txt")) {
    $reservas = file("reservas.txt", FILE_IGNORE_NEW_LINES);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reservas - Getafest</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php include "header.php"; ?>
<div class="contenedor">
    <div class="cabecera-listado">
        <h2>Listado de Reservas</h2>
        <form class="form-inline" action="index.php" method="POST">
            <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
            <button type="submit">+ Nueva Reserva</button>
        </form>
    </div>

    <div class="tabla-scroll">
        <table class="tabla-reservas">
            <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Edad</th>
                <th>Pase</th>
                <th>Pago</th>
                <th>Total</th>
                <th>Acción Admin</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($reservas as $indice => $linea) {
                if (trim($linea) === "") {
                    continue;
                }
                $id = $indice + 1;
                $datos = explode("|", $linea);
                echo "<tr>";
                echo "<td>" . $id . "</td>";
                echo "<td>" . htmlspecialchars($datos[0]) . "</td>";
                echo "<td>" . htmlspecialchars($datos[1]) . "</td>";
                echo "<td>" . htmlspecialchars($datos[2]) . "</td>";
                echo "<td>" . htmlspecialchars($datos[3]) . "</td>";
                echo "<td>" . htmlspecialchars($datos[4]) . "</td>";
                echo "<td>" . htmlspecialchars($datos[6]) . "</td>";
                echo "<td>" . htmlspecialchars($datos[7]) . "</td>";
                echo "<td>";
                echo "<form class='form-inline' action='ver_pase.php' method='POST'>";
                echo "<input type='hidden' name='usuario' value='" . htmlspecialchars($usuario) . "'>";
                echo "<input type='hidden' name='id' value='" . $id . "'>";
                echo "<button type='submit' class='boton-pase'>Ver Pase</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
