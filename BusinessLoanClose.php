<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?><br><br><br><br><br>
 <style type="text/css">
  .spanColor{
        color: red;
    }
    h4{
      color: black;
    }
    @media screen and (min-device-width: 320px) and (max-device-width: 767px) { 
.mobileView{
  display: block;
}
}
 @media screen and (min-device-width: 768px)  { 
.mobileView{
  display: none;
}
}

 </style>
 <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-small ">
    <div class="modal-content">
      <div class="modal-header no-border-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body text-center">
        <h5>Invaild ID </h5>
      </div>
       <center><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.herf='BusinessLoanClose.php';">OK</button></center><br><br>
      </div>
    </div>
  </div>
  <?php
                $result=null;
$balance=0;
                $sqlQuery="SELECT  lt.*,bl.*,(loan_grand_amount-paid_amount ) AS loan_bal_amt FROM business_loan as bl inner join business_loan_transaction lt on lt.loan_id=bl.loan_id  ";


                if(isset($_GET['loan_id']) && $_GET['loan_id'] !="" ){
                    $sqlQuery=$sqlQuery."where bl.loan_id = ".$_GET['loan_id']."  and bl.status = 'ACTIVE' ";
             $query = mysqli_query($conn,$sqlQuery);
             $cquery=mysqli_num_rows($query);
    if($cquery== 0){
     echo "<SCRIPT LANGUAGE='JavaScript'>    
        $('#smallModal').modal('show');
        
        </SCRIPT>";
   }
                 $result = mysqli_fetch_array($query);
                  
               $balselect=mysqli_num_rows(mysqli_query($conn,"select * from business_loan_transaction where loan_id = ".$_GET['loan_id']." "));

	 $balancetwo="select max(transaction_date) as maxdate,datediff(now(),max(transaction_date)) as ddate, TIMESTAMPDIFF(MONTH,NOW(),max(transaction_date))+1 as mdate from business_loan_transaction where loan_id= ".$_GET['loan_id']."";
	
	 $bal=mysqli_query($conn,$balancetwo);
	   $cnt=mysqli_num_rows($bal);
	   if(empty($balselect)){
      if($result['interest_type']==365){
		   $balance=round($result['loan_bal_amt']*(($result['interest_percentage']/100)/365),2);
      }else if($result['interest_type']==1){
        $balance=round($result['loan_bal_amt']*(($result['interest_percentage']/100)/1),2);
      }

		   }
	   else{
	   $balval=mysqli_fetch_array($bal);
      if($result['interest_type']==365){
	   $balance=round($balval['ddate']*$result['loan_bal_amt']*(($result['interest_percentage']/100)/365),2);
	   }else if($result['interest_type']==1){
      $balance=round($balval['mdate']*$result['loan_bal_amt']*(($result['interest_percentage']/100)/1),2);
	   }
	}
}
  else{
	 $sqlQuery=null;
	}
	
                 
                                ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script type="text/javascript">
  $(document).ready(function () {

       $("#loan_id").on('keyup', function (e) {
           if (e.keyCode == 13) { 
                     
               window.location.href="BusinessLoanClose.php?loan_id="+$('#loan_id').val();
               
           } 
       });

   });
function totalAmount(){
   
       var interest = Number(document.getElementById("interestPay").value);
       var loan =  Number(document.getElementById("loanPay").value);
          total = interest + loan;
          document.getElementById("totalPay").value = total + ".00";
     var date = new Date();
 
// GET YYYY, MM AND DD FROM THE DATE OBJECT
var yyyy = date.getFullYear().toString();
var mm = (date.getMonth()+1).toString();
var dd  = date.getDate().toString();
 
// CONVERT mm AND dd INTO chars
var mmChars = mm.split('');
var ddChars = dd.split('');
 
// CONCAT THE STRINGS IN YYYY-MM-DD FORMAT
var datestring = yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);

  document.getElementById('closingDate').value=datestring;
      }
  function loan() {

  var loan = $('#loan_id').val();  
        alert(loan);
  window.location.href="BusinessLoanClose.php?loan_id="+loan;
  
} 
 
 </script>

 <?php
if(isset($_POST['submit']) == 'Save') { 

    $query = "insert into business_loan_close(loan_id,closing_date,loan_pay,total_pay,payment_mode,loan_balance) values(".$_POST['loan_no'].",'".$_POST['closingDate']."',".$_POST['loanPay'].",".$_POST['totalPay'].",'".$_POST['paymentType']."',".$_POST['loanBalance'].")";
  
     // echo $query;
    $sqlQuery=mysqli_query($conn,$query);
   
   
        $status = "update business_loan set status = 'ClOSED' where loan_id = ".$_REQUEST["loan_id"]." ";

     $status1=mysqli_query($conn,$status);
 
     

       echo "<SCRIPT LANGUAGE='JavaScript'>                   
                 showSucessMessage('Payment Successfully Saved');
                </SCRIPT>";
     
}
  
?>
 <body onload="totalAmount()">
 <div class="container">
  <h4>Business Loan Close</h4><br>
  <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="Loan No">Loan No<span class="spanColor">*</span></label> 
                           <input type="text" value="<?php echo $result["loan_id"];?>" placeholder="Loan No" id="loan_id" name="loan_id" autocomplete="off" maxlength="250" class="form-control border-input">
                        </div>
                        <center>
                     <button type="button" class="btn btn-warning mr-1 mobileView" onclick="loan();">Look Up</button>
                           </center>
                        
 
                </div>
                <div class="col-sm-3">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                       <input type="hidden" name="loan_id" id="loan_id" value="<?php echo $result["loan_id"];?>">
                    <div class="form-group">
                      <input type="hidden" name="loan_no" id="loan_no" value="<?php echo $result["loan_id"];?>">
                        <label for="Lone Date">Loan Date</label> 
                            <input type="text" value=" <?php if(!empty($result["loan_date"])){
								
							echo date('d-m-Y',strtotime($result["loan_date"]));}?>" placeholder="Loan Date" id="loanDate" name="loanDate" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
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
                        <label for="Loan Type">Date<span class="spanColor">*</span></label> 
                            <input type="date" value=""  id="closingDate" name="closingDate" autocomplete="off" maxlength="250" class="form-control border-input" onload="getdate()" required>
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
                            <input type="text" value=" <?php echo number_format($result["loan_grand_amount"],2);?>" placeholder="Loan Grand Amount" class="form-control border-input" readonly>
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
            <input type="text" value="<?php echo number_format($result["month_interest_amount"],2);?>"  id="monthInterestAmount" name="monthInterestAmount" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
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
                        <label>Loan Balance</label> 
                            <input type="text" value="<?php echo $result["loan_bal_amt"];?>" id="loanBalance" name="loanBalance" class="form-control border-input" readonly>
                        </div>
                 </div>
                     
                 
                  <div class="col-sm-6">
                  <div class="form-group">
                        <label>Loan Pay</label> 
                        <input type="text" value="<?php echo $result["loan_bal_amt"];?>"  id="loanPay" name="loanPay" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
                 </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                        <label>Total Pay</label> 
                        <input type="text" value="<?php echo $result["loan_bal_amt"];?>"  id="totalPay" name="totalPay" autocomplete="off" maxlength="250" class="form-control border-input" onkeyup ="totalAmount();" readonly>
                        </div>
                 </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                        <label>Payment Mode</label><span class="spanColor">*</span>
                       <div style="border: 2px solid #ccc5b9;"> <select id="paymentType" name="paymentType" class="form-control  border-primary" value="" required>
                    <option value="">--Choose--</option>
                    <option value="CASH">Cash</option>
                    <option value="CARD">Card </option>
                </select></div>
                       
                        </div>
                 </div>
              </div>
              
            </div><br>
            <center>
            <input type="submit" class="btn btn-success" value="Save" name="submit">
              <button type="reset" class="btn btn-warning mr-1" align="right" >
                  <i class="icon-cross2"></i>Clear
              </button>
              </center>
            </form>
  
 </div>
 </body><br>
<?php  include 'footer.php';  ?>