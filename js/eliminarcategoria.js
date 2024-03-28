function categoriap_eliminar_msj(e) {

    if (confirm("¿Estás seguro que deseas eliminar la categoria?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete2 = document.querySelectorAll("#btnEliminarCategoria");

for (var i = 0; i < linkDelete2.length; i++) {
    linkDelete2[i].addEventListener('click', categoriap_eliminar_msj);
}