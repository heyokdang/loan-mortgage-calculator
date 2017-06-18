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

app.controller("LoanCalculatorCtr", ['$scope','$filter','$timeout','$location','$http', function($scope,$filter,$timeout,$location,$http){
  
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
  $scope.amountOneTimePaymentList = [];
  $scope.dateOneTimePaymentList = [];
  $scope.oneTimePaymentList = [];
  $scope.totalAmountExtraPayment = 0;

  $scope.pageIsLoading = false;
  $scope.amortization_schedule_show = false;
  $scope.extra_payments_information_show = false;
  $scope.loan_extra_payment_summary_show = false;
  $scope.add_extra_payments_form_show = false;
  $scope.output_parameters_show = false;
  $scope.dont_show_no_result = true;

  //secure code, only run on a cd = current domain
  // online mode, public mode
  // $scope.cd = $location.host();
  // dev mode
  $scope.cd = "loancalculator.pw";
  var p = "lo", r = "an", i = "ca", v = "lc", a = "ul", t = "at", e = "or", d = ".", o = "p", m = "w", n = "";
  $scope.pd = p + r + i + v + a + t + e + d + o + m + n;
  $scope.pdw = "www." + $scope.pd;

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

  $scope.getStartDateAdditionalYearly = function(){
    var da1 = new Date("1 " + $scope.loanstartdate);
    var da2 = new Date("1 " + $scope.dateAdditionalYearly + " " + da1.getFullYear());
    if (da2 >= da1) {
      return $scope.dateAdditionalYearly + " " + da1.getFullYear();
    };
    return $scope.dateAdditionalYearly + " " + (Number(da1.getFullYear()) + 1).toString();
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
          $scope.dont_show_no_result = false;

          $timeout(function () {
            // create url params object to share url
            var paramsObj = new Object();
            paramsObj.homevalue = $scope.homevalue;
            paramsObj.downpaymentpercent = $scope.downpaymentpercent;
            paramsObj.loanamount = $scope.loanamount ? Number($scope.loanamount.replace(/,/g, "")) : 0;
            paramsObj.loanterminmonths = $scope.loanterminmonths;
            paramsObj.interestrateperyear = $scope.interestrateperyear;

            paramsObj.loanstartdate = $scope.loanstartdate;
            paramsObj.drawcharts = $scope.drawcharts ? 1 : 0;
            paramsObj.annualamortizationtable = $scope.annualamortizationtable ? 1 : 0;
            paramsObj.monthlyamortizationtable = $scope.monthlyamortizationtable ? 1 : 0;
            paramsObj.calcfunc = "applyExtraPayments";
            paramsObj.amountAdditionalMonthly = $scope.amountAdditionalMonthly ? Number($scope.amountAdditionalMonthly.replace(/,/g, "")) : 0;
            paramsObj.amountAdditionalYearly = $scope.amountAdditionalYearly ? Number($scope.amountAdditionalYearly.replace(/,/g, "")) : 0;
            paramsObj.dateAdditionalYearly = $scope.dateAdditionalYearly;
            paramsObj.oneTimePaymentList = $scope.oneTimePaymentList;
            paramsObj.amountOneTimePaymentList = [];
            paramsObj.dateOneTimePaymentList = [];
            angular.forEach($scope.oneTimePaymentList, function(value, key) {
              paramsObj.amountOneTimePaymentList.push($scope.amountOneTimePaymentList[value]);
              paramsObj.dateOneTimePaymentList.push($scope.dateOneTimePaymentList[value]);
            });
            $location.search(paramsObj);
            $scope.$apply();
          });
  
          // check right domain
          if (($scope.pd != $scope.cd) && ($scope.pdw != $scope.cd)) {return;};
          $timeout(function () {
            var calculate_params = "homevalue=" + $scope.homevalue;
            calculate_params += "&downpaymentpercent=" + $scope.downpaymentpercent;
            calculate_params += "&loanamount=" + $scope.loanamount;
            calculate_params += "&loanterminmonths=" + $scope.loanterminmonths;
            calculate_params += "&interestrateperyear=" + $scope.interestrateperyear;
            calculate_params += "&loanstartdate=" + $scope.loanstartdate;
            calculate_params += "&amountAdditionalMonthly=" + $scope.amountAdditionalMonthly;
            calculate_params += "&amountAdditionalYearly=" + $scope.amountAdditionalYearly;
            calculate_params += "&dateAdditionalYearly=" + $scope.dateAdditionalYearly;

            angular.forEach($scope.oneTimePaymentList, function(value, key) {
              calculate_params += "&oneTimePaymentList[]=" + value;
              calculate_params += "&amountOneTimePaymentList[]=" + $scope.amountOneTimePaymentList[value];
              calculate_params += "&dateOneTimePaymentList[]=" + $scope.dateOneTimePaymentList[value];
            });
            var url = "extrapaymentcalculate.php?";
            url = url + calculate_params;
            $http.get(url)
              .then(function(response) {
                $scope.amountAdditionalMonthly = Number($scope.amountAdditionalMonthly);
                //First function handles success
                var content = response.data;
                // loan calculator formular
                $scope.payoffdate = content.payoffdate;
                $scope.total_interest_paid = content.total_interest_paid;
                $scope.total_interest_paid_percent = content.total_interest_paid_percent;
                $scope.total_principal_paid = content.total_principal_paid;
                $scope.total_principal_paid_percent = content.total_principal_paid_percent;
                $scope.total_paid = content.total_paid;
                $scope.months = content.months;
                $scope.monthly_payment = content.monthly_payment;
                $scope.amortization_schedule = content.amortization_schedule;
                $scope.yearly_amortization_schedule = content.yearly_amortization_schedule;

                $scope.extrapayment_monthly_payment = content.extrapayment_monthly_payment;
                $scope.extrapayment_months = content.extrapayment_months;
                $scope.totalAmountExtraPayment = content.totalAmountExtraPayment;
                $scope.extrapayment_total_paid = content.extrapayment_total_paid;
                $scope.extrapayment_total_interest_paid = content.extrapayment_total_interest_paid;
                $scope.extrapayment_payoffdate = content.extrapayment_payoffdate;

                $scope.monthly_principal_interest = content.monthly_principal_interest;
                
                $scope.oneTimePaymentList = content.oneTimePaymentList_right;
                $scope.amountOneTimePaymentList = content.amountOneTimePaymentList_right;
                $scope.dateOneTimePaymentList = content.dateOneTimePaymentList_right;

                $scope.enddate_amountAdditionalMonthly = content.enddate_amountAdditionalMonthly;
                $scope.enddate_amountAdditionalYearly = content.enddate_amountAdditionalYearly;
                $scope.startdate_amountAdditionalYearly = $scope.getStartDateAdditionalYearly();

                $scope.amountAdditionalMonthly_count = content.amountAdditionalMonthly_count;
                $scope.amountAdditionalYearly_count = content.amountAdditionalYearly_count;

                if (content.oneTimePaymentList_increase_id > 0) { $scope.id = content.oneTimePaymentList_increase_id };
                
                var yearly_date = content.yearly_date;
                var yearly_payment = content.yearly_payment;
                var yearly_principal = content.yearly_principal;
                var yearly_interest = content.yearly_interest;
                var yearly_balance = content.yearly_balance;
                
                $scope.loanchart2($scope.extrapayment_monthly_payment, $scope.extrapayment_total_interest_paid, "");
                $scope.lineYearlyAmortizationChart(yearly_date, yearly_payment, yearly_principal, yearly_interest);
                $scope.lineYearlyBalanceChart(yearly_date, yearly_balance);
                $scope.lineMonthlyAmortizationChart();
                $scope.lineMonthlyBalanceChart();
                
                $scope.pageIsLoading = false;
                $scope.amortization_schedule_show = true;
                $scope.extra_payments_information_show = true;
                $scope.loan_extra_payment_summary_show = true;
                $scope.add_extra_payments_form_show = false;

              }, function(response) {
                //Second function handles error
              });
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
          $scope.dont_show_no_result = false;

          // check right domain
          if (($scope.pd != $scope.cd) && ($scope.pdw != $scope.cd)) {return;};

          $timeout(function () {
            // create url params object to share url
            var paramsObj = new Object();
            paramsObj.homevalue = $scope.homevalue;
            paramsObj.downpaymentpercent = $scope.downpaymentpercent;
            paramsObj.loanamount = $scope.loanamount ? Number($scope.loanamount.replace(/,/g, "")) : 0;
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
            $scope.$apply();
          });
          
          $timeout(function () {
            var calculate_params = "homevalue=" + $scope.homevalue;
            calculate_params += "&downpaymentpercent=" + $scope.downpaymentpercent;
            calculate_params += "&loanamount=" + $scope.loanamount;
            calculate_params += "&loanterminmonths=" + $scope.loanterminmonths;
            calculate_params += "&interestrateperyear=" + $scope.interestrateperyear;
            calculate_params += "&loanstartdate=" + $scope.loanstartdate;
            var url = "calculate.php?";
            url = url + calculate_params;
            $http.get(url)
              .then(function(response) {
                //First function handles success
                var content = response.data;

                // loan calculator formular
                $scope.payoffdate = content.payoffdate;
                $scope.total_interest_paid = content.total_interest_paid;
                $scope.total_interest_paid_percent = content.total_interest_paid_percent;
                $scope.total_principal_paid = content.total_principal_paid;
                $scope.total_principal_paid_percent = content.total_principal_paid_percent;
                $scope.total_paid = content.total_paid;
                $scope.months = content.months;
                $scope.monthly_payment = content.monthly_payment;
                $scope.amortization_schedule = content.amortization_schedule;
                $scope.yearly_amortization_schedule = content.yearly_amortization_schedule;

                $scope.monthly_principal_interest = content.monthly_principal_interest;

                var yearly_date = content.yearly_date;
                var yearly_payment = content.yearly_payment;
                var yearly_principal = content.yearly_principal;
                var yearly_interest = content.yearly_interest;
                var yearly_balance = content.yearly_balance;
                $scope.loanchart();
                $scope.lineYearlyAmortizationChart(yearly_date, yearly_payment, yearly_principal, yearly_interest);
                $scope.lineYearlyBalanceChart(yearly_date, yearly_balance);
                $scope.lineMonthlyAmortizationChart();
                $scope.lineMonthlyBalanceChart();
                $scope.pageIsLoading = false;
                $scope.amortization_schedule_show = true;

              }, function(response) {

              });
           });
        } catch (e) {
          alert('calculate function has error........');
        }
  };

  $scope.loanchart2 = function(monthly_payment, total_interest_paid, prepayment_text){
    $scope.chartObject = {};

    $scope.chartObject.data = {"cols": [
        {id: "t", label: "Topping", type: "string"},
        {id: "s", label: "Slices", type: "number"}
    ], "rows": [
        {c: [
            {v: "Total Interest Paid"},
            {v: Math.round(total_interest_paid * 100)/100},
        ]},
        {c: [
            {v: "Down Payment"},
            {v: Math.round($scope.downpayment * 100)/100},
        ]},
        {c: [
            {v: "Total Principal Paid"},
            {v: Number($scope.loanamount.replace(/,/g, "")) }
        ]}
    ]};


    $scope.chartObject.type = "PieChart";
    $scope.chartObject.options = {
        'title': '$' + Math.round(monthly_payment * 100)/100 + ' MONTHLY PAYMENTS' + prepayment_text,
        is3D: false,
        backgroundColor: '#f5f3e5',
        fontSize: 16,
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
            {v: "Down Payment"},
            {v: Math.round($scope.downpayment * 100)/100},
        ]},
        {c: [
            {v: "Total Principal Paid"},
            {v: Number($scope.loanamount.replace(/,/g, "")) }
        ]}
    ]};

    $scope.chartObject.type = "PieChart";
    $scope.chartObject.options = {
        'title': '$' + Math.round($scope.monthly_payment * 100)/100 + ' MONTHLY PAYMENTS',
        is3D: false,
        backgroundColor: '#f5f3e5',
        fontSize: 16,
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

  $scope.loanchartWithPrepayment = function(){
    $scope.chartPrepaymentObject = {};

    $scope.chartPrepaymentObject.data = {"cols": [
        {id: "t", label: "Topping", type: "string"},
        {id: "s", label: "Slices", type: "number"}
    ], "rows": [
        {c: [
            {v: "Total Interest Paid"},
            {v: Math.round($scope.extrapayment_total_interest_paid * 100)/100},
        ]},
        {c: [
            {v: "Total Principal Paid"},
            {v: Number($scope.loanamount.replace(/,/g, "")) }
        ]}
    ]};

    $scope.chartPrepaymentObject.type = "PieChart";
    $scope.chartPrepaymentObject.options = {
        'title': '$' + Math.round($scope.extrapayment_monthly_payment * 100)/100 + ' MONTHLY PAYMENTS',
        is3D: false,
        backgroundColor: '#f5f3e5',
        fontSize: 16,
        fontName: 'tohoma',
        legend: {position: 'bottom', textStyle: { fontSize: 12}},
        pieHole: 0.4,
        pieSliceTextStyle: {
          color: 'black',
        },
    };

    $scope.chartPrepaymentObject.formatters = {
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
        'title': 'YEARLY BALANCE CHART',
        is3D: false, 
        backgroundColor: '',
        fontSize: 16,
        fontName: 'tohoma',
        legend: {position: 'right', textStyle: { fontSize: 12}},
        pieHole: 0.4,
        pieSliceTextStyle: {
          color: 'black',
        },
    };

    chart1.formatters = {
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
        'title': 'YEARLY AMORTIZATION CHART',
        is3D: false, 
        backgroundColor: '',
        fontSize: 16,
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

  $scope.lineYearlyAmortizationAnnotationChart = function(yearly_date, yearly_payment, yearly_principal, yearly_interest){
    var chart1 = {};
    chart1.type = "AnnotationChart";

    var data = {};
    data.cols = [];
    data.cols.push({id: "y", label: "Years", type: "date"});
    data.cols.push({id: "a", label: "Payment", type: "number"});
    data.cols.push({id: "p", label: "Principal Paid", type: "number"});
    data.cols.push({id: "i", label: "Interest Paid", type: "number"});

    data.rows = [];
    var mm = $scope.loanstartdate.split(" ")[0];
    mm = "JAN";
    angular.forEach(yearly_date, function(value, key) {

      var f = new Date(mm + " 1 " + key);
      var rowsObject = {};
      rowsObject.c = [];
      rowsObject.c.push({v: f});
      rowsObject.c.push({v: yearly_payment[key], f: $filter('currency')(yearly_payment[key], '$', 2)});
      rowsObject.c.push({v: yearly_principal[key], f: $filter('currency')(yearly_principal[key], '$', 2)});
      rowsObject.c.push({v: yearly_interest[key], f: $filter('currency')(yearly_interest[key], '$', 2)});

      data.rows.push(rowsObject);
    });
    chart1.data = data;
    chart1.options = {
        'title': 'YEARLY AMORTIZATION CHART',
        is3D: false,
        backgroundColor: '',
        displayAnnotations: false,
        displayAnnotationsFilter: true,
        allValuesSuffix: "",
        displayLegendValues: true,
        displayRangeSelector: false,
        displayZoomButtons: false,
        numberFormats: '$0.00',
        dateFormat: 'yyyy',
        fontSize: 16,
        fontName: 'tohoma',
        legend: {position: 'right', textStyle: { fontSize: 12}},
        pieHole: 0.4,
        pieSliceTextStyle: {
          color: 'black',
        },
    };
    chart1.formatters = {};
    $scope.lineYearlyAmortizationAnnotationChartObject = chart1;
  };

  $scope.lineYearlyAmortizationFullChart = function(yearly_date, yearly_payment, yearly_principal, yearly_interest, yearly_balance){
    var chart1 = {};
    chart1.type = "LineChart";

    var data = {};
    data.cols = [];
    data.cols.push({id: "y", label: "Years", type: "string"});
    data.cols.push({id: "i", label: "Interest Paid", type: "number"});
    data.cols.push({id: "p", label: "Principal Paid", type: "number"});
    data.cols.push({id: "a", label: "Payment", type: "number"});
    data.cols.push({id: "d", label: "Balance", type: "number"});

    data.rows = [];
    var balance = $scope.loanamount ? Number($scope.loanamount.replace(/,/g, "")) : 0;
    var rowsObject = {};
    rowsObject.c = [];
    rowsObject.c.push({v: 'START'});
    rowsObject.c.push({v: 0, f: '$0'});
    rowsObject.c.push({v: 0, f: '$0'});
    rowsObject.c.push({v: 0, f: '$0'});
    rowsObject.c.push({v: balance, f: $filter('currency')(balance, '$', 2)});
    data.rows.push(rowsObject);
    angular.forEach(yearly_date, function(value, key) {
      var rowsObject = {};
      rowsObject.c = [];
      rowsObject.c.push({v: key});
      rowsObject.c.push({v: yearly_interest[key], f: $filter('currency')(yearly_interest[key], '$', 2)});
      rowsObject.c.push({v: yearly_principal[key], f: $filter('currency')(yearly_principal[key], '$', 2)});
      rowsObject.c.push({v: yearly_payment[key], f: $filter('currency')(yearly_payment[key], '$', 2)});
      rowsObject.c.push({v: yearly_balance[key], f: $filter('currency')(yearly_balance[key], '$', 2)});
      data.rows.push(rowsObject);
    });
    chart1.data = data;
    chart1.options = {
        'title': 'YEARLY AMORTIZATION CHART',
        is3D: false, 
        backgroundColor: '',
        fontSize: 16,
        fontName: 'tohoma',
        legend: {position: 'right', textStyle: { fontSize: 12}},
        pieHole: 0.4,
        pieSliceTextStyle: {
          color: 'black',
        },
    };
    chart1.formatters = {};
    $scope.lineYearlyAmortizationFullChartObject = chart1;
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
        'title': 'MONTHLY AMORTIZATION CHART',
        is3D: false,
        backgroundColor: '',
        fontSize: 16,
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
        'title': 'MONTHLY BALANCE CHART',
        is3D: false, 
        backgroundColor: '',
        fontSize: 16,
        fontName: 'tohoma',
        legend: {position: 'right', textStyle: { fontSize: 12}},
        pieHole: 0.4,
        pieSliceTextStyle: {
          color: 'black',
        },
    };

    chart1.formatters = {
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

  $scope.Callhomevalue = function(){
    $scope.Calldownpayment();
    $scope.Callloanamount();
  };

  $scope.Callloanamount = function(){
    $scope.loanamount = $scope.homevalue - $scope.downpayment;
    $scope.loanamount = $scope.loanamount.toString();
  };

  $scope.Calldownpayment = function(){
    $scope.downpayment = ($scope.downpaymentpercent/100)*$scope.homevalue;
    $scope.Callloanamount();
  };
  $scope.Calldownpaymentpercent = function(){
    $scope.downpaymentpercent = ($scope.downpayment/$scope.homevalue)*100;
    $scope.Callloanamount();
  };

  $scope.addaOneTimePaymentStart = function(){
    $scope.loandefaultdate = $scope.loanstartdate = $filter('date')(new Date(), 'MMM yyyy', 0);
    $scope.id = 1;
    $scope.oneTimePaymentList.push("onetimepayment-" + $scope.id);
    $scope.amountOneTimePaymentList["onetimepayment-" + $scope.id] = 0;
    $scope.dateOneTimePaymentList["onetimepayment-" + $scope.id] = $scope.loandefaultdate;
  };

  $scope.centerCtrl = function(){
    var params = $location.search();

    if (params.calcfunc == "calculate") {
      $timeout(function () {

        $scope.homevalue = params.homevalue;
        $scope.downpaymentpercent = params.downpaymentpercent;
        $scope.Calldownpayment();
        $scope.loanterminmonths = params.loanterminmonths;
        $scope.loanterminyears = params.loanterminmonths/12;
        $scope.interestrateperyear = params.interestrateperyear;

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

        if (typeof params.oneTimePaymentList == 'string') {
          $scope.oneTimePaymentList.push(params.oneTimePaymentList);
          $scope.amountOneTimePaymentList[$scope.oneTimePaymentList[0]] = params.amountOneTimePaymentList;
          $scope.dateOneTimePaymentList[$scope.oneTimePaymentList[0]] = params.dateOneTimePaymentList;
          $scope.id = Number($scope.oneTimePaymentList[0].replace("onetimepayment-",""));
        }else if (typeof params.oneTimePaymentList=='object') {
          $scope.oneTimePaymentList = params.oneTimePaymentList;

          angular.forEach($scope.oneTimePaymentList, function(value, key) {
            $scope.amountOneTimePaymentList[value] = params.amountOneTimePaymentList[key];
            $scope.dateOneTimePaymentList[value] = params.dateOneTimePaymentList[key];
          });
          $scope.id = Number($scope.oneTimePaymentList[$scope.oneTimePaymentList.length - 1].replace("onetimepayment-",""));
        }else if (typeof params.oneTimePaymentList == 'undefined') {
          $scope.addaOneTimePaymentStart();
        };
        
        $scope.dont_show_no_result = false;
      });
      $timeout(function () {
        $scope.calculate();
      });
    }else if(params.calcfunc == "applyExtraPayments") {
      $timeout(function () {

        $scope.homevalue = params.homevalue;
        $scope.downpaymentpercent = params.downpaymentpercent;
        $scope.Calldownpayment();
        $scope.loanterminmonths = params.loanterminmonths;
        $scope.loanterminyears = params.loanterminmonths/12;
        $scope.interestrateperyear = params.interestrateperyear;

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
        if (typeof params.oneTimePaymentList == 'string') {
          $scope.oneTimePaymentList.push(params.oneTimePaymentList);
          $scope.amountOneTimePaymentList[$scope.oneTimePaymentList[0]] = params.amountOneTimePaymentList;
          $scope.dateOneTimePaymentList[$scope.oneTimePaymentList[0]] = params.dateOneTimePaymentList;
          $scope.id = Number($scope.oneTimePaymentList[0].replace("onetimepayment-",""));
        }else if (typeof params.oneTimePaymentList=='object') {
          $scope.oneTimePaymentList = params.oneTimePaymentList;

          angular.forEach($scope.oneTimePaymentList, function(value, key) {
            $scope.amountOneTimePaymentList[value] = params.amountOneTimePaymentList[key];
            $scope.dateOneTimePaymentList[value] = params.dateOneTimePaymentList[key];
          });
          $scope.id = Number($scope.oneTimePaymentList[$scope.oneTimePaymentList.length - 1].replace("onetimepayment-",""));
        }else if (typeof params.oneTimePaymentList == 'undefined') {
          $scope.addaOneTimePaymentStart();
        };

        $scope.dont_show_no_result = false;
      });
      $timeout(function () {
        $scope.applyExtraPayments();
      });
    }else{
      $scope.homevalue = "350000";
      
      $scope.downpaymentpercent = 20;
      $scope.Calldownpayment();

      $scope.loanamount = $scope.homevalue - $scope.downpayment;
      $scope.loanamount = $scope.loanamount.toString();
      $scope.loanterminyears = 20;
      $scope.Calloanterminmonths();
      $scope.interestrateperyear = 5;

      $scope.addaOneTimePaymentStart();
    }
  };
  
  $scope.centerCtrl();

}]);

app.directive('moneyNum', ['$filter', function($filter){
  return {
    restrict: 'A',
    link: function(scope, element, attrs){
      scope.addaOneTimePayment = function(){
        var keys = Object.keys(scope.dateOneTimePaymentList);
        scope.loandefaultdate = scope.dateOneTimePaymentList[keys[keys.length-1]] ? scope.dateOneTimePaymentList[keys[keys.length-1]] : scope.loandefaultdate;
        scope.id = scope.id + 1;
        scope.oneTimePaymentList.push("onetimepayment-" + scope.id);
        scope.amountOneTimePaymentList["onetimepayment-" + scope.id] = 0;
        scope.dateOneTimePaymentList["onetimepayment-" + scope.id] = scope.loandefaultdate;
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