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
    $pdf->Cell(340,28,utf8_decode('Reporte de gastos de compras'),0,0,'C');

    $pdf->Ln(25);

    $pdf->SetFillColor(225, 225, 225);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(15,8,'No.',1,0,'C',1);
    $pdf->Cell(85,8,'Proveedor',1,0,'C',1);
    $pdf->Cell(43,8,'Tip.Comprobante',1,0,'C',1);
    $pdf->Cell(55,8,utf8_decode('N.Comprobante'),1,0,'C',1);
    $pdf->Cell(40,8,'S.Comprobante',1,0,'C',1);
    $pdf->Cell(30,8,'Impuesto',1,0,'C',1);
    $pdf->Cell(50,8,'Fecha',1,0,'C',1);
    $pdf->Cell(30,8,'Total',1,1,'C',1);
    $pdf->SetFont('Arial','',12);

    include("../db/conexion.php");
    include("../clases/Compra.php");
    $conexion = new conexion();
    $conexion->conectar();
    $compra = new Compra();
    $compraArray = $compra->ObtenerCompras($conexion);
    

    for($i=0; $i<sizeof($compraArray); $i++){ 
        

        $idcompra = $compraArray[$i]->getIdcompra();
        $usuario = $compraArray[$i]->getIdusuario();
        $proveedor = $compraArray[$i]->getIdproveedor();
        $tipo_compro = $compraArray[$i]->getTipo();
        $no_compro = $compraArray[$i]->getComprobante();
        $serie_compro = $compraArray[$i]->getSerie();
        $fecha = $compraArray[$i]->getFecha();
        $impuesto = $compraArray[$i]->getImpuesto();
        $total = $compraArray[$i]->getTotal();
        $estado = $compraArray[$i]->getEstado();
  

        if ($estado==1) { 


            $pdf->SetTextColor(0,0, 0);
            $pdf->Cell(15,10,$idcompra,1,0,'C');
            $pdf->Cell(85,10,limitarCadena($proveedor,80,"..."),1,0,'C');
            $pdf->Cell(43,10,limitarCadena($tipo_compro,50,"..."),1,0,'C');
            $pdf->Cell(55,10,limitarCadena($no_compro,50,"..."),1,0,'C');
            $pdf->Cell(40,10,$serie_compro,1,0,'C');
            $pdf->Cell(30,10,$impuesto,1,0,'C');
            $pdf->Cell(50,10,$fecha,1,0,'C');
            $pdf->Cell(30,10,$total,1,1,'C');  

        }


    }


$pdf->Output();
?>
