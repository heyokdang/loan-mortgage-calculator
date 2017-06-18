var app = angular.module("LoanCalculatorApp", ['googlechart','ngMaterial', 'ngMessages']);

app.controller("LoanCalculatorCtr", function($scope,$filter){

  var bkloanamountnumber = 100000;
  $scope.loanamount = "100,000";
  $scope.loanterminyears = 3;
  $scope.loanterminmonths = 36;
  $scope.interestrateperyear = 6;
  $scope.amortization_schedule = [];

	$scope.calculate = function(){

    // loan calculator formular
    var balance = bkloanamountnumber;
    var rate = $scope.interestrateperyear / (12 * 100);
    var months = 12 * $scope.loanterminyears;
    var monthly_payment = (rate + ( rate / (Math.pow(1 + rate, months) - 1))) * balance;
    // 100% = total_principal_paid + total_interest_paid = total_paid
    var total_paid = monthly_payment * months;
    var total_principal_paid = bkloanamountnumber;
    var total_interest_paid = total_paid - total_principal_paid;
    var total_principal_paid_percent = (total_principal_paid/total_paid)*100;
    var total_interest_paid_percent = (total_interest_paid/total_paid)*100;
    $scope.total_interest_paid = total_interest_paid;

    $scope.monthly_payment = monthly_payment;
    $scope.amortization_schedule = [];
    var total_interest = 0;
    var i = 0;
    while(balance > 0){
      var amortization_obj = new Object();
      amortization_obj.interest_part = balance * rate;
      amortization_obj.principal_part = monthly_payment - amortization_obj.interest_part;
      total_interest += amortization_obj.interest_part;
      amortization_obj.total_interest = total_interest;
      amortization_obj.balance = balance - amortization_obj.principal_part;
      
      /* add more months to datetime picker */
      var d = new Date();
      d.setMonth(d.getMonth() + ++i);
      amortization_obj.payment_date = d;

      balance = amortization_obj.balance;
      $scope.amortization_schedule.push(amortization_obj);

      $scope.loanchart();

    };
  };

  $scope.add_extra_payments_calculate = function(){
    
  };

  $scope.testdate = function(){

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
            {v: bkloanamountnumber}
        ]}
    ]};

    $scope.chartObject.type = "PieChart";
    $scope.chartObject.options = {
        'title': '$' + Math.round($scope.monthly_payment * 100)/100 + ' MONTHLY PAYMENTS',
        'height':270,
        is3D: true, 
        backgroundColor: '#f5f3e5',
    };

     $scope.chartObject.formatters = {
        number: [{
            columnNum: 1,
            prefix: '$'
        }]
    };
  };

  

  $scope.Calloanterminmonths = function(){
    $scope.loanterminmonths = $scope.loanterminyears * 12;
  };

  $scope.Calloanterminyears = function(){
    $scope.loanterminyears = $scope.loanterminmonths / 12;
  };

  $scope.currencyformat = function(fieldname){
    bkloanamountnumber = parseInt($scope.loanamount);
    $scope.loanamount = $filter('currency')($scope.loanamount, '', 0);
  };


  $scope.numberformat = function(){
    $scope.loanamount = bkloanamountnumber;
  };

  $scope.testtest = function(){
    //$filter('number')($scope.loanamount, '', 0);
    //alert(angular.isNumber(bkloanamountnumber));
    alert(angular.isString(bkloanamountnumber));
  };

   $scope.calculate();

});

app.directive('moneyNum', ['$filter', function($filter){
  return {
    restrict: 'A',
    link: function(scope, element, attrs){
      /*scope.test = [];
      scope.test.push({name: 'test1'});
      scope.test.push({name: 'test2'});*/
      
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
    }
  };
}]);