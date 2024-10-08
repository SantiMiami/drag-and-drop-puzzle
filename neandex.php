<?php
session_start();
$usuario = $_GET['nombre'];
$contraseña = $_GET['contraseña'];
$Description = isset($_POST['textoDescripcion']) ? $_POST['textoDescripcion'] : 0;
$Image = isset($_POST['image']) ? $_POST['image'] : 0;


$_SESSION['nombre'] = htmlspecialchars($usuario);
$_SESSION['contraseña'] = htmlspecialchars($contraseña);
//echo "<h1>".$_SESSION['nombre']."</h1>";
//echo "<h1>".$_SESSION['contraseña']."</h1>";

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
        .descripcion {
            display: block; /* Inicialmente oculto */
            position: absolute;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            max-width: 300px;
        }
        /* Estilo para el área de texto */
        .descripcion textarea {
            width: 100%;
            height: 100px;
            border: none;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 5px;
            font-size: 14px;
        }
        /* Estilo para el botón de edición */
        #editar {
            margin-top: 10px;
            cursor: pointer;
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
    <p style = "text-align: center;" id="cronometro">00:00:00</p>
    <div id = "Boton">
        <button style = "position: relative; left: 45%;">INICIO</button>
    </div>
    <div class="container">
        <div id="puzzle"></div>
        <div id="piezas"></div>
    </div>
    <div id="mensaje">
        <h1>¡Ganaste!</h1>
        <form action='Gestion_de_contenido.php' method='post' enctype='multipart/form-data'>
            <textarea id='Comentario' name = 'Comentario'  placeholder='¡Dejanos tu comentario!'></textarea>
            <br><br>
            <input type='submit' value='Enviar comentario'>
        </form>
    </div>
    <!-- Funciones del administrador -->
    <?php
     if ($_SESSION['nombre'] == 'admin' and $_SESSION['contraseña'] == md5('admin')){
        echo "
            <div id='infoBox'>
            <h2 id = Pais></h2>
            <h2 id = description>Descripción del pais</h2>
            <form action='Cambios_en_pagina.php' method='post' enctype='multipart/form-data'>
                <textarea id='textoDescripcion' placeholder='Cambia la descripción aqui'></textarea>
                <label for='archivo'>Cambiar imagen del Estadio</label>
                <input type='file' id='image' name='image'>
                <img id = 'imagen' src='' alt='Descripción de la imagen' width='200' height='200'>
                <br><br>
                <input type='submit' value='Subir Imagen'>
            </form>
        </div>
        <button id='toggleButton' onclick='toggleInfoBox()'>Mostrar Recuadro</button>";
    } else{
        echo "<div id='infoBox'>
            <h2 id = Pais></h2>
            <h2 id = description>Descripción del pais</h2>
            <img src = '../Codes/Reino_unido.png' alt='Descripción de la imagen' width='600' height='400'>
            <br><br>";
    }

    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script>
        usuario = <?php echo json_encode($usuario); ?>;
        contraseña = <?php echo json_encode($contraseña); ?>;
        var AlmDescripcion = '';
        var AlmImagen = '';

        const Reino_unido = [
            { name: 'Inglaterra', image: 'images/Inglaterra.png', description: 'Descripción de Inglaterra' },
            { name: 'Escocia', image: 'images/Escocia.png', description: 'Descripción de Escocia' },
            { name: 'Pais_de_gales', image: 'images/Pais_de_gales.png', description: 'Descripción del País de Gales' },
            { name: 'Irlanda_del_norte', image: 'images/Irlanda_del_norte.png', description: 'Descripción de Irlanda del Norte' },
            { name: 'Republica_de_irlanda', image: 'images/Republica_de_irlanda.png', description: 'Descripción de la República de Irlanda' },
            { name: 'Londres', image: 'images/Londres.png', description: 'Descripción de Londres' }
        ];

        Reino_unido_description = {
            'Londres':'Londres es la capital y la ciudad más grande del Reino Unido. Ubicada en el sureste de Inglaterra a lo largo del río Támesis, es un importante centro global para la finanza, la cultura, el arte y la política.',
            'Inglaterra':'Inglaterra es un país ubicado en la isla de Gran Bretaña, en el noreste de Europa. Es una de las cuatro naciones constituyentes del Reino Unido, junto con Escocia, Gales e Irlanda del Norte. Su capital es Londres, una ciudad globalmente influyente en finanzas, cultura y política.',
            'Pais_de_gales':'El País de Gales es conocido por sus paisajes montañosos, costas escénicas, y castillos históricos. La lengua galés tiene un papel importante en la cultura galesa. También es famoso por sus festivales de música y su herencia minera.',
            'Irlanda_del_norte':'Irlanda del Norte es conocida por sus paisajes rurales y urbanos, la vibrante ciudad de Belfast y su historia política compleja. El área es famosa por sus paisajes naturales como la Calzada del Gigante y su rica herencia cultural e histórica.',
            'Republica_de_irlanda':'La República de Irlanda es conocida por sus verdes paisajes, rica herencia cultural, y su vibrante vida urbana en ciudades como Dublín y Cork. También es famosa por su literatura, música tradicional y festivales culturales.',
            'Escocia':'Escocia es conocida por sus paisajes montañosos, lagos (incluido el famoso Loch Ness), y su rica historia y cultura. Es famosa por su whisky, castillos históricos y festivales como el Edinburgh Festival Fringe.'
        };

        const puzzle = document.getElementById('puzzle');
        const piezas = document.getElementById('piezas');
        const mensaje = document.getElementById('mensaje');
        const infoContainer = document.getElementById('info-container');
        const infoTitle = document.getElementById('info-title');
        const infoDescription = document.getElementById('info-description');
        const infoClose = document.getElementById('info-close');
        const infoContent = document.getElementById('infoContent');
        const infoBox = document.getElementById('infoBox');
        textoDescripcion = document.getElementById('textoDescripcion');
        Imagen = document.getElementById('imagen');
        ChangesButton = document.getElementById('Changes');
        Button = document.getElementById('Boton');

        let terminado = Reino_unido.length;

        // Crear las piezas y agregarlas al contenedor de piezas
        Reino_unido.forEach(pais => {
            const div = document.createElement('div');
            div.className = 'pieza';
            div.id = pais.name;
            div.draggable = true;
            div.style.backgroundImage = `url('${pais.image}')`; // Asignar imagen de fondo
            piezas.appendChild(div);
        });

        /*Reino_unido_ids.forEach(pais_id => {
            const div = document.createElement('div');
            div.className = 'pieza';
            div.id = pais_id;
            div.addEventListener('click', () => {
            });
        });*/

        const idsAdmin = ['imagen', 'textoDescripcion', 'infoBox'];
        const idUser = ['infoBox'];

        // Obtener los elementos en base a los IDs
        const elementos = usuario === 'admin' && contraseña === CryptoJS.MD5('admin').toString() ? idsAdmin.map(id => document.getElementById(id)) : idUser.map(id => document.getElementById(id));
        // Verificar si todos los elementos están presentes
        //const todosPresentes = elementos.every(elemento => elemento !== null);

        // Crear las áreas del rompecabezas
        Reino_unido.forEach(pais => {
            const div = document.createElement('div');
            div.className = 'placeholder puzzle-area ' + pais.name;
            div.dataset.id = pais.name;
            puzzle.appendChild(div);
        });

            let segundos = 0;
            let minutos = 0;
            let horas = 0;
            let intervalo;

            function actualizarCronometro() {
                segundos++;
                if (segundos >= 60) {
                    segundos = 0;
                    minutos++;
                    if (minutos >= 60) {
                        minutos = 0;
                        horas++;
                    }
                }

                // Formatear la hora, minutos y segundos para que siempre tengan dos dígitos
                const segundosTexto = segundos < 10 ? '0' + segundos : segundos;
                const minutosTexto = minutos < 10 ? '0' + minutos : minutos;
                const horasTexto = horas < 10 ? '0' + horas : horas;

                // Actualizar el contenido del cronómetro
                document.getElementById('cronometro').innerText = horasTexto + ':' + minutosTexto + ':' + segundosTexto;
        }

        function iniciarCronometro() {
            intervalo = setInterval(actualizarCronometro, 1000); // Actualiza cada segundo
        }

        function pausarCronometro() {
            clearInterval(intervalo);
            console.log(segundos);
        }

        function reiniciarCronometro() {
            clearInterval(intervalo);
            segundos = 0;
            minutos = 0;
            horas = 0;
            document.getElementById('cronometro').innerText = '00:00:00';
        } 

        Button.addEventListener('click', function() {
            Button.style.display = "none";
            bolDraggable = true;
            alert(bolDraggable);
            iniciarCronometro();
            if (bolDraggable){ 
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
            }
        });

        
            // Función para manejar el clic fuera del área

            puzzle.addEventListener('drop', e => {
                e.preventDefault();
        
            e.target.classList.remove('hover');
            const id = e.dataTransfer.getData('id');
            const pieza = document.getElementById(id);


            document.addEventListener('click', function(event){
                idTarget = event.target.id;
                console.log(`Dentro del evento de "click" ${idTarget}`);

                bolElement = false;
                bolCountry = false;

                function guardarContenido(){
                    AlmDescripcion = textoDescripcion.innerHTML;
                    AlmImagen = Imagen.innerHTML;
                
                    var changeImagen = Imagen.value;
                    console.log(changeImagen);
                    Reino_unido_description[idTarget] = textoDescripcion.value;
                    //Imagen.scr = changeImagen;
                    console.log(Reino_unido_description[idTarget]);
                }

                elementos.forEach(elements =>{
                    if (idTarget === elements.id) bolElement = true;
                });

                Reino_unido.forEach(Contrys =>{
                    if (idTarget === Contrys.name) bolCountry = true;
                });
                    
                if (bolCountry || bolElement){
                    infoBox.style.display = 'block';
                    if (bolCountry){
                        Pais.textContent = idTarget;
                        description.textContent = Reino_unido_description[idTarget];
                        //Boton.addEventListener('click', guardarContenido);
                    } 
                    if (infoBox.style.display === 'none') infoBox.style.display = 'block'; 
                } else{
                        if (infoBox.style.display === 'block') infoBox.style.display = 'none';
                    }
            });

                if (e.target.dataset.id === id) {
                    e.target.appendChild(pieza);
                    terminado--;
                    idTarget = e.target.dataset.id;
                    console.log(`Fuera del evento de "click" ${idTarget}`)
                    
                    bolElement = false;
                    bolCountry = false;

                    elementos.forEach(elements =>{
                        if (idTarget === elements.id) bolElement = true;
                    });

                    Reino_unido.forEach(Contrys =>{
                        if (idTarget === Contrys.name) bolCountry = true;
                    });
                        
                    if (bolCountry || bolElement){
                        infoBox.style.display = 'block';
                        if (bolCountry){
                            Pais.textContent = idTarget;
                            description.textContent = Reino_unido_description[idTarget];
                            //Boton.addEventListener('click', guardarContenido);
                        } 
                        if (infoBox.style.display === 'none') infoBox.style.display = 'block'; 
                    } else{
                            if (infoBox.style.display === 'block') infoBox.style.display = 'none';
                        }
                        
                        if (terminado === 0) {
                            document.body.classList.add('ganaste');
                            document.getElementById('infoBox').style.display = 'block';
                            pausarCronometro();
                            //Button.style.display = "block";
                        }
                    }                
        });   

    </script>
    <?php
     /*if ($usuario == 'admin' and $contraseña == md5('admin')){
        echo "
            <div id='infoBox'>
            <h2>Información</h2>
            <h1 id='infoContent' rows='10' cols='50'></h1>
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
