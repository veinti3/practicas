<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festival</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<?php include "header.php"; ?>

<form action="procesar.php" method="POST" enctype="multipart/form-data">

    <h2>RELLENA CON TUS DATOS</h2>

    <fieldset>

        <legend>Informacion Personal</legend>

        <div class="informacion">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Nombre Completo">
        </div>

        <div class="informacion">
            <label for="apellido1">Apellido 1</label>
            <input type="text" id="apellido1" name="apellido1" required placeholder="Apellido 1">
        </div>

        <div class="informacion">
            <label for="apellido2">Apellido 2</label>
            <input type="text" id="apellido2" name="apellido2" required placeholder="Apellido 2">
        </div>

        <div class="informacion">
            <label for="correo">Correo Electronico</label>
            <input type="email" id="correo" name="correo" required placeholder="correo@dominio.es">
        </div>

        <div class="informacion">
            <label for="edad">Edad</label>
            <input type="number" id="edad" name="edad" required placeholder="Edad">
        </div>

    </fieldset>


    <fieldset>

        <legend>Configuracion del Pase</legend>

        <div class="grupo-radios-pase">

            <label>Tipo de Entrada:</label>

            <input type="radio" id="general" name="entrada" value="general" required>
            <label for="general">General (50€)</label>

            <input type="radio" id="vip" name="entrada" value="vip">
            <label for="vip">VIP (120€)</label>

            <input type="radio" id="super-vip" name="entrada" value="super-vip">
            <label for="super-vip">Super VIP (180€)</label>

        </div>


        <div class="grupo-checkbox-dias">

            <label>Dias del Festival:</label>

            <input type="checkbox" id="viernes" name="dias[]" value="viernes">
            <label for="viernes">Viernes (10€)</label>

            <input type="checkbox" id="sabado" name="dias[]" value="sabado">
            <label for="sabado">Sabado (10€)</label>

            <input type="checkbox" id="domingo" name="dias[]" value="domingo">
            <label for="domingo">Domingo (10€)</label>

        </div>


        <div class="metodo-pago">

            <label for="metodo">Metodo de Pago</label>

            <select name="metodo" id="metodo">

                <option value="tarjeta-de-credito">Tarjeta de Credito</option>
                <option value="bizum">Bizum</option>
                <option value="paypal">PayPal</option>

            </select>

        </div>


        <div class="foto-asistente">

            <label for="foto">Foto del Asistente</label>

            <input type="file" id="foto" name="foto" accept="image/*">

        </div>


        <div class="observacion">

            <label for="comentario">Comentario o Observaciones</label>

            <input type="text" name="comentario" id="comentario">

        </div>

    </fieldset>


    <button type="submit">ENVIAR FORMULARIO</button>

</form>

</body>
</html>
