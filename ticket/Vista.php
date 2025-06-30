<?php

	# Incluyendo librerias necesarias #
	require "./code128.php";
	require "../clases/DetalleV.php";
	$id = $_REQUEST['id'];

    $venta = new Venta();

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
	$pago_instalacion = $ventaArray[$i]->getPagoinstalacion();
    $total = $ventaArray[$i]->getTotal();
    $pago = $ventaArray[$i]->getPago();
    $estado = $ventaArray[$i]->getEstado(); 
    if($id == $idventa){

	$pdf = new PDF_Code128('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();

	# Logo de la empresa formato png #
	$pdf->Image('../app/AdminLTE-3.2.0/dist/img/logo2.png',117,12,80,35,'PNG');

	# Encabezado y datos de la empresa #
	$pdf->SetFont('Arial','B',15);
	$pdf->SetTextColor(32,100,210);
	$pdf->Cell(150,10,iconv("UTF-8", "ISO-8859-1",strtoupper("Distribuidora Del Pueblo No. 1")),0,0,'L');

	$pdf->Ln(9);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	//$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","RUC: 0000000000"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Direccion San Diego, Zacapa"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Teléfono: 3076 - 1408"),0,0,'L');

	$pdf->Ln(5);

	//$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Email: cvdp@ejemplo.com"),0,0,'L');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,7,iconv("UTF-8", "ISO-8859-1","Fecha de emisión:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,iconv("UTF-8", "ISO-8859-1",date($fecha)),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(28,7,iconv("UTF-8", "ISO-8859-1",strtoupper($tipoc." No.")),0,0,'C');

	$pdf->Ln(7);
	$usuario = new Usuario();
    $usuarioArray = $usuario->ObtenerUsuarios();

    for($i=0; $i<sizeof($usuarioArray); $i++){
        $id_usuario = $usuarioArray[$i]->getIdusuario();
        $nombre_usuario = $usuarioArray[$i]->getNombre();
        if($idusuario == $id_usuario){
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(12,7,iconv("UTF-8", "ISO-8859-1","Cajero:"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(134,7,iconv("UTF-8", "ISO-8859-1",$nombre_usuario),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",strtoupper($comprobante)),0,0,'C');
		}}
	$pdf->Ln(10);
	$personaob = new Persona();
    $personaArray = $personaob->ObtenerPersonas();

    for($i=0; $i<sizeof($personaArray); $i++){
      $id_cliente = $personaArray[$i]->getIdpersona();
      $nombre_cliente = $personaArray[$i]->getNombre();
      $nit_cliente = $personaArray[$i]->getNit();
      if($idcliente == $id_cliente){
	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(13,7,iconv("UTF-8", "ISO-8859-1","Cliente:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1",$nombre_cliente),0,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(8,7,iconv("UTF-8", "ISO-8859-1","Nit: "),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1",$nit_cliente),0,0,'L');
	$pdf->SetTextColor(39,39,51);

	  }}
	$pdf->Ln(2);


	$pdf->Ln(9);

	# Tabla de productos #
	$pdf->SetFont('Arial','',8);
	$pdf->SetFillColor(23,83,201);
	$pdf->SetDrawColor(23,83,201);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(100,8,iconv("UTF-8", "ISO-8859-1","Descripción"),1,0,'C',true);
	$pdf->Cell(18,8,iconv("UTF-8", "ISO-8859-1","Cant."),1,0,'C',true);
	$pdf->Cell(28,8,iconv("UTF-8", "ISO-8859-1","Precio"),1,0,'C',true);
	//$pdf->Cell(19,8,iconv("UTF-8", "ISO-8859-1","Desc."),1,0,'C',true);
	$pdf->Cell(35,8,iconv("UTF-8", "ISO-8859-1","Subtotal"),1,0,'C',true);

	$pdf->Ln(8);
	$pdf->SetTextColor(39,39,51); 

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
        $precio_producto = $productoArray->getPrecioV();
	
	/*----------  Detalles de la tabla  ----------*/
	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",$nombre_producto),'L',0,'C');
	$pdf->Cell(18,7,iconv("UTF-8", "ISO-8859-1",$cantidad_medida),'L',0,'C');
	$pdf->Cell(28,7,iconv("UTF-8", "ISO-8859-1","Q. ".$precio_venta/$cantidad_medida),'L',0,'C');
	//$pdf->Cell(19,7,iconv("UTF-8", "ISO-8859-1","Q. ".$precio_pro),'L',0,'C');
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1","Q. ".$precio_venta),'LR',0,'C');
	$pdf->Ln(7);
	/*----------  Fin Detalles de la tabla  ----------*/

	 }}
	
	$pdf->SetFont('Arial','B',9);
	
	# Impuestos & totales #
	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'T',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'T',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","SUBTOTAL"),'T',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","+ Q. ".$total+$descuento-$pago_instalacion),'T',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","ENVIO/INSTALACION"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","+ Q. ".$pago_instalacion),'',0,'C');
	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","DESCUENTO"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","- Q. ".$descuento),'',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),'T',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","Q. ".$total),'T',0,'C');

	$pdf->Ln(12);

	$pdf->SetFont('Arial','',9);

	$pdf->SetTextColor(39,39,51);
	$pdf->MultiCell(0,9,iconv("UTF-8", "ISO-8859-1","*** Para poder realizar un reclamo o devolución debe de presentar la factura o comprobante***"),0,'C',false);

	$pdf->Ln(9);

	# Codigo de barras #
	$pdf->SetFillColor(39,39,51);
	$pdf->SetDrawColor(23,83,201);
	$pdf->Code128(72,$pdf->GetY(),$serie,70,20);
	$pdf->SetXY(12,$pdf->GetY()+21);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",$serie),0,'C',false);
	}}

	if($estado == 0){
		$pdf->Image('../app/AdminLTE-3.2.0/dist/img/Cancelado.png',15,12,180,240,'PNG');	
	}
	# Nombre del archivo PDF #
	$pdf->Output("I","Factura_No_1.pdf",true);