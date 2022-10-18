<!-- <style>
@media (min-width:320px){
 .card-body{
margin-bottom: 200px;
 }
   
}
@media (min-width:425px){
 
  .card-body{
  	margin-bottom: 200px;

  } 
}

</style>

 -->


<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?><br><br><br><br><br>
 
	   
 
	   <div class="content-body"><!-- Basic Tables start -->

	<div class="app-content content container-fluid" >
  <div class="content-wrapper">
    <div class="content-header row">
    
      <div class=" col-md-6 col-xs-10 ">
        <h4 class="content-header-title" style="
     color: #000000;"
>View User</h4 >
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-10" style="text-align: right;">
          <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" 
          onclick="window.location.href='UserMaster.php'" >
            <i class="icon-check2"></i>Add User</button>
        </div>
      </div>
    </div>
	<div class="row">
	  <div class="col-xs-1"></div>

	    <div class="col-xs-10">
	        <div class="card card-with-shadow">
	            
	            <div class="card-body collapse in">
	               
	                <div class="table-responsive">
	                    <table class="table mb-0">
				
								

 <thead>	
    <tr>
	  <th><b>ID</b></th>
	  <th><b>Name</b></th>
	  <th><b>Email Id</b></th>
	  <th><b>Phone No</b></th>
     <th><b></b></th>
      
    </tr>
  </thead>
  <tbody>
  	<?php
	 $query = mysqli_query($conn,"select * from user_master");
		$count = mysqli_num_rows($query);
							if($count == 0)
							{
								?>
								<tr>
									<td  colspan="8" style="text-align: center;">
										No Record Found For Your Search.
									</td>
								</tr>
								<?php
							}
							else
							{
								$i=1;
								while($result = mysqli_fetch_array($query))
								{
									?>	
			
    <tr>
    	
     
	<th scope="row"><?php echo $result["user_id"];?></th>
		                              
      <td><?php echo $result["first_name"];echo $result["last_name"];?></td>
	  <td><?php echo $result["email_id"];?></td>
	  <td><?php echo $result["phone_no"];?></td>
	   <td>
		                                	<div class="form-actions right">											
												<button type="submit" class="btn btn-primary" 
												onclick="window.location.href='UserMaster.php?user_id=<?php echo $result["user_id"];?>'">
													<i class="icon-check2"></i> Edit
												</button>
											</div>
		                                </td>
	 

	  	

    </tr>
   
	                            <?php
								  $i++;
		                          }
		                          }
		                         ?>
  </tbody>
 
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php  include 'footer.php';  ?>