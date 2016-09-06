<?php
	require_once (__DIR__.'/fpdf/fpdf.php');
	require_once (__DIR__.'/fpdi/fpdi.php');
	require_once ('fpdi/FPDI_Protection.php');
	$origFile = "test.pdf";
	$password = "123456";
	$destFile = 'testEnc.pdf';
	
	$pdf = new FPDI_Protection();

	
	$pageCount = $pdf->setSourceFile($origFile);
	$pdf->SetProtection(array('print'), $password);
	
	for($x=0;$x<$pageCount-1;++$x){
		$pdf->addPage();		
		
		$tplIdx = $pdf->importPage($x+1);
		
		$pdf->useTemplate($tplIdx	);
		
		if($x==0){
			$pdf->SetFont('Courier');
			$pdf->SetTextColor(255, 0, 0);
			$pdf->SetXY(0, 0);
			$pdf->Write(0, 'This is just a simple text');
		}
	}
	
	$pdf->Output($destFile, 'F');
	$pdf->Output();
	
?>