function cotizacion_reactivar_msj(e) {

    if (confirm("¿Estás seguro que deseas reactivar la cotizacion?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete5 = document.querySelectorAll("#btnReactivarCotizacion");

for (var i = 0; i < linkDelete5.length; i++) {
    linkDelete5[i].addEventListener('click', cotizacion_reactivar_msj);
}