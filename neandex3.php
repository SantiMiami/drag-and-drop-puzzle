<?php
$usuario = $_GET['nombre'];
$contraseña = $_GET['contraseña'];
echo "<h1>".$usuario."</h1>";
echo "<h1>".$contraseña."</h1>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag and Drop (2)</title>
    <style>
        body {
            font-family: Arial, Verdana, sans-serif;
        }
        #infoBox {
            display: none; /* Ocultar inicialmente */
            position: fixed;
            top: 5%;
            left: 50%;
            transform: translate(-50%, 0);
            width: 80%;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Estilo del botón */
        #toggleButton {
            display: none; /* Ocultar inicialmente */
        }

        #piezas {
            display: flex;
            flex-wrap: wrap;
            width: 200px;
            margin: auto;
            justify-content: center;
        }

        #puzzle {
            border: 1px solid black;
            width: 700px;
            height: 1000px;
            display: flex;
            flex-wrap: wrap;
            margin: auto;
            background-image: url('Reino_unido.png');
            background-size: cover; /* Ajusta el tamaño de la imagen para cubrir el contenedor */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat;
        }

        .pieza {
            width: 165px;
            height: 105px;
            background-size: cover;
            margin: 10px;
            border-radius: 50%;
            background-size: cover; /* Ajusta el tamaño de la imagen para cubrir el contenedor */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat;
        }

        .placeholder {
            background-color: #F2F2F2;
            outline: 1px solid #333;
            border-radius: 50%;
            width: 165px;
            height: 106px;
            transition: 1s;
        }

        .placeholder.hover {
            background-color: orange;
        }

        .placeholder .pieza {
            margin: 0;
        }
        .Republica_de_irlanda {
            position: relative;
            top: 80px;
            left: 30px;
            background-color: #fffb00;
            outline: 1px solid #333;
            border-radius: 50%;
            width: 165px;
            height: 106px;
            transition: 1s;
        }

        .Republica_de_irlanda.hover {
            background-color: orange;
        }

        .Republica_de_irlanda .pieza {
            margin: 0;
        }
        .Irlanda_del_norte {
            position: relative;
            top: 450px;
            right: 380px;
            background-color: #00ff37;
            outline: 1px solid #333;
            border-radius: 50%;
            width: 165px;
            height: 106px;
            transition: 1s;
        }

        .Irlanda_del_norte.hover {
            background-color: orange;
        }

        .Irlanda_del_norte .pieza {
            margin: 0;
        }
        .Inglaterra {
            position: relative;
            left: 450px;
            top: 600px;
            background-color: #ff00b3;
            outline: 1px solid #333;
            border-radius: 50%;
            width: 165px;
            height: 106px;
            transition: 1s;
        }

        .Inglaterra.hover {
            background-color: orange;
        }

        .Inglaterra .pieza {
            margin: 0;
        }
        .Pais_de_gales {
            position: relative;
            top: 730px;
            left: 10px;
            background-color: #2600ff;
            outline: 1px solid #333;
            border-radius: 50%;
            width: 165px;
            height: 106px;
            transition: 1s;
        }

        .Pais_de_gales.hover {
            background-color: orange;
        }

        .Pais_de_gales .pieza {
            margin: 0;
        }

        .Escocia {
            position: relative;
            top: 170px;
            left: 110px;
            background-color: #ce0808;
            outline: 1px solid #333;
            border-radius: 50%;
            width: 165px;
            height: 106px;
            transition: 1s;
        }

        .Escocia.hover {
            background-color: orange;
        }

        .Escocia.pieza {
            margin: 0;
        }

        .Londres {
            position: relative;
            top: 210px;
            left: 360px;
            background-color: #08cece;
            outline: 1px solid #333333;
            border-radius: 50%;
            width: 165px;
            height: 106px;
            transition: 1s;
        }

        .Londres.hover {
            background-color: orange;
        }

        .Londres.pieza {
            margin: 0;
        }

        #mensaje {
            color: black;
            text-align: center;
            display: none;
        }

        .ganaste {
            background-color: #B3D67C;
        }

        .ganaste #mensaje {
            display: block;
        }

        .ganaste .placeholder {
            outline: none;
        }

        .ganaste #piezas {
            display: none;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="puzzle"></div>
        <div id="piezas"></div>
    </div>
    <h1 id="mensaje">¡Ganaste!</h1>
    <!-- Funciones del administrador -->
    <?php
     if ($usuario == 'admin' and $contraseña == md5('admin')){
        echo "
            <div id='infoBox'>
            <h2>Información</h2>
            <h1 id='infoContent' rows='10' cols='50'>Texto editable...</h1>
            <form action='/ruta/al/servidor' method='post' enctype='multipart/form-data'>
            <label for='archivo'>Elige un archivo:</label>
            <input type='file' id='archivo' name='archivo'>
            <br><br>
            <input type='submit' value='Subir Archivo'>
        </form>
            <img src='../Codes/Reino_unido.png' alt='Descripción de la imagen' width='200' height='200'>
            <br>
            <button onclick='saveInfo()'>Guardar</button>
        </div>
        <button id='toggleButton' onclick='toggleInfoBox()'>Mostrar Recuadro</button>";
    } else{
        echo "<div id='infoBox'>
            <h2>Información</h2>
            <h1 id='infoContent' rows='10' cols='50'>Texto editable...</h1>
            <img src='../Codes/Reino_unido.png' alt='Descripción de la imagen' width='600' height='400'>
            <br><br>
            <input type='submit' value='Subir Archivo'>";
    } 
    ?>


<script>
    const Reino_unido = [
        'Inglaterra', 'Escocia', 'Pais_de_gales',
        'Irlanda_del_norte', 'Republica_de_irlanda', 'Londres'
    ];

    const puzzle = document.getElementById('puzzle');
    const piezas = document.getElementById('piezas');
    const mensaje = document.getElementById('mensaje');
    const infoBox = document.getElementById('infoBox');
    const infoContent = document.getElementById('infoContent');

    let terminado = Reino_unido.length;

    // Crear las piezas y agregarlas al contenedor de piezas
    Reino_unido.forEach(pais => {
        const div = document.createElement('div');
        div.className = 'pieza';
        div.id = pais;
        div.draggable = true;
        div.style.backgroundImage = `url('images/${pais}.png')`; // Asignar imagen de fondo
        piezas.appendChild(div);
    });

    // Crear las áreas del rompecabezas
    Reino_unido.forEach(pais => {
        const div = document.createElement('div');
        div.className = pais;
        div.dataset.id = pais;
        puzzle.appendChild(div);
    });

    piezas.addEventListener('dragstart', e => {
        e.dataTransfer.setData('id', e.target.id);
    });

    puzzle.addEventListener('dragover', e => {
        e.preventDefault();
        e.target.classList.add('hover');
    });

    puzzle.addEventListener('dragleave', e => {
        e.target.classList.remove('hover');
    });

    puzzle.addEventListener('drop', e => {
        e.preventDefault();
        e.target.classList.remove('hover');

        const id = e.dataTransfer.getData('id');
        const pieza = document.getElementById(id);

        // Verifica que el elemento de destino sea válido
        if (e.target.dataset.id === id) {
            e.target.appendChild(pieza);

            // Mostrar información del país
            const pais = e.target.dataset.id;
            infoContent.textContent = pais;
            infoBox.style.display = 'block'; // Mostrar el recuadro de información

            terminado--;

            if (terminado === 0) {
                document.body.classList.add('ganaste');
            }
        }
    });

    // Función para guardar la información (opcional)
    function saveInfo() {
        // Implementar lógica para guardar información si es necesario
        alert('Información guardada!');
    }

    // Mostrar y ocultar el infoBox
    function toggleInfoBox() {
        if (infoBox.style.display === 'none' || infoBox.style.display === '') {
            infoBox.style.display = 'block';
        } else {
            infoBox.style.display = 'none';
        }
    }

    // Mostrar el infoBox por defecto si es admin
    if (document.getElementById('toggleButton')) {
        document.getElementById('toggleButton').addEventListener('click', toggleInfoBox);
    }
</script>

    <?php
     /*if ($usuario == 'admin' and $contraseña == md5('admin')){
        echo "
            <div id='infoBox'>
            <h2>Información</h2>
            <h1 id='infoContent' rows='10' cols='50'>Texto editable...</h1>
            <form action='/ruta/al/servidor' method='post' enctype='multipart/form-data'>
            <label for='archivo'>Elige un archivo:</label>
            <input type='file' id='archivo' name='archivo'>
            <br><br>
            <input type='submit' value='Subir Archivo'>
        </form>
            <img src='../Codes/Reino_unido.png' alt='Descripción de la imagen' width='200' height='200'>
            <br>
            <button onclick='saveInfo()'>Guardar</button>
        </div>
        <button id='toggleButton' onclick='toggleInfoBox()'>Mostrar Recuadro</button>";
    } else{
        echo "<div id='infoBox'>
            <h2>Información</h2>
            <h1 id='infoContent' rows='10' cols='50'>Texto editable...</h1>
            <img src='../Codes/Reino_unido.png' alt='Descripción de la imagen' width='600' height='400'>
            <br><br>
            <input type='submit' value='Subir Archivo'>";
    } */
    ?>
</body>
</html>
