<?php include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?>

    <div class="wrapper">
        <div class="background" style="background-image: url('assets/img/landscape.jpg');"> 
            <div class="filter-black"></div>
            <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 ">

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="demo-card">
                                <h3 class="title">Welcome</h3>
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
      <div class="modal-footer">
      
            <center><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.herf='index.php';">OK</button></center>
      
          
        </div>
      </div>
    </div>
  </div>
</div>
           
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
            $_SESSION["userName"] = $result["userName"];
           $_SESSION["userId"] = $result["id"];
           $_SESSION["fullName"] = $result["first_name"] . " " . $result["last_name"];
           
           $_SESSION["roleId"] = $result["user_role_id"];
           $_SESSION["loyaltyRewardPerc"] = 2.00;


            echo "<SCRIPT LANGUAGE='JavaScript'>                   
                    window.location.href= 'Dashboard.php'
                </SCRIPT>";
          }
        
    }
?> 