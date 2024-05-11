function cotizacion_eliminar_msj(e) {

    if (confirm("¿Estás seguro que deseas eliminar la informacion de la cotizacion?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete4 = document.querySelectorAll("#btnEliminarCotizacion");

for (var i = 0; i < linkDelete4.length; i++) {
    linkDelete4[i].addEventListener('click', cotizacion_eliminar_msj);
}