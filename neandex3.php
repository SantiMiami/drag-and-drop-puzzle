<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronómetro con JavaScript</title>
</head>
<body>
    <h1>Cronómetro</h1>
    <p id="cronometro">00:00:00</p>
    <button onclick="iniciarCronometro()">Iniciar</button>
    <button onclick="pausarCronometro()">Pausar</button>
    <button onclick="reiniciarCronometro()">Reiniciar</button>

    <script>
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
        }

        function reiniciarCronometro() {
            clearInterval(intervalo);
            segundos = 0;
            minutos = 0;
            horas = 0;
            document.getElementById('cronometro').innerText = '00:00:00';
        }
    </script>
</body>
</html>
