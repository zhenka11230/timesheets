<?php

require_once('./fpdf17/fpdf.php');

$args = $_REQUEST;
$week_data1 = json_decode($args['week_data1'], true);
$week_data2 = json_decode($args['week_data2'], true);
$week_total1 = json_decode($args['week_total1'], true);
$week_total2 = json_decode($args['week_total2'], true);
$two_week_total = json_decode($args['two_week_total'], true);
	
$first_name = $args['first_name'];
$last_name = $args['last_name'];
$ca_or_sa = $args['ca_or_sa'];
$payroll_period = $args['payroll_period'];
$department = $args['department'];

$ca_or_sa = strtolower($ca_or_sa);

foreach ($week_data1 as &$day) {
	filter_array($day);
	unset($day); //fixes odd php behavior of messing up the array https://bugs.php.net/bug.php?id=29992
}

foreach ($week_data2 as &$day) {
	filter_array($day);
	unset($day);
}

filter_array($week_total1);
filter_array($week_total2);
filter_array($two_week_total);

function date_to_m_d($date) {
	return date('m/d', strtotime($date));
}

function filter_array(&$array) {
	foreach ($array as $key => &$value) {
		if ($value == '0' || $value == '0:00') {
			$value = ' ';
		}
		if($key === 'date'){
			$value = date_to_m_d($value);
		}
		unset($value);
	}
}

//units mm
$r_h = 7.8; //row height
$tbl_y = 103; //begining of table y cordinate
$tbl_x = 31.9;

$tbl_w = array(
    'date' => 13,
    'time_in' => 13,
    'meal_period' => 13,
    'time_out' => 13,
    'hours_worked' => 22,
    'sick_hours' => 13,
    'annual_hours' => 16,
    'total' => 18,
    'shift_hours' => 13
);

//ob_start();

$p = new FPDF('P', 'mm', array(216, 279));
$p->Open();
$p->AddPage();
$p->Image('timesheet.jpg', 0, 0, 216);
$p->SetFont('Arial', '', 8);

if ($ca_or_sa === 'ca') {
	$p->SetXY(60, 42.5);
} else {
	$p->SetXY(81, 42.5);
}
$p->Cell(4, 4, 'X');

$p->SetXY(113, 64);
$p->Cell(40, $r_h, $payroll_period);

$p->SetXY(61, 72);
$p->Cell(40, $r_h, $last_name);

$p->SetXY(141, 72);
$p->Cell(40, $r_h, $first_name);

$p->SetXY(145, 80);
$p->Cell(40, $r_h, $department);

$p->SetXY($tbl_x, $tbl_y);

$row_iter_y = $tbl_y;
foreach ($week_data1 as $day) {
	$p->Cell($tbl_w['date'], $r_h, $day['date'], 0, 0,'C');
	$p->Cell($tbl_w['time_in'], $r_h, $day['time_in'], 0 ,0 ,'R');
	$p->Cell($tbl_w['meal_period'], $r_h, $day['meal_period'], 0, 0,'C');
	$p->Cell($tbl_w['time_out'], $r_h, $day['time_out'], 0 ,0 ,'R');
	$p->Cell($tbl_w['hours_worked'], $r_h, $day['hours_worked'], 0, 0,'C');
	$p->Cell($tbl_w['sick_hours'], $r_h, $day['sick_hours'], 0, 0,'C');
	$p->Cell($tbl_w['annual_hours'], $r_h, $day['annual_hours'], 0, 0,'C');
	$p->Cell($tbl_w['total'], $r_h, $day['total'], 0, 0,'C');
	$p->Cell($tbl_w['shift_hours'], $r_h, $day['shift_hours'], 0, 0,'C');
	$row_iter_y += $r_h;
	$p->SetXY($tbl_x, $row_iter_y);
}
$p->setX($tbl_x + $tbl_w['date'] + $tbl_w['time_in'] + $tbl_w['meal_period'] + $tbl_w['time_out']);
$p->Cell($tbl_w['hours_worked'], $r_h, $week_total1['total_hours_worked'], 0, 0,'C');
$p->Cell($tbl_w['sick_hours'], $r_h, $week_total1['total_sick_hours'], 0, 0,'C');
$p->Cell($tbl_w['annual_hours'], $r_h, $week_total1['total_annual_hours'], 0, 0,'C');
$p->Cell($tbl_w['total'], $r_h, $week_total1['total'], 0, 0,'C');
$p->Cell($tbl_w['shift_hours'], $r_h, $week_total1['total_shift_hours'], 0, 0,'C');

$row_iter_y += $r_h;

$p->SetXY($tbl_x, $row_iter_y);

foreach ($week_data2 as $day) {
	
	$p->Cell($tbl_w['date'], $r_h, $day['date'], 0, 0,'C');
	$p->Cell($tbl_w['time_in'], $r_h, $day['time_in'], 0 ,0 ,'R');
	$p->Cell($tbl_w['meal_period'], $r_h, $day['meal_period'], 0, 0,'C');
	$p->Cell($tbl_w['time_out'], $r_h, $day['time_out'], 0 ,0 ,'R');
	$p->Cell($tbl_w['hours_worked'], $r_h, $day['hours_worked'], 0, 0,'C');
	$p->Cell($tbl_w['sick_hours'], $r_h, $day['sick_hours'], 0, 0,'C');
	$p->Cell($tbl_w['annual_hours'], $r_h, $day['annual_hours'], 0, 0,'C');
	$p->Cell($tbl_w['total'], $r_h, $day['total'], 0, 0,'C');
	$p->Cell($tbl_w['shift_hours'], $r_h, $day['shift_hours'], 0, 0,'C');
	$row_iter_y += $r_h;
	$p->SetXY($tbl_x, $row_iter_y);
}

$p->setX($tbl_x + $tbl_w['date'] + $tbl_w['time_in'] + $tbl_w['meal_period'] + $tbl_w['time_out']);
$p->Cell($tbl_w['hours_worked'], $r_h, $week_total2['total_hours_worked'], 0, 0,'C');
$p->Cell($tbl_w['sick_hours'], $r_h, $week_total2['total_sick_hours'], 0, 0,'C');
$p->Cell($tbl_w['annual_hours'], $r_h, $week_total2['total_annual_hours'], 0, 0,'C');
$p->Cell($tbl_w['total'], $r_h, $week_total2['total'], 0, 0,'C');
$p->Cell($tbl_w['shift_hours'], $r_h, $week_total2['total_shift_hours'], 0, 0,'C');

$row_iter_y += $r_h;

$p->setXY($tbl_x + $tbl_w['date'] + $tbl_w['time_in'] + $tbl_w['meal_period'] + $tbl_w['time_out'], $row_iter_y);
$p->Cell($tbl_w['hours_worked'], $r_h, $two_week_total['total_hours_worked'], 0, 0,'C');
$p->Cell($tbl_w['sick_hours'], $r_h, $two_week_total['total_sick_hours'], 0, 0,'C');
$p->Cell($tbl_w['annual_hours'], $r_h, $two_week_total['total_annual_hours'], 0, 0,'C');
$p->Cell($tbl_w['total'], $r_h, $two_week_total['total'], 0, 0,'C');
$p->Cell($tbl_w['shift_hours'], $r_h, $two_week_total['total_shift_hours'], 0, 0,'C');

$p->Close();
$p->Output();


ob_flush();
?>
