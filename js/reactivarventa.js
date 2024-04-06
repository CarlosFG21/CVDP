function venta_reactivar_msj(e) {

    if (confirm("¿Estás seguro que deseas reactivar la venta?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete5 = document.querySelectorAll("#btnReactivarVenta");

for (var i = 0; i < linkDelete5.length; i++) {
    linkDelete5[i].addEventListener('click', venta_reactivar_msj);
}