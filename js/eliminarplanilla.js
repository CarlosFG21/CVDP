function eliminar_planilla_msj(e) {

    if (confirm("¿Estás seguro que deseas eliminar la planilla/pago del empleado?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete6 = document.querySelectorAll("#btnEliminarPago");

for (var i = 0; i < linkDelete6.length; i++) {
    linkDelete6[i].addEventListener('click', eliminar_planilla_msj);
}