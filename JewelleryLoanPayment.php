<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?><br><br><br><br><br>

 <style type="text/css">
@media screen and (min-device-width: 320px) and (max-device-width: 767px) {.mobileView{
  display: block;
}
}
 @media screen and (min-device-width: 768px)  { 
.mobileView{
  display: none;
}
}
.dialog{
 height: 200px;
 width: 300px;
   padding-top: 50px;
    border: #ffc0cb00;
    font-size: 17px;
    text-align: center;
}
 </style>
 <body>
  <div class="modal fade" id="smallAlertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-small ">
    <div class="modal-content">
      <div class="modal-header no-border-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body text-center">
        <h5>ID unavailable</h5>
      </div>
       <center><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.herf='JewelleryLoanPayment.php';">OK</button></center><br><br>
      </div>
    </div>
  </div>

  
  <?php
                $result=array(
                    'loan_id' => '',
                    'customer_name' => '',
                    'no_of_grams' => 0,
                    'amount_per_gram' => 0,
                    'loan_bal_amt' => 0,
                    'loan_grand_amount'=>0,
                    'interest_percentage' => 0,
                    'month_interest_amount' => 0,
                    'paid_amt'=> 0);

                $toalMonth = 0;


                $sqlQuery="SELECT  lt.trans_date,jl.*,(loan_grand_amount-paid_amt ) AS loan_bal_amt, paid_amt FROM jewellery_loan as jl inner join jewellery_loan_transaction as lt on lt.loan_id=jl.loan_id ";

                if(isset($_GET['loan_id']) && $_GET['loan_id'] !="" ){
                    $sqlQuery=$sqlQuery."where jl.loan_id = ".$_GET['loan_id']." 
                    and status = 'Active' ";

                      $loanTransactionDate = "select max(trans_date) as transaction_date FROM jewellery_loan_transaction where loan_id = ".$_REQUEST['loan_id']."  ";  
              $loanTD = mysqli_query($conn,$loanTransactionDate);
             $res = mysqli_fetch_array($loanTD);  
    
             $query = mysqli_query($conn,$sqlQuery);
                 $result = mysqli_fetch_array($query);

        
                 if(empty($result)){
                  echo "<SCRIPT LANGUAGE='JavaScript'>                   
                   $('#smallAlertModal').modal('show');
                </SCRIPT>";
                    
             }
                }else{
                 $sqlQuery=null;
                }

     
   

         ?>
        
        
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <?php
if(isset($_POST['submit']) == 'Save') {

  $mdate=date('Y-m-d',strtotime($_POST['interestToDate']));
  $today = date('Y-m-d');
// echo $mdate;



  echo  $query = "insert into jewellery_loan_transaction(loan_id,trans_date,loan_pay,total_pay,payment_mode,created_date,modified_date,loan_balance,interest_balance,penalty,trasactionType) values(".$_POST['loan_id'].",'".$today."',".$_POST['loanPay'].",".$_POST['totalPay'].",'',now(),now(),".$_POST['loanBalanceAmt'].",
        ".$_POST['interestBalance'].",0,'Amount Paid')";


    $sqlQuery=mysqli_query($conn,$query);

  

//   

     $paid_amt = "update jewellery_loan set paid_amt = paid_amt + ".$_POST['loanPay']." where loan_id = ".$_REQUEST["loan_id"]." ";

     $sqlQuery1=mysqli_query($conn,$paid_amt);

 if ($sqlQuery==true) {
    echo "<SCRIPT LANGUAGE='JavaScript'>                   
                 showSucessMessage('Payment Saved Successfully');
                  window.location.href='ViewLoan.php';
                </SCRIPT>";
 }
 

     
}
  
?>

 <div class="container">
    <h4>Interest Payment - Jewellery Loan
    <span style="text-align: right;margin-left: 30%;"><a href="NewExtraLoan.php?loan_id='<?php echo $result["loan_id"];?>'" class="btn btn-sm btn-success">वाढीव लोन</a>
    <a href="ViewLoanTrasaction.php?loan_id='<?php echo $result["loan_id"];?>'" class="btn btn-sm btn-warning">माहिती पहा</a></span>
    </h4>
    <div class="row">
     
                <div class="col-sm-3">

                    <div class="form-group">
                        <label for="Loan No">Loan No<span class="spanColor">*</span></label> 
                           <input type="text" value="<?php echo $result["loan_id"];?>" placeholder="Loan No" id="loan_id" name="loan_id" autocomplete="off" maxlength="250" class="form-control border-input"><br>
                           <center>
                           <button type="button" class="btn btn-warning mr-1 mobileView" onclick="loan();">Look Up</button>
                           </center>
                        </div>
                       
                </div>
                <div class="col-sm-3">
                    <?php 
                    $finalinterest = 0;
                    $totalday = 0;
                    if(!empty($result["loan_date"])){
                        
                        $now = time(); // or your date as well
                        $loanDate = strtotime($result["loan_date"]);
                        $dayCalculate = $now - $loanDate;
                        $amount = (int)$result['loan_grand_amount'];
                        $rate = $result['interest_percentage'];
                       // $totalday = ($dayCalculate / (60 * 60 * 24));
                        
                        $totalday = round(($dayCalculate) / 60 / 60 / 24);

                    $years = round((int)$totalday / 365, 4);
                    $interest = round($amount * ($rate) / 100, 2);
                    $interestperday = ((int)($interest) / (int)(30));
                    //echo $amount." ".$rate." ".$totalday." ".$interestperday."<br>";
                    $finalinterest = $totalday * $interestperday;
                    
                    $finalinterest = round($finalinterest,2);
                    }
                ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                    <div class="form-group">
                        <input type="hidden" name="loan_id" id="loan_id" value="<?php echo $result["loan_id"];?>">
                        <input type="hidden" name="total_month" id="total_month" value="<?php echo $totalday;?>">
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
                            <input type="date" value=""  id="interestToDate" name="interestToDate" autocomplete="off" maxlength="250" class="form-control border-input" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                </div>
            </div>
            <div class="row">
     <!-- <div class="col-sm-3">
                      <div class="form-group">
                        <label>EMI Date</label> 
                          <input type="date" value="<?php if(!empty($res['transaction_date'])){
                echo date('Y-m-d',strtotime('+30 days',strtotime($res['transaction_date'])));
              }?>" id="duedate" name="duedate" class="form-control border-input" readonly>
             
                     </div>
    </div>-->
   </div>
           <hr style="border: 1px dashed black">
            <div class="row">
                <div class="col-sm-6">
                     <h4>Loan Details</h4><br>
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label for="No Of Grams">No Of Grams</label> 
                            <input type="text" value=" <?php echo $result["no_of_grams"];?>"  class="form-control border-input" readonly>
                        </div>
                     </div>
                    
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label for="Loan Grand Amount">Loan Grand Amount</label> 
                            <input type="text" value=" <?php echo $result["loan_grand_amount"];?>" id="loanGrandAmount" placeholder="Loan Grand Amount" class="form-control border-input" readonly>
                        </div>
                     </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                        <label for="Interest Percentage">Interest Percentage</label> 
                        <input type="text" value="<?php echo $result["interest_percentage"];?>"  id="interest" name="interestPercentage" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
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
                        <label for="Interest Balance"> Total Days From Loan Date </label> 
                        
                        </div>
                      <?php echo $totalday." Days" ?>
                  </div>
                </div>
                <div class="col-sm-6">
                     <h4>Payment Details</h4><br>
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label>Loan Balance</label> 
                        <?php 
                            $balance = $result["loan_bal_amt"];
                            $totalMonthInterest = $result["month_interest_amount"];
                            
                            $totalBalance = ($balance + $finalinterest);
                        ?>
                            <input type="text" value="<?php echo $totalBalance;?>" id="loanBalanceAmt" name="loanBalanceAmt" class="form-control border-input"
                            readonly>
                        </div>
                     </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="Interest Balance">Interest Balance</label> 
                        <input type="text" value="<?=$finalinterest;?>"  id="interestBalance" name="interestBalance" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                        <label for="Interest Balance">Total Paid Amount</label> 
                        <input type="text" value="<?php echo round($result["paid_amt"]);?>" name="paidAmt" autocomplete="off" maxlength="250" class="form-control border-input" readonly>
                        </div>
                     </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                        <label>Loan Pay</label> 
                        <input type="text" value="0.00"  id="loanPay" name="loanPay" autocomplete="off" maxlength="250" class="form-control border-input" onkeyup ="totalAmount();loanBalance()">
                        </div>
                     </div>
                    <!--  <div class="col-sm-6">
                        <div class="form-group">
                        <label>Interest Pay</label> 
                        <input type="text" value="0.00"  id="interestPay" name="interestPay" autocomplete="off" maxlength="250" class="form-control border-input" onkeyup ="totalAmount();">
                        <span id="interestBalanceErroId" class="spanColor"></span>
                        </div>
                     </div>
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Penalty</label> 
                            <input type="text" value="0.00" class="form-control border-input" id="penalty" name="penalty" onkeyup ="totalAmount()">
                        </div>
                     </div>-->
                      <div class="col-sm-6">
                        <div class="form-group">
                        <label>Total Pay</label> 
                        <input type="text" value="0.00"  id="totalPay" name="totalPay" autocomplete="off" maxlength="250" class="form-control border-input" onkeyup ="totalAmount();" readonly>
                        </div>
                     </div>
                      <!--<div class="col-sm-6">
                        <div class="form-group">
                        <label>Payment Mode</label><span class="spanColor">*</span>
                       <div style="border: 2px solid #ccc5b9;"> <select id="paymentType" name="paymentType" class="form-control  border-primary" value="" required>
                    <option value="">--Choose--</option>
                    <option value="CASH">Cash</option>
                    <option value="CARD">Card </option>
                </select></div>-->
                       
                        </div>
                     </div>
                </div>
                
            </div><br><br>
            <center>
           <input type="submit" class="btn btn-success" value="Save" name="submit" onclick="return Validate()">

              <button type="reset" class="btn btn-warning mr-1" align="right" >
                  <i class="icon-cross2"></i> Clear
              </button>
              </center>

    </form>
 </div>
</div>

</body>

 <br>
<script type="text/javascript">
    $(document).ready(function () {

       $("#loan_id").on('keyup', function (e) {
           if (e.keyCode == 13) { 
              
               window.location.href="JewelleryLoanPayment.php?loan_id="+$('#loan_id').val();
               
           } 
       });

   });

     function loan() {

  var loan = $('#loan_id').val();  
        alert(loan);

  window.location.href="JewelleryLoanPayment.php?loan_id="+loan;
  
} 
function totalAmount(){
   
       var interest = Number(document.getElementById("interestPay").value);
       var loan =  Number(document.getElementById("loanPay").value);
       var penalty =  Number(document.getElementById("penalty").value);
          total = interest + loan + penalty;
          document.getElementById("totalPay").value = total;
      }

window.onload = pageOnLoad;
function pageOnLoad()
           {
             var  Amount = document.getElementById("loanGrandAmount").value;
             var  Month = document.getElementById("total_month").value; // no. of months
             var  InterestPer = document.getElementById("interest").value;
           
               // The equation is A = p * [[1 + (r/n)] ^ nt]
              res = (Amount* Month* ((InterestPer/100))* 1/365);
               //alert(r);
                result=Math.round( res*100)/100,2;
         //  document.getElementById("interestBalance").value =result;

           

   var date = new Date();
 
// GET YYYY, MM AND DD FROM THE DATE OBJECT
var yyyy = date.getFullYear().toString();
var mm = (date.getMonth()+1).toString();
var dd  = date.getDate().toString();
 
// CONVERT mm AND dd INTO chars
var mmChars = mm.split('');
var ddChars = dd.split('');
 
// CONCAT THE STRINGS IN YYYY-MM-DD FORMAT
var datestring = yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]) ;

  document.getElementById('interestToDate').value=datestring;
var emi = document.getElementById("duedate").value;
       emiDate=new Date(emi);
      //alert(emiDate);
       var today = document.getElementById("interestToDate").value;
       todayDate=new Date(today);
        // alert(todayDate);

     

 if(todayDate<emiDate)
{
    // alert("lessthan");
   document.getElementById("myDialog").showModal(); 
   
}
else if(todayDate>emiDate)
{
    // alert("greater");
     document.getElementById("penalty").removeAttribute("readonly");
    
}
  else{
    // alert("equal");
    document.getElementById("penalty").setAttribute("readonly", true);
   
}  


           }

  function Validate() {
        var interestBalance = document.getElementById("interestBalance").value;
        var interestPay = document.getElementById("interestPay").value;
        if (interestBalance != interestPay) {
            document.getElementById("interestBalanceErroId").innerHTML = "Interest Does Not Match.";
            return false;
        }
        return true;
    }


 </script>
<?php  include 'footer.php';  ?>