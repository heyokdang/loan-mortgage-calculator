<?php
$homevalue = 350000;
$downpayment = 30000;
$bal = $loanamount = 320000;
$interestrateperyear = 5;
$rate = $interestrateperyear/ (12 * 100);
$months = 36;
$monthly_principal_interest = ($rate + ( $rate / (pow(1 + $rate, $months) - 1))) * $bal;
$loanstartdate = "Jul 2016";
$f = strtotime($loanstartdate);
$bal_total_principal_plus = $downpayment;
$bal_total_principal_plus_percent = ($bal_total_principal_plus/$homevalue)*100;
$bal_pmimonths = 0;
$bal_pmi_ofday = strtotime("+".$bal_pmimonths." months", $f);
$bal_pmi_ofday = date('M Y',$bal_pmi_ofday);
$bal_pmi_total = 0;
while(($bal >= $monthly_principal_interest) && ($bal_total_principal_plus_percent < 20)){

	// $bal_pmimonths++;
	$bal_pmi_ofday = strtotime("+".$bal_pmimonths." months", $f);
	$bal_pmi_ofday = date('M Y',$bal_pmi_ofday);

  	$bal_interest = $bal * $rate;
  	$bal_principal = $monthly_principal_interest - $bal_interest;
  	$bal_total_principal_plus += $bal_principal;
  	$bal_total_principal_plus_percent = ($bal_total_principal_plus/$homevalue)*100;

  	echo "$bal_pmi_ofday - ba $bal - mpi $monthly_principal_interest = interest $bal_interest - principal $bal_principal - percent: $bal_total_principal_plus_percent";
	echo "\n";

	$bal_pmimonths++;

  	$bal -= $bal_principal;

}

$pmipercent = 1;
$pmi =  ($pmipercent/100)*$loanamount;
$bal_pmi_total = $bal_pmimonths * $pmi;
echo "\n";
echo "$bal_pmi_total";
echo "\n";
echo "$pmi";
echo "\n";
echo "$bal_pmimonths";
echo "\n";
echo "$bal_pmi_ofday";