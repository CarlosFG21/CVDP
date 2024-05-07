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
    $pdf->Cell(298,28,utf8_decode('Reporte de pago de empleados'),0,0,'C');

    $pdf->Ln(25);

    $pdf->SetFillColor(225, 225, 225);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(15,8,'No.',1,0,'C',1);
    $pdf->Cell(93,8,'Nombre',1,0,'C',1);
    $pdf->Cell(30,8,'Salario',1,0,'C',1);
    $pdf->Cell(30,8,'Mes',1,0,'C',1);
    $pdf->Cell(30,8,utf8_decode('Año'),1,0,'C',1);
    $pdf->Cell(30,8,'Pago Ad.',1,0,'C',1);
    $pdf->Cell(30,8,'Cantidad',1,0,'C',1);
    $pdf->Cell(30,8,'Total Pag.',1,1,'C',1);
    $pdf->SetFont('Arial','',12);

    include("../clases/Planilla.php");
    $planilla = new Planilla();
    $plaArray = $planilla->ObtenerPlanillaPago();

    for($i=0; $i<sizeof($plaArray); $i++){ 

        
        $id = $plaArray[$i]->getIdplanilla();
        $nombre = $plaArray[$i]->getNombre();
        $apellido = $plaArray[$i]->getApellido();
        $completo = $nombre. " " .$apellido;
        $salario = $plaArray[$i]->getSalario();
        $tipo = $plaArray[$i]->getTipo();
        $cantidad = $plaArray[$i]->getCantidad();
        $mes = $plaArray[$i]->getMes();
        $anio = $plaArray[$i]->getAnio();
        $total = $salario + $cantidad;
        $estado = $plaArray[$i]->getEstado();

       if ($estado==1) {

        $pdf->SetTextColor(0,0, 0);
            $pdf->Cell(15,10,$id,1,0,'C');
            $pdf->Cell(93,10,limitarCadena($completo,80,"..."),1,0,'C');
            $pdf->Cell(30,10,$salario,1,0,'C');
            $pdf->Cell(30,10,$mes,1,0,'C');
            $pdf->Cell(30,10,$anio,1,0,'C');
            $pdf->Cell(30,10,$tipo,1,0,'C');
            $pdf->Cell(30,10,$cantidad,1,0,'C');
            $pdf->Cell(30,10,$total,1,1,'C');  
            
            
        }


    }


  
    $pdf->Output();
?>
