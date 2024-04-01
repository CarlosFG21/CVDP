function empleado_eliminar_msj(e) {

    if (confirm("¿Estás seguro que deseas eliminar el empleado?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete4 = document.querySelectorAll("#btnEliminarEmpleado");

for (var i = 0; i < linkDelete4.length; i++) {
    linkDelete4[i].addEventListener('click', empleado_eliminar_msj);
}