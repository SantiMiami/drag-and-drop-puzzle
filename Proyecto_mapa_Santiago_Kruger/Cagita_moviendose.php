<?php
$x = 100;
$y = 100;

echo "<!DOCTYPE html>
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
            width: 200px;
            height: 250px;
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
</body>
</html>
"





?>