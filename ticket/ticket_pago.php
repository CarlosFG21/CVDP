<?php

	# Incluyendo librerias necesarias #
    require "./code128.php";
    include("../clases/DetalleCuentaC.php");
    //require "../clases/DetalleCuentaC.php";
    
    $id = $_REQUEST['id'];
    $detallecuentacob = new DetalleCuentaC();
    $DetalleCuentaCArray = $detallecuentacob->ObtenerDetalleCuentaC();

    for($i=0; $i<sizeof($DetalleCuentaCArray); $i++){

    $iddetallecuentac = $DetalleCuentaCArray[$i]->getIdDetallecuentac();
    $idcuentac = $DetalleCuentaCArray[$i]->getIdCuentaporcobrarc();
    $idusuario = $DetalleCuentaCArray[$i]->getIdusuarioc();
    $fechapago = $DetalleCuentaCArray[$i]->getFechapago();
    $cantidadapagar = $DetalleCuentaCArray[$i]->getCantidadabonar();
    $cantidadActual = $DetalleCuentaCArray[$i]->getSaldop();
    $estado = $DetalleCuentaCArray[$i]->getEstado();

    if($id == $iddetallecuentac){

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
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Fecha: ".date($fechapago)),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Caja No: ".$idusuario),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cajero: ".$nombre_usuario),0,'C',false);
    $pdf->SetFont('Arial','B',10);
    }}
    $pdf->Ln(1);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Ticket No: ".$iddetallecuentac)),0,'C',false);
    
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $cuentaporcobrar = new CuentaC();
    $cuentaporcobrarArray = $cuentaporcobrar->ObtenerCuentaC();

    for($i=0; $i<sizeof($cuentaporcobrarArray); $i++){
    $idcuentac2 = $cuentaporcobrarArray[$i]->getIdcobrar();
    $idcliente = $cuentaporcobrarArray[$i]->getIdcliente();
    $deuda = $cuentaporcobrarArray[$i]->getDeuda();
   
    if($idcuentac == $idcuentac2){
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

    if($deuda == 0){
      $pdf->Ln(2);
      $pdf->SetFont('Arial','B',12);
      $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","PAGO TOTAL CREDITO"),0,'C',false);
      $pdf->Ln(1);
    }else{
      $pdf->Ln(2);
      $pdf->SetFont('Arial','B',12);
      $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","ABONO AL CREDITO"),0,'C',false);
      $pdf->Ln(1);
    }

    $pdf->SetFont('Arial','',9);
    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);
  }}//fin
    
    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","Q. ".$cantidadActual),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","Pago"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","- Q. ".$cantidadapagar),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","DEUDA RESTANTES"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","Q. ".$cantidadActual-$cantidadapagar),0,0,'C');

    $pdf->Ln(10);
  
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","*** Para poder realizar un reclamo o verificación de pago debe de presentar este ticket ***"),0,'C',false);

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(0,7,iconv("UTF-8", "ISO-8859-1","Gracias por su pago"),'',0,'C');

    $pdf->Ln(9);

    # Codigo de barras #
    $pdf->Code128(5,$pdf->GetY(),$iddetallecuentac,70,20);
    $pdf->SetXY(0,$pdf->GetY()+21);
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",$iddetallecuentac),0,'C',false);
     }}//final del obtener venta
    # Nombre del archivo PDF #
    $pdf->Output("I","Ticket_pago_No1.pdf",true);