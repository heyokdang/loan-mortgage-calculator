<!DOCTYPE html>
<html lang="en" ng-app="LoanCalculatorApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="The best Mortgage Calculator softwave, Calculate your monthly mortgage payment">
    <meta name="keywords" content="mortgage calculator,mortgage,home loan calculator,amortization,mortgage payment calculator,interest calculator,amortization schedule,payment calculator,amortization calculator,mortgage calculator uk">
    <meta name="author" content="">
    <meta name="google-site-verification" content="lN-dqbwZvJ6AJafFNevQtC7EZorowspUwuRGOZ8Hf1c" />

    <!-- Facebook Like, Share content -->
    <meta property="og:url"                content="http://www.loancalculator.pw" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Welcom to LoanCalculator.pw!" />
    <meta property="og:description"        content="The best Mortgage Calculator softwave, Calculate your monthly mortgage payment" />
    <meta property="og:image"              content="img/loan-calculator1.jpg" />
    <meta property="og:site_name"          content="Loancalculator" />
    <meta property="fb:app_id"             content="957153911066174" />

    <title>Mortgage calculator</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/angular-material.min.css" rel="stylesheet">

    <link href="css/ng-bs3-datepicker.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/app.css" rel="stylesheet">
    <link href="css/mortgage-calculator.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" media="print" href="css/mortgage-calculator-print.css">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

  </head>

  <body ng-controller="LoanCalculatorCtr as LCCtr" ng-cloak>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-75178474-1', 'auto');
      ga('send', 'pageview');

    </script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=957153911066174";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default hidden-print">
      <div class="container">
        <div class="navbar-header">

          <!-- Nav header navbar-header.html -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html" alt="HOME" title="HOME"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
          <!-- End Nav header -->

        </div>
        <div id="navbar" class="navbar-collapse collapse">

          <!-- Navbar navbar.html -->
          <ul class="nav navbar-nav">
            <li><a href="contact.html">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <div class="fb-like" data-href="http://loancalculator.pw" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            </li>
            <li>
              <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://loancalculator.pw" data-text="The best loan calculator softwave, this loan calculator will help you determine the monthly payments on a loan" data-via="loan_calc">Tweet</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </li>
            <li>
              <!-- Place this tag where you want the share button to render. -->
              <div class="g-plus" data-action="share" data-annotation="bubble"></div>
            </li>
            <div id="likeus"></div>
          </ul>
          <!-- End Navbar navbar.html -->

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div id="loader-wrapper" ng-show="pageIsLoading">
      <div id="loader"><img src="img/loading-ajax.gif"></div>
    </div>

    <div class="container">

      <div class="row hidden-print">
        <div class="col-md-8 col-sm-12">
          <h1>Mortgage Calculator</h1>
          <p>The best Mortgage Calculator softwave, Calculate your monthly mortgage payment using the free calculator below. A house is the largest purchase most of us will ever make so it's important to calculate what your mortgage payment will be and how much you can afford. Estimate your monthly payments and see the effect of adding extra payments.</p>
          <hr>
          <div class="row">
            <div class="col-md-12 calculator-form">
              <form class="" ng-submit="calculate()">

                <div class="row">
                  <div class="col-md-6">

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="spleft">Home value</span><span class="spright">$</span></div>
                        <input money-num ng-model="homevalue" ng-change="Callhomevalue()" type="text" class="form-control" id="homevalue">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="spleft">Down payment</span><span class="spright">$</span></div>
                        <input money-num ng-model="downpayment" ng-change="Calldownpaymentpercent()" type="text" class="form-control form-control2" id="downpayment">
                        <div class="form-control2">
                          <input ym-num ng-model="downpaymentpercent" ng-change="Calldownpayment()" type="text" class="form-control percent" id="downpaymentpercent"><span class="percenticon">%</span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="spleft">Mortgage Amount</span><span class="spright">$</span></div>
                        <input money-num ng-model="loanamount" type="text" class="form-control" id="loanamount" readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon">Mortgage term in years</div>
                        <input ng-model="loanterminyears" ym-num ng-change="Calloanterminmonths()" type="text" class="form-control" id="loanterminyearsid">
                      </div>
                    </div>
                
                    <!-- <p class="br-ortext">or</p> -->

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon">or Mortgage term in months</div>
                        <input ng-model="loanterminmonths" ym-num ng-change="Calloanterminyears()" type="text" class="form-control" id="loanterminmonthsid">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="spleft">Interest rate per year</span><span class="spright">%</span></div>
                        <input ng-model="interestrateperyear" ym-num type="text" class="form-control" id="interestrateperyear">
                      </div>
                    </div>

                    

                  </div>
                  <div class="col-md-6">

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="spleft">PMI (FHA) per year</span><span class="spright">$</span></div>
                        <input money-num ng-model="pmi" ng-change="Callpmipercent()" type="text" class="form-control form-control2" id="pmi">
                        <div class="form-control2">
                          <input ym-num ng-model="pmipercent" ng-change="Callpmi()" type="text" class="form-control percent" id="pmipercent"><span class="percenticon">%</span>
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon notice">
                          <span class="spleft">PMI (FHA) only applied when downpayment < 20%</span>
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="spleft">Property taxs/year</span><span class="spright">$</span></div>
                        <input money-num ng-model="propertytaxs" ng-change="Callpropertytaxspercent()" type="text" class="form-control form-control2" id="propertytaxs">
                        <div class="form-control2">
                          <input ym-num ng-model="propertytaxspercent" ng-change="Callpropertytaxs()" type="text" class="form-control percent" id="propertytaxspercent"><span class="percenticon">%</span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="spleft">Home insurance</span><span class="spright">$</span></div>
                        <input money-num ng-model="homeinsurance" type="text" ng-change="Callhomeinsurancepercent()" class="form-control form-control2" id="homeinsurance">
                        <div class="form-control2">
                          <input ym-num ng-model="homeinsurancepercent" type="text" ng-change="Callhomeinsurance()" class="form-control percent" id="homeinsurancepercent"><span class="percenticon">%</span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="spleft">HOA dues per month</span><span class="spright">$</span></div>
                        <input money-num ng-model="hoadues" type="text" class="form-control" id="hoadues">
                      </div>
                    </div>

                    <div class="form-group">
                        <ng-bs3-datepicker id="loanstartdate" data-ng-model='loanstartdate' date-min-view-mode="months" date-view-mode="months" date-format="MMM YYYY" language="en-ca" />
                    </div>

                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <button id="bt_calculator" type="submit" class="btn btn-primary">CALCULATE</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>



          </div>
        </div>
        <div class="col-md-4 col-sm-12"><h2 style="display:none">Advertisement</h2></div>
      </div>

      <div class="row">

        <div class="col-md-8 col-sm-12">
          <div class="row">
            <div class="col-sm-12 hidden-print addextrapaymentbt">
              <button id="add_extra_payments_bt" type="button" class="btn btn-link" ng-click="addExtraPaymentForm()">
                <span class="glyphicon glyphicon-collapse-down"></span> ADD EXTRA PAYMENTS
              </button>
            </div>

            <div class="col-sm-12 add_extra_payments_form hidden-print">
              <div id="add_extra_payments_form" class="check-element animate-show" ng-show="add_extra_payments_form_show">
                <form class="" ng-submit="applyExtraPayments()">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><span class="spleft">$</span></div>
                          <input money-num ng-model="amountAdditionalMonthly" type="text" class="form-control" id="amountAdditionalMonthly">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      to your monthly payment.
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12"><hr class="divide-onetimepayment"></div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><span class="spleft">$</span></div>
                          <input money-num ng-model="amountAdditionalYearly" type="text" class="form-control" id="amountAdditionalYearly">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      as an extra yearly payment occurring every
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        
                          <ng-bs3-datepicker id="dateAdditionalYearly" data-ng-model='dateAdditionalYearly' date-min-view-mode="months" date-view-mode="months" date-format="MMM" language="en-ca">

                            <button type="button" class="btn disabled btn-sm" >
                              <span class="glyphicon glyphicon-repeat"></span>
                            </button>

                          </ng-bs3-datepicker>
                        
                      </div>
                    </div>
                  </div>

                  <!--  as a one-time payment in  -->
                  <div class="row onetimepayment" ng-repeat="onetimepayment in oneTimePaymentList">
                    <div class="col-sm-12"><hr class="divide-onetimepayment"></div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><span class="spleft">$</span></div>
                          <input money-num ng-model="amountOneTimePaymentList[onetimepayment]" type="text" class="form-control" id="{{onetimepayment}}">
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      as a one-time payment in
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <ng-bs3-datepicker ng-model='dateOneTimePaymentList[onetimepayment]' date-min-view-mode="months" date-view-mode="months" date-format="MMM YYYY" language="en-ca">
                          <button type="button" class="btn btn-danger btn-sm remove-btn" ng-click="removeaOneTimePayment(onetimepayment)">
                            <span class="glyphicon glyphicon-remove"></span>
                          </button>
                        </ng-bs3-datepicker>
                      </div>
                    </div>
                  </div>
                  <!-- as a one-time payment in  -->

                  <div class="row">

                    <div class="col-sm-6">
                      <div class="form-group">
                          <button type="button" ng-click="addaOneTimePayment()" class="btn btn-info bt-add-more-one-time-payment">
                            <span class="glyphicon glyphicon-plus"></span> Add more one-time payment
                          </button>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary bt-apply-extra-payments">APPLY EXTRA PAYMENTS</button>
                      </div>
                    </div>
                    
                  </div>
                </form>
              
              </div>
            </div>

            <div class="col-sm-12 hidden-print">
              
              <button id="amortization_schedule_bt" type="button" class="btn btn-success" ng-click="showAmortizationSchedule()">
                <span class="glyphicon glyphicon-collapse-down"></span> SHOW AMORTIZATION SCHEDULE
              </button>
              <br>
              <br>
              <button id="outputparameters" type="button" class="btn btn-link" ng-click="showOutputParameters()">
                <span class="glyphicon glyphicon-collapse-down"></span> Output parameters
              </button>
              <div id="collapseoutputparameters" ng-show="output_parameters_show">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="checkbox">
                      <label><input type="checkbox" ng-model="drawcharts" value="" ng-change="urlDrawcharts()">Draw charts</label>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="checkbox">
                      <label><input type="checkbox" ng-model="annualamortizationtable" value="" ng-change="urlAnnual()">Annual amortization table</label>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="checkbox">
                      <label><input type="checkbox" ng-model="monthlyamortizationtable" value="" ng-change="urlMonthly()">Monthly amortization table</label>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-sm-12" style="text-align:center">
              <div id="amortization_schedule" ng-show="amortization_schedule_show">
                <div class="row notification" ng-show="dont_show_no_result">
                  <br><br>
                  <p>Please enter data in form and press CALCULATOR button to show the result.</p>
                  <p>Or click ADD EXTRA PAYMENTS to show the form, add data in fields needed, click ADD MORE ONE-TIME PAYMENT button to add more one-time payment if needed and press APPLY EXTRA PAYMENTS button to show the result.</p>
                  <br><br>
                </div>
                <div class="row" ng-hide="dont_show_no_result">
                  <div class="col-sm-12">
                    <a type="button" class="btn btn-default hidden-print" href="javascript:window.print()">
                      <span class="glyphicon glyphicon-print" aria-hidden="true"></span> PRINT THIS SCHEDULE
                    </a>
                    <br>
                    <p style="text-align:left" class="visible-print-block"><span class=" glyphicon glyphicon-home"></span> http://loancalculator.pw </p>
                    <br>
                  </div>
                  <div class="col-sm-12 showbriefinfo">

                    <div class="row" ng-show="drawcharts">
                      <div class="col-sm-12">
                        <div google-chart chart="chartObject" class="chart"></div>
                      </div>
                    </div>
                    <div class="row" ng-show="drawcharts">
                      <div class="col-sm-12">
                        <br>
                      </div>
                    </div>
                    <div class="row" ng-show="drawcharts">
                      <div class="col-sm-12">
                        <div google-chart chart="lineYearlyAmortizationChartObject" ng-show="annualamortizationtable" class="chart"></div>
                      </div>
                    </div>
                    <div class="row" ng-show="drawcharts">
                      <div class="col-sm-12">
                        <div google-chart chart="lineYearlyBalanceChartObject" ng-show="annualamortizationtable" class="chart"></div>
                      </div>
                      <div class="col-sm-12 visible-print-block" ng-show="annualamortizationtable && !monthlyamortizationtable">
                        <br><br><br>
                        <br>
                      </div>
                    </div>
                    
                    <!-- <div class="row" ng-show="drawcharts">
                      <div class="col-sm-12">
                        <h4>YEARLY AMORTIZATION CHART</h4>
                        <div google-chart chart="lineYearlyAmortizationAnnotationChartObject" ng-show="annualamortizationtable" class="chart"></div>
                      </div>
                    </div> -->
                    
                    <!-- <div class="row" ng-show="drawcharts">
                      <div class="col-sm-12">
                        <div google-chart chart="lineYearlyAmortizationFullChartObject" ng-show="annualamortizationtable" class="chart"></div>
                      </div>
                    </div> -->
                    

                    <div class="row" ng-show="drawcharts">
                      <div class="col-sm-12">
                        <div google-chart chart="lineMonthlyAmortizationChartObject" ng-show="monthlyamortizationtable" class="chart"></div>
                      </div>
                      <div class="col-sm-12 visible-print-block" ng-show="monthlyamortizationtable && annualamortizationtable">
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                      </div>
                    </div>
                    <div class="row" ng-show="drawcharts">
                      <div class="col-sm-12">
                        <div google-chart chart="lineMonthlyBalanceChartObject" ng-show="monthlyamortizationtable" class="chart"></div>
                      </div>
                      <div class="col-sm-12 visible-print-block" ng-show="monthlyamortizationtable && !annualamortizationtable">
                        <br><br><br>
                      </div>
                    </div>
                    <div class="row" ng-show="drawcharts">
                      <div class="col-sm-12">
                        <br><br>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-sm-6">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <h4>LOAN DATA INFORMATION</h4>
                          </li>
                          <li class="list-group-item">
                            {{homevalue | currency}}<br>
                            Home value
                          </li>
                          <li class="list-group-item">
                            {{downpayment | currency}} ({{downpaymentpercent}}%)<br>
                            Down payment
                          </li>
                          <li class="list-group-item">
                            {{loanamount | currency}}<br>
                            Loan amount
                          </li>
                          <li class="list-group-item">
                            {{interestrateperyear}}%<br>
                            Interest rate per year
                          </li>
                          <li class="list-group-item">
                            {{pmi | currency}} ({{pmipercent}}%)<br>
                            PMI per year
                          </li>
                          <li class="list-group-item">
                            {{pmimonths}}<br>
                            Months of PMI (till {{pmi_ofday}})
                          </li>
                          <li class="list-group-item">
                            {{propertytaxs | currency}} ({{propertytaxspercent}}%)<br> 
                            Property taxs per year
                          </li>
                          <li class="list-group-item">
                            {{homeinsurance | currency}} ({{homeinsurancepercent}}%)<br>
                            Home insurance per year
                          </li>
                          <li class="list-group-item">
                            {{hoadues | currency}}<br>
                            HOA dues per month
                          </li>
                          <li class="list-group-item">
                            {{loanterminyears}}<br>
                            Loan term in years
                          </li>
                          <li class="list-group-item">
                            {{loanterminmonths}}<br>
                            Loan term in months
                          </li>
                          <li class="list-group-item">
                            {{loanstartdate}}<br>
                            Loan start date
                          </li>
                        </ul>
                      </div>

                      <div id="extra-payments-information" ng-show="extra_payments_information_show" class="col-sm-6">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <h4>EXTRA PAYMENTS INFORMATION</h4>
                          </li>
                          <li class="list-group-item" ng-show="amountAdditionalMonthly">
                            Plus {{amountAdditionalMonthly | currency}} to your monthly payment.<br>
                            {{amountAdditionalMonthly_count}} times (from {{loanstartdate}} to {{enddate_amountAdditionalMonthly}})
                          </li>
                          <li class="list-group-item" ng-show="amountAdditionalYearly && dateAdditionalYearly">
                            Plus {{amountAdditionalYearly | currency}} as an extra yearly payment occurring every {{dateAdditionalYearly}}<br>
                            {{amountAdditionalYearly_count}} times (from {{startdate_amountAdditionalYearly}} to {{enddate_amountAdditionalYearly}})
                          </li>
                          <li class="list-group-item" ng-repeat="itp in oneTimePaymentList" ng-if="copareDate(dateOneTimePaymentList[itp])">
                            Plus {{amountOneTimePaymentList[itp] | currency}} as a one-time payment in {{dateOneTimePaymentList[itp]}}
                          </li>
                          <li class="list-group-item">
                            TOTAL EXTRA PAYMENT {{totalAmountExtraPayment | currency}}
                          </li>
                        </ul>
                      </div>

                      <div class="col-sm-6">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <h4>LOAN PAYMENT SUMMARY</h4>
                          </li>
                          <li class="list-group-item">
                            {{monthly_payment | currency}}<br>
                            Monthly payment
                          </li>
                          <li class="list-group-item">
                            {{pmi/12 | currency}}<br>
                            Monthly PMI ({{pmimonths}} times, till {{pmi_ofday}})
                          </li>
                          <li class="list-group-item">
                            {{propertytaxs/12 | currency}}<br>
                            Monthly property taxs
                          </li>
                          <li class="list-group-item">
                            {{homeinsurance/12 | currency}}<br>
                            Monthly home insurance
                          </li>
                          <li class="list-group-item">
                            {{hoadues | currency}}<br>
                            Monthly HOA dues
                          </li>
                          <li class="list-group-item">
                            {{monthly_pmi_taxs_insurance_hoa | currency}}<br>
                            Monthly TAXS INSURANCE PMI HOA (TAXS ...)
                          </li>

                          <li class="list-group-item">
                            {{monthly_principal_interest | currency}}<br>
                            Monthly Principal & Interest
                          </li>
                          <li class="list-group-item">
                            {{months}}<br>
                            Number of Payments
                          </li>
                          <li class="list-group-item">
                            {{total_pmi_taxs_insurance_hoa_paid | currency}}<br>
                            Total TAXS INSURANCE PMI HOA Paid
                          </li>
                          <li class="list-group-item">
                            {{total_interest_paid | currency}}<br>
                            Total Interest Paid
                          </li>
                          <li class="list-group-item">
                            {{total_principal_paid | currency}}<br>
                            Total Principal Paid
                          </li>
                          <li class="list-group-item">
                            {{total_paid | currency}}<br>
                            Total Payments
                          </li>
                          
                          <li class="list-group-item">
                            {{payoffdate}}<br>
                            Pay-off Date
                          </li>
                        </ul>
                      </div>

                      <div id="loan-extra-payment-summary" ng-show="loan_extra_payment_summary_show"  class="col-sm-6">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <h4>LOAN EXTRA PAYMENTS SUMMARY</h4>
                          </li>
                          <li class="list-group-item">
                            {{extrapayment_monthly_payment | currency}}<br>
                            Monthly Payment
                          </li>
                          <li class="list-group-item">
                            {{pmi/12 | currency}}<br>
                            Monthly PMI ({{extra_payment_pmimonths}} times, till {{extra_payment_pmi_ofday}})
                          </li>
                          <li class="list-group-item">
                            {{propertytaxs/12 | currency}}<br>
                            Monthly property taxs
                          </li>
                          <li class="list-group-item">
                            {{homeinsurance/12 | currency}}<br>
                            Monthly home insurance
                          </li>
                          <li class="list-group-item">
                            {{hoadues | currency}}<br>
                            Monthly HOA dues
                          </li>
                          <li class="list-group-item">
                            {{monthly_pmi_taxs_insurance_hoa | currency}}<br>
                            Monthly TAXS INSURANCE PMI HOA (TAXS ...)
                          </li>

                          <li class="list-group-item">
                            {{monthly_principal_interest | currency}}<br>
                            Monthly Principal & Interest
                          </li>
                          <li class="list-group-item">
                            {{extrapayment_months}}<br>
                            Number of Payments
                          </li>
                          <li class="list-group-item">
                            {{extrapayment_total_pmi_taxs_insurance_hoa_paid | currency}}<br>
                            Total TAXS INSURANCE PMI HOA Paid
                          </li>
                          
                          <li class="list-group-item">
                            {{extrapayment_total_interest_paid | currency}}<br>
                            Total Interest Paid
                          </li>
                          <li class="list-group-item">
                            {{total_principal_paid | currency}}<br>
                            Total Principal Paid
                          </li>
                          <li class="list-group-item">
                            {{extrapayment_total_paid | currency}}<br>
                            Total Payments
                          </li>
                          <li class="list-group-item">
                            {{extrapayment_payoffdate}}<br>
                            Pay-off Date
                          </li>
                          <li class="list-group-item">
                            {{(total_interest_paid - extrapayment_total_interest_paid) | currency}}<br>
                            Total interest savings
                          </li>
                          <li class="list-group-item">
                            {{total_pmi_taxs_insurance_hoa_paid - extrapayment_total_pmi_taxs_insurance_hoa_paid | currency}}<br>
                            Total TAXS INSURANCE PMI HOA savings
                          </li>
                          <li class="list-group-item">
                            {{((total_pmi_taxs_insurance_hoa_paid - extrapayment_total_pmi_taxs_insurance_hoa_paid) + (total_interest_paid - extrapayment_total_interest_paid)) | currency}}<br>
                            Total savings
                          </li>
                        </ul>
                      </div>

                    </div>
                  </div>
                  <br><br>

                  <div class="col-sm-12" ng-show="annualamortizationtable">
                    <h4>Yearly Amortization Schedule</h4>
                    <br>
                    <table class="table table-condensed table-hover">
                      <thead>
                        <tr>
                          <th>DATE</th>
                          <th>PAYMENT</th>
                          <th>PRINCIPAL</th>
                          <th>INTEREST</th>
                          <th ng-show="extra_payments_information_show">EXTRA</th>
                          <!-- <th>TOTAL INTEREST</th> -->
                          <th>TAXS ...</th>
                          <th>BALANCE</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="yearly_amortization in yearly_amortization_schedule">
                          <td>{{yearly_amortization.yearly_date}}</td>
                          <td>{{yearly_amortization.yearly_payment | currency}}</td>
                          <td>{{yearly_amortization.yearly_principal | currency}}</td>
                          <td>{{yearly_amortization.yearly_interest | currency}}</td>
                          <td ng-show="extra_payments_information_show">{{yearly_amortization.yearly_extrayearlypayment | currency}}</td>
                          <!-- <td>{{yearly_amortization.yearly_total_interest | currency}}</td> -->
                          <td>{{yearly_amortization.yearly_pmi_taxs_insurance_hoa | currency}}</td>
                          <td>{{yearly_amortization.yearly_balance | currency}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="col-sm-12" ng-show="monthlyamortizationtable">
                    <!-- <h3>Monthly Amortization Schedule</h3> -->
                    <h4>MONTHLY AMORTIZATION SCHEDULE</h4>
                    <br>
                    <table class="table table-condensed table-hover">
                      <thead>
                        <tr>
                          <!-- <th>ID</th> -->
                          <th>DATE</th>
                          <th>PAYMENT</th>
                          <th>PRINCIPAL</th>
                          <th>INTEREST</th>
                          <th ng-show="extra_payments_information_show">EXTRA</th>
                          <!-- <th>TOTAL INTEREST</th> -->
                          <th>TAXS ...</th>
                          <th>BALANCE</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="amortization in amortization_schedule" class="{{amortization.payment_date}}">
                          <!-- <td>{{$index + 1}}</td> -->
                          <td>{{amortization.payment_date}}</td>
                          <td>{{amortization.monthly_payment | currency}}</td>
                          <td>{{amortization.principal_part | currency}}</td>
                          <td>{{amortization.interest_part | currency}}</td>
                          <td ng-show="extra_payments_information_show">{{amortization.extramonthlypayment | currency}}</td>
                          <!-- <td>{{amortization.total_interest | currency}}</td> -->
                          <td>{{amortization.pmi_taxs_insurance_hoa | currency}}</td>
                          <td>{{amortization.balance | currency}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="col-sm-12 hidden-print">
                    <p style="text-align:right" class="visible-print-block">http://loancalculator.pw <span class=" glyphicon glyphicon-home"></span></p>
                    <a type="button" class="btn btn-default" href="javascript:window.print()">
                      <span class="glyphicon glyphicon-print" aria-hidden="true"></span> PRINT THIS SCHEDULE
                    </a>
                    <br><br>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 hidden-print">
          <h2 style="display:none">Advertisement</h2>
        </div>
      </div>
      
      <div class="row hidden-print">
        <div class="col-md-12">
          <h2 style="display:none">Advertisement</h2>
        </div>
      </div>
      <footer>
        <div class="row">
          <div class="col-md-6">
            <p>© 2016 Loancalculator.pw, Inc.</p>
          </div>
          <div class="col-md-6 hidden-print">
            
            <!-- Likeus-footer.html -->
            <ul class="nav navbar-nav navbar-right">
            <li>
              <div class="fb-like" data-href="http://loancalculator.pw" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            </li>
            <li>
              <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://loancalculator.pw" data-text="This loan calculator will help you determine the monthly payments on a loan" data-via="loan_calc">Tweet</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </li>
            <li>
              <!-- Place this tag where you want the share button to render. -->
              <div class="g-plus" data-action="share" data-annotation="bubble"></div>
            </li>
            <div id="likeus2"></div>
          </ul>
          <!-- End likeus-footer.html -->

          </div>
        </div>
      </footer>
    </div> <!-- /container -->
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.9.1.min.js"></script>
    <script>//var j = jQuery.noConflict();</script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/angular.min.js"></script>
    <script src="js/angular-animate.min.js"></script>
    <script src="js/angular-route.min.js"></script>
    <script src="js/angular-aria.min.js"></script>
    <script src="js/angular-messages.min.js"></script>
    <script src="js/angular-material.min.js"></script>
    <script src='js/fr-ca.min.js' charset='utf-8'></script>
    <script src='js/ng-bs3-datepicker.min.js' charset='utf-8'></script>
    
    <script src="js/ng-google-chart.min.js"></script>
    <script src="js/mortgage-calculator.js"></script>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>