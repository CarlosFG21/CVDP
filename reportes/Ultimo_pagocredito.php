<?php

require "../ticket/code128.php";
require "../clases/DetalleCuentaC.php";

// Obtener el último ID de pago
$detallecuentacob = new DetalleCuentaC();
$id = $detallecuentacob->ObtenerUltimoIdPagoCredito();

if ($id === null) {
    die("ID no válido");
}

$detallecuentac = $detallecuentacob->BuscarDetallecuentac($id);

if (!$detallecuentac) {
    die("Detalle de cuenta no encontrado");
}

$iddetallecuentac = $detallecuentac->getIdDetallecuentac();
$idcuentac = $detallecuentac->getIdCuentaporcobrarc();
$idusuario = $detallecuentac->getIdusuarioc();
$fechapago = $detallecuentac->getFechapago();
$cantidadapagar = $detallecuentac->getCantidadabonar();
$cantidadActual = $detallecuentac->getSaldop();
$estado = $detallecuentac->getEstado();

$pdf = new PDF_Code128('P','mm',array(80,258));
$pdf->SetMargins(4,10,4);
$pdf->AddPage();

// Logo
$pdf->Image('../app/AdminLTE-3.2.0/dist/img/logoticket.png', 10, 6, 60, 20, 'PNG');
$pdf->Ln(20);

// Encabezado de la empresa
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(0, 5, strtoupper("Distribuidora Del Pueblo No. 1"), 0, 'C');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0, 5, "Ferreteria", 0, 'C');
$pdf->MultiCell(0, 5, "Direccion San Diego, Zacapa", 0, 'C');
$pdf->MultiCell(0, 5, "Telefono: 3076 - 1408", 0, 'C');

$pdf->Ln(2);
$pdf->Cell(0, 5, "------------------------------------------------------", 0, 0, 'C');
$pdf->Ln(5);

// Datos del usuario (cajero)
$usuario = new Usuario();
$usuarioArray = $usuario->ObtenerUsuarios();

foreach ($usuarioArray as $user) {
    if ($idusuario == $user->getIdusuario()) {
        $pdf->MultiCell(0, 5, "Fecha: ".date('d/m/Y', strtotime($fechapago)), 0, 'C');
        $pdf->MultiCell(0, 5, "Caja No: ".$idusuario, 0, 'C');
        $pdf->MultiCell(0, 5, "Cajero: ".$user->getNombre(), 0, 'C');
        break;
    }
}

$pdf->Ln(1);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0, 5, strtoupper("Ticket No: ".$iddetallecuentac), 0, 'C');

$pdf->Ln(1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0, 5, "------------------------------------------------------", 0, 0, 'C');
$pdf->Ln(5);

// Datos del cliente
$cuentaporcobrar = new CuentaC();
$cuentaporcobrarArray = $cuentaporcobrar->ObtenerCuentaC();

foreach ($cuentaporcobrarArray as $cuenta) {
    if ($idcuentac == $cuenta->getIdcobrar()) {
        $personaob = new Persona();
        $personaArray = $personaob->ObtenerPersonas();

        foreach ($personaArray as $persona) {
            if ($cuenta->getIdcliente() == $persona->getIdpersona()) {
                $pdf->MultiCell(0, 5, "Cliente: ".$persona->getNombre(), 0, 'C');
                $pdf->MultiCell(0, 5, "Nit: ".$persona->getNit(), 0, 'C');
                break;
            }
        }

        $pdf->Ln(2);
        $pdf->SetFont('Arial','B',12);

        if ($cantidadActual - $cantidadapagar == 0) {
            $pdf->MultiCell(0, 5, "PAGO TOTAL CREDITO", 0, 'C');
        } else {
            $pdf->MultiCell(0, 5, "ABONO AL CREDITO", 0, 'C');
        }

        break;
    }
}

// Detalles del pago
$pdf->Ln(5);
$pdf->SetFont('Arial','',9);
$pdf->Cell(72, 5, "-------------------------------------------------------------------", 0, 0, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(18, 5, "", 0, 0, 'C');
$pdf->Cell(22, 5, "TOTAL", 0, 0, 'C');
$pdf->Cell(32, 5, "Q. ".$cantidadActual, 0, 0, 'C');
$pdf->Ln(5);

$pdf->Cell(18, 5, "", 0, 0, 'C');
$pdf->Cell(22, 5, "Pago", 0, 0, 'C');
$pdf->Cell(32, 5, "- Q. ".$cantidadapagar, 0, 0, 'C');
$pdf->Ln(5);

$pdf->Cell(18, 5, "", 0, 0, 'C');
$pdf->Cell(22, 5, "Deuda restante", 0, 0, 'C');
$pdf->Cell(32, 5, "Q. ".($cantidadActual - $cantidadapagar), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","*** Para poder realizar un reclamo o verificación de pago debe de presentar este ticket ***"),0,'C',false);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,7,iconv("UTF-8", "ISO-8859-1","Gracias por su pago"),'',0,'C');
$pdf->Ln(9);

// Código de barras
$pdf->Code128(5, $pdf->GetY(), $iddetallecuentac, 70, 20);
$pdf->SetXY(0, $pdf->GetY() + 21);
$pdf->SetFont('Arial', '', 14);
$pdf->MultiCell(0, 5, $iddetallecuentac, 0, 'C');

// Salida del PDF
$pdf->Output("I", "Ticketpago_No1.pdf", true);

?>
