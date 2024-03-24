function rol_reactivar_msj(e) {

    if (confirm("¿Estás seguro que deseas reactivar el rol?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete1 = document.querySelectorAll("#btnReactivarRol");

for (var i = 0; i < linkDelete1.length; i++) {
    linkDelete1[i].addEventListener('click', rol_reactivar_msj);
}