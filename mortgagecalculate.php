<?php
// http://localhost/loancalculator2/calculate.php?loanamount=1,000,000&loanterminmonths=36&interestrateperyear=6&loanstartdate=Sep%202016
// $monthly_payment = $_POST['monthly_payment'];
// $balance = $_POST['loanamount'];
// $rate = $_POST['rate'];
// $months = $_POST['months'];
// $loanstartdate = $_POST['loanstartdate'];
// echo "dfsdfsdfsdfsdfsdf";exit();

// http://localhost/loancalculator2/mortgage-calculator2.html?homevalue=350000&downpaymentpercent=0&loanamount=350000&loanterminmonths=240&interestrateperyear=5&pmipercent=0.625&propertytaxspercent=1.25&homeinsurancepercent=0.35&hoadues=0&loanstartdate=Apr%202016
// http://localhost/loancalculator2/mortgagecalculate.php?homevalue=350000&downpaymentpercent=0&loanamount=350000&loanterminmonths=240&interestrateperyear=5&pmipercent=0.625&propertytaxspercent=1.25&homeinsurancepercent=0.35&hoadues=0&loanstartdate=Apr%202016



$homevalue = (float)preg_replace("/,/","",(isset($_GET['homevalue']) ? $_GET['homevalue'] : 0));
$total_principal_plus_percent = $downpaymentpercent = (float)(isset($_GET['downpaymentpercent']) ? $_GET['downpaymentpercent'] : 0);
$total_principal_plus = $downpayment = (float)(($downpaymentpercent/100)*$homevalue);
$loanamount_backup = $balance = $loanamount = $homevalue - $downpayment;
// $balance = $loanamount = $loanamount + ($loanamount * 1.75)/100;
// $balance = $loanamount = preg_replace("/,/","",(isset($_GET['loanamount']) ? $_GET['loanamount'] : 0));
$interestrateperyear = isset($_GET['interestrateperyear']) ? $_GET['interestrateperyear'] : 0;
$rate = $interestrateperyear/ (12 * 100);
$months = isset($_GET['loanterminmonths']) ? $_GET['loanterminmonths'] : 0;
$loanstartdate = isset($_GET['loanstartdate']) ? $_GET['loanstartdate'] : date('M Y');
$pmi_or_fha_used_when_downpaymentpercent_less_than = 20;

$pmipercent = isset($_GET['pmipercent']) ? $_GET['pmipercent'] : 0;
$pmi =  ($pmipercent/100)*$loanamount_backup;
$monthly_pmi = $pmi/12;
$pmimonths = 0;
$pmi_ofday = "NOT SET";

$propertytaxspercent = isset($_GET['propertytaxspercent']) ? $_GET['propertytaxspercent'] : 0;
$propertytaxs = ($propertytaxspercent/100)*$homevalue;
$monthly_propertytaxs = $propertytaxs/12;
$total_propertytaxs_paid = $monthly_propertytaxs * $months;

$homeinsurancepercent = isset($_GET['homeinsurancepercent']) ? $_GET['homeinsurancepercent'] : 0;
$homeinsurance = ($homeinsurancepercent/100)*$homevalue;
$monthly_homeinsurance = $homeinsurance/12;
$total_homeinsurance_paid = $monthly_homeinsurance * $months;

$hoadues = isset($_GET['hoadues']) ? $_GET['hoadues'] : 0;
$total_hoadues_paid = $hoadues * $months;

$monthly_taxs_insurance_hoa = $monthly_pmi_taxs_insurance_hoa_backup = $monthly_propertytaxs + $monthly_homeinsurance + $hoadues;
$monthly_principal_interest = ($rate + ( $rate / (pow(1 + $rate, $months) - 1))) * $balance;
// echo "$monthly_principal_interest";
// exit;
$monthly_payment_backup = $monthly_payment = $monthly_taxs_insurance_hoa + $monthly_principal_interest;
if($total_principal_plus_percent < $pmi_or_fha_used_when_downpaymentpercent_less_than){
	$monthly_payment_backup += $monthly_pmi;
	$monthly_pmi_taxs_insurance_hoa_backup += $monthly_pmi;
}

$total_principal_interest_paid = $monthly_principal_interest * $months;
$total_principal_paid = $balance;
$total_interest_paid = $total_principal_interest_paid - $total_principal_paid;
// $total_principal_paid_percent = ($total_principal_paid/$total_paid)*100;
// $total_interest_paid_percent = ($total_interest_paid/$total_paid)*100;
$total_pmi_taxs_insurance_hoa_paid2 = 0;
// $total_pmi_taxs_insurance_hoa_paid = $total_propertytaxs_paid + $total_homeinsurance_paid + $total_hoadues_paid;


// $total_paid = 0;
// $total_paid = $monthly_payment * $months;
// $total_paid = $total_pmi_taxs_insurance_hoa_paid + $total_principal_interest_paid;
// $total_paid = $total_pmi_taxs_insurance_hoa_paid + $total_principal_interest_paid + $downpayment;

// $total_principal_paid_percent = ($total_principal_paid/$total_paid)*100;
// $total_interest_paid_percent = ($total_interest_paid/$total_paid)*100;

$f = strtotime($loanstartdate);
$f = strtotime("+".($months - 1)." months", $f);
$payoffdate = date('M Y',$f);
$f = strtotime("-".($months - 1)." months", $f);

/*echo $balance;
echo "<br />";
$balance = preg_replace("/,/","",$_GET['loanamount']);
echo $balance;*/
/*echo "<br />";
echo gettype($interestrateperyear);
echo "<br />";
echo $interestrateperyear*2;
exit();*/

/*echo "<br />";
echo $monthly_payment;
echo "<br />";
echo $balance;
echo "<br />";
echo $rate;
echo "<br />";
echo $months;
echo "<br />";
echo $loanstartdate;
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";*/

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
$yearly_pmi_taxs_insurance_hoa = array();

$f = strtotime($loanstartdate);
// $f = strtotime("+1 months", strtotime($loanstartdate));
// echo date('M Y',$f)

$total_interest = 0;

$amortization_schedule = array();
$yearly_amortization_schedule = array();
$i = 0;
while($balance1 >= $monthly_payment1){
	// if ($pmi_ofday < $f) {
	// 	$amortization_obj->pmi_taxs_insurance_hoa = $monthly_taxs_insurance_hoa - $monthly_pmi;
	// 	$monthly_payment = $monthly_payment 
	// }
	$amortization_obj = new StdClass();
	$amortization_obj->monthly_payment = $monthly_payment;
	$amortization_obj->interest_part = $balance * $rate;
	$amortization_obj->principal_part = $monthly_principal_interest - $amortization_obj->interest_part;
	$amortization_obj->pmi_taxs_insurance_hoa = $monthly_taxs_insurance_hoa;
	
	$total_interest += $amortization_obj->interest_part;
	// $amortization_obj->total_interest = $total_interest;

	if($total_principal_plus_percent < $pmi_or_fha_used_when_downpaymentpercent_less_than){

		$total_principal_plus += $amortization_obj->principal_part;
		$total_principal_plus_percent = ($total_principal_plus/$homevalue)*100;
		// echo "$total_principal_extra_payment_plus | $homevalue | $total_principal_extra_payment_plus_percent";
		// echo "\n";
		$pmimonths++;
		$pmi_ofday = date('M Y',$f);
		$amortization_obj->pmi_taxs_insurance_hoa += $monthly_pmi;
		$total_pmi_taxs_insurance_hoa_paid2 += $monthly_pmi;
		$amortization_obj->monthly_payment += $monthly_pmi;
		// echo ++$i;
		// echo " - ";
		// echo $amortization_obj->principal_part;
		// echo " - ";
		// echo $amortization_obj->interest_part;
		// echo " - ";
		// echo $amortization_obj->extramonthlypayment;
		// echo " - ";
		// echo $total_principal_extra_payment_plus;
		// echo "\n";

	}else{
		// echo $extra_payment_pmimonths;
		// echo "\n";
		// echo $extra_payment_pmi_ofday;
		// echo "\n";
		// echo $total_principal_extra_payment_plus;
		// exit;
	}

	$temp_balance = $balance - $amortization_obj->principal_part;
	$amortization_obj->balance = ($temp_balance < 0) ? 0 : $temp_balance;
	// $amortization_obj->balance = $balance - $amortization_obj->principal_part;

	$amortization_obj->payment_date = date('M Y',$f);
    $balance = $amortization_obj->balance;
    array_push($amortization_schedule,$amortization_obj);
    $balance1 = floor(($balance + $balance*$rate)*100);

    // $total_paid += $monthly_payment;
    $total_pmi_taxs_insurance_hoa_paid2 += $monthly_taxs_insurance_hoa;

    /* create year array */
	$y = date('Y',$f);

	$yearly_date[$y] = $y;

	$yearly_payment[$y] = isset($yearly_payment[$y]) ? $yearly_payment[$y] : 0;
	$yearly_payment[$y] += $amortization_obj->monthly_payment;

	$yearly_principal[$y] = isset($yearly_principal[$y]) ? $yearly_principal[$y] : 0;
	$yearly_principal[$y] += $amortization_obj->principal_part;

	$yearly_interest[$y] = isset($yearly_interest[$y]) ? $yearly_interest[$y] : 0;
	$yearly_interest[$y] += $amortization_obj->interest_part; 

	$yearly_pmi_taxs_insurance_hoa[$y] = isset($yearly_pmi_taxs_insurance_hoa[$y]) ? $yearly_pmi_taxs_insurance_hoa[$y] : 0;
	$yearly_pmi_taxs_insurance_hoa[$y] += $amortization_obj->pmi_taxs_insurance_hoa;

	$yearly_balance[$y] = $balance;

	// if ($pmi_ofday == date('M Y',$f)) {
	//   	$monthly_taxs_insurance_hoa = $monthly_taxs_insurance_hoa - $monthly_pmi;
	//   	$monthly_payment = $monthly_taxs_insurance_hoa + $monthly_principal_interest;
 	//  };



	/* additional one month */
	$f = strtotime("+1 months", $f);

	// if ($i++ == 5) {
	// 	break;
	// }
}

$total_pmi_paid = $pmimonths * $monthly_pmi;
$total_pmi_taxs_insurance_hoa_paid = $total_pmi_paid + $total_propertytaxs_paid + $total_homeinsurance_paid + $total_hoadues_paid;
$total_paid = $total_pmi_taxs_insurance_hoa_paid + $total_principal_interest_paid + $downpayment;
$total_principal_paid_percent = ($total_principal_paid/$total_paid)*100;
$total_interest_paid_percent = ($total_interest_paid/$total_paid)*100;

foreach ($yearly_date as $key => $value){
	$yearly_total_interest += $yearly_interest[$key];
	$yearly_amortization_obj = new StdClass();
	$yearly_amortization_obj->yearly_date = $key;
	$yearly_amortization_obj->yearly_payment = $yearly_payment[$key];
	$yearly_amortization_obj->yearly_interest = $yearly_interest[$key];
	$yearly_amortization_obj->yearly_principal = $yearly_principal[$key];
	$yearly_amortization_obj->yearly_total_interest = $yearly_total_interest;
	$yearly_amortization_obj->yearly_pmi_taxs_insurance_hoa = $yearly_pmi_taxs_insurance_hoa[$key];
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

$paymentObj->pmimonths = $pmimonths;
$paymentObj->pmi_ofday = $pmi_ofday;
$paymentObj->monthly_principal_interest = $monthly_principal_interest;
$paymentObj->total_pmi_taxs_insurance_hoa_paid = $total_pmi_taxs_insurance_hoa_paid;
$paymentObj->total_pmi_taxs_insurance_hoa_paid2 = $total_pmi_taxs_insurance_hoa_paid2;

$paymentObj->total_pmi_paid = $total_pmi_paid;
$paymentObj->total_propertytaxs_paid = $total_propertytaxs_paid;
$paymentObj->total_homeinsurance_paid = $total_homeinsurance_paid;
$paymentObj->total_hoadues_paid = $total_hoadues_paid;

$paymentObj->monthly_pmi_taxs_insurance_hoa = $monthly_pmi_taxs_insurance_hoa_backup;

$json = json_encode($paymentObj);

// echo "<pre>";
//print_r($paymentObj);
echo $json;
// echo "</pre>";