function rol_eliminar_msj(e) {

    if (confirm("¿Estás seguro que deseas eliminar el rol?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete0 = document.querySelectorAll("#btnEliminarRol");

for (var i = 0; i < linkDelete0.length; i++) {
    linkDelete0[i].addEventListener('click', rol_eliminar_msj);
}