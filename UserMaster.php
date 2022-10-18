<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?><br><br><br><br><br>
 <style type="text/css">
    .spanColor{
        color: red;
    }
	</style>
	
	<?php




if(isset($_POST['submit'])== 'Save') {

    try {

        if(($_POST['user_id']) && ($_POST['user_id'] != "")){


            $update="update user_master set 
                user_name='".$_REQUEST["userName"]."',password='".$_REQUEST["password"]."',email_id='".$_REQUEST["emailId"]."',
                phone_no='".$_REQUEST["phoneNo"]."',first_name='".$_REQUEST["firstName"]."',last_name='".$_REQUEST["lastName"]."' ,
                 modified_time=now(),modified_by=1
                 where user_id=".$_REQUEST["user_id"]." ";
				 
				   $query1 = mysqli_query($conn,$update);
         
			
          
               echo "<SCRIPT LANGUAGE='JavaScript'>    
               
					window.location.href= 'ViewUser.php'
					
					
				 
                </SCRIPT>";
          
        }else{ 

        	  $query = "insert into user_master(user_name,password,created_time,created_by,modified_time, modified_by,status,first_name,last_name,email_id,phone_no) 
        values('".$_POST['userName']."','".$_POST['password']."',now(),1,now(),1,'Active',' ".$_POST['firstName']."', '".$_POST['lastName']."', '".$_POST['emailId']."', '".$_POST['phoneNo']."')";

            
              $sqlQuery = mysqli_query($conn,$query);

              $user_id=mysqli_insert_id();

                echo "<SCRIPT LANGUAGE='JavaScript'>                   
                    window.location.href= 'ViewUser.php'
                </SCRIPT>";

        }

    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

}

?>
	

<div class="container">
        <h4 class="card-title" id="basic-layout-colored-form-control">User Master</h4><br>
        <a class="heading-elements-toggle">
            <i class="icon-ellipsis font-medium-3"></i>
        </a>
		<?php
						$result1=null;
						
						if((isset($_REQUEST['user_id'])) && ($_REQUEST['user_id'] != ""))
						{
							$sql1 = mysqli_query($conn,"select * from user_master where user_id='".$_REQUEST["user_id"]."'");
							$result1 = mysqli_fetch_array($sql1);
						}						  
					?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="formId" name="id" method="POST" >
			<input type="hidden" name="user_id" id="user_id" value='<?php echo $result1["user_id"]; ?>' />

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="User Name">User Name<span class="spanColor">*</span></label> 
                            <input type="text"  placeholder="User Name" id="userName"  name="userName" autocomplete="off" class="form-control border-input" required maxlength="25" value='<?php echo $result1["user_name"]; ?>' oninput="this.value = this.value.replace(/[^a-z A-Z]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
								<span id="userNameErroId" style="color: red;font-weight: bold;" </span>
                        </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="Lone Date">Password<span class="spanColor">*</span></label> 
                            <input type="password"  placeholder="Password" value='<?php echo $result1["password"]; ?>' id="password" name="password" autocomplete="off" maxlength="25" class="form-control border-input" pattern=".{6,}" title="Six or more characters"  required >
                        </div>
                </div>
				</div>
				 <div class="row">
                <div class="col-sm-6">
                      <div class="form-group">
                        <label for="Confirm Password">Confirm Password<span class="spanColor">*</span></label> 
						 <input type="password" placeholder="Confirm Password" id="confirmPassword" name="confirmPassword" autocomplete="off" maxlength="25" pattern=".{6,}" title="Six or more characters" class="form-control border-input" value='<?php echo $result1["password"]; ?>' required>
						 <span id="confirmPasswordErroId" style="color: red;font-weight: bold;" ></span>
                        </div>
                </div>
            
           
                <div class="col-sm-6">
                    <div class="form-group">
                    <label for="First Name">First Name<span class="spanColor">*</span></label> 
                            <input type="text"  placeholder="First Name" class="form-control border-input" id="firstName" name="firstName" value='<?php echo $result1["first_name"]; ?>' autocomplete="off" required maxlength="25" oninput="this.value = this.value.replace(/[^a-z A-Z]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        </div>
                </div>
				</div>
				 <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="Last Name">Last Name<span class="spanColor">*</span></label> 
                            <input type="text"  placeholder="Last Name" id="lastName"  value='<?php echo $result1["last_name"]; ?>' name="lastName" autocomplete="off" class="form-control border-input" required maxlength="25" oninput="this.value = this.value.replace(/[^a-z A-Z]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                          
                        </div>
                </div>
                <div class="col-sm-6">
            <div class="form-group">
                        <label for="Phone No">Phone No<span class="spanColor">*</span></label> 
                            <input type="text"  placeholder="Phone No" id="phoneNo" value='<?php echo $result1["phone_no"]; ?>' name="phoneNo" autocomplete="off"  class="form-control border-input" required  maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                   <div class="form-group">
                        <label for="Email Id">Email Id<span class="spanColor">*</span></label> 
						
                            <input type="text"  placeholder="Email Id" id="emailId" name="emailId" value='<?php echo $result1["email_id"]; ?>' autocomplete="off"  class="form-control border-input"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
							
                        </div>
                </div>
				 
						 <div class="col-sm-6">
                        <div class="form-group">
                        <label>Status</label><span class="spanColor">*</span>
                       <div style="border: 2px solid #ccc5b9;"> <select id="status" name="status" class="form-control  border-primary" value="" required>
                    <option value="">--Choose--</option>
                    <option value="Active" <?php if( $result1['status']=='Active'){ echo "selected ";}?> >Active</option>
                    <option value="Inactive" <?php if( $result1['status']=='Inactive'){ echo "selected ";}?>>Inactive </option>
                </select></div>
                       
                        </div>
                     </div>
              
				
                </div>
				<div class="button" align="center">
					<input type="submit" class="btn btn-success" value="Save" name="submit" onclick="return Validate()"/>
								
									<button type="reset" class="btn btn-warning mr-1" >
										<i class="icon-cross2"></i> Clear
									</button>
									</div>
				</form>
			<div class="modal fade" id="smallAlertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-small ">
    <div class="modal-content">
      <div class="modal-header no-border-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body text-center">
        <h5>updated successfully </h5>
      </div>
      <div class="modal-footer">
      
            <center><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.herf='index.php';">OK</button></center>
      
          
        </div>
      </div>
    </div>
  </div>
				</div>
				
			
<script>
    function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;
        if (password != confirmPassword) {
            document.getElementById("confirmPasswordErroId").innerHTML = "Password Does Not Match.";
            return false;
        }
        return true;
    }
			
	</script>		
<?php  include 'footer.php';  ?>