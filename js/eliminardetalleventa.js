function detallev_eliminar_msj(e) {

    if (confirm("¿Estás seguro que deseas eliminar la informacion del producto?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete4 = document.querySelectorAll("#btnEliminarDetalleV");

for (var i = 0; i < linkDelete4.length; i++) {
    linkDelete4[i].addEventListener('click', detallev_eliminar_msj);
}