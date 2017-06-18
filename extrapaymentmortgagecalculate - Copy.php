<?php
// http://www.loancalculator.pw/extrapaymentcalculate.php?loanamount=100000&loanterminmonths=36&interestrateperyear=6&loanstartdate=Nov%202018&amountAdditionalMonthly=100&amountAdditionalYearly=20&dateAdditionalYearly=May
// http://localhost/loancalculator2/extrapaymentcalculate.php?
// loanamount=100000&loanterminmonths=36&interestrateperyear=6&loanstartdate=Sep%202016&
// amountAdditionalMonthly=10&amountAdditionalYearly=20&dateAdditionalYearly=Jun&
// oneTimePaymentList[]=onetimepayment-1&oneTimePaymentList[]=onetimepayment-2&oneTimePaymentList[]=onetimepayment-3&
// amountOneTimePaymentList[]=30&amountOneTimePaymentList[]=40&amountOneTimePaymentList[]=50&
// dateOneTimePaymentList[]=Oct%202016&dateOneTimePaymentList[]=May%202017&dateOneTimePaymentList[]=Aug%202018


error_reporting(0);

$homevalue = preg_replace("/,/","",(isset($_GET['homevalue']) ? $_GET['homevalue'] : 0));
$downpaymentpercent = isset($_GET['downpaymentpercent']) ? $_GET['downpaymentpercent'] : 0;
$downpayment = ($downpaymentpercent/100)*$homevalue;
// $balance = $loanamount = $homevalue - $downpayment;
$balance = $loanamount = preg_replace("/,/","",(isset($_GET['loanamount']) ? $_GET['loanamount'] : 0));
$interestrateperyear = isset($_GET['interestrateperyear']) ? $_GET['interestrateperyear'] : 0;
$rate = $interestrateperyear/ (12 * 100);
$months = isset($_GET['loanterminmonths']) ? $_GET['loanterminmonths'] : 0;

$pmipercent = isset($_GET['pmipercent']) ? $_GET['pmipercent'] : 0;
$pmi =  ($pmipercent/100)*$loanamount;
$monthly_pmi = $pmi/12;
$pmimonths = isset($_GET['pmimonths']) ? $_GET['pmimonths'] : 0;
$pmimonths = ($pmimonths < $months) ? $pmimonths : $months;
$total_pmi_paid = $monthly_pmi * $pmimonths;

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

$monthly_pmi_taxs_insurance_hoa = $monthly_pmi_taxs_insurance_hoa_backup = $monthly_pmi + $monthly_propertytaxs + $monthly_homeinsurance + $hoadues;
$monthly_principal_interest = ($rate + ( $rate / (pow(1 + $rate, $months) - 1))) * $balance;
// $monthly_payment_backup = $monthly_payment = $monthly_pmi_taxs_insurance_hoa + $monthly_principal_interest;

$loanstartdate = isset($_GET['loanstartdate']) ? $_GET['loanstartdate'] : "";


$total_principal_interest_paid = $monthly_principal_interest * $months;
$total_principal_paid = $balance;
$total_interest_paid = $total_principal_interest_paid - $total_principal_paid;
// $total_principal_paid_percent = ($total_principal_paid/$total_paid)*100;
// $total_interest_paid_percent = ($total_interest_paid/$total_paid)*100;
$total_pmi_taxs_insurance_hoa_paid2 = 0;
$total_pmi_taxs_insurance_hoa_paid = $total_pmi_paid + $total_propertytaxs_paid + $total_homeinsurance_paid + $total_hoadues_paid;
$extrapayment_total_pmi_taxs_insurance_hoa_paid = 0;
// $total_paid = 0;
// $total_paid = $monthly_payment * $months;
// $total_paid = $total_pmi_taxs_insurance_hoa_paid + $total_principal_interest_paid;
$total_paid = $total_pmi_taxs_insurance_hoa_paid + $total_principal_interest_paid + $downpayment;

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

$monthly_payment_backup = $monthly_payment = $monthly_pmi_taxs_insurance_hoa + $monthly_principal_interest;
$monthly_payment_with_additionalMonthly_backup = $monthly_payment_with_additionalMonthly = $monthly_pmi_taxs_insurance_hoa + $monthly_principal_interest + $amountAdditionalMonthly;

$oneTimePaymentList = isset($_GET['oneTimePaymentList']) ? $_GET['oneTimePaymentList'] : [];
$_amountOneTimePaymentList = isset($_GET['amountOneTimePaymentList']) ? $_GET['amountOneTimePaymentList'] : [];
$_dateOneTimePaymentList = isset($_GET['dateOneTimePaymentList']) ? $_GET['dateOneTimePaymentList'] : [];
$amountOneTimePaymentList = [];
$dateOneTimePaymentList = [];

$dateAmountOneTimePaymentList = [];

// var_dump($oneTimePaymentList);exit();
// set key and value for amountOneTimePaymentList and dateOneTimePaymentList
foreach ($oneTimePaymentList as $key => $value){
  $amountOneTimePaymentList[$value] = $_amountOneTimePaymentList[$key];
  $dateOneTimePaymentList[$value] = $_dateOneTimePaymentList[$key];

  // create $date with value to add to $monthly_payment1
  $dateAmountOneTimePaymentList[$_dateOneTimePaymentList[$key]] = isset($dateAmountOneTimePaymentList[$_dateOneTimePaymentList[$key]]) ? $dateAmountOneTimePaymentList[$_dateOneTimePaymentList[$key]] : 0;
  $dateAmountOneTimePaymentList[$_dateOneTimePaymentList[$key]] += $_amountOneTimePaymentList[$key];
}

$oneTimePaymentList_right = [];
$amountOneTimePaymentList_right = [];
$dateOneTimePaymentList_right = [];

/*echo "<pre>";
echo "<br />";
echo "balance: ";
print_r($balance);
echo "<br />";
echo "rate: ";
print_r($rate);
echo "<br />";
echo "monthly_payment: ";
print_r($monthly_payment);
echo "<br />";
echo "loanstartdate: ";
print_r($loanstartdate);
echo "<br />";
echo "amountAdditionalMonthly: ";
print_r($amountAdditionalMonthly);
echo "<br />";
echo "amountAdditionalYearly: ";
print_r($amountAdditionalYearly);
echo "<br />";
echo "dateAdditionalYearly: ";
print_r($dateAdditionalYearly);
echo "<br />";
echo "oneTimePaymentList: ";
echo "<br />";
print_r($oneTimePaymentList);
echo "<br />";
echo "amountOneTimePaymentList: ";
echo "<br />";
print_r($amountOneTimePaymentList);
echo "<br />";
echo "dateOneTimePaymentList: ";
echo "<br />";
print_r($dateOneTimePaymentList);
echo "</pre>";

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
echo "<br />";
*/

// temp balance
$temp_balance = 0;

$balance1 = $balance*100;
$monthly_payment1 = floor(($monthly_principal_interest + $amountAdditionalMonthly)*100);

/*echo "<pre>";
echo "<br />";
echo "balance1: ";
print_r($balance1);
echo "<br />";
echo "monthly_payment1: ";
print_r($monthly_payment1);
echo "<br />";
echo "</pre>";*/

// Loan Extra Payments Summary
$total_paid_with_extra_payment = 0;
$extra_payment_months = 0;

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
$f = strtotime("+".($months - 1)." months", $f);
$payoffdate = date('M Y',$f);
// $f = strtotime("-".($months - 1)." months", $f);
$f = strtotime($loanstartdate);
// PMI only apply in first 66 months.
// $pmi_ofday = strtotime("+65 months", $f);
$pmi_ofday = strtotime("+".($pmimonths - 1)." months", $f); 
$pmi_ofday = date('M Y',$pmi_ofday);

$total_interest = 0;

$amortization_schedule = array();
$yearly_amortization_schedule = array();
$i = 0;
// echo $monthly_payment1;
// echo "<br>";
// echo $balance1;
// echo "<br>------------<br>";
while($balance1 >= $monthly_payment1){

  $amortization_obj = new StdClass();
  $amortization_obj->payment_date = date('M Y',$f);
  $amortization_obj->interest_part = $balance * $rate;
  $amortization_obj->monthly_payment = $monthly_payment_with_additionalMonthly;
  $amortization_obj->extramonthlypayment = $amountAdditionalMonthly;
  // $amortization_obj->monthly_payment += $amountAdditionalMonthly;
  // total amount extra payment
  $totalAmountExtraPayment += $amountAdditionalMonthly;

  if ( date('M',$f) == $dateAdditionalYearly ) {
    // if ($amortization_obj->monthly_payment >= $balance) {
    //   // don't use extra payment of this yearly

    // }

    $amortization_obj->monthly_payment += $amountAdditionalYearly;
    // total amount extra payment
    $totalAmountExtraPayment += $amountAdditionalYearly;
  };

  // if ($balance > ($monthly_principal_interest + $amountAdditionalMonthly)) {
  //   $amortization_obj->extramonthlypayment += $amountAdditionalMonthly;
  // }




  /*echo "<pre>";
  echo "<br />";
  echo "amortization_obj: ";
  print_r($amortization_obj);
  echo "<br />";
  echo "</pre>";
  exit();*/

  $amount_one_time_payment = 0;
  foreach ($oneTimePaymentList as $key => $value){
    if ($dateOneTimePaymentList[$value] == $amortization_obj->payment_date) {
      // amount one time payment
      $amount_one_time_payment = isset($amountOneTimePaymentList[$value]) ? $amountOneTimePaymentList[$value] : 0;

      // if ($amortization_obj->monthly_payment == $balance) {
      //   // don't use extra payment of this month
      //   unset($oneTimePaymentList[$key]);
      //   unset($dateOneTimePaymentList[$value]);
      //   unset($amountOneTimePaymentList[$value]);
      // }
      
      // if (($amount_one_time_payment + $amortization_obj->monthly_payment) <= $balance) {
      //   $amortization_obj->monthly_payment += $amount_one_time_payment;
      //   $totalAmountExtraPayment +=   $amount_one_time_payment;
      // }elseif ($amortization_obj->monthly_payment == $balance) {
      //   // don't use extra payment of this month
      //   unset($oneTimePaymentList[$key]);
      //   unset($dateOneTimePaymentList[$value]);
      //   unset($amountOneTimePaymentList[$value]);
      // }

      $amortization_obj->monthly_payment += $amount_one_time_payment;
      // total amount extra payment
      $totalAmountExtraPayment +=   $amount_one_time_payment;

      // array_push($oneTimePaymentList_right,$value);
      // $amountOneTimePaymentList_right[$value] = $amount_one_time_payment;
      // $dateOneTimePaymentList_right[$value] = $dateOneTimePaymentList[$value];


/*      echo "<pre>";
      echo "<br />";
      echo "Extra Payment check matched datetime:";
      echo "<br />";
      echo "dateOneTimePaymentList[".$value."]: ".$dateOneTimePaymentList[$value];
      echo "<br />";
      echo "amortization_obj->payment_date: ".$amortization_obj->payment_date;
      echo "<br />";
      echo "amortization_obj->monthly_payment: ".$amortization_obj->monthly_payment;
      echo "<br />";
      echo "</pre>";*/
    };
  }

  $amortization_obj->principal_part = $amortization_obj->monthly_payment - $amortization_obj->interest_part - $monthly_pmi_taxs_insurance_hoa;
  $amortization_obj->pmi_taxs_insurance_hoa = $monthly_pmi_taxs_insurance_hoa;

  $total_interest += $amortization_obj->interest_part;
  // $amortization_obj->total_interest = $total_interest;
  
  $temp_balance = $balance - $amortization_obj->principal_part;
  $amortization_obj->balance = ($temp_balance < 0) ? 0 : $temp_balance;
  // amortization_obj.balance = balance - amortization_obj.principal_part;
  
  $balance = $amortization_obj->balance;
  array_push($amortization_schedule,$amortization_obj);
  
  // $balance1 = floor(($balance + $balance*$rate)*100);
  $balance1 = floor($balance*100);
  // echo "<br>";
  // echo $balance1;
  // echo "<br>";

  // Loan Extra Payments Summary
  $total_paid_with_extra_payment += $amortization_obj->monthly_payment;
  $extra_payment_months++;

  $total_pmi_taxs_insurance_hoa_paid2 += $monthly_pmi_taxs_insurance_hoa;
  $extrapayment_total_pmi_taxs_insurance_hoa_paid += $monthly_pmi_taxs_insurance_hoa;
  
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

  $yearly_pmi_taxs_insurance_hoa[$y] = isset($yearly_pmi_taxs_insurance_hoa[$y]) ? $yearly_pmi_taxs_insurance_hoa[$y] : 0;
  $yearly_pmi_taxs_insurance_hoa[$y] += $amortization_obj->pmi_taxs_insurance_hoa;
  
  $yearly_balance[$y] = $balance;

  if ($pmi_ofday == date('M Y',$f)) {
    $monthly_pmi_taxs_insurance_hoa = $monthly_pmi_taxs_insurance_hoa - $monthly_pmi;
    $monthly_payment_with_additionalMonthly = $monthly_pmi_taxs_insurance_hoa + $monthly_principal_interest + $amountAdditionalMonthly;
  };
  
  /* additional one month */
  $f = strtotime("+1 months", $f);


  // $monthly_payment1 = $monthly_principal_interest + $amountAdditionalMonthly + $dateAmountOneTimePaymentList[date('M Y',$f)];
  // if(date('M',$f) == $dateAdditionalYearly){
  //   $monthly_payment1 += $amountAdditionalYearly;
  // }
  // echo "<br>";
  // echo date('M Y',$f);
  // echo ": ";
  // echo $monthly_payment1;
};
// exit;
// check One time payment list element, only get right elements, means paid in right date.
$startdatetime = strtotime($loanstartdate);
$enddatetime = $f;
foreach ($oneTimePaymentList as $key => $value){
  $amount_one_time_payment = isset($amountOneTimePaymentList[$value]) ? $amountOneTimePaymentList[$value] : 0;
  $temp_dateOneTimePayment = strtotime($dateOneTimePaymentList[$value]);
  if (($temp_dateOneTimePayment >= $startdatetime) && ($temp_dateOneTimePayment < $enddatetime)) {
    array_push($oneTimePaymentList_right,$value);
    $amountOneTimePaymentList_right[$value] = $amount_one_time_payment;
    $dateOneTimePaymentList_right[$value] = $dateOneTimePaymentList[$value];
  }
}

// if balance still > 0 and < monthly_payment_no_additional_monthly then still pay PMI, Hoa, Insurance, Taxs, but no need to pay additional_monthly or any extra payments.
if ($balance>0) {
  $amortization_obj = new StdClass();
  
  $amortization_obj->payment_date = date('M Y',$f);
  
  $amortization_obj->interest_part = $balance * $rate;
  $amortization_obj->monthly_payment = $balance + $amortization_obj->interest_part + $monthly_pmi_taxs_insurance_hoa;
  
  $amortization_obj->principal_part = $balance;
  $amortization_obj->pmi_taxs_insurance_hoa = $monthly_pmi_taxs_insurance_hoa;

  $total_interest += $amortization_obj->interest_part;
  // $amortization_obj->total_interest = $total_interest;
  // balance - balance - amortization_obj.principal_part = 0
  // amortization_obj.balance = balance - amortization_obj.principal_part;
  $amortization_obj->balance = 0;
  
  $balance = $amortization_obj->balance;
  array_push($amortization_schedule,$amortization_obj);
  
  // Loan Extra Payments Summary
  $total_paid_with_extra_payment += $amortization_obj->monthly_payment;
  $extra_payment_months++;

  $total_pmi_taxs_insurance_hoa_paid2 += $monthly_pmi_taxs_insurance_hoa;
  $extrapayment_total_pmi_taxs_insurance_hoa_paid += $monthly_pmi_taxs_insurance_hoa;

    /* create yearly array */
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

  var_dump($amortization_obj);exit("heo");
  
  /* additional one month */
  $f = strtotime("+1 months", $f);
};

// $scope.total_interest_paid = total_interest;

/* yearly */
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

// Loan Extra payments summary
/* additional one month */
$f = strtotime("-1 months", $f);
$extrapayment_payoffdate = date('M Y',$f);
$extrapayment_total_interest_paid = $total_interest;
$extrapayment_total_paid = $total_paid_with_extra_payment + $downpayment + $extrapayment_total_pmi_taxs_insurance_hoa_paid;
$extrapayment_months = $extra_payment_months;
$extrapayment_monthly_payment = $monthly_payment_with_additionalMonthly_backup;

/*echo "<br />";
echo "<br />";
echo "extrapayment_payoffdate: ".$extrapayment_payoffdate;
echo "<br />";
echo "extrapayment_total_interest_paid: ".$extrapayment_total_interest_paid;
echo "<br />";
echo "extrapayment_total_paid: ".$extrapayment_total_paid;
echo "<br />";
echo "extrapayment_months: ".$extrapayment_months;
echo "<br />";
echo "extrapayment_monthly_payment: ".$extrapayment_monthly_payment;
echo "<br />";
echo "<br />";*/

/*echo "<pre>";
print_r($yearly_date);
print_r($yearly_amortization_schedule);
print_r($amortization_schedule);
echo "</pre>";*/

$extrapaymentObj = new StdClass();
$extrapaymentObj->yearly_amortization_schedule = $yearly_amortization_schedule;
$extrapaymentObj->amortization_schedule = $amortization_schedule;

// $extrapaymentObj->monthly_payment_with_additionalMonthly = $monthly_payment_with_additionalMonthly_backup;
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

$extrapaymentObj->pmi_ofday = $pmi_ofday;
$extrapaymentObj->monthly_principal_interest = $monthly_principal_interest;
$extrapaymentObj->total_pmi_taxs_insurance_hoa_paid = $total_pmi_taxs_insurance_hoa_paid;
$extrapaymentObj->total_pmi_taxs_insurance_hoa_paid2 = $total_pmi_taxs_insurance_hoa_paid2;
$extrapaymentObj->extrapayment_total_pmi_taxs_insurance_hoa_paid = $extrapayment_total_pmi_taxs_insurance_hoa_paid;

$extrapaymentObj->total_pmi_paid = $total_pmi_paid;
$extrapaymentObj->total_propertytaxs_paid = $total_propertytaxs_paid;
$extrapaymentObj->total_homeinsurance_paid = $total_homeinsurance_paid;
$extrapaymentObj->total_hoadues_paid = $total_hoadues_paid;

$extrapaymentObj->monthly_pmi_taxs_insurance_hoa = $monthly_pmi_taxs_insurance_hoa_backup;
$extrapaymentObj->oneTimePaymentList_right = $oneTimePaymentList_right;
$extrapaymentObj->amountOneTimePaymentList_right = $amountOneTimePaymentList_right;
$extrapaymentObj->dateOneTimePaymentList_right = $dateOneTimePaymentList_right;

// echo "<pre>";
// print_r($extrapaymentObj);
// echo "</pre>";


$json = json_encode($extrapaymentObj);

// echo "<pre>";
//print_r($extrapaymentObj);
echo $json;
// echo "</pre>";