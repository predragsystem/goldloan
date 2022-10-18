<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?><br><br><br><br><br>
<style type="text/css">
	span{
		color: red;
	}
	.form-control.border-primary{
			border: 1px solid #CCC5B9;
	}
	@media (min-width: 768px) and (max-width: 768px) {
  
.card-title{
	margin-top: 120px;
	text-align:left;
	
}

}

</style>
<?php
$loanDetails = false;

		$sqlQuery="SELECT * FROM jewellery_loan as j inner join jewellery_loan_transaction as jt on j.loan_id=jt.loan_id ";
		if(isset($_GET['loan_no']) && $_GET['loan_no'] != ""){
		$sqlQuery=$sqlQuery."where j.loan_id = ".$_GET['loan_no']." ";
		// echo $sqlQuery;
		$loanDetails = true;
		
	      }else if(isset($_GET['fromDate']) && isset($_GET['toDate']) ){
		$sqlQuery=$sqlQuery."where j.loan_date > '".$_GET['fromDate']."' and j.loan_date < '".$_GET['toDate']."'";
	 
		$loanDetails = true;
		
	      }
       $query = mysqli_query($conn,$sqlQuery);
	   
	   ?>

<body>
<div class="container" >
		<h4 class="card-title" id="basic-layout-colored-form-control">Loan Report</h4><br>
		<a class="heading-elements-toggle">
			<i class="icon-ellipsis font-medium-3"></i>
		</a>
			<form action="#" method="POST" >
				<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label for="From Date">From Date</label> 
                            <input type="date"  placeholder="From Date" class="form-control border-input" id="fromDate">
                        </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="To Date">To Date</label> 
                            <input type="date" value="" placeholder="To Date" class="form-control border-input"  id="toDate">

                        </div>
				</div>
				<div class="col-sm-1">
				
                        <h4 align="center">or</h4>
                    </div>
			

<div class="col-sm-3">
			<div class="form-group" >
						<label for="Loan No">Loan No</label> 
                             <input type="text"  placeholder="Loan No" id="loan_no" name="loan_no" autocomplete="off" maxlength="250" class="form-control border-input">
                        </div>
				</div>


			</div>
			
		
			
			
			<div class="row">
			<!-- 	<div class="col-sm-6">
					<div class="form-group">
						<label for="Process Type">Process Type<span>*</span></label> 
                            <input type="text" value="" placeholder="Process Type" class="form-control border-input">
                        </div>
				</div> -->
			
				
			</div>
			<br>
			<div class="form-actions" align="center">
									<!-- <button type="reset" class="btn btn-warning mr-1" align="right" >
										<i class="icon-cross2"></i> view
									</button> -->
									<button type="button"  class="btn btn-warning mr-1" onclick="tableDataView();showdate();">View</button>
									
									 
								</div>
			
			</form><br><br>
			<div class="table-responsive" id="tableData">
			<table class="table table-bordered">
				<?php 
								if($loanDetails){
									?>
  <thead style="background-color: #40261a;
    color: white;font-size: 12px;">
    <tr>
      <th scope="col">Loan No</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Loan Date</th>
      <th scope="col">Loan Amount</th>
      <th scope="col">Transaction Date</th>
      <th scope="col">Loan Received Amount</th>
      <th scope="col">Loan Paid Amount</th>
      <th scope="col">Interest Paid Amount</th>
      <th scope="col">No Of Gram</th>
      <th scope="col">Amount Per Gram</th>



    </tr>
  </thead>
  <tbody>
  	<?php
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
    	
      <td><?php echo $result["loan_id"];?></td>
      <td><?php echo $result["customer_name"];?></td>
      <td><?php  echo $result["loan_date"];?>
	  </td>
      <td><?php echo $result["loan_receive_amount"];?></td>
      <td><?php  echo $result["loan_date"];?>
	  </td>
	  <td><?php echo $result["loan_receive_amount"];?></td>
	  <td><?php echo $result["loan_pay"];?></td>
	  <td><?php echo $result["interest_pay"];?></td>
	  <td><?php echo $result["no_of_grams"];?></td>
      <td><?php echo $result["amount_per_gram"];?></td>



	  	<?php 
							}
							?>

    </tr>
   
  </tbody>
  <?php
								$i++;
							}
						}
						?>
</table>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
	
		function tableDataView() {

	var loan_no = $('#loan_no').val();	
	  	  
	window.location.href="JewelleryLoanReport.php?loan_no="+loan_no;
	
}	

function showdate(){

	var fromDate = document.getElementById("fromDate").value;
	var toDate = document.getElementById("toDate").value;
	var loan_no = $('#loan_no').val();	
	
	window.location.href = "JewelleryLoanReport.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&loan_no="+loan_no;
	
}
</script>	

</body>

<?php  include 'footer.php';  ?>