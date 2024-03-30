function persona_reactivar_msj(e) {

    if (confirm("¿Estás seguro que deseas reactivar el cliente o proveedor?")) {
        return true;
    } else {

        e.preventDefault(); //se cancela el evento

    }

}

let linkDelete5 = document.querySelectorAll("#btnReactivarPersona");

for (var i = 0; i < linkDelete5.length; i++) {
    linkDelete5[i].addEventListener('click', persona_reactivar_msj);
}