<?php
error_reporting(0);

$homevalue = preg_replace("/,/","",(isset($_GET['homevalue']) ? $_GET['homevalue'] : 0));
$downpaymentpercent = isset($_GET['downpaymentpercent']) ? $_GET['downpaymentpercent'] : 0;
$downpayment = ($downpaymentpercent/100)*$homevalue;
$balance = $loanamount = preg_replace("/,/","",(isset($_GET['loanamount']) ? $_GET['loanamount'] : 0));
$interestrateperyear = isset($_GET['interestrateperyear']) ? $_GET['interestrateperyear'] : 0;
$rate = $interestrateperyear/ (12 * 100);
$months = isset($_GET['loanterminmonths']) ? $_GET['loanterminmonths'] : 0;

$monthly_principal_interest = ($rate + ( $rate / (pow(1 + $rate, $months) - 1))) * $balance;

$loanstartdate = isset($_GET['loanstartdate']) ? $_GET['loanstartdate'] : "";

$total_principal_interest_paid = $monthly_principal_interest * $months;
$total_principal_paid = $balance;
$total_interest_paid = $total_principal_interest_paid - $total_principal_paid;
$total_paid = $total_principal_interest_paid + $downpayment;

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

$monthly_payment_backup = $monthly_payment = $monthly_principal_interest;
$monthly_payment_with_additionalMonthly_backup = $monthly_payment_with_additionalMonthly = $monthly_principal_interest + $amountAdditionalMonthly;

$oneTimePaymentList = isset($_GET['oneTimePaymentList']) ? $_GET['oneTimePaymentList'] : [];
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

$f = strtotime($loanstartdate);
$f = strtotime("+".($months - 1)." months", $f);
$payoffdate = date('M Y',$f);
$f = strtotime($loanstartdate);
// PMI only apply in first 66 months.
// $pmi_ofday = strtotime("+65 months", $f);
// $pmi_ofday = strtotime("+".($pmimonths - 1)." months", $f); 
// $pmi_ofday = date('M Y',$pmi_ofday);

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

while($balance1 >= $monthly_payment1){

  $amortization_obj = new StdClass();
  $amortization_obj->payment_date = date('M Y',$f);
  $amortization_obj->interest_part = $balance * $rate;
  $total_interest += $amortization_obj->interest_part;
  $amortization_obj->principal_part = $monthly_principal_interest - $amortization_obj->interest_part;
  $amortization_obj->monthly_payment = $monthly_payment_with_additionalMonthly;
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
  
  $temp_balance = $balance - $amortization_obj->principal_part - $amortization_obj->extramonthlypayment;
  $amortization_obj->balance = ($temp_balance < 0) ? 0 : $temp_balance;
  $balance = $amortization_obj->balance;
  array_push($amortization_schedule,$amortization_obj);
  
  $balance1 = floor(($balance + $balance*$rate)*100);
  
  // Loan Extra Payments Summary
  $total_paid_with_extra_payment += $amortization_obj->monthly_payment;
  $extra_payment_months++;
  
  /* create year array */
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
  // $amortization_obj->pmi_taxs_insurance_hoa = $monthly_pmi_taxs_insurance_hoa;
  $amortization_obj->payment_date = date('M Y',$f);

  if($balance1 > $monthly_principal_interest1){
    
    $amortization_obj->principal_part = $monthly_principal_interest - $amortization_obj->interest_part;
    $extra_payment = $balance - $amortization_obj->principal_part;
    $amortization_obj->monthly_payment = $monthly_principal_interest + $extra_payment;
    $amortization_obj->extramonthlypayment = $extra_payment;
    // total amount extra payment
    $totalAmountExtraPayment += $extra_payment;

    if (($amountAdditionalMonthly > 0) && ($extra_payment >= $amountAdditionalMonthly)) {
      # code...
      $total_amountAdditionalMonthly += $amountAdditionalMonthly;
      $amountAdditionalMonthly_count++;
      $enddate_amountAdditionalMonthly = date('M Y',$f);
      $extra_payment -= $amountAdditionalMonthly;
    }

    if ((date('M',$f) == $dateAdditionalYearly) && ($amountAdditionalYearly > 0) && ($extra_payment >= $amountAdditionalYearly)) {
      # code...
      $total_amountAdditionalYearly += $amountAdditionalYearly;
      $amountAdditionalYearly_count++;
      $enddate_amountAdditionalYearly = date('M Y',$f);
      $extra_payment -= $amountAdditionalYearly;
    }

    // if 2 cases above right and now $extra_payment > 0 then onetimeextrapayment is exist or is not exist, if ontimeextrapayment is not exist is because amountAdditionalMonthly is so big or amountAdditionalYearly is so big.
    // if 2 cases above wrong and now $extra_payment > 0 then onetimeextrapayment is exist
    if ($extra_payment > 0) {
      if (!isset($AmountdateOneTimePaymentList[date('M Y',$f)])) {
        # code...
        $AmountdateOneTimePaymentList_track[date('M Y',$f)] = "onetimepayment-".$oneTimePaymentList_increase_id;
        $dateOneTimePaymentList[$AmountdateOneTimePaymentList_track[date('M Y',$f)]] = date('M Y',$f);
        $oneTimePaymentList_increase_id++;
      }

      $AmountdateOneTimePaymentList[date('M Y',$f)] = $extra_payment;
      $amountOneTimePaymentList[$AmountdateOneTimePaymentList_track[date('M Y',$f)]] = $extra_payment;
      $total_amountOneTimePaymentList += $AmountdateOneTimePaymentList[date('M Y',$f)];
      $extra_payment = 0;

    }
  }else{
    // if($balance1 <= $monthly_principal_interest)
    $amortization_obj->principal_part = $balance;
    $amortization_obj->monthly_payment = $amortization_obj->interest_part + $amortization_obj->principal_part;
    $amortization_obj->extramonthlypayment = 0;
  }
  
  // Loan Extra Payments Summary
  $total_paid_with_extra_payment += $amortization_obj->monthly_payment;
  
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
  
  $yearly_balance[$y] = $balance;
  
  /* additional one month */
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
    $yearly_amortization_obj->yearly_balance = $yearly_balance[$key];
    array_push($yearly_amortization_schedule,$yearly_amortization_obj);
}

// Loan Extra payments summary
/* additional one month */
$extrapayment_payoffdate = date('M Y',$f);
$extrapayment_total_interest_paid = $total_interest;
$extrapayment_total_paid = $total_paid_with_extra_payment + $downpayment;
$extrapayment_months = $extra_payment_months;
$extrapayment_monthly_payment = $monthly_payment_with_additionalMonthly_backup;

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

$extrapaymentObj->oneTimePaymentList_right = $oneTimePaymentList_right;
$extrapaymentObj->amountOneTimePaymentList_right = $amountOneTimePaymentList_right;
$extrapaymentObj->dateOneTimePaymentList_right = $dateOneTimePaymentList_right;

$extrapaymentObj->enddate_amountAdditionalMonthly = $enddate_amountAdditionalMonthly;
$extrapaymentObj->enddate_amountAdditionalYearly = $enddate_amountAdditionalYearly;
$extrapaymentObj->amountAdditionalMonthly_count = $amountAdditionalMonthly_count;
$extrapaymentObj->amountAdditionalYearly_count = $amountAdditionalYearly_count;

$extrapaymentObj->oneTimePaymentList_increase_id = $oneTimePaymentList_increase_id;

$json = json_encode($extrapaymentObj);

echo $json;