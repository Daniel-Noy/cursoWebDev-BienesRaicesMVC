let darkmode = localStorage.getItem('modo-activado');


document.addEventListener('DOMContentLoaded', ()=> {
    eventlisteners();
    verificarModo();
})


function eventlisteners() {
    const botonMenu = document.querySelector('.menu-desplegable');
    botonMenu.addEventListener('click', navegacionResponsive);
    
    const darkBoton = document.querySelector('.dark-mode-boton');
    darkBoton.addEventListener('click', modoOscuro);

    
    const tipoContacto = document.querySelectorAll('[name=metodo-contacto]');
    tipoContacto.forEach( input => {
        input.addEventListener('click', mostrarInputs);
    })
}



function navegacionResponsive() {
    const menuDesplegable = document.querySelector('.nav-header');

    menuDesplegable.classList.toggle('mostrar');
}

function modoOscuro() {
    darkmode = localStorage.getItem('modo-activado');

    if (darkmode === '0') {
        document.body.classList.add('dark-mode');
        localStorage.setItem('modo-activado', '1');
        console.log('if');
    }   else {
        document.body.classList.remove('dark-mode');
        localStorage.setItem('modo-activado', '0');
        console.log('else');
    }
    console.log(darkmode);
}

function verificarModo() {
    if(darkmode === '1') {
        document.body.classList.add('dark-mode');
    }
}

function mostrarInputs(input) {
    const contactoDiv = document.querySelector('.inputs-contacto');
    const inputId = input.target.id;

    if(inputId === 'metodo-email') {
        contactoDiv.innerHTML = 
        `
        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email" placeholder="Tu Correo Electronico">
        `
    } else {
        contactoDiv.innerHTML = 
        `
        <label for="telefono">Telefono:</label>
        <input type="tel" name="telefono" id="telefono" placeholder="Tu Teléfono">

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha">

        <label for="fecha">Hora: (disponibilidad)</label>
        <input type="time" name="hora" id="hora" min="09:00" max="18:00">
        `
    }
}