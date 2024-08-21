<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detectar clics</title>
    <style>
        #area {
            width: 200px;
            height: 200px;
            background-color: lightblue;
            position: absolute;
            top: 50px;
            left: 50px;
            border: 2px solid blue;
        }
    </style>
</head>
<body>
    <div id="area"></div>

    <script>
        // Obtener el elemento que queremos observar
        const area = document.getElementById('area');

        // Función para manejar el clic dentro del área
        function handleClickInside(event) {
            console.log('Clic dentro del área.');
        }

        // Función para manejar el clic fuera del área
        function handleClickOutside(event) {
            if (!area.contains(event.target)) {
                console.log('Clic fuera del área.');
            }
        }

        // Agregar el evento de clic al documento
        document.addEventListener('click', handleClickOutside);

        // Agregar el evento de clic al área
        area.addEventListener('click', handleClickInside);
    </script>
</body>
</html>
