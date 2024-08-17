<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag and Drop</title>
    <style>
        body {
            font-family: Arial, Verdana, sans-serif;
            margin: 0;
            padding: 0;
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
            position: relative;
        }

        .pieza {
            width: 165px;
            height: 105px;
            background-size: cover;
            margin: 10px;
            border-radius: 5px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            cursor: pointer;
        }

        .placeholder {
            background-color: #F2F2F2;
            border: 2px dashed #333;
            border-radius: 5px;
            width: 165px;
            height: 105px;
            transition: background-color 0.3s;
        }

        .placeholder.hover {
            background-color: orange;
        }

        .info-container {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border: 1px solid #ccc;
            padding: 15px;
            display: none;
            z-index: 1000;
        }

        .info-container img {
            max-width: 100px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }

        .info-container button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .info-container button:hover {
            background-color: #0056b3;
        }

        .ganaste {
            background-color: #B3D67C;
        }

        .ganaste #mensaje {
            display: block;
        }

        .ganaste #piezas {
            display: none;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
        }

        .puzzle-area {
            border: 2px solid transparent; /* Border for visibility */
            border-radius: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="puzzle"></div>
        <div id="piezas"></div>
    </div>
    <h1 id="mensaje">¡Ganaste!</h1>
    
    <!-- Contenedor para mostrar información del país -->
    <div id="info-container" class="info-container">
        <div id="info-content">
            <img id="info-image" src="" alt="Imagen del país">
            <h2 id="info-title"></h2>
            <p id="info-description"></p>
            <button id="info-close">Cerrar</button>
        </div>
    </div>

    <script>
        const Reino_unido = [
            { name: 'Inglaterra', image: 'images/Inglaterra.png', description: 'Descripción de Inglaterra' },
            { name: 'Escocia', image: 'images/Escocia.png', description: 'Descripción de Escocia' },
            { name: 'Pais_de_gales', image: 'images/Pais_de_gales.png', description: 'Descripción del País de Gales' },
            { name: 'Irlanda_del_norte', image: 'images/Irlanda_del_norte.png', description: 'Descripción de Irlanda del Norte' },
            { name: 'Republica_de_irlanda', image: 'images/Republica_de_irlanda.png', description: 'Descripción de la República de Irlanda' },
            { name: 'Londres', image: 'images/Londres.png', description: 'Descripción de Londres' }
        ];

        const puzzle = document.getElementById('puzzle');
        const piezas = document.getElementById('piezas');
        const mensaje = document.getElementById('mensaje');
        const infoContainer = document.getElementById('info-container');
        const infoTitle = document.getElementById('info-title');
        const infoImage = document.getElementById('info-image');
        const infoDescription = document.getElementById('info-description');
        const infoClose = document.getElementById('info-close');

        let terminado = Reino_unido.length;

        // Crear las piezas y agregarlas al contenedor de piezas
        Reino_unido.forEach(pais => {
            const div = document.createElement('div');
            div.className = 'pieza';
            div.id = pais.name;
            div.draggable = false;
            div.style.backgroundImage = `url('${pais.image}')`; // Asignar imagen de fondo
            piezas.appendChild(div);
        });

        // Crear las áreas del rompecabezas
        Reino_unido.forEach(pais => {
            const div = document.createElement('div');
            div.className = 'placeholder puzzle-area ' + pais.name;
            div.dataset.id = pais.name;
            puzzle.appendChild(div);
        });

        piezas.addEventListener('dragstart', e => {
            e.dataTransfer.setData('id', e.target.id);
        });

        puzzle.addEventListener('dragover', e => {
            e.preventDefault();
            if (e.target.classList.contains('placeholder')) {
                e.target.classList.add('hover');
            }
        });

        puzzle.addEventListener('dragleave', e => {
            if (e.target.classList.contains('placeholder')) {
                e.target.classList.remove('hover');
            }
        });

        puzzle.addEventListener('drop', e => {
            e.preventDefault();
            if (e.target.classList.contains('placeholder')) {
                e.target.classList.remove('hover');

                const id = e.dataTransfer.getData('id');
                const pieza = document.getElementById(id);

                // Verifica que el elemento de destino sea válido
                if (e.target.dataset.id === id) {
                    e.target.appendChild(pieza);
                    pieza.classList.add('pieza'); // Asegura que el estilo se mantenga
                    
                    // Mostrar información del país
                    const paisInfo = Reino_unido.find(pais => pais.name === id);
                    if (paisInfo) {
                        infoTitle.textContent = paisInfo.name;
                        infoImage.src = paisInfo.image;
                        infoDescription.textContent = paisInfo.description;
                        infoContainer.style.display = 'block';
                    }
                    
                    terminado--;

                    if (terminado === 0) {
                        document.body.classList.add('ganaste');
                    }
                }
            }
        });

        infoClose.addEventListener('click', () => {
            infoContainer.style.display = 'none';
        });
    </script>
</body>
</html>
