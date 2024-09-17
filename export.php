<?php
include 'includes/db.php';
include 'functions.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$user_id = $_SESSION['user_id'];
if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'):
$query = "SELECT `biodata_id`,`file_no`,`ippis_no`,`firstname`,`lastname`,`othername`,`gender`,`phonenumber`, ";
$query .= " `email`,`qualifications`, `dob`,`do_ap`,`do_pa`,`type_app`,`countryname`,`statename`,`lganame`, ";
$query .= " `section`,`department`,`rank`,`salary_structure`, `conditess`,`steps` ";
$query .= " FROM `tblbiodata` AS bdt INNER JOIN tbllga AS lg ON bdt.lga=lg.lgaid ";
$query .= " INNER JOIN tblstate AS st ON lg.stateid=st.stateid ";
$query .= " INNER JOIN tblcountries AS ct ON st.countryid=ct.countryid ";
else:
$query = "SELECT `biodata_id`,`file_no`,`ippis_no`,`firstname`,`lastname`,`othername`,`gender`,`phonenumber`, ";
$query .= " `email`,`qualifications`, `dob`,`do_ap`,`do_pa`,`type_app`,`countryname`,`statename`,`lganame`, ";
$query .= " `section`,`department`,`rank`,`salary_structure`, `conditess`,`steps` ";
$query .= " FROM `tblbiodata` AS bdt INNER JOIN tbllga AS lg ON bdt.lga=lg.lgaid ";
$query .= " INNER JOIN tblstate AS st ON lg.stateid=st.stateid ";
$query .= " INNER JOIN tblcountries AS ct ON st.countryid=ct.countryid WHERE user_id = $user_id ";
endif;
$result = mysqli_query($conn, $query);
if(!$result){
    die('QUERY FAILED'.mysqli_error($conn));
}
if (mysqli_num_rows($result)>0) {

    // Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$sheet = $spreadsheet->getActiveSheet();

// marging cells for the header
$sheet->mergeCells('A1:V1');
$sheet->mergeCells('A2:V2');

// setting the header text
$sheet->setCellValue('A1', 'THE FEDERAL POLYTECHNIC MUBI, ADAMAWA STATE NIGERIA.');
$sheet->setCellValue('A2', 'REGISTRY DEPARTMENT (STATISTICS UNIT)');

// align the header text to center
$sheet->getStyle('A1:A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

// set font size and set it bold
$sheet->getStyle('A1:A2')->getFont()->setSize(14)->setBold(true);

// setting column name
$sheet->setCellValue('A3', 'ID')->getStyle('A3')->getFont()->setBold(true);
$sheet->setCellValue('B3', 'FILE NUMBER')->getStyle('B3')->getFont()->setBold(true);
$sheet->setCellValue('C3', 'FIRST NAME')->getStyle('C3')->getFont()->setBold(true);
$sheet->setCellValue('D3', 'LAST NAME')->getStyle('D3')->getFont()->setBold(true);
$sheet->setCellValue('E3', 'OTHER NAME')->getStyle('E3')->getFont()->setBold(true);
$sheet->setCellValue('F3', 'GENDER')->getStyle('F3')->getFont()->setBold(true);
$sheet->setCellValue('G3', 'PHONE NUMBER')->getStyle('G3')->getFont()->setBold(true);
$sheet->setCellValue('H3', 'EMAIL')->getStyle('H3')->getFont()->setBold(true);
$sheet->setCellValue('I3', 'QUALIFICATIONS')->getStyle('I3')->getFont()->setBold(true);
$sheet->setCellValue('J3', 'DATE OF BIRTH')->getStyle('J3')->getFont()->setBold(true);
$sheet->setCellValue('K3', 'DATE OF APP')->getStyle('K3')->getFont()->setBold(true);
$sheet->setCellValue('L3', 'DATE OF PA')->getStyle('L3')->getFont()->setBold(true);
$sheet->setCellValue('M3', 'TYPE OF APP')->getStyle('M3')->getFont()->setBold(true);
$sheet->setCellValue('N3', 'COUNTRY')->getStyle('N3')->getFont()->setBold(true);
$sheet->setCellValue('O3', 'STATE')->getStyle('O3')->getFont()->setBold(true);
$sheet->setCellValue('P3', 'LGA')->getStyle('P3')->getFont()->setBold(true);
$sheet->setCellValue('Q3', 'SECTION')->getStyle('Q3')->getFont()->setBold(true);
$sheet->setCellValue('R3', 'DEPARTMENTS')->getStyle('R3')->getFont()->setBold(true);
$sheet->setCellValue('S3', 'RANKS')->getStyle('S3')->getFont()->setBold(true);
$sheet->setCellValue('T3', 'SALARY STRUCTURE')->getStyle('T3')->getFont()->setBold(true);
$sheet->setCellValue('U3', 'CONDITESS')->getStyle('U3')->getFont()->setBold(true);
$sheet->setCellValue('V3', 'STEPS')->getStyle('V3')->getFont()->setBold(true);

// set column width
$sheet->getColumnDimension('A')->setWidth(6);
$sheet->getColumnDimension('B')->setWidth(10);
$sheet->getColumnDimension('C')->setWidth(10);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(10);
$sheet->getColumnDimension('F')->setWidth(10);
$sheet->getColumnDimension('G')->setWidth(14);
$sheet->getColumnDimension('H')->setWidth(10);
$sheet->getColumnDimension('I')->setWidth(10);
$sheet->getColumnDimension('J')->setWidth(10);
$sheet->getColumnDimension('K')->setWidth(10);
$sheet->getColumnDimension('L')->setWidth(10);
$sheet->getColumnDimension('M')->setWidth(10);
$sheet->getColumnDimension('N')->setWidth(10);
$sheet->getColumnDimension('O')->setWidth(10);
$sheet->getColumnDimension('P')->setWidth(10);
$sheet->getColumnDimension('Q')->setWidth(10);
$sheet->getColumnDimension('R')->setWidth(10);
$sheet->getColumnDimension('S')->setWidth(10);
$sheet->getColumnDimension('T')->setWidth(10);
$sheet->getColumnDimension('U')->setWidth(6);
$sheet->getColumnDimension('V')->setWidth(6);

// initial row number to start data insertion
$initialRow = 4;
 while ($row = mysqli_fetch_assoc($result)){
     $sheet->setCellValue('A'. $initialRow, $row['biodata_id']);
     $sheet->setCellValue('B'. $initialRow, $row['file_no']);
     $sheet->setCellValue('C'. $initialRow, $row['firstname']);
     $sheet->setCellValue('D'. $initialRow, $row['lastname']);
     $sheet->setCellValue('E'. $initialRow, $row['othername']);
     $sheet->setCellValue('F'. $initialRow, $row['gender']);
     $sheet->setCellValue('G'. $initialRow, $row['phonenumber']);
     $sheet->setCellValue('H'. $initialRow, $row['email']);
     $sheet->setCellValue('I'. $initialRow, $row['qualifications']);
     $sheet->setCellValue('J'. $initialRow, $row['dob']);
     $sheet->setCellValue('K'. $initialRow, $row['do_ap']);
     $sheet->setCellValue('L'. $initialRow, $row['do_pa']);
     $sheet->setCellValue('M'. $initialRow, $row['type_app']);
     $sheet->setCellValue('N'. $initialRow, $row['countryname']);
     $sheet->setCellValue('O'. $initialRow, $row['statename']);
     $sheet->setCellValue('P'. $initialRow, $row['lganame']);
     $sheet->setCellValue('Q'. $initialRow, $row['section']);
     $sheet->setCellValue('R'. $initialRow, $row['department']);
     $sheet->setCellValue('S'. $initialRow, $row['rank']);
     $sheet->setCellValue('T'. $initialRow, $row['salary_structure']);
     $sheet->setCellValue('U'. $initialRow, $row['conditess']);
     $sheet->setCellValue('V'. $initialRow, $row['steps']);

     $initialRow++;
 }
}else{
    header('Location: view_records.php?error=notFound');
    exit;
}


// Write the spreadsheet to a file
$writer = new Xlsx($spreadsheet);
$fileName = 'personnel_records.xlsx';

// Output to browser for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
?>