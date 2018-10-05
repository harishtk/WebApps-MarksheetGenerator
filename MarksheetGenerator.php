<?php

	require('fpdf/fpdf.php');
	
/*	class PDF_Marksheet extends FPDF {

          function __construct ($orientation = 'P', $unit = 'pt', $format = "A4", $margin = 40) {
                   $this->SetTopMargin($margin);
                   $this->SetLeftMargin($margin);
                   $this->SetRightMargin($margin);
                   $this->SetAutoPageBreak(true, $margin);
          }
          
          function Header() {
                   $this->SetFont('Arial', 'B', 20);
                   $this->SetTextColor(12, 49, 109);
                   $this->Cell(0, 30, "GOVERNMENT OF TAMILNADU", 0, 1, 'C', true);
          }
          
	}   */
	//This is the function that generates PDF file.
    function generatePDF($reg_no, $student_name, $dob, $sem, $program, $mon_year_of_exam, $course_title, $ia, $ee) {
    $o_total = 0;
    $ispass = 1;
	$margin = 40;

	$pdf = new FPDF('P', 'pt', 'A4');
	$pdf->SetTopMargin($margin);
    $pdf->SetLeftMargin($margin);
    $pdf->SetRightMargin($margin);
    $pdf->SetAutoPageBreak(true, $margin - 20);
    $pdf->AddPage();

    $pdf->Image("logo.jpg",20, 30, 150);

    $pdf->SetDrawColor(12, 49, 109);
    $pdf->Rect($margin - 20, $margin - 20, 555, 802 , 'D');

     $pdf->SetFont('Arial', 'B', 12);

     $pdf->SetTextColor(12, 49, 109);
     $pdf->Cell(0, 20,"GOVERNMENT OF TAMILNADU", 0, 1, 'C', false);

     $pdf->SetFont('Arial','', 8);
     $pdf->Cell(0, 10,"DEPARTMENT OF TECHINCAL EDUCATION", 0, 1, 'C', false);

     $pdf->Ln();
     $pdf->SetFont('Arial', 'B', 15);
     $pdf->Cell(0, 20,"TAMILNADU POLYTECHNIC COLLEGE", 0, 1, 'C', false);

          $pdf->SetFont('Arial', '', 7.5);
     $pdf->Cell(0, 10, "(AUTONOMOUS)", 0, 1, 'C', false);
     $pdf->Cell(0, 10, "MADURAI - 625011", 0, 1, 'C', false);

     $pdf->SetFont('Arial', 'B', 10);
       $pdf->Cell(0, 30, "AUTONOMOUS EXAMINATIONS", 0, 1, 'C', false);
         $pdf->Cell(0, 15, "MARK SHEET", 0, 1, 'C', false);

     $pdf->SetFont('Arial', '', 10);
     $pdf->SetTextColor(0);
      $pdf->Cell(0, 15, "FULL TIME DIPLOMA ( TNP2 SCHEME )", 0, 1, 'C', false);
      $pdf->Ln();
      $pdf->Line($pdf->GetX() - 20,$pdf->GetY(), $pdf->GetX() + 535, $pdf->GetY() );
      $x = $pdf->GetX();
      $y = $pdf->GetY();
      $pdf->MultiCell(0, 30, "REGISTER NO. :     ".$reg_no."  |  ", 0,1);
      $pdf->SetXY($x + 130,$y);
      $pdf->MultiCell(0, 30, "   NAME :     ".$student_name, false);
      $pdf->SetXY($x + 360, $y);
      $pdf->MultiCell(0, 30, "|    DATE OF BIRTH : ".$dob, false);

      $pdf->Line($pdf->GetX() - 20,$pdf->GetY(), $pdf->GetX() + 535, $pdf->GetY() );

      $x = $pdf->GetX();
      $y = $pdf->GetY();
      $pdf->MultiCell(0, 30, $program."  |  ", 0,1);
      $pdf->SetXY($x + 200,$y);
      $pdf->MultiCell(0, 30, $sem, false);
      $pdf->SetXY($x + 360, $y);
      $pdf->MultiCell(0, 30, "  |   ".$mon_year_of_exam, false);

      $pdf->Line($pdf->GetX() - 20,$pdf->GetY(), $pdf->GetX() + 535, $pdf->GetY() );

      $x = $pdf->GetX();
      $y = $pdf->GetY();
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->MultiCell(0, 30, "COURSE_TITLE", 0,1);
      $pdf->Line($pdf->GetX() - 20,$pdf->GetY(), $pdf->GetX() + 535, $pdf->GetY() );
      $pdf->SetXY($x + 310,$y);
      $pdf->MultiCell(0, 30, "IA", false);
      $pdf->SetXY($x + 360, $y);
      $pdf->MultiCell(0, 30, "EE", false);
      $pdf->SetXY($x + 400, $y);
      $pdf->MultiCell(0, 30, "  TOTAL", false);
      $pdf->SetXY($x + 450, $y);
      $pdf->MultiCell(0, 30, "     RESULT", false);

      $pdf->SetFont('Arial', '', 12);

      $x = $pdf->GetX();
      $y = $pdf->GetY();
      for ( $i = 0; $i < count($course_title); $i++ ) {
          $pdf->MultiCell(0, 30, $course_title[$i], false);
          $pdf->SetXY($x + 300, $y);
          if ( $i == 0 )
                    $pdf->Line($pdf->GetX(), $y - 30, $pdf->GetX(), $y + 330);
          $pdf->MultiCell(0, 30, "   ".$ia[$i], false);
          $pdf->SetXY($x + 350, $y);
          if ( $i == 0 )
                    $pdf->Line($pdf->GetX(), $y  - 30, $pdf->GetX(), $y + 330);
          $pdf->MultiCell(0, 30,"   ".$ee[$i], false);
          $pdf->SetXY($x + 400, $y);
          if ( $i == 0 )
                    $pdf->Line($pdf->GetX(), $y - 30, $pdf->GetX(), $y + 330);
          $total = $ia[$i] + $ee[$i];
          $o_total += $total;
          $pdf->MultiCell(0, 30,"   ".$total, false);
          $pdf->SetXY($x + 450, $y);
          if ( $i == 0 )
                    $pdf->Line($pdf->GetX(), $y - 30, $pdf->GetX(), $y + 330);
          $pdf->MultiCell(0, 30, "   ".getRemarks($total), false);
          $x = $pdf->GetX();
      $y = $pdf->GetY();

      }

      $pdf->Ln();
      $pdf->Ln();
      $pdf->Ln();
      $pdf->Ln();
      $pdf->SetTextColor(12, 49, 109);
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Line($pdf->GetX() - 20,$pdf->GetY(), $pdf->GetX() + 535, $pdf->GetY() );
      $pdf->SetRightMargin(200);
       $pdf->Cell(0, 30, "TOTAL:     ".$o_total, 0, 1, 'R', false);
       $x = $pdf->GetX();
       $y = $pdf->GetY();
         $pdf->Cell(0, 15, "CLASSIFICATION:     ", 0, 1, 'R', false);
         $pdf->Ln();
         $pdf->Line($pdf->GetX() - 20,$pdf->GetY(), $pdf->GetX() + 535, $pdf->GetY() );
         $pdf->SetXY( $x + 350, $y);
         $pdf->Cell(0, 15, ($ispass == 1) ? "PASS":"FAIL", 0, 1,false);

      $pdf->Ln();
      $pdf->Ln();
      $pdf->Ln();
      $pdf->Ln();
       $pdf->Cell(0, 20, "SEAL", 0, 1, false);
      $pdf->Ln();
      $pdf->SetRightMargin(100);
      $pdf->Cell(0, 20, "Attestation", 0, 1, 'R', false);
      $pdf->SetRightMargin($margin);
      $pdf->Ln();
      $pdf->Cell(0, 20, "P - PASS   E - EXEMPTED   A - ABSENT   NC - NOT CLEARED   IA - INTERNAL ASSESSMENT   EE - END EXAM", 0, 1, 'C', false);


	$pdf->Output('Marksheet_'.$reg_no.'.pdf', 'I');
    }
    
    function getRemarks($total) {
               if ( $total > 35 )
                  return "PASS";
               else {
                    $ispass = 0;
                   return "FAIL";
                   }
      }
	
?>
