<?php
require('fpdf.php');
include('db.php');

$id = $_GET['id']; // Get report ID from URL
$result = $conn->query("SELECT * FROM loan_reports WHERE id = $id");
$data = $result->fetch_assoc();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0, 10, "Loan Report", 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);

$pdf->Cell(0, 10, "Branch: " . $data['branch'], 0, 1);
$pdf->Cell(0, 10, "Visitor Name: " . $data['visitor_name'], 0, 1);
$pdf->Cell(0, 10, "Visit Date: " . $data['visit_date'], 0, 1);
$pdf->Cell(0, 10, "Applicant Name: " . $data['applicant_name'], 0, 1);
$pdf->Cell(0, 10, "Firm Name: " . $data['firm_name'], 0, 1);
$pdf->Cell(0, 10, "Business Address: " . $data['business_address'], 0, 1);
$pdf->Cell(0, 10, "Annual Net Income: ₹" . $data['annual_net_income'], 0, 1);
$pdf->Cell(0, 10, "Loan Purpose: " . $data['loan_purpose'], 0, 1);
$pdf->Cell(0, 10, "CIBIL Score: " . $data['cibil_score'], 0, 1);

$pdf->Output("D", "Loan_Report_" . $data['applicant_name'] . ".pdf");
?>
