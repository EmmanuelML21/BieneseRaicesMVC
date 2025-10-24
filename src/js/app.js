document.addEventListener('DOMContentLoaded', function () {

    eventListeners();
    darkMode();
});
//dark Mode
function darkMode() {
    const preferencia = window.matchMedia('(prefers-color-scheme: dark)');
    //console.log(preferencia.matches);
    if (preferencia.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
    //en caso de cambie su interfaz se realize el cambio automaticamente
    preferencia.addEventListener('change', function () {
        if (preferencia.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });
    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobilMenu = document.querySelector('.mobile-menu');
    mobilMenu.addEventListener('click', navegacionResponisve);
    //muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name ="contacto[contacto]"]');
    //es agregar un evento listener a cada input de nuestro arreglo metodoContacto
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));

}

function navegacionResponisve() {
    const navegacion = document.querySelector('.navegacion');
    // navegacion.classList.toggle('mostrar') //es lo mismo que abajo pero mas limpio
    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    //le decimos al evento que busque en target que tipo de valor es
    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero de telefono</label>
            <input type="tel" placeholder="Tu telefono" id="telefono" name="contacto[telefono]" required>
            
            <p>Elija la fecha y hora para su llamada</p>

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="9:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <p>Digite su direccion de correo electronico</p>

            <label for="email">Email</label>
            <input type="email" placeholder="Tu email" id="email" name="contacto[email]" required>
        `;
    }


}