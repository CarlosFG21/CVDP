<?php
function limitarCadena($cadena, $limite, $sufijo){
	if(strlen($cadena) > $limite){
		return substr($cadena, 0, $limite) . $sufijo;
	}
	return $cadena;
}
?>

<?php
require('../ticket/fpdf.php');
# Incluyendo librerias necesarias #
     $pdf = new FPDF('L','mm','Legal');
    //$pdf = new PDF_Code128('P','mm',array(80,258));
    $pdf->SetMargins(4,10,4);
    $pdf->AddPage();
    #logo para de la empresa

    $pdf->SetFont('Arial','B',25);
    $pdf->SetTextColor(66, 131, 245);
    $pdf->Cell(178,16,utf8_decode('"Distribuidora '),0,0,'R',0);
    $pdf->SetTextColor(245, 0, 0);
    $pdf->Cell(47,16,utf8_decode('Del Pueblo"'),0,0,'C');

    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(66, 131, 245);
    $pdf->Cell(343,28,utf8_decode('Reporte de gastos de ventas'),0,0,'C');

    $pdf->Ln(25);

    $pdf->SetFillColor(225, 225, 225);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(15,8,'No.',1,0,'C',1);
    $pdf->Cell(85,8,'Cliente',1,0,'C',1);
    $pdf->Cell(43,8,'Tip.Comprobante',1,0,'C',1);
    $pdf->Cell(55,8,utf8_decode('N.Comprobante'),1,0,'C',1);
    $pdf->Cell(40,8,'No.Serie',1,0,'C',1);
    $pdf->Cell(30,8,'Metodo P.',1,0,'C',1);
    $pdf->Cell(50,8,'Fecha',1,0,'C',1);
    $pdf->Cell(30,8,'Total',1,1,'C',1);
    $pdf->SetFont('Arial','',12);

    
    include("../clases/DetalleV.php");
    $ventaob = new Venta();
    $ventaArray = $ventaob->ObtenerVenta();
    for($i=0; $i<sizeof($ventaArray); $i++){

                    $id = $ventaArray[$i]->getIdventa();
                    $idcliente = $ventaArray[$i]->getIdcliente();
                    $idusuario = $ventaArray[$i]->getIdusuario();
                    $tipoc = $ventaArray[$i]->getTipoc();
                    $comprobante = $ventaArray[$i]->getComprobante();
                    $serie = $ventaArray[$i]->getSerie();
                    $fecha = $ventaArray[$i]->getFecha();
                    $total = $ventaArray[$i]->getTotal();
                    $pago = $ventaArray[$i]->getPago();
                    $estado = $ventaArray[$i]->getEstado();
                    $cliente = new Persona();
                    $clienteArray = $cliente->BuscarPersona($idcliente);
                    $nombre_cliente = $clienteArray->getNombre();
  

        if ($estado==1) { 


            $pdf->SetTextColor(0,0, 0);
            $pdf->Cell(15,10,$id,1,0,'C');
            $pdf->Cell(85,10,limitarCadena($nombre_cliente,80,"..."),1,0,'C');
            $pdf->Cell(43,10,limitarCadena($tipoc,50,"..."),1,0,'C');
            $pdf->Cell(55,10,limitarCadena($comprobante,50,"..."),1,0,'C');
            $pdf->Cell(40,10,$serie,1,0,'C');
            $pdf->Cell(30,10,$pago,1,0,'C');
            $pdf->Cell(50,10,$fecha,1,0,'C');
            $pdf->Cell(30,10,$total,1,1,'C');  

        }


    }


$pdf->Output();
?>
