<?php

require "../ticket/code128.php";
require "../clases/DetalleCuentaC.php";

// Obtener el último ID de pago
$pagocred = new CuentaC();
$id = $pagocred->ObtenerUltimoIdPagoCredito();

// Obtener detalles de la cuenta
$detallecuentacob = new DetalleCuentaC();
$DetalleCuentaCArray = $detallecuentacob->ObtenerDetalleCuentaC();

foreach ($DetalleCuentaCArray as $detallecuentac) {
    $iddetallecuentac = $detallecuentac->getIdDetallecuentac();
    $idcuentac = $detallecuentac->getIdCuentaporcobrarc();
    $idusuario = $detallecuentac->getIdusuarioc();
    $fechapago = $detallecuentac->getFechapago();
    $cantidadapagar = $detallecuentac->getCantidadabonar();
    $cantidadActual = $detallecuentac->getSaldop();
    $estado = $detallecuentac->getEstado();

    if ($id == $idcuentac) {
        $pdf = new PDF_Code128('P', 'mm', [80, 258]);
        $pdf->SetMargins(4, 10, 4);
        $pdf->AddPage();

        // Logo de la empresa
        $pdf->Image('../app/AdminLTE-3.2.0/dist/img/logoticket.png', 10, 6, 60, 20, 'PNG');
        $pdf->Ln(20);

        // Información de la empresa
        $pdf->SetFont('Arial','B',10);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(0, 5, strtoupper("Distribuidora Del Pueblo No. 1"), 0, 'C');
        $pdf->SetFont('Arial','',9);
        $pdf->MultiCell(0, 5, "Ferreteria", 0, 'C');
        $pdf->MultiCell(0, 5, "Direccion San Diego, Zacapa", 0, 'C');
        $pdf->MultiCell(0, 5, "Telefono: 3076 - 1408", 0, 'C');

        $pdf->Ln(1);
        $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "------------------------------------------------------"), 0, 0, 'C');
        $pdf->Ln(5);

        // Obtener nombre del usuario
        $usuario = new Usuario();
        $usuarioArray = $usuario->ObtenerUsuarios();
        $nombre_usuario = '';
        foreach ($usuarioArray as $user) {
            if ($idusuario == $user->getIdusuario()) {
                $nombre_usuario = $user->getNombre();
                break;
            }
        }

        if ($nombre_usuario) {
            $pdf->SetFont('Arial','',9);
            $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Fecha: " . date($fechapago)), 0, 'C', false);
            $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Caja No: " . $idusuario), 0, 'C', false);
            $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Cajero: " . $nombre_usuario), 0, 'C', false);
        }

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Ln(1);
        $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", strtoupper("Ticket No: " . $iddetallecuentac)), 0, 'C', false);

        $pdf->SetFont('Arial', '', 9);
        $pdf->Ln(1);
        $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "------------------------------------------------------"), 0, 0, 'C');
        $pdf->Ln(5);

        // Obtener detalles del cliente
        $cuentaporcobrar = new CuentaC();
        $cuentaporcobrarArray = $cuentaporcobrar->ObtenerCuentaC();
        $cliente_info = '';

        foreach ($cuentaporcobrarArray as $cuentac) {
            if ($idcuentac == $cuentac->getIdcobrar()) {
                $personaob = new Persona();
                $personaArray = $personaob->ObtenerPersonas();
                foreach ($personaArray as $persona) {
                    if ($cuentac->getIdcliente() == $persona->getIdpersona()) {
                        $cliente_info = [
                            "Cliente: " . $persona->getNombre(),
                            "Nit: " . $persona->getNit()
                        ];
                        break 2;
                    }
                }
            }
        }

        // Mostrar la información del cliente
        foreach ($cliente_info as $info) {
            $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", $info), 0, 'C', false);
        }

        // Mostrar tipo de pago
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 12);
        if ($cuentac->getDeuda() == 0) {
            $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "PAGO TOTAL CREDITO"), 0, 'C', false);
        } else {
            $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "ABONO AL CREDITO"), 0, 'C', false);
        }

        $pdf->Ln(1);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
        $pdf->Ln(5);

        // Mostrar detalles de pago
        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "TOTAL"), 0, 0, 'C');
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "Q. " . $cantidadActual), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "Pago"), 0, 0, 'C');
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "- Q. " . $cantidadapagar), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "DEUDA RESTANTE"), 0, 0, 'C');
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "Q. " . ($cantidadActual - $cantidadapagar)), 0, 0, 'C');

        $pdf->Ln(10);

        // Mensaje para el cliente
        $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "*** Para poder realizar un reclamo o verificación de pago debe de presentar este ticket ***"), 0, 'C', false);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 7, iconv("UTF-8", "ISO-8859-1", "Gracias por su pago"), '', 0, 'C');
        $pdf->Ln(9);

        // Código de barras
        $pdf->Code128(5, $pdf->GetY(), $iddetallecuentac, 70, 20);
        $pdf->SetXY(0, $pdf->GetY() + 21);
        $pdf->SetFont('Arial', '', 14);
        $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", $iddetallecuentac), 0, 'C', false);
    }
}

// Nombre del archivo PDF
$pdf->Output("I", "Ticket_pagoC_1.pdf", true);
?>
