function categoriap_reactivar_msj(e) {

    if (confirm("¿Estás seguro que deseas reactivar la categoria?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete3 = document.querySelectorAll("#btnReactivarCategoria");

for (var i = 0; i < linkDelete3.length; i++) {
    linkDelete3[i].addEventListener('click', categoriap_reactivar_msj);
}