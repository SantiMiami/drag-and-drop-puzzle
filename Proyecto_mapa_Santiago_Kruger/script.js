document.addEventListener('DOMContentLoaded', () => {
    // Definir los datos de información para cada ciudad
    const cityData = {
        'new-york':{
            text:'<h1>La idea seria que, el usuario al acceder a la pagina, tendría que armar el pais, indicando cada uno de sus estados. Si el estado colocado es correcto, este indicará el estadio de futbol correspondiente. Cuanto mas rapido termine el rompecabezas, mayor puntaje tendra el usuario y se mostrará una pantalla el puntaje de cada uno. Puede variar entre estados o entre estadio.',
            image: '../copamer/Idea_proyecto.png'
        },
        /* 
        'los-angeles':{ 
            text:'Los Ángeles es famosa por su industria del entretenimiento y sus playas.',
            image: '../copamer/californiaa.jpg'
        },

        'chicago':{ 
            text:'Chicago es conocida por su arquitectura y su comida.',
            image: '../copamer/californiaa.jpg'
        },*/
        
        // Agrega más datos de ciudades aquí
    };
    const infoContainer = document.getElementById('info-container');
    const infoText = document.getElementById('info-text');
    const infoImage = document.getElementById('info-image');


    // Función para mostrar información
    function showInfo(cityId) {
        const info = cityData[cityId];
        if (info){
            infoText.textContent = info.text;
            infoImage.src = info.image;
            infoContainer.style.display = 'block';
        }
    }

    // Añadir eventos de clic a cada ciudad
    const cities = document.querySelectorAll('.city');
    cities.forEach(city => {
        city.addEventListener('click', () => {
            const cityId = city.id;
            showInfo(cityId);
        });
    });

    document.addEventListener('click', (event) => {
        if (!infoContainer.contains(event.target) && !event.target.classList.contains('city')) {
            infoContainer.style.display = 'none';
        }
    });
});

const block = document.getElementById('block1');

let isDragging = false; // Estado del arrastre
let offsetX, offsetY; // Desplazamientos del ratón

// Evento cuando el ratón se presiona sobre el bloque
block.addEventListener('mousedown', (event) => {
    isDragging = true;
    offsetX = event.clientX - block.getBoundingClientRect().left;
    offsetY = event.clientY - block.getBoundingClientRect().top;
    block.style.cursor = 'grabbing'; // Cambia el cursor al arrastrar
});

// Evento cuando el ratón se mueve
document.addEventListener('mousemove', (event) => {
    if (isDragging) {
        const x = event.clientX - offsetX;
        const y = event.clientY - offsetY;
        block.style.left = `${x}px`;
        block.style.top = `${y}px`;
    }
});

// Evento cuando se suelta el ratón
document.addEventListener('mouseup', () => {
    isDragging = false;
    block.style.cursor = 'grab'; // Cambia el cursor de vuelta
});