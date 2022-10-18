 <?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?><br><br><br><br><br>
 <style type="text/css">
 	.spanColor{
        color: red;
    }
    h4{
    	color: black;
    }
 </style>
  <?php
                $result=null;

                $sqlQuery="SELECT * FROM loan_master ";

                if(isset($_GET['loan_id']) && $_GET['loan_id'] !="" ){
                    $sqlQuery=$sqlQuery."where loan_id = ".$_GET['loan_id']." ";
             $query = mysqli_query($conn,$sqlQuery);
                 $result = mysqli_fetch_array($query);
                }else{
                 $sqlQuery=null;
                }
        


                 
                                ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function () {

       $("#loan_id").on('keyup', function (e) {
           if (e.keyCode == 13) { 
                     
               window.location.href="InterestPayment.php?loan_id="+$('#loan_id').val();
               
           } 
       });

   });

 </script>
 <div class="container">
 	<h4>Interest Payment</h4><br>
 	<div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="Loan No">Loan No<span class="spanColor">*</span></label> 
                           <input type="text" value="<?php echo $result["loan_id"];?>" placeholder="Loan No" id="loan_id" name="loan_id" autocomplete="off" maxlength="250" class="form-control border-input">
                        </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="Lone Date">Loan Date</label> 
                            <input type="text" value=" <?php echo $result["loan_date"];?>" placeholder="Loan Date" id="loanDate" name="loanDate" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
                </div>
                <div class="col-sm-3">
                      <div class="form-group">
                        <label for="Loan Type">Customer Name</label> 
                            <input type="text" value=" <?php echo $result["customer_name"];?>" placeholder="Customer Name" id="customerName" name="customerName" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
                </div>
                <div class="col-sm-3">
                      <div class="form-group">
                        <label for="Loan Type">Interest To Date<span class="spanColor">*</span></label> 
                            <input type="date" value=""  id="interestToDate" name="interestToDate" autocomplete="off" maxlength="250" class="form-control border-input">
                        </div>
                </div>
            </div>
           <hr style="border: 1px dashed black">
            <div class="row">
            	<div class="col-sm-6">
            		 <h4>Loan Details</h4><br>
            		 <div class="col-sm-6">
                      <div class="form-group">
                        <label for="Loan Grand Amount">Loan Grand Amount</label> 
                            <input type="text" value=" <?php echo $result["loan_receive_amount"];?>" placeholder="Loan Grand Amount" class="form-control border-input" readonly>
                        </div>
            		 </div>
            		  <div class="col-sm-6">
            		 	<div class="form-group">
                        <label for="Interest Percentage">Interest Percentage</label> 
						<input type="text" value="<?php echo $result["interest_percentage"];?>"  id="interestPercentage" name="interestPercentage" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
            		 </div>
            		  <div class="col-sm-6">
            		 	<div class="form-group">
                        <label for="Monthly Interest Amount">Monthly Interest Amount</label> 
						<input type="text" value="<?php echo $result["month_interest_amount"];?>"  id="monthInterestAmount" name="monthInterestAmount" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
            		 </div>
            		  <div class="col-sm-6">
            		 	<div class="form-group">
                        <label for="Daily Interest Amount">Daily Interest Amount</label> 
						<input type="text" value="<?php echo $result["daily_interest_amount"];?>"  id="dailyInterestAmount" name="dailyInterestAmount" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
            		 </div>
            		  <div class="col-sm-6">
            		 	
            		 </div>
            	</div>
            	<div class="col-sm-6">
            		 <h4>Payment Details</h4><br>
            		 <div class="col-sm-6">
                      <div class="form-group">
                        <label for="Loan Grand Amount">Loan Balance</label> 
                            <input type="text" value="<?php echo $result["loan_receive_amount"];?>" placeholder="Loan Grand Amount" class="form-control border-input" readonly>
                        </div>
            		 </div>
            		  <div class="col-sm-6">
            		 	<div class="form-group">
                        <label for="Interest Percentage">Interest Pay</label> 
						<input type="text" value=""  id="interestPercentage" name="interestPercentage" autocomplete="off" maxlength="250" class="form-control border-input">
                        </div>
            		 </div>
            		  <div class="col-sm-6">
            		 	<div class="form-group">
                        <label for="Monthly Interest Amount">Monthly Interest Amount</label> 
						<input type="text" value="<?php echo $result["month_interest_amount"];?>"  id="monthInterestAmount" name="monthInterestAmount" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
            		 </div>
            		  <div class="col-sm-6">
            		 	<div class="form-group">
                        <label for="Daily Interest Amount">Daily Interest Amount</label> 
						<input type="text" value="<?php echo $result["daily_interest_amount"];?>"  id="dailyInterestAmount" name="dailyInterestAmount" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
            		 </div>
            		  <div class="col-sm-6">
            		 	
            		 </div>
            	</div>
            	
            </div>
 	
 </div>
<?php  include 'footer.php';  ?>