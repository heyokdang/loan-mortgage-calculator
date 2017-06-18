<?php

$homevalue = preg_replace("/,/","",(isset($_GET['homevalue']) ? $_GET['homevalue'] : 0));
$downpaymentpercent = isset($_GET['downpaymentpercent']) ? $_GET['downpaymentpercent'] : 0;
$downpayment = ($downpaymentpercent/100)*$homevalue;
$balance = $loanamount = preg_replace("/,/","",(isset($_GET['loanamount']) ? $_GET['loanamount'] : 0));
$interestrateperyear = isset($_GET['interestrateperyear']) ? $_GET['interestrateperyear'] : 0;
$rate = $interestrateperyear/ (12 * 100);
$months = isset($_GET['loanterminmonths']) ? $_GET['loanterminmonths'] : 0;

$monthly_principal_interest = ($rate + ( $rate / (pow(1 + $rate, $months) - 1))) * $balance;
$monthly_payment_backup = $monthly_payment = $monthly_principal_interest;

$loanstartdate = isset($_GET['loanstartdate']) ? $_GET['loanstartdate'] : "";

$total_principal_interest_paid = $monthly_principal_interest * $months;
$total_principal_paid = $balance;
$total_interest_paid = $total_principal_interest_paid - $total_principal_paid;
$total_paid = $total_principal_interest_paid + $downpayment;

$total_principal_paid_percent = ($total_principal_paid/$total_paid)*100;
$total_interest_paid_percent = ($total_interest_paid/$total_paid)*100;

$f = strtotime($loanstartdate);
$f = strtotime("+".($months - 1)." months", $f);
$payoffdate = date('M Y',$f);
$f = strtotime("-".($months - 1)." months", $f);
// PMI only apply in first 66 months.
// $pmi_ofday = strtotime("+".($pmimonths - 1)." months", $f); 
// $pmi_ofday = date('M Y',$pmi_ofday);

$balance1 = $balance*100;
$monthly_payment1 = floor($monthly_principal_interest*100);

// Yearly Amortization Schedule
$y = "";
$yearly_date = array();
$yearly_payment = array();
$yearly_principal = array();
$yearly_interest = array();
$yearly_total_interest = 0;
$yearly_balance = array();

$f = strtotime($loanstartdate);

$total_interest = 0;

$amortization_schedule = array();
$yearly_amortization_schedule = array();
$i = 0;
while($balance1 >= $monthly_payment1){

	$amortization_obj = new StdClass();
	$amortization_obj->monthly_payment = $monthly_payment;
	$amortization_obj->interest_part = $balance * $rate;
	$amortization_obj->principal_part = $monthly_principal_interest - $amortization_obj->interest_part;
	
	$total_interest += $amortization_obj->interest_part;
	
	$temp_balance = $balance - $amortization_obj->principal_part;
	$amortization_obj->balance = ($temp_balance < 0) ? 0 : $temp_balance;
	
	$amortization_obj->payment_date = date('M Y',$f);
    $balance = $amortization_obj->balance;
    array_push($amortization_schedule,$amortization_obj);
    $balance1 = floor(($balance + $balance*$rate)*100);
    
    /* create year array */
	$y = date('Y',$f);
	
	$yearly_date[$y] = $y;
	
	$yearly_payment[$y] = isset($yearly_payment[$y]) ? $yearly_payment[$y] : 0;
	$yearly_payment[$y] += $amortization_obj->monthly_payment;
	
	$yearly_principal[$y] = isset($yearly_principal[$y]) ? $yearly_principal[$y] : 0;
	$yearly_principal[$y] += $amortization_obj->principal_part;
	
	$yearly_interest[$y] = isset($yearly_interest[$y]) ? $yearly_interest[$y] : 0;
	$yearly_interest[$y] += $amortization_obj->interest_part; 
	
	$yearly_balance[$y] = $balance;
	
	/* additional one month */
	$f = strtotime("+1 months", $f);
}

foreach ($yearly_date as $key => $value){
	$yearly_total_interest += $yearly_interest[$key];
	$yearly_amortization_obj = new StdClass();
	$yearly_amortization_obj->yearly_date = $key;
	$yearly_amortization_obj->yearly_payment = $yearly_payment[$key];
	$yearly_amortization_obj->yearly_interest = $yearly_interest[$key];
	$yearly_amortization_obj->yearly_principal = $yearly_principal[$key];
	$yearly_amortization_obj->yearly_total_interest = $yearly_total_interest;
	$yearly_amortization_obj->yearly_balance = $yearly_balance[$key];
	array_push($yearly_amortization_schedule,$yearly_amortization_obj);
}

$paymentObj = new StdClass();
$paymentObj->yearly_amortization_schedule = $yearly_amortization_schedule;
$paymentObj->amortization_schedule = $amortization_schedule;
$paymentObj->months = $months;
$paymentObj->monthly_payment = $monthly_payment_backup;
$paymentObj->total_paid = $total_paid;
$paymentObj->total_principal_interest_paid = $total_principal_interest_paid;
$paymentObj->total_principal_paid = $total_principal_paid;
$paymentObj->total_interest_paid = $total_interest_paid;
$paymentObj->total_principal_paid_percent = $total_principal_paid_percent;
$paymentObj->total_interest_paid_percent = $total_interest_paid_percent;
$paymentObj->payoffdate = $payoffdate;
$paymentObj->yearly_date = $yearly_date;
$paymentObj->yearly_payment = $yearly_payment;
$paymentObj->yearly_principal = $yearly_principal;
$paymentObj->yearly_interest = $yearly_interest;
$paymentObj->yearly_balance = $yearly_balance;

$paymentObj->monthly_principal_interest = $monthly_principal_interest;

$json = json_encode($paymentObj);

echo $json;