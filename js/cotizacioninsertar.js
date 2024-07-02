// Función para agregar la venta al detalle
function agregarCotizacion() {
    // Obtener valores del formulario
    var idproducto = parseInt(document.getElementById('id_producto').value)
    var unidadm = document.getElementById('unidad_medida').value;
    var cantidad = parseFloat(document.getElementById('cantidad_v').value);
    var precio = parseFloat(document.getElementById('precio_producto2').value);
    
    // Validar que los campos no estén vacíos
    if (isNaN(idproducto) || unidadm === "" || isNaN(cantidad) || isNaN(precio)) {
      alert("Por favor completa todos los campos correctamente.");
      return;
    }
    
    // Crear objeto con los datos de la venta
    var cotizacion = {
      idproducto: idproducto,
      cantidad: cantidad,
      unidadm: unidadm,
      precio: precio
    };
    
    // Agregar la venta a la tabla
    agregarCotizacionATabla(cotizacion);
    
    document.getElementById('id_producto1').value = "";
    document.getElementById('nombre_producto').value = "";
    document.getElementById('descripcion').value = "";
    document.getElementById('cantidad_producto').value = "";
    document.getElementById('cantidad_v').value = "";
    document.getElementById('precio_producto').value = "";
  }
  
  function agregarCotizacionATabla(cotizacion) {
    var tabla = document.getElementById('tablaCotizaciones').getElementsByTagName('tbody')[0];

    // Verificar si ya existe el producto en la tabla
    var existeProducto = Array.from(tabla.rows).some(row => row.getAttribute('data-id') === cotizacion.idproducto.toString());

    if (existeProducto) {
        alert('El producto ya está agregado.');
        return;
    }

    // Crear fila de la tabla con los detalles de la venta
    var fila = tabla.insertRow();

    // Establecer atributo data-id con el idproducto
    fila.setAttribute('data-id', cotizacion.idproducto);

    var cellProducto = fila.insertCell(0);
    var cellCantidad = fila.insertCell(1);
    var cellunidadm = fila.insertCell(2);
    var cellPrecioUnitario = fila.insertCell(3);
    var cellTotal = fila.insertCell(4);
    var cellAcciones = fila.insertCell(5);

    cellProducto.textContent = cotizacion.idproducto;
    cellCantidad.textContent = cotizacion.cantidad;
    cellunidadm.textContent = cotizacion.unidadm;
    cellPrecioUnitario.textContent = cotizacion.precio;

    // Calcular y mostrar el total de la venta
    var totalCotizacion = cotizacion.cantidad * cotizacion.precio;
    cellTotal.textContent = 'Q' + totalCotizacion.toFixed(2);

    // Botón para eliminar fila
    var btnEliminarD = document.createElement('button');
    btnEliminarD.textContent = 'Eliminar';
    btnEliminarD.className = 'eliminar-btn';

    // Agregar evento click para eliminar fila
    btnEliminarD.onclick = function () {
        // Obtener el idproducto de la fila
        var idProductoEliminar = cotizacion.idproducto;

        // Recorrer las filas de la tabla para encontrar la fila con el producto a eliminar
        for (var i = 0; i < tabla.rows.length; i++) {
            var fila = tabla.rows[i];
            if (fila.getAttribute('data-id') === idProductoEliminar.toString()) {
                // Eliminar la fila de la tabla
                tabla.deleteRow(i);

                // Recalcular el total general después de eliminar
                recalcularTotalGeneral();
                obtenerDatosTabla();
                break;
            }
        }
    };

    cellAcciones.appendChild(btnEliminarD);

    // Limpiar campos del formulario (si es necesario)
    document.getElementById('id_producto1').value = "";
    document.getElementById('nombre_producto').value = "";
    document.getElementById('descripcion').value = "";
    document.getElementById('cantidad_producto').value = "";
    document.getElementById('cantidad_v').value = "";
    document.getElementById('precio_producto').value = "";

    // Recalcular el total general al agregar una nueva venta
    recalcularTotalGeneral();
    obtenerDatosTabla();
}

  function recalcularTotalGeneral() {
    var tabla = document.getElementById('tablaCotizaciones').getElementsByTagName('tbody')[0];
    var totalGeneral = 0;
  
    // Iterar sobre las filas de la tabla para sumar los totales
    for (var i = 0; i < tabla.rows.length; i++) {
      var totalCotizacionString = tabla.rows[i].cells[4].textContent.replace('Q', '');
      totalGeneral += parseFloat(totalCotizacionString);
    }
  
    // Mostrar el total general en un input
    document.getElementById('sub_total').value = totalGeneral.toFixed(2);
  }

  // Suponiendo que tengas una función para obtener los datos de la tabla
function obtenerDatosTabla() {
  var tabla = document.getElementById('tablaCotizaciones').getElementsByTagName('tbody')[0];
  var datos = [];

  // Recorrer las filas de la tabla y construir un array de objetos
  for (var i = 0; i < tabla.rows.length; i++) {
      var idproducto = tabla.rows[i].getAttribute('data-id');
      var cantidad = tabla.rows[i].cells[1].textContent;
      var unidadmedida = tabla.rows[i].cells[2].textContent;
      var precio = tabla.rows[i].cells[3].textContent;
      
      // Construir objeto de venta
      var cotizacion = {
          idproducto: idproducto,
          cantidad: cantidad,
          unidadmedida: unidadmedida,
          precio: precio
      };

      datos.push(cotizacion);
  }

  // Convertir a JSON y asignar al campo oculto
  document.getElementById('datosTabla').value = JSON.stringify(datos);
}
