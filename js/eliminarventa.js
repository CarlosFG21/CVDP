function venta_eliminar_msj(e) {

    if (confirm("¿Estás seguro que deseas eliminar la venta?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete4 = document.querySelectorAll("#btnEliminarVenta");

for (var i = 0; i < linkDelete4.length; i++) {
    linkDelete4[i].addEventListener('click', venta_eliminar_msj);
}