<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Inicio de Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="Gestion_de_contenido.php" method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Iniciar Sesión">
        <h3>¿No tienes una cuenta? ¡Registrate!</h3>
    </form>
    <h2>Registro</h2>
    <form action="Gestion_de_contenido.php" method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="r_username" name="r_username" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="r_password" name="r_password" required><br><br>
    <input type="submit" value="Registro">
        <!--<h2>Pregunta de seguridad</h2>
        <label for="username">Pregunta de seguridad:</label>
        <select id="Direccion" name="Direccion">
            <option value="Vertical">¿</option>
            <option value="Horizontal">Horizontal</option>
        </select>
        <label for="password">Pregunta de seguridad:</label>
        <input type="text" id="Security_cuestion" name="Security_cuestion" required><br><br>
        <label for="password">Respuesta:</label>
        <input type="password" id="Answer" name="Answer" required><br><br>
        -->

        

    <div id="session-expired" style="display:none; color:red;">
        La sesión ha expirado.
    </div>

    <?php if (isset($_GET['session']) && $_GET['session'] == 'expired'): ?>
        <script>
            document.getElementById('session-expired').style.display = 'block';
        </script>
    <?php endif; ?>
    

    <div id="session-expired" style="display:none; color:red;">
        La sesión ha expirado.
    </div>
</body>
</html>