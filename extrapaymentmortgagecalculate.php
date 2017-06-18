<?php
// http://www.loancalculator.pw/extrapaymentcalculate.php?loanamount=100000&loanterminmonths=36&interestrateperyear=6&loanstartdate=Nov%202018&amountAdditionalMonthly=100&amountAdditionalYearly=20&dateAdditionalYearly=May
// http://localhost/loancalculator2/extrapaymentcalculate.php?
// loanamount=100000&loanterminmonths=36&interestrateperyear=6&loanstartdate=Sep%202016&
// amountAdditionalMonthly=10&amountAdditionalYearly=20&dateAdditionalYearly=Jun&
// oneTimePaymentList[]=onetimepayment-1&oneTimePaymentList[]=onetimepayment-2&oneTimePaymentList[]=onetimepayment-3&
// amountOneTimePaymentList[]=30&amountOneTimePaymentList[]=40&amountOneTimePaymentList[]=50&
// dateOneTimePaymentList[]=Oct%202016&dateOneTimePaymentList[]=May%202017&dateOneTimePaymentList[]=Aug%202018

// <!-- 1 test url
// http://localhost/loancalculator2/mortgage-calculator2.html#?homevalue=350000&downpaymentpercent=0&loanamount=350000&loanterminmonths=240&interestrateperyear=5&pmipercent=0.625&propertytaxspercent=1.25&homeinsurancepercent=0.35&hoadues=0&loanstartdate=Apr%202016&drawcharts=1&annualamortizationtable=1&monthlyamortizationtable=1&calcfunc=applyExtraPayments&amountAdditionalMonthly=100&amountAdditionalYearly=200&dateAdditionalYearly=Apr&oneTimePaymentList=onetimepayment-1&oneTimePaymentList=onetimepayment-2&oneTimePaymentList=onetimepayment-3&oneTimePaymentList=onetimepayment-4&oneTimePaymentList=onetimepayment-5&amountOneTimePaymentList=100&amountOneTimePaymentList=500&amountOneTimePaymentList=100&amountOneTimePaymentList=50&amountOneTimePaymentList=200&dateOneTimePaymentList=Aug%202017&dateOneTimePaymentList=Oct%202019&dateOneTimePaymentList=Sep%202024&dateOneTimePaymentList=Oct%202028&dateOneTimePaymentList=Jun%202034

// http://localhost/loancalculator2/extrapaymentmortgagecalculate.php?homevalue=350000&downpaymentpercent=0&loanamount=350000&loanterminmonths=240&interestrateperyear=5&pmipercent=0.625&propertytaxspercent=1.25&homeinsurancepercent=0.35&hoadues=0&loanstartdate=Apr%202016&amountAdditionalMonthly=100&amountAdditionalYearly=200&dateAdditionalYearly=Apr&oneTimePaymentList[]=onetimepayment-1&amountOneTimePaymentList[]=100&dateOneTimePaymentList[]=Aug%202017&oneTimePaymentList[]=onetimepayment-2&amountOneTimePaymentList[]=500&dateOneTimePaymentList[]=Oct%202019&oneTimePaymentList[]=onetimepayment-3&amountOneTimePaymentList[]=100&dateOneTimePaymentList[]=Sep%202024&oneTimePaymentList[]=onetimepayment-4&amountOneTimePaymentList[]=50&dateOneTimePaymentList[]=Oct%202028&oneTimePaymentList[]=onetimepayment-5&amountOneTimePaymentList[]=200&dateOneTimePaymentList[]=Jun%202034
// -->

// <!-- 2 test url
// http://localhost/loancalculator2/mortgage-calculator2.html#?homevalue=350000&downpaymentpercent=10&loanamount=315000&loanterminmonths=240&interestrateperyear=5&pmipercent=0.625&propertytaxspercent=1.25&homeinsurancepercent=0.35&hoadues=0&loanstartdate=Apr%202016&drawcharts=1&annualamortizationtable=1&monthlyamortizationtable=1&calcfunc=applyExtraPayments&amountAdditionalMonthly=100&amountAdditionalYearly=200&dateAdditionalYearly=Apr&oneTimePaymentList=onetimepayment-1&oneTimePaymentList=onetimepayment-2&oneTimePaymentList=onetimepayment-3&oneTimePaymentList=onetimepayment-4&oneTimePaymentList=onetimepayment-5&oneTimePaymentList=onetimepayment-6&amountOneTimePaymentList=100&amountOneTimePaymentList=500&amountOneTimePaymentList=100&amountOneTimePaymentList=50&amountOneTimePaymentList=3000&amountOneTimePaymentList=3000&dateOneTimePaymentList=Aug%202017&dateOneTimePaymentList=Oct%202019&dateOneTimePaymentList=Sep%202024&dateOneTimePaymentList=Oct%202028&dateOneTimePaymentList=Feb%202034&dateOneTimePaymentList=Oct%202028

// http://localhost/loancalculator2/extrapaymentmortgagecalculate.php?homevalue=350000&downpaymentpercent=10&loanamount=315000&loanterminmonths=240&interestrateperyear=5&pmipercent=0.625&propertytaxspercent=1.25&homeinsurancepercent=0.35&hoadues=0&loanstartdate=Apr%202016&amountAdditionalMonthly=100&amountAdditionalYearly=200&dateAdditionalYearly=Apr&oneTimePaymentList[]=onetimepayment-1&amountOneTimePaymentList[]=100&dateOneTimePaymentList[]=Aug%202017&oneTimePaymentList[]=onetimepayment-2&amountOneTimePaymentList[]=500&dateOneTimePaymentList[]=Oct%202019&oneTimePaymentList[]=onetimepayment-3&amountOneTimePaymentList[]=100&dateOneTimePaymentList[]=Sep%202024&oneTimePaymentList[]=onetimepayment-4&amountOneTimePaymentList[]=50&dateOneTimePaymentList[]=Oct%202028&oneTimePaymentList[]=onetimepayment-5&amountOneTimePaymentList[]=3000&dateOneTimePaymentList[]=Feb%202034&oneTimePaymentList[]=onetimepayment-6&amountOneTimePaymentList[]=3000&dateOneTimePaymentList[]=Oct%202028
// -->

// <!-- 3 test url
// http://localhost/loancalculator2/mortgage-calculator2.html#?homevalue=350000&downpaymentpercent=5&loanamount=332500&loanterminmonths=240&interestrateperyear=5&pmipercent=0.625&propertytaxspercent=1.25&homeinsurancepercent=0.35&hoadues=0&loanstartdate=Apr%202016&drawcharts=1&annualamortizationtable=1&monthlyamortizationtable=1&calcfunc=applyExtraPayments&amountAdditionalMonthly=100&amountAdditionalYearly=200&dateAdditionalYearly=Apr&oneTimePaymentList=onetimepayment-1&oneTimePaymentList=onetimepayment-2&oneTimePaymentList=onetimepayment-3&oneTimePaymentList=onetimepayment-4&oneTimePaymentList=onetimepayment-5&oneTimePaymentList=onetimepayment-6&amountOneTimePaymentList=100&amountOneTimePaymentList=500&amountOneTimePaymentList=100&amountOneTimePaymentList=50&amountOneTimePaymentList=3000&amountOneTimePaymentList=3000&dateOneTimePaymentList=Aug%202017&dateOneTimePaymentList=Oct%202019&dateOneTimePaymentList=Sep%202024&dateOneTimePaymentList=Oct%202028&dateOneTimePaymentList=Sep%202024&dateOneTimePaymentList=Feb%202034

// http://localhost/loancalculator2/extrapaymentmortgagecalculate.php?homevalue=350000&downpaymentpercent=5&loanamount=332500&loanterminmonths=240&interestrateperyear=5&pmipercent=0.625&propertytaxspercent=1.25&homeinsurancepercent=0.35&hoadues=0&loanstartdate=Apr%202016&amountAdditionalMonthly=100&amountAdditionalYearly=200&dateAdditionalYearly=Apr&oneTimePaymentList[]=onetimepayment-1&amountOneTimePaymentList[]=100&dateOneTimePaymentList[]=Aug%202017&oneTimePaymentList[]=onetimepayment-2&amountOneTimePaymentList[]=500&dateOneTimePaymentList[]=Oct%202019&oneTimePaymentList[]=onetimepayment-3&amountOneTimePaymentList[]=100&dateOneTimePaymentList[]=Sep%202024&oneTimePaymentList[]=onetimepayment-4&amountOneTimePaymentList[]=50&dateOneTimePaymentList[]=Oct%202028&oneTimePaymentList[]=onetimepayment-5&amountOneTimePaymentList[]=3000&dateOneTimePaymentList[]=Sep%202024&oneTimePaymentList[]=onetimepayment-6&amountOneTimePaymentList[]=3000&dateOneTimePaymentList[]=Feb%202034
// -->

// http://localhost/loancalculator2/extrapaymentmortgagecalculate.php?homevalue=350000&downpaymentpercent=20&loanamount=280000&loanterminmonths=240&interestrateperyear=5&pmipercent=0.625&pmimonths=40&propertytaxspercent=1.25&homeinsurancepercent=0.35&hoadues=0&loanstartdate=Apr%202016&amountAdditionalMonthly=100&amountAdditionalYearly=200&dateAdditionalYearly=Apr&oneTimePaymentList[]=onetimepayment-1&amountOneTimePaymentList[]=100&dateOneTimePaymentList[]=Aug%202017&oneTimePaymentList[]=onetimepayment-2&amountOneTimePaymentList[]=500&dateOneTimePaymentList[]=Oct%202019&oneTimePaymentList[]=onetimepayment-3&amountOneTimePaymentList[]=100&dateOneTimePaymentList[]=Sep%202024&oneTimePaymentList[]=onetimepayment-4&amountOneTimePaymentList[]=50&dateOneTimePaymentList[]=Oct%202028&oneTimePaymentList[]=onetimepayment-5&amountOneTimePaymentList[]=3000&dateOneTimePaymentList[]=Sep%202024&oneTimePaymentList[]=onetimepayment-6&amountOneTimePaymentList[]=3000&dateOneTimePaymentList[]=Feb%202028&oneTimePaymentList[]=onetimepayment-7&amountOneTimePaymentList[]=3000&dateOneTimePaymentList[]=Feb%202028

// http://localhost/loancalculator2/extrapaymentmortgagecalculate.php?homevalue=350000&downpaymentpercent=20&loanamount=280000&loanterminmonths=240&interestrateperyear=5&pmipercent=0.625&pmimonths=40&propertytaxspercent=1.25&homeinsurancepercent=0.35&hoadues=0&loanstartdate=Apr%202016&amountAdditionalMonthly=100&amountAdditionalYearly=200&dateAdditionalYearly=Apr&oneTimePaymentList[]=onetimepayment-1&amountOneTimePaymentList[]=100&dateOneTimePaymentList[]=Aug%202017&oneTimePaymentList[]=onetimepayment-2&amountOneTimePaymentList[]=500&dateOneTimePaymentList[]=Oct%202019&oneTimePaymentList[]=onetimepayment-3&amountOneTimePaymentList[]=100&dateOneTimePaymentList[]=Sep%202024&oneTimePaymentList[]=onetimepayment-4&amountOneTimePaymentList[]=50&dateOneTimePaymentList[]=Oct%202028&oneTimePaymentList[]=onetimepayment-5&amountOneTimePaymentList[]=3000&dateOneTimePaymentList[]=Dec%202033&oneTimePaymentList[]=onetimepayment-6&amountOneTimePaymentList[]=3000&dateOneTimePaymentList[]=Jan%202034

error_reporting(0);

$homevalue = (float)preg_replace("/,/","",(isset($_GET['homevalue']) ? $_GET['homevalue'] : 0));
$total_principal_extra_payment_plus_percent = $downpaymentpercent = (float)(isset($_GET['downpaymentpercent']) ? $_GET['downpaymentpercent'] : 0);
$total_principal_extra_payment_plus = $downpayment = (float)(($downpaymentpercent/100)*$homevalue);

// echo gettype($homevalue);
// echo "\n";
// echo gettype($total_principal_extra_payment_plus_percent);
// echo "\n";
// echo gettype($total_principal_extra_payment_plus);
// echo "\n";

$balance = $loanamount = $homevalue - $downpayment;
// $balance = $loanamount = preg_replace("/,/","",(isset($_GET['loanamount']) ? $_GET['loanamount'] : 0));
$interestrateperyear = isset($_GET['interestrateperyear']) ? $_GET['interestrateperyear'] : 0;
$rate = $interestrateperyear/ (12 * 100);
$months = isset($_GET['loanterminmonths']) ? $_GET['loanterminmonths'] : 0;
$loanstartdate = isset($_GET['loanstartdate']) ? $_GET['loanstartdate'] : date('M Y');
$f = strtotime($loanstartdate);

$pmipercent = isset($_GET['pmipercent']) ? $_GET['pmipercent'] : 0;
$pmi =  ($pmipercent/100)*$loanamount;
$monthly_pmi = $pmi/12;
$extra_payment_pmimonths = 0;

// echo "$total_principal_extra_payment_plus | $homevalue | $total_principal_extra_payment_plus_percent";
// echo "\n";

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

$total_principal_interest_paid = $monthly_principal_interest * $months;
$total_principal_paid = $balance;
$total_interest_paid = $total_principal_interest_paid - $total_principal_paid;
// <----
// got total pmi with no extra payment
// used pmi or fha when down payment percent less than 20%
$pmi_or_fha_used_when_downpaymentpercent_less_than = 20;
$extra_payment_pmimonths = 0;
$extra_payment_pmi_ofday = "NOT SET";
$bal = $balance;
$total_principal_plus = $downpayment;
$total_principal_plus_percent = $total_principal_extra_payment_plus_percent;
$bal_pmimonths = 0;
$bal_pmi_ofday = "NOT SET";
$bal_pmi_total = 0;
// $i=0;
while(($bal >= $monthly_principal_interest) && ($total_principal_plus_percent < $pmi_or_fha_used_when_downpaymentpercent_less_than)){
  
  $bal_pmi_ofday = strtotime("+".$bal_pmimonths." months", $f);
  $bal_pmi_ofday = date('M Y',$bal_pmi_ofday);

  $bal_interest = $bal * $rate;
  $bal_principal = $monthly_principal_interest - $bal_interest;
  $total_principal_plus += $bal_principal;
  $total_principal_plus_percent = ($total_principal_plus/$homevalue)*100;

  $bal -= $bal_principal;
  $bal_pmimonths++;

  // echo ++$i;
  // echo " - ";
  // echo $bal_principal;
  // echo " - ";
  // echo $bal_interest;
  // echo " - ";
  // echo $total_principal_plus;
  // echo "\n";
}

$pmimonths = $bal_pmimonths;
// $bal_pmi_ofday = strtotime("+".$bal_pmimonths." months", $f);
$pmi_ofday = $bal_pmi_ofday;
$bal_pmi_total = $total_pmi_paid = $bal_pmimonths * $monthly_pmi;
$total_pmi_taxs_insurance_hoa_paid = $total_pmi_paid + $total_propertytaxs_paid + $total_homeinsurance_paid + $total_hoadues_paid;
$total_paid = $total_pmi_taxs_insurance_hoa_paid + $total_principal_interest_paid + $downpayment;

// ---->
$total_principal_paid_percent = ($total_principal_paid/$total_paid)*100;
$total_interest_paid_percent = ($total_interest_paid/$total_paid)*100;


// amount additinal monthly
$amountAdditionalMonthly = isset($_GET['amountAdditionalMonthly']) ? $_GET['amountAdditionalMonthly'] : 0;
// amount additional yearly
$amountAdditionalYearly = isset($_GET['amountAdditionalYearly']) ? $_GET['amountAdditionalYearly'] : 0;
// date additional yearly
$dateAdditionalYearly = isset($_GET['dateAdditionalYearly']) ? $_GET['dateAdditionalYearly'] : "";
// amount one time payment
$amount_one_time_payment = 0;
// total amount extra payment
$totalAmountExtraPayment = 0;

// echo "rate: ". $rate;
// echo "<br />";
// echo "amountAdditionalMonthly: " . $amountAdditionalMonthly;
// echo "<br />";
// echo "amountAdditionalYearly: " . $amountAdditionalYearly;
// echo " --- ";
// // date additional yearly
// echo "dateAdditionalYearly: " . $dateAdditionalYearly;

$total_pmi_taxs_insurance_hoa_paid2 = 0;
$extrapayment_total_pmi_taxs_insurance_hoa_paid = 0;

$monthly_payment_backup = $monthly_payment = $monthly_taxs_insurance_hoa + $monthly_principal_interest;
$monthly_payment_with_additionalMonthly_backup = $monthly_payment_with_additionalMonthly = $monthly_taxs_insurance_hoa + $monthly_principal_interest + $amountAdditionalMonthly;
if($total_principal_extra_payment_plus_percent < $pmi_or_fha_used_when_downpaymentpercent_less_than){
  $monthly_payment_backup += $monthly_pmi;
  $monthly_pmi_taxs_insurance_hoa_backup += $monthly_pmi;
  $monthly_payment_with_additionalMonthly_backup += $monthly_pmi;
}

// echo $pmimonths;
// echo "\n";
// echo $pmi_ofday;
// echo "\n";
// echo $total_principal_plus;
// echo "\n";
// exit;

$oneTimePaymentList = isset($_GET['oneTimePaymentList']) ? $_GET['oneTimePaymentList'] : [];
// $oneTimePaymentList = array_reverse($oneTimePaymentList, true);
$_amountOneTimePaymentList = isset($_GET['amountOneTimePaymentList']) ? $_GET['amountOneTimePaymentList'] : [];
$_dateOneTimePaymentList = isset($_GET['dateOneTimePaymentList']) ? $_GET['dateOneTimePaymentList'] : [];
$amountOneTimePaymentList = [];
$dateOneTimePaymentList = [];

$AmountdateOneTimePaymentList = [];
$AmountdateOneTimePaymentList_track = [];

$oneTimePaymentList_increase_id = explode('-',$oneTimePaymentList[count($oneTimePaymentList) - 1])[1];
$oneTimePaymentList_increase_id++;

// set key and value for amountOneTimePaymentList and dateOneTimePaymentList
foreach ($oneTimePaymentList as $key => $value){
  // create $date with value to add to $monthly_payment1
  if(isset($AmountdateOneTimePaymentList[$_dateOneTimePaymentList[$key]])){
    $AmountdateOneTimePaymentList[$_dateOneTimePaymentList[$key]] += $_amountOneTimePaymentList[$key];
  }else{
    $AmountdateOneTimePaymentList[$_dateOneTimePaymentList[$key]] = $_amountOneTimePaymentList[$key];
    $AmountdateOneTimePaymentList_track[$_dateOneTimePaymentList[$key]] = $value;
  }
}

foreach ($AmountdateOneTimePaymentList_track as $key => $value){
  $amountOneTimePaymentList[$value] = $AmountdateOneTimePaymentList[$key];
  $dateOneTimePaymentList[$value] = $key;
}

$oneTimePaymentList_right = [];
$amountOneTimePaymentList_right = [];
$dateOneTimePaymentList_right = [];

$enddate_amountAdditionalMonthly = "";
$enddate_amountAdditionalYearly = "";
$amountAdditionalMonthly_count = 0;
$amountAdditionalYearly_count = 0;

// Loan Extra Payments Summary
$total_paid_with_extra_payment = 0;
$extra_payment_months = 0;

// Yearly Amortization Schedule
$y = "";
$yearly_date = array();
$yearly_payment = array();
$yearly_principal = array();
$yearly_interest = array();
$yearly_extrayearlypayment = array();
$yearly_total_interest = 0;
$yearly_balance = array();
$yearly_pmi_taxs_insurance_hoa = array();

$f = strtotime("+".($months - 1)." months", $f);
$payoffdate = date('M Y',$f);
$f = strtotime($loanstartdate);

$total_interest = 0;

$amortization_schedule = array();
$yearly_amortization_schedule = array();
$i = 0;

$total_amountAdditionalMonthly = 0;
$total_amountAdditionalYearly = 0;
$total_amountOneTimePaymentList = 0;
// temp balance
$temp_balance = 0;
$balance1 = floor(($balance + $balance*$rate)*100);
$monthly_payment1 = $monthly_principal_interest + $amountAdditionalMonthly + $AmountdateOneTimePaymentList[date('M Y',$f)];
if(date('M',$f) == $dateAdditionalYearly){
  $monthly_payment1 += $amountAdditionalYearly;
}
$monthly_payment1 *= 100;
// echo "\n\n\n\n\n\n\n\n\n\n\n";
while($balance1 >= $monthly_payment1){

  $amortization_obj = new StdClass();
  $amortization_obj->payment_date = date('M Y',$f);
  $amortization_obj->interest_part = $balance * $rate;
  $total_interest += $amortization_obj->interest_part;
  $amortization_obj->principal_part = $monthly_principal_interest - $amortization_obj->interest_part;
  
  $amortization_obj->pmi_taxs_insurance_hoa = $monthly_taxs_insurance_hoa;
  
  $amortization_obj->monthly_payment = $monthly_principal_interest + $amountAdditionalMonthly + $monthly_taxs_insurance_hoa;
  $amortization_obj->extramonthlypayment = $amountAdditionalMonthly;

  if ( date('M',$f) == $dateAdditionalYearly ) {
    $enddate_amountAdditionalYearly = date('M Y',$f);

    $amortization_obj->monthly_payment += $amountAdditionalYearly;
    $amortization_obj->extramonthlypayment += $amountAdditionalYearly;

    $amountAdditionalYearly_count++;
  }

  if(isset($AmountdateOneTimePaymentList[date('M Y',$f)])){
    $amortization_obj->monthly_payment += $AmountdateOneTimePaymentList[date('M Y',$f)];
    $totalAmountExtraPayment += $AmountdateOneTimePaymentList[date('M Y',$f)];
    $total_amountOneTimePaymentList += $AmountdateOneTimePaymentList[date('M Y',$f)];
    $amortization_obj->extramonthlypayment += $AmountdateOneTimePaymentList[date('M Y',$f)];
  }

  // update pmi
  if($total_principal_extra_payment_plus_percent < $pmi_or_fha_used_when_downpaymentpercent_less_than){

    $total_principal_extra_payment_plus += $amortization_obj->principal_part;
    $total_principal_extra_payment_plus += $amortization_obj->extramonthlypayment;
    $total_principal_extra_payment_plus_percent = ($total_principal_extra_payment_plus/$homevalue)*100;
    // echo "$total_principal_extra_payment_plus | $homevalue | $total_principal_extra_payment_plus_percent";
    // echo "\n";
    $extra_payment_pmimonths++;
    $extra_payment_pmi_ofday = date('M Y',$f);
    $total_pmi_taxs_insurance_hoa_paid2 += $monthly_pmi;
    $extrapayment_total_pmi_taxs_insurance_hoa_paid += $monthly_pmi;
    $amortization_obj->pmi_taxs_insurance_hoa += $monthly_pmi;
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

  }
  // else{
    // echo $extra_payment_pmimonths;
    // echo "\n";
    // echo $extra_payment_pmi_ofday;
    // echo "\n";
    // echo $total_principal_extra_payment_plus;
    // exit;
  // }
  
  $temp_balance = $balance - $amortization_obj->principal_part - $amortization_obj->extramonthlypayment;
  $amortization_obj->balance = $balance = ($temp_balance < 0) ? 0 : $temp_balance;
  
  $balance1 = floor(($balance + $balance*$rate)*100);
  // echo "<br>";
  // echo $balance1;
  // echo "<br>";

  // Loan Extra Payments Summary
  $total_paid_with_extra_payment += $amortization_obj->monthly_payment;
  $extra_payment_months++;

  $total_pmi_taxs_insurance_hoa_paid2 += $monthly_taxs_insurance_hoa;
  $extrapayment_total_pmi_taxs_insurance_hoa_paid += $monthly_taxs_insurance_hoa;

  array_push($amortization_schedule,$amortization_obj);

  /* create year array */
  $y = date('Y',$f);
  
  $yearly_date[$y] = $y;
  // exit;
  
  $yearly_payment[$y] = isset($yearly_payment[$y]) ? $yearly_payment[$y] : 0;
  $yearly_payment[$y] += $amortization_obj->monthly_payment;

  $yearly_principal[$y] = isset($yearly_principal[$y]) ? $yearly_principal[$y] : 0;
  $yearly_principal[$y] += $amortization_obj->principal_part;

  $yearly_interest[$y] = isset($yearly_interest[$y]) ? $yearly_interest[$y] : 0;
  $yearly_interest[$y] += $amortization_obj->interest_part;

  $yearly_extrayearlypayment[$y] = isset($yearly_extrayearlypayment[$y]) ? $yearly_extrayearlypayment[$y] : 0;
  $yearly_extrayearlypayment[$y] += $amortization_obj->extramonthlypayment;

  $yearly_pmi_taxs_insurance_hoa[$y] = isset($yearly_pmi_taxs_insurance_hoa[$y]) ? $yearly_pmi_taxs_insurance_hoa[$y] : 0;
  $yearly_pmi_taxs_insurance_hoa[$y] += $amortization_obj->pmi_taxs_insurance_hoa;
  
  $yearly_balance[$y] = $balance;
  
  /* additional one month */
  $f = strtotime("+1 months", $f);


  $monthly_payment1 = $monthly_principal_interest + $amountAdditionalMonthly + $AmountdateOneTimePaymentList[date('M Y',$f)];
  if(date('M',$f) == $dateAdditionalYearly){
    $monthly_payment1 += $amountAdditionalYearly;
  }
  $monthly_payment1 *= 100;
  $monthly_payment1 = floor($monthly_payment1);

}

$amountAdditionalMonthly_count = $extra_payment_months;

// $amountAdditionalMonthly_count = $extra_payment_months;
// total amount extra payment
$total_amountAdditionalMonthly += $amountAdditionalMonthly_count*$amountAdditionalMonthly;
$totalAmountExtraPayment += $total_amountAdditionalMonthly;
$f = strtotime("-1 months", $f);
$enddate_amountAdditionalMonthly = date('M Y',$f);
/* additional one month */
// total amount extra payment
$total_amountAdditionalYearly += $amountAdditionalYearly_count*$amountAdditionalYearly;
$totalAmountExtraPayment += $total_amountAdditionalYearly;

if ($balance>0) {
  $f = strtotime("+1 months", $f);
  $extra_payment_months++;
  $monthly_principal_interest1 = $monthly_principal_interest*100;
  
  $amortization_obj = new StdClass();
  $amortization_obj->interest_part = $balance * $rate;
  $total_interest += $amortization_obj->interest_part;
  $amortization_obj->pmi_taxs_insurance_hoa = $monthly_taxs_insurance_hoa;
  $amortization_obj->payment_date = date('M Y',$f);

  // $balance1 = $balance + $interest
  // $monthly_payment1 = $principal + $interest + $extra_payment
  // $monthly_principal_interest1 = $principal + $interest
  // if($balance1 > $monthly_principal_interest1) => 
  // $balance + $interest > $principal + $interest => 
  // $balance > $principal
  if($balance1 > $monthly_principal_interest1){
    
    $amortization_obj->principal_part = $monthly_principal_interest - $amortization_obj->interest_part;
    $extra_payment = $balance - $amortization_obj->principal_part;
    // echo "\n<br>extra payment: $extra_payment \n<br>";
    $amortization_obj->monthly_payment = $monthly_principal_interest + $extra_payment + $monthly_taxs_insurance_hoa;
    $amortization_obj->extramonthlypayment = $extra_payment;
    // total amount extra payment
    $totalAmountExtraPayment += $extra_payment;
    
    if (($amountAdditionalMonthly > 0) && ($extra_payment >= $amountAdditionalMonthly)) {
      # code...
      $total_amountAdditionalMonthly += $amountAdditionalMonthly;
      $amountAdditionalMonthly_count++;
      $enddate_amountAdditionalMonthly = date('M Y',$f);
      $extra_payment -= $amountAdditionalMonthly;
      // echo "\n<br>monthly sub extra payment: $extra_payment \n<br>";
    }
    
    if ((date('M',$f) == $dateAdditionalYearly) && ($amountAdditionalYearly > 0) && ($extra_payment >= $amountAdditionalYearly)) {
      # code...
      $total_amountAdditionalYearly += $amountAdditionalYearly;
      $amountAdditionalYearly_count++;
      $enddate_amountAdditionalYearly = date('M Y',$f);
      $extra_payment -= $amountAdditionalYearly;
      // echo "\n<br>yearly sub extra payment: $extra_payment \n<br>";
    }
    
    // if 2 cases above right and now $extra_payment > 0 then onetimeextrapayment is exist or is not exist, if ontimeextrapayment is not exist is because amountAdditionalMonthly is so big or amountAdditionalYearly is so big.
    // if 2 cases above wrong and now $extra_payment > 0 then onetimeextrapayment is exist
    if ($extra_payment > 0) {
      
      if (!isset($AmountdateOneTimePaymentList[date('M Y',$f)])) {
        # code...
        $AmountdateOneTimePaymentList_track[date('M Y',$f)] = "onetimepayment-".$oneTimePaymentList_increase_id;
        $dateOneTimePaymentList[$AmountdateOneTimePaymentList_track[date('M Y',$f)]] = date('M Y',$f);
        // echo "\n<br>one time extra payment: $extra_payment \n<br>";
        $oneTimePaymentList_increase_id++;
      }
      
      $AmountdateOneTimePaymentList[date('M Y',$f)] = $extra_payment;
      $amountOneTimePaymentList[$AmountdateOneTimePaymentList_track[date('M Y',$f)]] = $extra_payment;
      $total_amountOneTimePaymentList += $AmountdateOneTimePaymentList[date('M Y',$f)];
      $extra_payment = 0;
      
    }

  }else{
    // if($balance1 <= $monthly_principal_interest1) => $balance <= $principal
    $amortization_obj->principal_part = $balance;
    $amortization_obj->monthly_payment = $amortization_obj->interest_part + $amortization_obj->principal_part + $monthly_taxs_insurance_hoa;
    $amortization_obj->extramonthlypayment = 0;
    // var_dump($amortization_obj);
    // exit;
  }

  // update pmi
  if($total_principal_extra_payment_plus_percent < $pmi_or_fha_used_when_downpaymentpercent_less_than){

    $extra_payment_pmimonths++;
    $extra_payment_pmi_ofday = date('M Y',$f);
    $total_pmi_taxs_insurance_hoa_paid2 += $monthly_pmi;
    $extrapayment_total_pmi_taxs_insurance_hoa_paid += $monthly_pmi;
    $amortization_obj->pmi_taxs_insurance_hoa += $monthly_pmi;
    $amortization_obj->monthly_payment += $monthly_pmi;

  }

  // Loan Extra Payments Summary
  $total_paid_with_extra_payment += $amortization_obj->monthly_payment;
  $total_pmi_taxs_insurance_hoa_paid2 += $monthly_taxs_insurance_hoa;
  $extrapayment_total_pmi_taxs_insurance_hoa_paid += $monthly_taxs_insurance_hoa;

  $amortization_obj->balance = 0;
  $balance = 0;
  array_push($amortization_schedule,$amortization_obj);
  
  /* create yearly array */
  $y = date('Y',$f);
  
  $yearly_date[$y] = $y;
  
  $yearly_payment[$y] = isset($yearly_payment[$y]) ? $yearly_payment[$y] : 0;
  $yearly_payment[$y] += $amortization_obj->monthly_payment;
  
  $yearly_principal[$y] = isset($yearly_principal[$y]) ? $yearly_principal[$y] : 0;
  $yearly_principal[$y] += $amortization_obj->principal_part;
  
  $yearly_interest[$y] = isset($yearly_interest[$y]) ? $yearly_interest[$y] : 0;
  $yearly_interest[$y] += $amortization_obj->interest_part;

  $yearly_extrayearlypayment[$y] = isset($yearly_extrayearlypayment[$y]) ? $yearly_extrayearlypayment[$y] : 0;
  $yearly_extrayearlypayment[$y] += $amortization_obj->extramonthlypayment;

  $yearly_pmi_taxs_insurance_hoa[$y] = isset($yearly_pmi_taxs_insurance_hoa[$y]) ? $yearly_pmi_taxs_insurance_hoa[$y] : 0;
  $yearly_pmi_taxs_insurance_hoa[$y] += $amortization_obj->pmi_taxs_insurance_hoa;
  
  $yearly_balance[$y] = $balance;
  
}

// check One time payment list element, only get right elements, means paid in right date.
$startdatetime = strtotime($loanstartdate);
$enddatetime = $f;
foreach ($AmountdateOneTimePaymentList_track as $key => $value){
  $amount_one_time_payment = $amountOneTimePaymentList[$value];
  $temp_dateOneTimePayment = strtotime($dateOneTimePaymentList[$value]);
  if (($temp_dateOneTimePayment >= $startdatetime) && ($temp_dateOneTimePayment <= $enddatetime)) {
    array_push($oneTimePaymentList_right,$value);
    $amountOneTimePaymentList_right[$value] = $amount_one_time_payment;
    $dateOneTimePaymentList_right[$value] = $dateOneTimePaymentList[$value];
  }
}

/* yearly */
foreach ($yearly_date as $key => $value){
    $yearly_total_interest += $yearly_interest[$key];
    $yearly_amortization_obj = new StdClass();
    $yearly_amortization_obj->yearly_date = $key;
    $yearly_amortization_obj->yearly_payment = $yearly_payment[$key];
    $yearly_amortization_obj->yearly_interest = $yearly_interest[$key];
    $yearly_amortization_obj->yearly_principal = $yearly_principal[$key];
    $yearly_amortization_obj->yearly_total_interest = $yearly_total_interest;
    $yearly_amortization_obj->yearly_extrayearlypayment = $yearly_extrayearlypayment[$key];
    $yearly_amortization_obj->yearly_pmi_taxs_insurance_hoa = $yearly_pmi_taxs_insurance_hoa[$key];
    $yearly_amortization_obj->yearly_balance = $yearly_balance[$key];
    array_push($yearly_amortization_schedule,$yearly_amortization_obj);
}

// Loan Extra payments summary
$extrapayment_payoffdate = date('M Y',$f);
$extrapayment_total_interest_paid = $total_interest;
$extrapayment_total_paid = $total_paid_with_extra_payment + $downpayment;
$extrapayment_months = $extra_payment_months;
$extrapayment_monthly_payment = $monthly_payment_with_additionalMonthly_backup;

$extrapayment_total_pmi_paid = $monthly_pmi * $extra_payment_pmimonths;
$extrapayment_total_propertytaxs_paid = $monthly_propertytaxs * $extra_payment_months;
$extrapayment_total_homeinsurance_paid = $monthly_homeinsurance * $extra_payment_months;
$extrapayment_total_hoadues_paid = $hoadues * $extra_payment_months;

$extrapaymentObj = new StdClass();
$extrapaymentObj->yearly_amortization_schedule = $yearly_amortization_schedule;
$extrapaymentObj->amortization_schedule = $amortization_schedule;

$extrapaymentObj->extrapayment_monthly_payment = $extrapayment_monthly_payment;
$extrapaymentObj->extrapayment_months = $extra_payment_months;
$extrapaymentObj->totalAmountExtraPayment = $totalAmountExtraPayment;
$extrapaymentObj->extrapayment_total_paid = $extrapayment_total_paid;
$extrapaymentObj->extrapayment_total_interest_paid = $extrapayment_total_interest_paid;
$extrapaymentObj->extrapayment_payoffdate = $extrapayment_payoffdate;

$extrapaymentObj->monthly_payment = $monthly_payment_backup;
$extrapaymentObj->months = $months;
$extrapaymentObj->total_paid = $total_paid;
$extrapaymentObj->total_interest_paid = $total_interest_paid;
$extrapaymentObj->total_principal_paid = $total_principal_paid;
$extrapaymentObj->payoffdate = $payoffdate;

$extrapaymentObj->total_principal_paid_percent = $total_principal_paid_percent;
$extrapaymentObj->total_interest_paid_percent = $total_interest_paid_percent;

$extrapaymentObj->yearly_date = $yearly_date;
$extrapaymentObj->yearly_payment = $yearly_payment;
$extrapaymentObj->yearly_principal = $yearly_principal;
$extrapaymentObj->yearly_interest = $yearly_interest;
$extrapaymentObj->yearly_balance = $yearly_balance;

$extrapaymentObj->monthly_principal_interest = $monthly_principal_interest;
$extrapaymentObj->total_pmi_taxs_insurance_hoa_paid = $total_pmi_taxs_insurance_hoa_paid;
$extrapaymentObj->total_pmi_taxs_insurance_hoa_paid2 = $total_pmi_taxs_insurance_hoa_paid2;
$extrapaymentObj->extrapayment_total_pmi_taxs_insurance_hoa_paid = $extrapayment_total_pmi_taxs_insurance_hoa_paid;

$extrapaymentObj->pmimonths = $pmimonths;
$extrapaymentObj->pmi_ofday = $pmi_ofday;
$extrapaymentObj->total_pmi_paid = $total_pmi_paid;
$extrapaymentObj->total_propertytaxs_paid = $total_propertytaxs_paid;
$extrapaymentObj->total_homeinsurance_paid = $total_homeinsurance_paid;
$extrapaymentObj->total_hoadues_paid = $total_hoadues_paid;

$extrapaymentObj->extra_payment_pmimonths = $extra_payment_pmimonths;
$extrapaymentObj->extra_payment_pmi_ofday = $extra_payment_pmi_ofday;
$extrapaymentObj->extrapayment_total_pmi_paid = $extrapayment_total_pmi_paid;
$extrapaymentObj->extrapayment_total_propertytaxs_paid = $extrapayment_total_propertytaxs_paid;
$extrapaymentObj->extrapayment_total_homeinsurance_paid = $extrapayment_total_homeinsurance_paid;
$extrapaymentObj->extrapayment_total_hoadues_paid = $extrapayment_total_hoadues_paid;

$extrapaymentObj->monthly_pmi_taxs_insurance_hoa = $monthly_pmi_taxs_insurance_hoa_backup;
$extrapaymentObj->oneTimePaymentList_right = $oneTimePaymentList_right;
$extrapaymentObj->amountOneTimePaymentList_right = $amountOneTimePaymentList_right;
$extrapaymentObj->dateOneTimePaymentList_right = $dateOneTimePaymentList_right;

$extrapaymentObj->enddate_amountAdditionalMonthly = $enddate_amountAdditionalMonthly;
$extrapaymentObj->enddate_amountAdditionalYearly = $enddate_amountAdditionalYearly;
$extrapaymentObj->amountAdditionalMonthly_count = $amountAdditionalMonthly_count;
$extrapaymentObj->amountAdditionalYearly_count = $amountAdditionalYearly_count;

$extrapaymentObj->oneTimePaymentList_increase_id = $oneTimePaymentList_increase_id;
// echo "<pre>";
// print_r($extrapaymentObj);
// echo "</pre>";

$json = json_encode($extrapaymentObj);

echo $json;

// echo "\n\n\n\n\n";
// // echo $total_pmi_paid;
// echo "\n\n\n\n\n";
// echo $total_principal_plus;
// echo "\n\n\n\n\n";
// echo $total_principal_plus_percent;
// echo "\n\n\n\n\n";
// echo $total_principal_extra_payment_plus;
// echo "\n\n\n\n\n";
// echo $total_principal_extra_payment_plus_percent;
// echo "\n\n\n\n\n";
// echo $extra_payment_pmimonths . " -- " . $pmimonths;