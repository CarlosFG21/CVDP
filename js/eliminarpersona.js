function persona_eliminar_msj(e) {

    if (confirm("¿Estás seguro que deseas eliminar el cliente o proveedor?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete4 = document.querySelectorAll("#btnEliminarPersona");

for (var i = 0; i < linkDelete4.length; i++) {
    linkDelete4[i].addEventListener('click', persona_eliminar_msj);
}