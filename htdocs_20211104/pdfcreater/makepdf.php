<?php

require('tfpdf/tfpdf.php');
$pdf = new tFPDF;

$pdf->AddFont('ShipporiMincho', '', 'ShipporiMinchoB1-Regular.ttf', true);
// $names = explode(',', $_GET['names']);
$names = htmlentities($_GET['names'], ENT_QUOTES, "utf-8");
$names = explode("\r\n", $names);
// $names = explode(",", $names);

foreach ($names as $name) {
  $pdf->SetFont('ShipporiMincho', '', 20);
  $pdf->AddPage();

  $pdf->Cell(0, 10, '微積プリント');
  $pdf->Ln(1);
  $pdf->Cell(100);
  $pdf->Cell(90, 10, "名前：$name", "B");

  $pdf->Ln(40);
  make_contents();
}
$pdf->Output();


function make_contents()
{
  global $pdf;
  $contents = htmlentities($_GET['contents'], ENT_QUOTES, "utf-8");
  $contents = explode("\r\n", $contents);
  // $contents = explode(",", $_GET['contents']);
  $count = 0;
  $Y = $pdf->GetY();

  foreach ($contents  as $content) {
    $count++;

    if ($count == 10) {
      $pdf->setY($Y);
    }
    if ($count >= 10) {
      $pdf->setX(110);
    }
    $pdf->SetFont('ShipporiMincho', '', 25);
    $pdf->Cell(20, 10, "({$count})");
    $pdf->SetFont('ShipporiMincho', '', 30);
    $pdf->Cell(80, 10, $content);
    $pdf->Ln(25);
  }
}
