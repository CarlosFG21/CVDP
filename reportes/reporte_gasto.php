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
     $pdf = new FPDF('L','mm','A4');
    //$pdf = new PDF_Code128('P','mm',array(80,258));
    $pdf->SetMargins(4,10,4);
    $pdf->AddPage();
    #logo para de la empresa

    $pdf->SetFont('Arial','B',25);
    $pdf->SetTextColor(66, 131, 245);
    $pdf->Cell(158,16,utf8_decode('"Distribuidora '),0,0,'R',0);
    $pdf->SetTextColor(245, 0, 0);
    $pdf->Cell(47,16,utf8_decode('Del Pueblo"'),0,0,'C');

    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(66, 131, 245);
    $pdf->Cell(298,28,utf8_decode('Reporte de gastos de la distribuidora'),0,0,'C');

    $pdf->Ln(25);

    $pdf->SetFillColor(225, 225, 225);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(15,8,'No.',1,0,'C',1);
    $pdf->Cell(85,8,'Empleado',1,0,'C',1);
    $pdf->Cell(43,8,'Tipo de gasto',1,0,'C',1);
    $pdf->Cell(55,8,utf8_decode('Descripción'),1,0,'C',1);
    $pdf->Cell(30,8,'Fecha',1,0,'C',1);
    $pdf->Cell(30,8,'Monto',1,0,'C',1);
    $pdf->Cell(30,8,'Estado',1,1,'C',1);
    $pdf->SetFont('Arial','',12);

    include("../clases/Gasto.php");
    $gasto = new Gasto();
    $gastoArray = $gasto->ObtenerGastos();

    for($i=0; $i<sizeof($gastoArray); $i++){  
        
    $nombre =  $gastoArray[$i]->getNombre();
    $apellido =  $gastoArray[$i]->getApellido();
    $completo = $nombre. " " .$apellido;
    $id = $gastoArray[$i]->getIdgasto();
    $tipo = $gastoArray[$i]->getTipo();
    $descripcion = $gastoArray[$i]->getDescriocion();
    $fecha = $gastoArray[$i]->getFecha();
    $monto = $gastoArray[$i]->getMonto();
    $estado = $gastoArray[$i]->getEstado();

        if ($estado==1) { 


            $pdf->SetTextColor(0,0, 0);
            $pdf->Cell(15,10,$id,1,0,'C');
            $pdf->Cell(85,10,limitarCadena($completo,80,"..."),1,0,'C');
            $pdf->Cell(43,10,limitarCadena($tipo,50,"..."),1,0,'C');
            $pdf->Cell(55,10,limitarCadena($descripcion,50,"..."),1,0,'C');
            $pdf->Cell(30,10,$fecha,1,0,'C');
            $pdf->Cell(30,10,$monto,1,0,'C');
            $pdf->Cell(30,10,"Ingresado",1,1,'C');  

        }


    }


$pdf->Output();
?>
