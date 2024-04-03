function empleado_reactivar_msj(e) {

    if (confirm("¿Estás seguro que deseas reactivar el empleado?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete5 = document.querySelectorAll("#btnReactivarEmpleado");

for (var i = 0; i < linkDelete5.length; i++) {
    linkDelete5[i].addEventListener('click', empleado_reactivar_msj);
}