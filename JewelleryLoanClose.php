<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?>
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
 <div class="modal fade" id="smallAlertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-small ">
    <div class="modal-content">
      <div class="modal-header no-border-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body text-center">
         <h5>ID unavailable</h5>
      </div>
       <center><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.herf='JewelleryLoanClose.php';">OK</button></center><br><br>
      </div>
    </div>
  </div>
  <?php
     $result=array(
                    'loan_id' => '',
                    'customer_name' => '',
                    'loan_date' => '',
                    'no_of_grams' => 0,
                    'amount_per_gram' => 0,
                    'loan_bal_amt' => 0,
                    'loan_grand_amount'=>0,
                    'interest_percentage' => 0,
                    'month_interest_amount' => 0,
                    'paid_amt'=> 0);


    $sqlQuery="SELECT  lt.*,jl.*,(loan_grand_amount-paid_amt ) AS loan_bal_amt FROM jewellery_loan as jl inner join jewellery_loan_transaction lt on lt.loan_id=jl.loan_id";


    if(isset($_GET['loan_id']) && $_GET['loan_id'] !="" ){
        $sqlQuery=$sqlQuery." where jl.loan_id = ".$_GET['loan_id']."  and jl.status = 'Active' ";
     $query = mysqli_query($conn,$sqlQuery);
     $cquery=mysqli_num_rows($query);
    if($cquery== 0){
     echo "<SCRIPT LANGUAGE='JavaScript'>    
        $('#smallAlertModal').modal('show');
        
        </SCRIPT>";
   }
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
                     
               window.location.href="JewelleryLoanClose.php?loan_id="+$('#loan_id').val();
               
           } 
       });

   });
function totalAmount(){
   
       var interest = Number(document.getElementById("interestPay").value);
       var loan =  Number(document.getElementById("loanPay").value);
          total = interest + loan;
          document.getElementById("totalPay").value = total + ".00";

var  Amount = document.getElementById("loanBalance").value;
             var  Month = 12; // no. of months
             var  InterestPer = document.getElementById("interestPercentage").value;
           
               // The equation is A = p * [[1 + (r/n)] ^ nt]
              res = (Amount* ((InterestPer/100))/ ( Month ));
               //alert(r);
                result=Math.round( res*100)/100,2;
              
           document.getElementById("interestPay").value =result;
           //date

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
  window.location.href="JewelleryLoanClose.php?loan_id="+loan;
  
} 


 </script>
  
 <?php
if(isset($_POST['submit']) == 'Save') { 

    $query = "insert into jewellery_loan_close(loan_id,closing_date,loan_pay,total_pay,payment_mode,loan_balance) values(".$_POST['loan_no'].",'".$_POST['closingDate']."',".$_POST['loanPay'].",".$_POST['totalPay'].",'".$_POST['paymentType']."',".$_POST['loanBalance'].")";
  
   //echo $query;
    $sqlQuery=mysqli_query($conn,$query);
   
   
        $status = "update Jewellery_loan set status = 'CLOSED' where loan_id = ".$_REQUEST["loan_id"]." ";

     $status1=mysqli_query($conn,$status);
 echo "<SCRIPT LANGUAGE='JavaScript'>                   
                 showSucessMessage('Payment Successfully Saved');
                </SCRIPT>";
     
}
  
?>
 <body onload="totalAmount()">
 <div class="container">
  <h4>Jewellery Loan Close</h4><br>
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
                            <input type="date" value=""  id="closingDate" name="closingDate" autocomplete="off" maxlength="250" class="form-control border-input" required>
                        </div>
                </div>
            </div>

           <hr style="border: 1px dashed black">
            <div class="row">
              <div class="col-sm-6">
                 <h4>Loan Details</h4><br>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="No Of Grams">No Of Grams</label> 
                            <input type="text" value=" <?php echo round($result["no_of_grams"],2);?>"  class="form-control border-input" readonly>
                        </div>
                     </div>
                     
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
                  
                 </div>
              </div>
              <div class="col-sm-6">
                 <h4>Payment Details</h4><br>
                 <div class="col-sm-6">
                 
                      <div class="form-group">
                        <label>Loan Balance</label> 
                            <input type="text" value="<?php echo number_format($result["loan_bal_amt"],2);?>" id="loanBalance" name="loanBalance" class="form-control border-input" readonly>
                        </div>
                 </div>
                     
                 
                  <div class="col-sm-6">
                  <div class="form-group">
                        <label>Loan Pay</label> 
                        <input type="text" value="<?php echo number_format($result["loan_bal_amt"],2);?>"  id="loanPay" name="loanPay" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
                 </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                        <label>Total Pay</label> 
                        <input type="text" value="<?php echo number_format($result["loan_bal_amt"],2);?>"  id="totalPay" name="totalPay" autocomplete="off" maxlength="250" class="form-control border-input" onkeyup ="totalAmount();" readonly>
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