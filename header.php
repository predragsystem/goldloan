<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Gold Loan Software</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="bootstrap3/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/ct-paper.css" rel="stylesheet"/>
    <link href="assets/css/demo.css" rel="stylesheet" />
     <link href="assets/css/style.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/toastr.css">

  <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/toastr.min.css">

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> -->
    <link href="assets/css/themify-icons.css" rel="stylesheet">
<?php
  session_start();

  if(isset($_SESSION["userId"]) && ($_SESSION["userId"] != "")){
 
  }else{
    echo "<SCRIPT LANGUAGE='JavaScript'>                   
    window.location.href= 'index.php'
  </SCRIPT>";
  }
?>
</head>
<style>
 @media (min-width: 768px) and (max-width: 992px) {
body{
  margin-bottom: 180px;
          margin-top: 100px;

}
}

body::before {
    content: '';
    width: 100%;
    height: 100%;
    display: block;
    z-index: -1;
    background: url('assets/img/632225.jpg');
    background-size: cover;
    -webkit-filter: blur(10px);
    filter: blur(10px);
    position: absolute !important;
    top: 0;
    right: 0;
}
</style>
<body>
 
<nav class="navbar navbar-ct-danger navbar-fixed-top" role="navigation-demo" id="demo-navbar">
  <div class="container-header">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="Dashboard.php">
           <div class="logo-container">
                <div class="logo">
                    <img src="assets/img/logo/logo7.png" alt="Creative Tim Logo">
                </div>
                <div class="brand">
                    Loan Software
                </div>
            </div>
      </a>
    </div>

<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navigation-example-2">
      <ul class="nav navbar-nav navbar-right">
 
         <li>
            <a class="btn btn-danger btn-simple" href="Dashboard.php">Dashboard</a>
          </li>
         <li><a class="btn btn-danger btn-simple" href="JewelleryLoan.php">New Loan</a></li>
           
          <li class="dropdown">
            <a href="#" class="dropdown-toggle btn btn-simple btn-danger" data-toggle="dropdown">
              Loan Payment<b class="caret"></b>
            </a> 
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a href="JewelleryLoanPayment.php"> Loan Payment</a></li>
               <li><a href="JewelleryLoanClose.php"> Loan Close</a></li>
            </ul>
        </li>
         <li><a class="btn btn-danger btn-simple" href="LoanReport.php"> Loan Report</a></li>
        
      
          <li>
            <a href="logout.php" class="btn btn-danger btn-fill"></i>Log Out</a>
          </li>
       </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-->
</nav>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>

<script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>

<!--  Plugins -->
<script src="assets/js/ct-paper-checkbox.js"></script>
<script src="assets/js/ct-paper-radio.js"></script>
<script src="assets/js/bootstrap-select.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/ct-paper-bootstrapswitch.js"></script>
<script src="assets/js/jquery.tagsinput.js"></script>
<script src="assets/js/ct-paper.js"></script>


  <script src="app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/extensions/toastr.min.js" type="text/javascript"></script>



  <script type="text/javascript">
    
     function showSucessMessage(message){

      toastr.success(message, "INFORMATION", {
        positionClass: "toast-top-center",
        containerId: "toast-top-center"
      });      
    }
  </script>