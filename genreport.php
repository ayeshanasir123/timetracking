<?php
require('fpdf184/fpdf.php');
// Database Connection 
include("connect.php");
// Select data from MySQL database
$select = "SELECT * FROM `tasks` ORDER BY id";
$result = $conn->query($select);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
while($row = $result->fetch_object()){
  $id = $row->id;
  $title = $row->title;
  $comment = $row->comment;
  $time = $row->time;
  $pdf->Cell(20,10,$id,1);
  $pdf->Cell(40,10,$title,1);
  $pdf->Cell(80,10,$comment,1);
  $pdf->Cell(40,10,$time,1);
  $pdf->Ln();
}
$pdf->Output();
?>