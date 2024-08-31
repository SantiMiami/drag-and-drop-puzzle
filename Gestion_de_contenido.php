<?php
$servername = "localhost"; // Cambia esto al servidor de tu base de datos
$username = "root"; // Cambia esto a tu nombre de usuario de MySQL
$password = ""; // Cambia esto a tu contraseña de MySQL
$database = "reino unido"; // Cambia esto a tu nombre de base de datos
// Crea la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database, 1331);
// Verifica la conexión
if ($conn->connect_error) {
 die("Error de conexión a la base de datos: ".$conn->connect_error);
}

//Contador en tiempo real
session_start();
if (!isset($_SESSION['Tiempo']))$_SESSION['Tiempo'] = time();
$Segundos = time() - $_SESSION['Tiempo'];


/*if (!$_POST['username'] and !$_POST['password'] and !$_POST['r_username'] and !$_POST['r_password'] and !$_POST['comentario']){
    header("Location: Inicio_de_sesion.php");
}*/

//Si se ha registrado un usuario
if (isset($_POST['username']) and isset($_POST['password'])){ 
    //Recepcion de datos
    $Usuario = $_POST['username'];
    $Contraseña = $_POST['password'];


    //Encriptacion
    $contraseñaEncr = md5($Contraseña); //Contraseña
    $usuarioEncr = md5($Usuario); //Usuario
}

//Registro de sesion
if (isset($Usuario) and isset($Contraseña)) { //Si se han ingresado datos de registro  
    // Variables para la búsqueda
    $strSearchUser = $Usuario;
    $strSearchPass = $contraseñaEncr;
    $TableUser = 'usuario';
    $ColUser = 'nombre';
    $ColPass = 'contraseña';

    // Consulta SQL
    $sql = "SELECT * FROM $TableUser WHERE $ColUser = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $strSearchUser); // "s" indica que es una cadena de texto

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: neandex.php?nombre=" . urlencode($Usuario) . "&contraseña=" . urlencode($contraseñaEncr));
        exit();

    } else {
        echo "Usuario no disponible, porfavor, registrese para obtener una cuenta";
    }
    $stmt->close();
    if ($Segundos >= 15) {
        echo "Segundo aviso...";
        session_unset();
        session_destroy();
        header("Location: inicio_de_sesion.php");
        $Segundos = 0;
        exit();
    }
} else $UserStarted = $_SESSION['nombre'];

if (isset($_POST['Comentario'])){
    $UserComment = $_POST['Comentario']; //Almacenamiento de comentario
    //Registro de sesion
    if (isset($UserComment)) { //Si se han ingresado datos de registro  
        // Variables para la búsqueda
        $TableUser = 'usuario';
        $ColComment = 'comentario';

        // Consulta SQL
        $sql = "UPDATE $TableUser SET comentario='$UserComment' WHERE nombre = '$UserStarted'";
        $stmt = $conn->prepare($sql);

        $stmt->execute();
    }
}

$stmt->close();


    $strSearchUser = $r_usuario;
    $strSearchPass = $contraseñaEncr;
    $TableUser = 'usuario';
    $ColUser = 'nombre';
    $ColPass = 'contraseña';

    if (isset($r_usuario) and isset($r_contraseña)) { //Si se han ingresado datos de registro  
        // Variables para la búsqueda
        $strSearchUser = $r_usuario;
        $strSearchPass = $contraseñaEncr;
        $TableUser = 'usuario';
        $ColUser = 'nombre';
        $ColPass = 'contraseña';
    
        // Consulta SQL
        $sql = "SELECT * FROM $TableUser WHERE $ColUser = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $strSearchUser); // "s" indica que es una cadena de texto
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            echo "Este usuario ya esta registrado. Porfavor, inicie sesión";
        } else {
            echo "No se encuentra disponible";
            $sql = "INSERT INTO `usuario`(`nombre`, `contraseña`) VALUES (?, ?)";
            $stmtInsert = $conn->prepare($sql);
            $stmtInsert->bind_param("ss", $strSearchUser, $strSearchPass); // "ss" indica que ambos parámetros son cadenas de texto
            if ($stmtInsert->execute()) {
                echo "Nuevo registro insertado correctamente.";
            } else {
                echo "Error: " . $stmtInsert->error;
            }
            $stmtInsert->close();
        }
        $stmt->close();
    }


    if ($Segundos >= 15) {
        echo "Segundo aviso...";
        session_unset();
        session_destroy();
        header("Location: inicio_de_sesion.php");
        $Segundos = 0;
        exit();
    }
        /*if (!file_exists("usuario.txt")){
        fopen("usuario.txt", "w");
        $archUsuario = "usuario.txt"; 
        $dato_usuario = fopen($archUsuario, "r+");
        fwrite($dato_usuario, $usuarioEncr);
        fseek($dato_usuario, 0);
        $contenidoUser = fread($dato_usuario, filesize($archUsuario));
        fclose($dato_usuario);
        echo "<br>"; 
    } else{
        $archUsuario = "usuario.txt"; 
        $dato_usuario = fopen($archUsuario, "r+");
        fwrite($dato_usuario, $usuarioEncr);
        fseek($dato_usuario, 0);
        $contenidoUser = fread($dato_usuario, filesize($archUsuario));
        fclose($dato_usuario);
        echo "<br>";
    }
    //Contraseña
    if (!file_exists("contraseña.txt")){
        fopen("contraseña.txt", "w");
        $arcContraseña = "contraseña.txt";
        $dato_contraseña = fopen($arcContraseña, "r+");
        fwrite($dato_contraseña, $contraseñaEncr);
        fseek($dato_contraseña, 0);
        $contenidoPass = fread($dato_contraseña, filesize($arcContraseña));
        fclose($dato_contraseña); 
    } else{
        $arcContraseña = "contraseña.txt";
        $dato_contraseña = fopen($arcContraseña, "r+");
        fwrite($dato_contraseña, $contraseñaEncr);
        fseek($dato_contraseña, 0);
        $contenidoPass = fread($dato_contraseña, filesize($arcContraseña));
        fclose($dato_contraseña);
    }
    //DNI    
    if (!file_exists("DNI.txt")){
        fopen("DNI.txt", "w");
        $arcDNI = "DNI.txt";
        $dato_DNI = fopen($arcDNI, "r+");
        fwrite($dato_DNI, $DNIEncr);
        fseek($dato_DNI, 0);
        $contenidoDNI = fread($dato_DNI, filesize($arcDNI));
        fclose($dato_DNI); 
    } else{
        $arcDNI = "contraseña.txt";
        $dato_DNI = fopen($arcDNI, "r+");
        fwrite($dato_DNI, $contraseñaEncr);
        fseek($dato_DNI, 0);
        $contenidoDNI = fread($dato_DNI, filesize($arcDNI));
        fclose($dato_DNI);
    }

    echo "<h1>Registro realizado</h1>";
    if ($Segundos >= 5) {
        header("Location: Formulario.php");
        $Segundos = 0;
        exit();
    }
} else{
    //Inicio de sesion
    if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['DNI'])){ //Si el usuario y contraseña ingresados
        //Usuario
        $archUsuario = "usuario.txt"; 
        $dato_usuario = fopen($archUsuario, "r+");
        fseek($dato_usuario, 0);
        $contenidoUser = fread($dato_usuario, filesize($archUsuario));
        fclose($dato_usuario);
        echo "<br>";

        //Contraseña
        $arcContraseña = "contraseña.txt";
        $dato_contraseña = fopen($arcContraseña, "r+");
        fseek($dato_contraseña, 0);
        $contenidoPass = fread($dato_contraseña, filesize($arcContraseña));
        fclose($dato_contraseña);

        $inicio_usuario = md5($_POST['username']);
        $inicio_contraseña = md5($_POST['password']);
        $inicio_DNI = md5($_POST['DNI']);

        if ($contenidoPass == $inicio_contraseña and $contenidoUser == $inicio_usuario){
            echo "<h1>bienvenido</h1>";
            $_SESSION['password'] = $inicio_contraseña;
            $_SESSION['usuario'] = $inicio_usuario;
        } else{
            echo "<h1>usuario no registrado</h1>";
            if ($Segundos >= 5) {
                header("Location: Formulario.php");
                $Segundos = 0;
                exit();
            }
        }
    }
}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertir en Botón en Coordenadas</title>
    <style>
        #movable {
            width: 100px;
            height: 100px;
            background-color: blue;
            position: absolute;
            cursor: move;
            color: white;
            text-align: center;
            line-height: 100px;
        }

        #button {
            display: none;
            width: 100px;
            height: 50px;
            background-color: green;
            color: white;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="movable">Arrástrame</div>
    <div id="button">¡Haz clic!</div>

    <script>
        const movable = document.getElementById('movable');
        const button = document.getElementById('button');
        const targetX = 200; // Coordenada X objetivo
        const targetY = 200; // Coordenada Y objetivo
        const tolerance = 10; // Tolerancia para la comparación

        function makeMovable() {
            movable.onmousedown = function(event) {
                let shiftX = event.clientX - movable.getBoundingClientRect().left;
                let shiftY = event.clientY - movable.getBoundingClientRect().top;

                function moveAt(pageX, pageY) {
                    movable.style.left = pageX - shiftX + 'px';
                    movable.style.top = pageY - shiftY + 'px';
                    checkPosition();
                }

                moveAt(event.pageX, event.pageY);

                function onMouseMove(event) {
                    moveAt(event.pageX, event.pageY);
                }

                document.addEventListener('mousemove', onMouseMove);

                movable.onmouseup = function() {
                    document.removeEventListener('mousemove', onMouseMove);
                    movable.onmouseup = null;
                };
            };

            movable.ondragstart = function() {
                return false;
            };
        }

        function checkPosition() {
            const rect = movable.getBoundingClientRect();
            const x = rect.left + window.scrollX;
            const y = rect.top + window.scrollY;

            if (Math.abs(x - targetX) <= tolerance && Math.abs(y - targetY) <= tolerance) {
                makeButton();
            }
        }

        function makeButton() {
            movable.style.display = 'none'; // Oculta el div movible
            button.style.display = 'block'; // Muestra el botón

            button.onclick = function() {
                alert('¡Botón presionado!');
            };
        }

        makeMovable();
    </script>
</body>
</html>



<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condición a Botón</title>
    <style>
        #movable {
            width: 100px;
            height: 100px;
            background-color: blue;
            position: absolute;
            cursor: move;
        }

        #button {
            display: none;
            width: 100px;
            height: 50px;
            background-color: green;
            color: white;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="movable"></div>
    <div id="button">¡Haz clic!</div>

    <script>
        let movable = document.getElementById('movable');
        let button = document.getElementById('button');

        // Función para mover el div
        function makeMovable() {
            movable.onmousedown = function(event) {
                let shiftX = event.clientX - movable.getBoundingClientRect().left;
                let shiftY = event.clientY - movable.getBoundingClientRect().top;

                function moveAt(pageX, pageY) {
                    movable.style.left = pageX - shiftX + 'px';
                    movable.style.top = pageY - shiftY + 'px';
                }

                moveAt(event.pageX, event.pageY);

                function onMouseMove(event) {
                    moveAt(event.pageX, event.pageY);
                }

                document.addEventListener('mousemove', onMouseMove);

                movable.onmouseup = function() {
                    document.removeEventListener('mousemove', onMouseMove);
                    movable.onmouseup = null;
                };
            };
        }

        // Simula la condición
        setTimeout(() => {
            // Condición cumplida
            movable.style.display = 'none'; // Oculta el div movible
            button.style.display = 'block'; // Muestra el botón

            button.onclick = function() {
                alert('¡Botón presionado!');
            };
        }, 5000); // Ejemplo de condición cumplida después de 5 segundos

        makeMovable();
    </script>
</body>
</html>

    <script>
        const movable = document.getElementById('movable');
        const button = document.getElementById('button');
        const targetX = 100; // Coordenada X objetivo
        const targetY = 100; // Coordenada Y objetivo
        const tolerance = 10; // Tolerancia para la comparación

        function makeMovable() {
            movable.onmousedown = function(event) {
                let shiftX = event.clientX - movable.getBoundingClientRect().left;
                let shiftY = event.clientY - movable.getBoundingClientRect().top;

                function moveAt(pageX, pageY) {
                    movable.style.left = pageX - shiftX + 'px';
                    movable.style.top = pageY - shiftY + 'px';
                    checkPosition();
                }

                moveAt(event.pageX, event.pageY);

                function onMouseMove(event) {
                    moveAt(event.pageX, event.pageY);
                }

                document.addEventListener('mousemove', onMouseMove);

                movable.onmouseup = function() {
                    document.removeEventListener('mousemove', onMouseMove);
                    movable.onmouseup = null;
                };
            };

            movable.ondragstart = function() {
                return false;
            };
        }

        function checkPosition() {
            const rect = movable.getBoundingClientRect();
            const x = rect.left + window.scrollX;
            const y = rect.top + window.scrollY;
            
            if (Math.abs(x - targetX) <= tolerance && Math.abs(y - targetY) <= tolerance) {
                makeButton();
            }
        }

        function makeButton() {
            movable.style.display = 'none'; // Oculta el div movible
            button.style.display = 'block'; // Muestra el botón

            button.onclick = function() {
                alert('¡Botón presionado!');
            };
        }

        makeMovable();
    </script>
*/

echo "
<script>setInterval(function() {
    location.reload();
}, 1000);</script>";


?>