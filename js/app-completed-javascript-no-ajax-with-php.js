// indexOf function for ie 8
if (!Array.prototype.indexOf)
{
  Array.prototype.indexOf = function(elt /*, from*/)
  {
    var len = this.length >>> 0;

    var from = Number(arguments[1]) || 0;
    from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
    if (from < 0)
      from += len;

    for (; from < len; from++)
    {
      if (from in this &&
          this[from] === elt)
        return from;
    }
    return -1;
  };
}

var app = angular.module("LoanCalculatorApp", ['googlechart','ngMaterial', 'ngMessages', 'ng-bs3-datepicker']);
  
app.controller("LoanCalculatorCtr", ['$scope','$filter','$timeout','$location', function($scope,$filter,$timeout,$location){
  
  $scope.amortization_schedule = [];
  $scope.yearly_amortization_schedule = [];

  // Output params
  // $scope.monthlyvsbiweekly = false;
  $scope.drawcharts = true;
  $scope.monthlyamortizationtable = true;
  $scope.annualamortizationtable = true;
  
  //Extra payments
  $scope.amountAdditionalMonthly = 0;
  $scope.amountAdditionalYearly = 0;
  // $scope.dateAdditionalYearly = "select a time";
  $scope.dateAdditionalYearly = "";
  $scope.id = 0;
  $scope.amountOneTimePaymentList =[];
  $scope.dateOneTimePaymentList = [];
  $scope.oneTimePaymentList = [];
  $scope.totalAmountExtraPayment = 0;

  $scope.pageIsLoading = false;
  $scope.amortization_schedule_show = false;
  $scope.extra_payments_information_show = false;
  $scope.loan_extra_payment_summary_show = false;
  $scope.add_extra_payments_form_show = false;
  $scope.output_parameters_show = false;

  //secure code, only run on a cd = current domain
  // online mode, public mode
  // $scope.cd = $location.host();
  // dev mode
  $scope.cd = "loancalculator.pw";
  var p = "lo", r = "an", i = "ca", v = "lc", a = "ul", t = "at", e = "or", d = ".", o = "p", m = "w", n = "";
  $scope.pd = p + r + i + v + a + t + e + d + o + m + n;

  $scope.showOutputParameters = function(){
    if ($scope.output_parameters_show) {
      $scope.output_parameters_show = false;
    }else{
      $scope.output_parameters_show = true;
    }
  };

  $scope.addExtraPaymentForm = function(){
    if ($scope.add_extra_payments_form_show) {
      $scope.add_extra_payments_form_show = false;
    }else{
      $scope.add_extra_payments_form_show = true;
    }
  };
  
  $scope.showAmortizationSchedule = function(){
    if ($scope.amortization_schedule_show) {
      $scope.amortization_schedule_show = false;
    }else{
      $scope.amortization_schedule_show = true;
    }
  };
  
  $scope.copareDate = function(da){
    var da1 = new Date("1 " + da);
    var da2 = new Date("1 " + $scope.loanstartdate);
    var da3 = new Date("1 " + $scope.payoffdate);
    // alert(da1.toString() + " ---- " + da2);
    return ((da1 >= da2) && (da1 < da3));
  };

  $scope.urlDrawcharts = function(){
    $location.search("drawcharts",$scope.drawcharts ? 1 : 0);
  };

  $scope.urlAnnual = function(){
    $location.search("annualamortizationtable",$scope.annualamortizationtable ? 1 : 0);
  };

  $scope.urlMonthly = function(){
    $location.search("monthlyamortizationtable",$scope.monthlyamortizationtable ? 1 : 0);
  };
  
  $scope.applyExtraPayments = function(){
    
    try {
          $scope.pageIsLoading = true;
          $scope.amortization_schedule_show = false;
          $scope.extra_payments_information_show = false;
          $scope.loan_extra_payment_summary_show = false;
          $scope.output_parameters_show = false;
          $scope.totalAmountExtraPayment = 0;
  
          // loan calculator formular
          var balance = $scope.loanamount ? Number($scope.loanamount.replace(/,/g, "")) : 0;
          var rate = $scope.interestrateperyear / (12 * 100);
          var months = $scope.loanterminmonths;
          var monthly_payment = (rate + ( rate / (Math.pow(1 + rate, months) - 1))) * balance;

          var total_paid = monthly_payment * months;
          var total_principal_paid = balance;
          var total_interest_paid = total_paid - total_principal_paid;
          var total_principal_paid_percent = (total_principal_paid/total_paid)*100;
          var total_interest_paid_percent = (total_interest_paid/total_paid)*100;

          // amount additinal monthly
          var amount_additional_monthly = ($scope.amountAdditionalMonthly ? Number($scope.amountAdditionalMonthly.replace(/,/g, "")) : 0);
          // amount additional yearly
          var amount_additional_yearly = ($scope.amountAdditionalYearly ? Number($scope.amountAdditionalYearly.replace(/,/g, "")) : 0);
          // amount one time payment
          var amount_one_time_payment = 0;

          // temp balance
          var temp_balance = 0;

          $timeout(function () {
            // create url params object to share url
            var paramsObj = new Object();
            paramsObj.loanamount = $scope.loanamount ? Number($scope.loanamount.replace(/,/g, "")) : 0;
            // paramsObj.loanterminyears = $scope.loanterminyears;
            paramsObj.loanterminmonths = $scope.loanterminmonths;
            paramsObj.interestrateperyear = $scope.interestrateperyear;
            paramsObj.loanstartdate = $scope.loanstartdate;
            paramsObj.drawcharts = $scope.drawcharts ? 1 : 0;
            paramsObj.annualamortizationtable = $scope.annualamortizationtable ? 1 : 0;
            paramsObj.monthlyamortizationtable = $scope.monthlyamortizationtable ? 1 : 0;
            paramsObj.calcfunc = "applyExtraPayments";
            paramsObj.amountAdditionalMonthly = amount_additional_monthly;
            paramsObj.amountAdditionalYearly = amount_additional_yearly;
            paramsObj.dateAdditionalYearly = $scope.dateAdditionalYearly;
            paramsObj.oneTimePaymentList = $scope.oneTimePaymentList;
            paramsObj.amountOneTimePaymentList = [];
            paramsObj.dateOneTimePaymentList = [];
            angular.forEach($scope.oneTimePaymentList, function(value, key) {
              paramsObj.amountOneTimePaymentList.push($scope.amountOneTimePaymentList[value]);
              paramsObj.dateOneTimePaymentList.push($scope.dateOneTimePaymentList[value]);
            });
            $location.search(paramsObj);
          });
  
          var f = new Date("1 " + $scope.loanstartdate);
          // Loan Payment Summary
          f.setMonth(f.getMonth() + (months - 1));
          // check right domain
          if ($scope.pd != $scope.cd) {return;};
          $scope.payoffdate = $filter('date')(f, 'MMM yyyy', 0);
          f.setMonth(f.getMonth() - (months - 1));
          $scope.total_interest_paid = total_interest_paid;
          $scope.total_paid = total_paid;
          $scope.months = months;
          $scope.monthly_payment = monthly_payment;
          $scope.amortization_schedule = [];
          $scope.yearly_amortization_schedule = [];
          var total_interest = 0;

          var balance1 = balance*100;
          var monthly_payment1 = Math.floor(monthly_payment*100);

          // Loan Extra Payments Summary
          total_paid = 0;
          months = 0;

          // yearly
          var y;
          var yearly_date = [];
          var yearly_payment = [];
          var yearly_principal = [];
          var yearly_interest = [];
          var yearly_total_interest = 0;
          var yearly_balance = [];

          $timeout(function () {
          
            while(balance1 >= monthly_payment1){
    
              var amortization_obj = new Object();
              amortization_obj.payment_date = $filter('date')(f, 'MMM yyyy', 0);
              amortization_obj.interest_part = balance * rate;
              amortization_obj.monthly_payment = monthly_payment + amount_additional_monthly;
              // total amount extra payment
              $scope.totalAmountExtraPayment += amount_additional_monthly;

              if ( $filter('date')(f, 'MMM', 0) == $scope.dateAdditionalYearly ) {
                amortization_obj.monthly_payment += amount_additional_yearly;
                // total amount extra payment
                $scope.totalAmountExtraPayment +=   amount_additional_yearly;
              };
    
              angular.forEach($scope.oneTimePaymentList, function(value, key) {
                if ($scope.dateOneTimePaymentList[value] == amortization_obj.payment_date) {
                  // amount one time payment
                  amount_one_time_payment = ($scope.amountOneTimePaymentList[value] ? Number($scope.amountOneTimePaymentList[value].replace(/,/g, "")) : 0);
                  amortization_obj.monthly_payment += amount_one_time_payment;
                  // total amount extra payment
                  $scope.totalAmountExtraPayment +=   amount_one_time_payment;
                };
              });
    
              amortization_obj.principal_part = amortization_obj.monthly_payment - amortization_obj.interest_part;
              total_interest += amortization_obj.interest_part;
              amortization_obj.total_interest = total_interest;
              
              temp_balance = balance - amortization_obj.principal_part;
              amortization_obj.balance = (temp_balance < 0) ? 0 : temp_balance;
              // amortization_obj.balance = balance - amortization_obj.principal_part;
              
              balance = amortization_obj.balance;
              $scope.amortization_schedule.push(amortization_obj);
              
              balance1 = Math.floor((balance + balance*rate)*100);
              
              // Loan Extra Payments Summary
              total_paid += amortization_obj.monthly_payment;
              months ++;

              /* create year array */
              y = $filter('date')(f, 'yyyy', 0);
              
              yearly_date[y] = y;
              
              yearly_payment[y] = yearly_payment[y] ? yearly_payment[y] : 0;
              yearly_payment[y] += amortization_obj.monthly_payment;

              yearly_principal[y] = yearly_principal[y] ? yearly_principal[y] : 0;
              yearly_principal[y] += amortization_obj.principal_part;

              yearly_interest[y] = yearly_interest[y] ? yearly_interest[y] : 0;
              yearly_interest[y] += amortization_obj.interest_part; 

              yearly_balance[y] = balance;

              /* additional one month */
              f.setMonth(f.getMonth() + 1);
            };
  
            if (balance>0) {
              var amortization_obj = new Object();
              
              amortization_obj.payment_date = $filter('date')(f, 'MMM yyyy', 0);
              
              amortization_obj.interest_part = balance * rate;
              amortization_obj.monthly_payment = balance + amortization_obj.interest_part;
              
              amortization_obj.principal_part = balance;
              total_interest += amortization_obj.interest_part;
              amortization_obj.total_interest = total_interest;
              // balance - balance - amortization_obj.principal_part = 0
              // amortization_obj.balance = balance - amortization_obj.principal_part;
              amortization_obj.balance = 0;
              
              balance = amortization_obj.balance;
              $scope.amortization_schedule.push(amortization_obj);
              
              // Loan Extra Payments Summary
              total_paid += amortization_obj.monthly_payment;
              months ++;
              
              /* create yearly array */
              y = $filter('date')(f, 'yyyy', 0);
              
              yearly_date[y] = y;
              
              yearly_payment[y] = yearly_payment[y] ? yearly_payment[y] : 0;
              yearly_payment[y] += amortization_obj.monthly_payment;

              yearly_principal[y] = yearly_principal[y] ? yearly_principal[y] : 0;
              yearly_principal[y] += amortization_obj.principal_part;

              yearly_interest[y] = yearly_interest[y] ? yearly_interest[y] : 0;
              yearly_interest[y] += amortization_obj.interest_part; 

              yearly_balance[y] = balance;

              /* additional one month */
              f.setMonth(f.getMonth() + 1);
            };

            // $scope.total_interest_paid = total_interest;

            /* yearly */
            angular.forEach(yearly_date, function(value, key) {
              yearly_total_interest += yearly_interest[key];
              var yearly_amortization_obj = new Object();
              yearly_amortization_obj.yearly_date = key;
              yearly_amortization_obj.yearly_payment = yearly_payment[key];
              yearly_amortization_obj.yearly_interest = yearly_interest[key];
              yearly_amortization_obj.yearly_principal = yearly_principal[key];
              yearly_amortization_obj.yearly_total_interest = yearly_total_interest;
              yearly_amortization_obj.yearly_balance = yearly_balance[key];
              $scope.yearly_amortization_schedule.push(yearly_amortization_obj);
            });

            // Loan Extra payments summary
            /* additional one month */
            f.setMonth(f.getMonth() - 1);
            $scope.extrapayment_payoffdate = $filter('date')(f, 'MMM yyyy', 0);
            $scope.extrapayment_total_interest_paid = total_interest;
            $scope.extrapayment_total_paid = total_paid;
            $scope.extrapayment_months = months;
            $scope.extrapayment_monthly_payment =  monthly_payment + ($scope.amountAdditionalMonthly ? Number($scope.amountAdditionalMonthly) : 0);

            $scope.loanchart();

            $scope.pageIsLoading = false;
            $scope.amortization_schedule_show = true;
            $scope.extra_payments_information_show = true;
            $scope.loan_extra_payment_summary_show = true;
            $scope.add_extra_payments_form_show = false;

            $scope.lineYearlyAmortizationChart(yearly_date, yearly_payment, yearly_principal, yearly_interest);
            $scope.lineYearlyBalanceChart(yearly_date, yearly_balance);

            $scope.lineMonthlyAmortizationChart();
            $scope.lineMonthlyBalanceChart();
          });
        } catch (e) {
          // console.log("Got an error!",e);
          // throw e; // rethrow to not marked as handled
          alert('applyExtraPayments function has error........');
        }
  };

	$scope.calculate = function(){
    try {
          $scope.pageIsLoading = true;
          $scope.amortization_schedule_show = false;
          $scope.extra_payments_information_show = false;
          $scope.loan_extra_payment_summary_show = false;
          $scope.add_extra_payments_form_show = false;
          $scope.output_parameters_show = false;

          // loan calculator formular
          var balance = $scope.loanamount ? Number($scope.loanamount.replace(/,/g, "")) : 0;
          var rate = $scope.interestrateperyear / (12 * 100);
          var months = $scope.loanterminmonths;
          var monthly_payment = (rate + ( rate / (Math.pow(1 + rate, months) - 1))) * balance;
          // check right domain
          if ($scope.pd != $scope.cd) {return;};
          // 100% = total_principal_paid + total_interest_paid = total_paid
          var total_paid = monthly_payment * months;
          var total_principal_paid = balance;
          var total_interest_paid = total_paid - total_principal_paid;
          var total_principal_paid_percent = (total_principal_paid/total_paid)*100;
          var total_interest_paid_percent = (total_interest_paid/total_paid)*100;

          $timeout(function () {
            // create url params object to share url
            var paramsObj = new Object();
            paramsObj.loanamount = $scope.loanamount ? Number($scope.loanamount.replace(/,/g, "")) : 0;
            // paramsObj.loanterminyears = $scope.loanterminyears;
            paramsObj.loanterminmonths = $scope.loanterminmonths;
            paramsObj.interestrateperyear = $scope.interestrateperyear;
            paramsObj.loanstartdate = $scope.loanstartdate;
            paramsObj.drawcharts = $scope.drawcharts ? 1 : 0;
            paramsObj.annualamortizationtable = $scope.annualamortizationtable ? 1 : 0;
            paramsObj.monthlyamortizationtable = $scope.monthlyamortizationtable ? 1 : 0;
            paramsObj.calcfunc = "calculate";
            paramsObj.amountAdditionalMonthly =  ($scope.amountAdditionalMonthly ? Number($scope.amountAdditionalMonthly.replace(/,/g, "")) : 0);
            paramsObj.amountAdditionalYearly = ($scope.amountAdditionalYearly ? Number($scope.amountAdditionalYearly.replace(/,/g, "")) : 0);
            paramsObj.dateAdditionalYearly = $scope.dateAdditionalYearly;
            paramsObj.oneTimePaymentList = $scope.oneTimePaymentList;
            paramsObj.amountOneTimePaymentList = [];
            paramsObj.dateOneTimePaymentList = [];
            angular.forEach($scope.oneTimePaymentList, function(value, key) {
              paramsObj.amountOneTimePaymentList.push($scope.amountOneTimePaymentList[value]);
              paramsObj.dateOneTimePaymentList.push($scope.dateOneTimePaymentList[value]);
            });
            $location.search(paramsObj);
          });

          var f = new Date("1 " + $scope.loanstartdate);
          f.setMonth(f.getMonth() + (months - 1));
          $scope.payoffdate = $filter('date')(f, 'MMM yyyy', 0);
          f.setMonth(f.getMonth() - (months - 1));
          $scope.total_interest_paid = total_interest_paid;
          $scope.total_paid = total_paid;
          $scope.months = months;
          $scope.monthly_payment = monthly_payment;
          $scope.amortization_schedule = [];
          $scope.yearly_amortization_schedule = [];
          var total_interest = 0;

          var balance1 = balance*100;
          var monthly_payment1 = Math.floor(monthly_payment*100);

          // Yearly Amortization Schedule
          var y;
          var yearly_date = [];
          var yearly_payment = [];
          var yearly_principal = [];
          var yearly_interest = [];
          var yearly_total_interest = 0;
          var yearly_balance = [];

          // temp balance
          var temp_balance = 0;

          $timeout(function () {

            while(balance1 >= monthly_payment1){

              var amortization_obj = new Object();
              amortization_obj.monthly_payment = monthly_payment;
              amortization_obj.interest_part = balance * rate;
              amortization_obj.principal_part = monthly_payment - amortization_obj.interest_part;
              total_interest += amortization_obj.interest_part;
              amortization_obj.total_interest = total_interest;

              temp_balance = balance - amortization_obj.principal_part;
              amortization_obj.balance = (temp_balance < 0) ? 0 : temp_balance;
              // amortization_obj.balance = balance - amortization_obj.principal_part;
              
              amortization_obj.payment_date = $filter('date')(f, 'MMM yyyy', 0);

              balance = amortization_obj.balance;
              $scope.amortization_schedule.push(amortization_obj);

              balance1 = Math.floor((balance + balance*rate)*100);

              /* create year array */
              y = $filter('date')(f, 'yyyy', 0);
              
              yearly_date[y] = y;
              
              yearly_payment[y] = yearly_payment[y] ? yearly_payment[y] : 0;
              yearly_payment[y] += amortization_obj.monthly_payment;

              yearly_principal[y] = yearly_principal[y] ? yearly_principal[y] : 0;
              yearly_principal[y] += amortization_obj.principal_part;

              yearly_interest[y] = yearly_interest[y] ? yearly_interest[y] : 0;
              yearly_interest[y] += amortization_obj.interest_part; 

              yearly_balance[y] = balance;

              /* additional one month */
              f.setMonth(f.getMonth() + 1);
            }
  
            angular.forEach(yearly_date, function(value, key) {
              yearly_total_interest += yearly_interest[key];
              var yearly_amortization_obj = new Object();
              yearly_amortization_obj.yearly_date = key;
              yearly_amortization_obj.yearly_payment = yearly_payment[key];
              yearly_amortization_obj.yearly_interest = yearly_interest[key];
              yearly_amortization_obj.yearly_principal = yearly_principal[key];
              yearly_amortization_obj.yearly_total_interest = yearly_total_interest;
              yearly_amortization_obj.yearly_balance = yearly_balance[key];
              $scope.yearly_amortization_schedule.push(yearly_amortization_obj);
            });
  
            $scope.loanchart();
            $scope.lineYearlyAmortizationChart(yearly_date, yearly_payment, yearly_principal, yearly_interest);
            $scope.lineYearlyBalanceChart(yearly_date, yearly_balance);
            $scope.lineMonthlyAmortizationChart();
            $scope.lineMonthlyBalanceChart();
            $scope.pageIsLoading = false;
            $scope.amortization_schedule_show = true;

          });
        } catch (e) {
          // console.log("Got an error!",e);
          // throw e; // rethrow to not marked as handled
          alert('calculate function has error........');
        }
  };

  $scope.loanchart = function(){

    $scope.chartObject = {};

    $scope.chartObject.data = {"cols": [
        {id: "t", label: "Topping", type: "string"},
        {id: "s", label: "Slices", type: "number"}
    ], "rows": [
        {c: [
            {v: "Total Interest Paid"},
            {v: Math.round($scope.total_interest_paid * 100)/100},
        ]},
        {c: [
            {v: "Total Principal Paid"},
            {v: Number($scope.loanamount.replace(/,/g, "")) }
        ]}
    ]};

    $scope.chartObject.type = "PieChart";
    $scope.chartObject.options = {
        'title': '$' + Math.round($scope.monthly_payment * 100)/100 + ' MONTHLY PAYMENTS',
        'height':270,
        'width':720,
        is3D: false,
        backgroundColor: '#f5f3e5',
        fontSize: 16,
        /*colors:['brown','grey',''],*/
        fontName: 'tohoma',
        legend: {position: 'bottom', textStyle: { fontSize: 12}},
        pieHole: 0.4,
        pieSliceTextStyle: {
          color: 'black',
        },
    };

    $scope.chartObject.formatters = {
        number: [{
            columnNum: 1,
            prefix: '$'
        }]
    };
  };

  $scope.lineYearlyBalanceChart = function(yearly_date, yearly_balance){
    var chart1 = {};
    chart1.type = "LineChart";

    var data = {};
    data.cols = [];
    data.cols.push({id: "y", label: "Years", type: "string"});
    data.cols.push({id: "i", label: "Balance", type: "number"});

    data.rows = [];
    // first balance
    var balance = $scope.loanamount ? Number($scope.loanamount.replace(/,/g, "")) : 0;
    var rowsObject = {};
    rowsObject.c = [];
    rowsObject.c.push({v: 'START'});
    rowsObject.c.push({v: balance, f: $filter('currency')(balance, '$', 2)});
    data.rows.push(rowsObject);

    angular.forEach(yearly_date, function(value, key) {
      var rowsObject = {};
      rowsObject.c = [];
      rowsObject.c.push({v: key});
      rowsObject.c.push({v: yearly_balance[key], f: $filter('currency')(yearly_balance[key], '$', 2)});
      data.rows.push(rowsObject);
    });
    chart1.data = data;

    chart1.options = {
        // displayExactValues: true,
        // width: 600,
        // height: 200,
        // is3D: true,
        // chartArea: {left:10,top:10,bottom:0,height:"100%"}
        'title': 'YEARLY BALANCE CHART',
        'height':270,
        'width':720,
        is3D: false, 
        backgroundColor: '',
        fontSize: 16,
        /*colors:['brown','grey'],*/
        fontName: 'tohoma',
        legend: {position: 'right', textStyle: { fontSize: 12}},
        pieHole: 0.4,
        pieSliceTextStyle: {
          color: 'black',
        },
    };

    chart1.formatters = {
      // number : [{
      //   columnNum: 1,
      //   pattern: "$ #,##0.00"
      // }]
    };

    $scope.lineYearlyBalanceChartObject = chart1;
  };

  $scope.lineYearlyAmortizationChart = function(yearly_date, yearly_payment, yearly_principal, yearly_interest){
    var chart1 = {};
    chart1.type = "LineChart";

    var data = {};
    data.cols = [];
    data.cols.push({id: "y", label: "Years", type: "string"});
    data.cols.push({id: "i", label: "Interest Paid", type: "number"});
    data.cols.push({id: "p", label: "Principal Paid", type: "number"});
    data.cols.push({id: "a", label: "Payment", type: "number"});

    data.rows = [];
    angular.forEach(yearly_date, function(value, key) {
      var rowsObject = {};
      rowsObject.c = [];
      rowsObject.c.push({v: key});
      rowsObject.c.push({v: yearly_interest[key], f: $filter('currency')(yearly_interest[key], '$', 2)});
      rowsObject.c.push({v: yearly_principal[key], f: $filter('currency')(yearly_principal[key], '$', 2)});
      rowsObject.c.push({v: yearly_payment[key], f: $filter('currency')(yearly_payment[key], '$', 2)});
      data.rows.push(rowsObject);
    });
    chart1.data = data;
    chart1.options = {
        // displayExactValues: true,
        // width: 600,
        // height: 200,
        // is3D: true,
        // chartArea: {left:10,top:10,bottom:0,height:"100%"}
        'title': 'YEARLY AMORTIZATION CHART',
        'height':270,
        'width':720,
        is3D: false, 
        backgroundColor: '',
        fontSize: 16,
        /*colors:['brown','grey'],*/
        fontName: 'tohoma',
        legend: {position: 'right', textStyle: { fontSize: 12}},
        pieHole: 0.4,
        pieSliceTextStyle: {
          color: 'black',
        },
    };
    chart1.formatters = {};
    $scope.lineYearlyAmortizationChartObject = chart1;
  };

  $scope.lineMonthlyAmortizationChart = function(){
    $scope.lineMonthlyAmortizationChartObject = "";
    var chart1 = {};
    chart1.type = "LineChart";

    var data = {};
    data.cols = [];
    data.cols.push({id: "y", label: "Time", type: "string"});
    data.cols.push({id: "i", label: "Interest Paid", type: "number"});
    data.cols.push({id: "p", label: "Principal Paid", type: "number"});
    data.cols.push({id: "a", label: "Payment", type: "number"});

    data.rows = [];
    angular.forEach($scope.amortization_schedule, function(value, key) {
      var rowsObject = {};
      rowsObject.c = [];
      rowsObject.c.push({v: value.payment_date});
      rowsObject.c.push({v: value.interest_part, f: $filter('currency')(value.interest_part, '$', 2)});
      rowsObject.c.push({v: value.principal_part, f: $filter('currency')(value.principal_part, '$', 2)});
      rowsObject.c.push({v: value.monthly_payment, f: $filter('currency')(value.monthly_payment, '$', 2)});
      data.rows.push(rowsObject);
    });
    chart1.data = data;
    chart1.options = {
        // displayExactValues: true,
        // height: 200,
        // is3D: true,
        // chartArea: {left:10,top:10,bottom:0,height:"100%"}
        'title': 'MONTHLY AMORTIZATION CHART',
        'height':270,
        'width':720,
        is3D: false,
        backgroundColor: '',
        fontSize: 16,
        /*colors:['brown','grey'],*/
        fontName: 'tohoma',
        legend: {position: 'right', textStyle: { fontSize: 12 }},
        pieHole: 0.4,
        pieSliceTextStyle: {
          color: 'black',
        },
    };
    chart1.formatters = {};

    $scope.lineMonthlyAmortizationChartObject = chart1;
  };

  $scope.lineMonthlyBalanceChart = function(){
    var chart1 = {};
    chart1.type = "LineChart";

    var data = {};
    data.cols = [];
    data.cols.push({id: "m", label: "Monthly", type: "string"});
    data.cols.push({id: "b", label: "Balance", type: "number"});

    data.rows = [];
    // first balance
    var balance = $scope.loanamount ? Number($scope.loanamount.replace(/,/g, "")) : 0;
    var rowsObject = {};
    rowsObject.c = [];
    rowsObject.c.push({v: 'START'});
    rowsObject.c.push({v: balance, f: $filter('currency')(balance, '$', 2)});
    data.rows.push(rowsObject);

    angular.forEach($scope.amortization_schedule, function(value, key) {
      var rowsObject = {};
      rowsObject.c = [];
      rowsObject.c.push({v: value.payment_date});
      rowsObject.c.push({v: value.balance, f: $filter('currency')(value.balance, '$', 2)});
      data.rows.push(rowsObject);
    });
    chart1.data = data;

    chart1.options = {
        // displayExactValues: true,
        // width: 600,
        // height: 200,
        // is3D: true,
        // chartArea: {left:10,top:10,bottom:0,height:"100%"}
        'title': 'MONTHLY BALANCE CHART',
        'height':270,
        'width':720,
        is3D: false, 
        backgroundColor: '',
        fontSize: 16,
        /*colors:['brown','grey'],*/
        fontName: 'tohoma',
        legend: {position: 'right', textStyle: { fontSize: 12}},
        pieHole: 0.4,
        pieSliceTextStyle: {
          color: 'black',
        },
    };

    chart1.formatters = {
      // number : [{
      //   columnNum: 1,
      //   pattern: "$ #,##0.00"
      // }]
    };

    $scope.lineMonthlyBalanceChartObject = chart1;
  };
  
  $scope.Calloanterminmonths = function(){
    $scope.loanterminmonths = Math.round($scope.loanterminyears * 12);
  };

  $scope.Calloanterminyears = function(){
    $scope.loanterminmonths = Math.round($scope.loanterminmonths);
    var loanterminyears = $scope.loanterminmonths / 12;
    $scope.loanterminyears = loanterminyears.toFixed(2);
  };

  $scope.centerCtrl = function(){
    var params = $location.search();
    if (params.calcfunc == "calculate") {
      $timeout(function () {
        $scope.loanamount = params.loanamount;
        $scope.loanterminmonths = params.loanterminmonths;
        $scope.interestrateperyear = params.interestrateperyear;
        $scope.loandefaultdate = $scope.loanstartdate = params.loanstartdate;
        $scope.loanterminyears = params.loanterminmonths/12;
        $scope.drawcharts = Number(params.drawcharts) ? true : false;
        $scope.annualamortizationtable = Number(params.annualamortizationtable) ? true : false;
        $scope.monthlyamortizationtable = Number(params.monthlyamortizationtable) ? true : false;
        $scope.amountAdditionalMonthly = params.amountAdditionalMonthly;
        $scope.amountAdditionalYearly = params.amountAdditionalYearly;
        $scope.dateAdditionalYearly = params.dateAdditionalYearly;
        $scope.oneTimePaymentList = params.oneTimePaymentList ? params.oneTimePaymentList : [];
        $scope.id = Number($scope.oneTimePaymentList[$scope.oneTimePaymentList.length - 1].replace("onetimepayment-",""));
        angular.forEach(params.oneTimePaymentList, function(value, key) {
          $scope.amountOneTimePaymentList[value] = params.amountOneTimePaymentList[key];
          $scope.dateOneTimePaymentList[value] = params.dateOneTimePaymentList[key];
        });
      });
      $timeout(function () {
        $scope.calculate();
      });
    }else if(params.calcfunc == "applyExtraPayments") {
      $timeout(function () {
        $scope.loanamount = params.loanamount;
        $scope.loanterminmonths = params.loanterminmonths;
        $scope.interestrateperyear = params.interestrateperyear;
        $scope.loandefaultdate = $scope.loanstartdate = params.loanstartdate;
        $scope.loanterminyears = params.loanterminmonths/12;
        $scope.drawcharts = params.drawcharts ? true : false;
        $scope.annualamortizationtable = Number(params.annualamortizationtable) ? true : false;
        $scope.monthlyamortizationtable = Number(params.monthlyamortizationtable) ? true : false;
        $scope.amountAdditionalMonthly = params.amountAdditionalMonthly;
        $scope.amountAdditionalYearly = params.amountAdditionalYearly;
        $scope.dateAdditionalYearly = params.dateAdditionalYearly;
        $scope.oneTimePaymentList = params.oneTimePaymentList ? params.oneTimePaymentList : [];
        $scope.id = Number($scope.oneTimePaymentList[$scope.oneTimePaymentList.length - 1].replace("onetimepayment-",""));
        angular.forEach(params.oneTimePaymentList, function(value, key) {
          $scope.amountOneTimePaymentList[value] = params.amountOneTimePaymentList[key];
          $scope.dateOneTimePaymentList[value] = params.dateOneTimePaymentList[key];
        });
      });
      $timeout(function () {
        $scope.applyExtraPayments();
      });
    }else{
      $scope.loanamount = "100000";
      $scope.loanterminyears = 3;
      $scope.loanterminmonths = 36;
      $scope.interestrateperyear = 6;
      $scope.loandefaultdate = $scope.loanstartdate = $filter('date')(new Date(), 'MMM yyyy', 0);
      // $scope.loanstartdate = 'Dec 2020'
      $scope.calculate();
    }
  };
  
  $scope.centerCtrl();

}]);

app.directive('moneyNum', ['$filter', function($filter){
  return {
    restrict: 'A',
    link: function(scope, element, attrs){
      scope.addaOneTimePayment = function(){
        // scope.dateOneTimePaymentList is an Object
        // The Object.keys() method returns an array of a given object's own enumerable properties, in the same order as that provided by a for...in loop (the difference being that a for-in loop enumerates properties in the prototype chain as well).
        var keys = Object.keys(scope.dateOneTimePaymentList);
        // alert(keys[keys.length-1]);
        scope.loandefaultdate = scope.dateOneTimePaymentList[keys[keys.length-1]] ? scope.dateOneTimePaymentList[keys[keys.length-1]] : scope.loandefaultdate;
        scope.id = scope.id + 1;
        scope.oneTimePaymentList.push("onetimepayment-" + scope.id);
        scope.amountOneTimePaymentList["onetimepayment-" + scope.id] = 0;
        // scope.dateOneTimePaymentList["onetimepayment-" + scope.id] = 'select a time';
        // scope.dateOneTimePaymentList["onetimepayment-" + scope.id] = scope.loanstartdate;
        scope.dateOneTimePaymentList["onetimepayment-" + scope.id] = scope.loandefaultdate;
        // alert(scope.dateOneTimePaymentList[keys[keys.length-1]]);
      };
      scope.removeaOneTimePayment = function(onetimepaymentName){
        var index = scope.oneTimePaymentList.indexOf(onetimepaymentName);
        scope.oneTimePaymentList.splice(index, 1);
        delete scope.amountOneTimePaymentList[onetimepaymentName];
        delete scope.dateOneTimePaymentList[onetimepaymentName];
      };
      element.on('focus',function(){
        var num_str = element.val();
        var res = num_str.replace(/,/g, "");
        element.val(res);
      });
      element.on('blur',function(){
        var num_str = element.val();
        var money = $filter('currency')(num_str, '', 0);
        element.val(money);
      });
      element.on('click',function(){
        if(element.attr('id') == 'loanamountid') return;
        this.selectionStart = 0;
        this.selectionEnd = 999;
      });
    }
  };
}]);

app.directive('ymNum', function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
          element.on('click',function(){
            this.selectionStart = 0;
            this.selectionEnd = 999;
          });
        }
    }
});