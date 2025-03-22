<?php

	# Incluyendo librerias necesarias #
	require "../ticket/code128.php";
	require "../clases/DetalleV.php";
	
    $VentaID = new DetalleV();
    $venta = new Venta();

    $id = $VentaID->ObtenerUltimoIdVenta();

    $ventaArray = $venta->ObtenerVenta();
    for($i=0; $i<sizeof($ventaArray); $i++){
    $idventa = $ventaArray[$i]->getIdventa();
    $idcliente = $ventaArray[$i]->getIdcliente();
    $idusuario = $ventaArray[$i]->getIdusuario();
    $tipoc = $ventaArray[$i]->getTipoc();
    $comprobante = $ventaArray[$i]->getComprobante();
    $serie = $ventaArray[$i]->getSerie();
    $fecha = $ventaArray[$i]->getFecha();
    $descuento = $ventaArray[$i]->getDescuento();
    $pago_instalacion =$ventaArray[$i]->getPagoinstalacion();
    $total = $ventaArray[$i]->getTotal();
    $pago = $ventaArray[$i]->getPago();
    $estado = $ventaArray[$i]->getEstado(); 
    if($id == $idventa){

    $pdf = new PDF_Code128('P','mm',array(80,258));
    $pdf->SetMargins(4,10,4);
    $pdf->AddPage();
    #logo para de la empresa
    $pdf->Image('../app/AdminLTE-3.2.0/dist/img/logoticket.png',10,6,60,20,'PNG');
    $pdf->Ln(20);
    # Encabezado y datos de la empresa #
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Distribuidora Del Pueblo No. 1")),0,'C',false);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Ferreteria"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Direccion San Diego, Zacapa"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: 3076 - 1408"),0,'C',false);
    //$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Email: cvdp@gmail.com"),0,'C',false);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $usuario = new Usuario();
    $usuarioArray = $usuario->ObtenerUsuarios();

    for($i=0; $i<sizeof($usuarioArray); $i++){
        $id_usuario = $usuarioArray[$i]->getIdusuario();
        $nombre_usuario = $usuarioArray[$i]->getNombre();
        if($idusuario == $id_usuario){
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Fecha: ".date($fecha)),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Caja No: ".$idusuario),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cajero: ".$nombre_usuario),0,'C',false);
    $pdf->SetFont('Arial','B',10);
    }}
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Ticket No: ".$comprobante)),0,'C',false);
    $pdf->SetFont('Arial','',9);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $personaob = new Persona();
    $personaArray = $personaob->ObtenerPersonas();

    for($i=0; $i<sizeof($personaArray); $i++){
      $id_cliente = $personaArray[$i]->getIdpersona();
      $nombre_cliente = $personaArray[$i]->getNombre();
      $nit_cliente = $personaArray[$i]->getNit();
      if($idcliente == $id_cliente){
      
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cliente: ".$nombre_cliente),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Nit: ".$nit_cliente),0,'C',false);
    
    }}//Final del los datos del cliente
    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);

    # Tabla de productos #
    $pdf->Cell(12,5,iconv("UTF-8", "ISO-8859-1","Cant."),0,0,'C');
    $pdf->Cell(29,5,iconv("UTF-8", "ISO-8859-1","Precio U."),0,0,'C');
    //$pdf->Cell(15,5,iconv("UTF-8", "ISO-8859-1","."),0,0,'C');
    $pdf->Cell(28,5,iconv("UTF-8", "ISO-8859-1","Total"),0,0,'C');

    $pdf->Ln(3);
    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);

    $detallevob = new DetalleV();
    $detallevArray = $detallevob->ObtenerDetalleV();

    for($i=0; $i<sizeof($detallevArray); $i++){
    $id_detallev = $detallevArray[$i]->getIdetallev();
    $id_producto = $detallevArray[$i]->getIdproducto();
    $id_venta = $detallevArray[$i]->getIdventa();
    $cantidad_medida = $detallevArray[$i]->getCantidadm();
    $precio_venta = $detallevArray[$i]->getPrecio();
     if($idventa == $id_venta){
        $productoob = new Producto1();
        $productoArray = $productoob->BuscarProducto1($id_producto);
        $id_producto2 = $productoArray->getIdproducto();
        $nombre_producto = $productoArray->getNombre();
        $precio_producto = $productoArray->getPrecio();
                                                              
    /*----------  Detalles de la tabla  ----------*/
    $pdf->Ln(2);
    $pdf->MultiCell(0,4,iconv("UTF-8", "ISO-8859-1",$nombre_producto),0,'C',false);
    $pdf->Cell(12,4,iconv("UTF-8", "ISO-8859-1",$cantidad_medida),0,0,'C');
    $pdf->Cell(29,4,iconv("UTF-8", "ISO-8859-1","Q. ".$precio_venta/$cantidad_medida),0,0,'C');
    //$pdf->Cell(19,4,iconv("UTF-8", "ISO-8859-1","$0.00 USD"),0,0,'C');
    $pdf->Cell(28,4,iconv("UTF-8", "ISO-8859-1","Q. ".$precio_venta),0,0,'C');
    
    $pdf->Ln(4);
    //$pdf->MultiCell(0,4,iconv("UTF-8", "ISO-8859-1",""),0,'C',false);
    $pdf->Ln(2);
    /*----------  Fin Detalles de la tabla  ----------*/
    }}//final del detalle productos


    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');

        $pdf->Ln(5);

    # totales #
    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","SUBTOTAL"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","+ Q. ".$total+$descuento-$pago_instalacion),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","Q. ".$total+$descuento-$pago_instalacion),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","ENVIO/INSTALACION"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","+ Q. ".$pago_instalacion),0,0,'C');
    
    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","DESCUENTO"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","- Q. ".$descuento),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","Q. ".$total),0,0,'C');

    $pdf->Ln(10);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","*** Para poder realizar un reclamo o devolución debe de presentar este ticket ***"),0,'C',false);

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(0,7,iconv("UTF-8", "ISO-8859-1","Gracias por su compra"),'',0,'C');

    $pdf->Ln(9);

    # Codigo de barras #
    $pdf->Code128(5,$pdf->GetY(),$serie,70,20);
    $pdf->SetXY(0,$pdf->GetY()+21);
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",$serie),0,'C',false);
     }}//final del obtener venta
    # Nombre del archivo PDF #
    $pdf->Output("I","Ticket_No_1.pdf",true);