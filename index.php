
<!doctype html>

<html lang="en">
 <?php 
    session_start();
    include 'database/DatabaseConfig.php';
?> 
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>Apka Munim - Best Girvi Loan Managmant Software</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
     <link href="bootstrap3/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/ct-paper.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
    <link href="assets/css/demo.css" rel="stylesheet" /> 
	
    <link href="assets/css/examples.css" rel="stylesheet" /> 
         
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
      <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>

<script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>

<!--  Plugins -->
<script src="assets/js/ct-paper-checkbox.js"></script>
<script src="assets/js/ct-paper-radio.js"></script>
<script src="assets/js/bootstrap-select.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
      <style type="text/css">
          .background::before {
    content: '';
    width: 100%;
    height: 100%;
    display: block;
    z-index: -1;
    background: url('assets/img/landscape.jpg');
    background-size: cover;
    -webkit-filter: blur(3px);
    filter: blur(3px);
    position: absolute !important;
    top: 0;
    right: 0;
}
      </style>
</head>
<body class="full-screen login">
    <nav class="navbar navbar-ct-transparent navbar-fixed-top" role="navigation-demo" id="register-navbar">
      <div class="container tim col-xs-offset-4">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header ">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigation-example-2">
          
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-->
    </nav> 
    
    <div class="wrapper">
        <div class="background"> 
            <div class="filter-black"></div>
            <div class="container tim">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-6  ">

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="demo-card">
                                <div class="logo ">
                    <img src="assets/img/logo/apka_munim.png" style="width:100%;" alt="Best Girvi Loan Managment">
                </div>
                                <form class="register-form">
                                    <label>Username</label>
                                    <input type="text" class="form-control" placeholder="Username" name="user-name" id="user-name" required="required"
                                    >

                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="user-password" id="user-password" required="required">
                                   <!--  <input type="submit" name="submit"  id="submit" class="btn btn-danger btn-block" value="Register">  -->
                                     
							<button type="submit" class="btn btn-danger btn-block" id="submit" value="Save" name="submit" >LOGIN</button>
                        
                         
                                </form>
                                
                            </div>

                        </form>
                        </div>
                    </div>
                    <div class="text-center "><p>Copywrite @ <a href="http://www.predragsystem.in" target="_blank" class="text-danger">PreDrag System</a></p></div>
            </div>     
             <div class="modal fade" id="smallAlertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-small ">
    <div class="modal-content">
      <div class="modal-header no-border-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body text-center">
        <h5>Invaild Username Or Password </h5>
      </div>
       <center><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.herf='index.php';">OK</button></center><br><br>
      </div>
    </div>
  </div>
</div>
            <!-- <div class="demo-footer text-center">
                    <h6>&copy; 2016, made with <i class="fa fa-heart heart"></i> by Creative Tim</h6>
            </div> -->
        </div>
    </div>      

</body>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <script src="app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script> 
<script src="assets/js/ct-paper.js"></script>
  <script src="app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
    <script src="app-assets/js/scripts/extensions/sweet-alerts.min.js" type="text/javascript"></script> -->
 
       
</html>

   <?php   

    if(isset($_POST['submit'])== 'Save') {

          $query = mysqli_query($conn,"select * from user_master where 
                    user_name = '".$_POST["user-name"]."' and 
                    password ='".$_POST["user-password"]."' and status = 'Active'");
          
          $count = mysqli_num_rows($query);        
          if($count == 0) {
                echo "<SCRIPT LANGUAGE='JavaScript'>                   
                   $('#smallAlertModal').modal('show');
                </SCRIPT>";
          } else {           

            $result = mysqli_fetch_array($query);
            $_SESSION["userName"] = $result["username"];
           $_SESSION["userId"] = $result["user_id"];
           $_SESSION["fullName"] = $result["first_name"] . " " . $result["last_name"];
           
           $_SESSION["roleId"] = $result["user_role_id"];
         


            echo "<SCRIPT LANGUAGE='JavaScript'>      
                       
                    window.location.href= 'Dashboard.php'
                </SCRIPT>";

          }
        
    }
?> 