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
  <?php
                $result=null;

                $sqlQuery="SELECT  lt.loan_balance,lt.loan_pay,lt.interest_pay,lm.*,(loan_grand_amount-paid_amt ) AS loan_bal_amt FROM loan_master as lm inner join loan_transaction lt on lt.loan_id=lm.loan_id  ";


                if(isset($_GET['loan_id']) && $_GET['loan_id'] !="" ){
                    $sqlQuery=$sqlQuery."where lm.loan_id = ".$_GET['loan_id']."  and lm.status = 'ACTIVE' ";
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
                     
               window.location.href="LoanClose.php?loan_id="+$('#loan_id').val();
               
           } 
       });

   });
function totalAmount(){
   
       var interest = Number(document.getElementById("interestPay").value);
       var loan =  Number(document.getElementById("loanPay").value);
          total = interest + loan;
          document.getElementById("totalPay").value = total + ".00";
      }
  function loan() {

  var loan = $('#loan_id').val();  
        alert(loan);
  window.location.href="LoanClose.php?loan_no="+loan;
  
} 


 </script>
 <?php
if(isset($_POST['submit']) == 'Save') { 

    $query = "insert into loan_close(loan_id,closing_date,interest_pay,loan_pay,total_pay,payment_mode,loan_balance) values(".$_POST['loan_no'].",'".$_POST['closingDate']."',".$_POST['interestPay'].",".$_POST['loanPay'].",".$_POST['totalPay'].",'".$_POST['paymentType']."',".$_POST['loanBalance'].")";
  
     // echo $query;
    $sqlQuery=mysqli_query($conn,$query);
   
        $status = "update loan_master set status = 'COMP' where loan_id = ".$_REQUEST["loan_id"]." ";

     $status1=mysqli_query($conn,$status);

}
  
?>
 <body onload="totalAmount()">
 <div class="container">
  <h4>Loan Close</h4><br>
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
                        <label for="Loan Type">Date<span class="spanColor">*</span></label> 
                            <input type="date" value=""  id="closingDate" name="closingDate" autocomplete="off" maxlength="250" class="form-control border-input">
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
                            <input type="text" value=" <?php echo number_format($result["loan_receive_amount"],2);?>" placeholder="Loan Grand Amount" class="form-control border-input" readonly>
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
            <input type="text" value="<?php echo number_format($result["daily_interest_amount"],2);?>"  id="dailyInterestAmount" name="dailyInterestAmount" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
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
                        <label>Interest Pay</label> 
            <input type="text" value=" <?php if($result["month_interest_amount"]!=""&&$result["month_interest_amount"]!="0.0000")
            {
              echo number_format($result["month_interest_amount"],2);
            }else if($result["daily_interest_amount"]!="")
            {
              echo number_format($result["daily_interest_amount"],2);
            };?>"  id="interestPay" name="interestPay" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
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
                        <input type="text" value="0.00"  id="totalPay" name="totalPay" autocomplete="off" maxlength="250" class="form-control border-input" onkeyup ="totalAmount();" readonly>
                        </div>
                 </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                        <label>Payment Mode</label><span class="spanColor">*</span>
                       <div style="border: 2px solid #ccc5b9;"> <select id="paymentType" name="paymentType" class="form-control  border-primary" value="">
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