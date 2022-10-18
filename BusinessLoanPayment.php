<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?><br><br><br><br><br>
 <style type="text/css">
   
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
   <center><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.herf='BusinessLoanPayment.php';">OK</button></center><br><br>
      </div>
    </div>
  </div>
  <div class="modal fade" id="interestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-small ">
    <div class="modal-content">
      <div class="modal-header no-border-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body text-center">
        <h5>Already paid</h5>
      </div>
      <div class="modal-footer">
      
            <center><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.herf='BusinessLoanPayment.php';">OK</button></center>
      
          
        </div>
      </div>
    </div>
  </div>
  <?php
  $result=null;
  $balance=0;
  $penalty=0.00;
  $sqlQuery="select *,(loan_grand_amount-paid_amount ) AS loan_bal_amt FROM `business_loan` ";

  if(isset($_GET['loan_id']) && $_GET['loan_id'] !="" ){
    $sqlQuery=$sqlQuery."where loan_id = ".$_GET['loan_id']." 
    and status = 'ACTIVE' ";
    $query = mysqli_query($conn,$sqlQuery);
    $cquery=mysqli_num_rows($query);
    if($cquery== 0){
     echo "<SCRIPT LANGUAGE='JavaScript'>    
        $('#smallAlertModal').modal('show');
        
        </SCRIPT>";
   }else{
   $result = mysqli_fetch_array($query);
   }
   
   
   $balselect=mysqli_num_rows(mysqli_query($conn,"select *  from business_loan_transaction where loan_id = ".$_GET['loan_id']." "));

   $balancetwo="select max(transaction_date) as maxdate,datediff(now(),max(transaction_date)) as ddate, TIMESTAMPDIFF(MONTH,NOW(),max(transaction_date))+1 as mdate ,max(due_date) as due_date from business_loan_transaction where loan_id= ".$_GET['loan_id']."";
  
   $bal=mysqli_query($conn,$balancetwo);
     $cnt=mysqli_num_rows($bal);
     if(empty($balselect)){
      if($result['interest_type']=="Daily"){
       $balance=round($result['loan_bal_amt']*(($result['interest_percentage']/100)/365),2);
      }else if($result['interest_type']=="Monthly"){
        $balance=round($result['loan_bal_amt']*(($result['interest_percentage']/100)/12),2);
      }

       }
     else{
     $balval=mysqli_fetch_array($bal);
      if($result['interest_type']=="Daily"){
     $balance=round($balval['ddate']*$result['loan_bal_amt']*(($result['interest_percentage']/100)/365),2);
     }else if($result['interest_type']=="Monthly"){
      
       $remamt=floor($balval['ddate']/30);
      
        
      
       $pay=$balval['ddate']-30;
       $penalty=10*$pay;
      
      $balance=round($result['loan_bal_amt']*(($result['interest_percentage']/100)/12),2);
    
     }
  }

}
  else{
   $sqlQuery=null;
  }
  
     
?>

    
<div class="modal fade" id="myDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-small ">
   <div class="modal-content">
     <div class="modal-header no-border-header">
     </div>
     <div class="modal-body text-center">
      <span style="color: red"><i class="fa fa-times-circle"></i></span> Process Failed<br>
      
       <h5>Your EMI Date is</h5><?php if(!empty($balval["due_date"])){
               echo date('d-m-Y',strtotime($balval["due_date"]));}?>
     </div>
      <center><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.href='BusinessLoanPayment.php';">OK</button></center>
       <br>
       <br>
     </div>
   </div>
 </div> 

  <?php

if(isset($_POST['submit']) == 'Save') {
  $result=mysqli_fetch_array(mysqli_query($conn,"select * from business_loan where loan_id = ".$_REQUEST['loan_id'].""));
  if($result['interest_type']=='Monthly'){
  $duedate=date('Y-m-d',strtotime('+30 days',strtotime($_POST['dueDate'])));
  }else if($result['interest_type']=='Daily'){
    $duedate=date('Y-m-d',strtotime('+1 days',strtotime($_POST['dueDate'])));
  } 

$intdate=date('Y-m-d G:i:s',strtotime($_POST['interestToDate']));
$mdate=date('Y-m-d G:i:s',strtotime($_POST['loanDate']));
$querytwo=mysqli_fetch_array(mysqli_query($conn,"select * from business_loan_transaction where transaction_date='".$mdate."' and  loan_id='".$_REQUEST['loan_id']."' "));

if(!empty($querytwo)){
  //$tdate=date('Y-m-d G:i:s',strtotime($querytwo['mdate']));
    if($result['interest_type']=='Monthly'){
  $transdate=$_POST['dueDate'];
  }else if($result['interest_type']=='Daily'){
    $transdate=$_POST['interestToDate'];
  }
  $queryss = "update  business_loan_transaction set interest_pay='".$_POST['interestPay']."',loan_pay='".$_POST['loanPay']."',total_pay='".$_POST['totalPay']."',payment_mode='".$_POST['paymentType']."',created_date=now(),modified_date=now(),loan_balance='".$_POST['loanBalanceAmt']."',transaction_date='".$transdate."',due_date='".$duedate."',penalty_amt='".$_POST['penaltyAmount']."' where transaction_date='".$mdate."' and loan_id='".$_REQUEST['loan_id']."' ";
  
  
   $sqlQuery=mysqli_query($conn,$queryss);
  
     
}else{
  if($result['interest_type']=='Monthly'){
  $transdate=$_POST['dueDate'];
  }else{
    $transdate=$_POST['interestToDate'];
  }
    $queryqw = "insert into business_loan_transaction(loan_id,transaction_date,interest_pay,loan_pay,total_pay,payment_mode,created_date,modified_date,loan_balance,due_date,penalty_amt) values(".$_POST['loan_id'].",'".$transdate."',".$_POST['interestPay'].",".$_POST['loanPay'].",".$_POST['totalPay'].",'".$_POST['paymentType']."',now(),now(),".$_POST['loanBalanceAmt'].",'".$duedate."',".$_POST['penaltyAmount'].")";


    $sqlQuery=mysqli_query($conn,$queryqw);
}
     $paid_amt = "update business_loan set paid_amount = paid_amount + ".$_POST['loanPay']." where loan_id = ".$_REQUEST["loan_id"]." ";

     $sqlQuery1=mysqli_query($conn,$paid_amt);
  if ($sqlQuery==true) {
    echo "<SCRIPT LANGUAGE='JavaScript'>                   
                 showSucessMessage('Payment Saved Successfully');
                </SCRIPT>";
 }
}
  
?>


 <div class="container">
    <h4>Interest Payment - Business Loan</h4><br>

    <div class="row">

                <div class="col-sm-3">

                    <div class="form-group">
                        <label for="Loan No">Loan No<span class="spanColor">*</span></label> 
                           <input type="text" value="<?php echo $result["loan_id"];?>" placeholder="Loan No" id="loan_id" name="loan_id" autocomplete="off" maxlength="250" class="form-control border-input"><br>
                           <center>
                           <button type="button" class="btn btn-warning mr-1 mobileView" onclick="loan();" >Look Up</button>
                           </center>
                        </div>
                       <!--  <button type="submit" class="btn btn-warning mr-1" align="right" onclick="">
                  <i class="icon-cross2"></i> Look Up
              </button> -->
                </div>
                <div class="col-sm-3">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="loan_id"  id="loan_id" value="<?php echo $result["loan_id"];?>">
                        <label for="Lone Date">Loan Date</label> 
                            <input type="text"   value=" <?php if(!empty($result["loan_date"])){
                
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
                            <input type="date" value=""  id="interestToDate" name="interestToDate" autocomplete="off" maxlength="250" onload="getdate()" class="form-control border-input" required>
                        </div>
                </div>
      
            </div>
       <div class="row">
        <div class="col-sm-3">
                      <div class="form-group">
                        <label for="Loan Type">Due Date<span class="spanColor">*</span></label> 
                            <input type="date" value="<?php if(!empty($balval["due_date"])){ echo date('Y-m-d',strtotime($balval["due_date"]));}?>"  id="dueDate" name="dueDate" autocomplete="off" maxlength="250"  class="form-control border-input" readonly>
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
                            <input type="text" value=" <?php echo $result["loan_grand_amount"];?>" id="loanGrandAmount" placeholder="Loan Grand Amount" class="form-control border-input" readonly>
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
                      <div class="form-group">
                        <label>Loan Balance</label> 
                            <input type="text" value="<?php echo $result["loan_bal_amt"];?>" id="loanBalanceAmt" name="loanBalanceAmt" class="form-control border-input" readonly>
                        </div>
                     </div>
                      
                </div>
      
                <div class="col-sm-6">
                     <h4>Payment Details</h4><br>
                      <div class="row">
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label>Loan Balance</label> 
                            <input type="text" value="<?php echo $result["loan_bal_amt"];?>" id="loanBalanceAmt" name="loanBalanceAmt" class="form-control border-input" readonly>
                        </div>
                     </div>
                    
                      <div class="col-sm-6">
                        <div class="form-group">
                        <label>Interest Balance</label> 
                        <input type="text" value="<?php echo $balance;?>"   id="interestBalance" name="interestBalance" autocomplete="off" maxlength="250" class="form-control border-input" onkeyup ="totalAmount();" readonly>
                        </div>
                     </div>
           </div>
           <div class="row">
             <div class="col-sm-6">
                        <div class="form-group">
                        <label>Interest pay</label> 
                        <input type="text" id="interestPay" name="interestPay" autocomplete="off" maxlength="250" class="form-control border-input" value="<?php echo $balance;?>"  onkeyup ="totalAmount();" required >
             
                        </div>
            <span id="interestPayErroId" style="color: red;font-weight: bold;" ></span>
                     </div>
            
      
      
                      <div class="col-sm-6">
                        <div class="form-group">
                        <label>Loan Pay</label> 
                        <input type="text" value="0.00"  id="loanPay" name="loanPay" autocomplete="off" maxlength="250" class="form-control border-input" onkeyup ="totalAmount();loanBalance()">
                        </div>
                     </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
                        <div class="form-group">
                        <label>Penalty Amount</label> 
                        <input type="text" value="0.00"  id="penaltyAmount" name="penaltyAmount" autocomplete="off" maxlength="250" class="form-control border-input" onkeyup ="totalAmount();">
                        </div>
                     </div>
          
                      <div class="col-sm-6">
                        <div class="form-group">
                        <label>Total Pay</label> 
                        <input type="text" value="0.00"  id="totalPay" name="totalPay" autocomplete="off" maxlength="250" class="form-control border-input" onkeyup ="totalAmounttotalAmount();" readonly>
                        </div>
                     </div>
           </div>
           <div class="row">
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
                </div>
            </div><br>
      
      
            <center>
      
           <input type="submit" class="btn btn-success" value="Save" name="submit" onclick="return Validate()"/>
              <button type="reset" class="btn btn-warning mr-1" align="right" >
                  <i class="icon-cross2"></i> Clear
              </button>
              </center>

    </form>
  
 </div><br>
 </body>
 <script type="text/javascript">
    $(document).ready(function () {

       $("#loan_id").on('keyup', function (e) {
           if (e.keyCode == 13) { 
                     
               window.location.href="BusinessLoanPayment.php?loan_id="+$('#loan_id').val();
               
           } 
       });

   });
   
   window.onload=getdate();
function getdate(){
  // GET CURRENT DATE
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

  document.getElementById('interestToDate').value=datestring;
}
     function loan() {

  var loan = $('#loan_id').val();  
        alert(loan);
  window.location.href="BusinessLoanPayment.php?loan_id="+loan;
  
} 
function totalAmount(){
   
       var interest = Number(document.getElementById("interestPay").value);
       var loan =  Number(document.getElementById("loanPay").value);
     var pay= Number(document.getElementById("penaltyAmount").value);
          total = interest + loan + pay;
          document.getElementById("totalPay").value = total;
      }
      window.onload=totalAmount();

 function Validate() {
        var password = document.getElementById("interestBalance").value;
        var confirmPassword = document.getElementById("interestPay").value;
        if (password != confirmPassword) {
            document.getElementById("interestPayErroId").innerHTML = "Interest Does Not Match.";
            return false;
        }
        return true;
    }

  function Validate1() {

     var emi = document.getElementById("dueDate").value;
      emiDate=new Date(emi);
   // alert(emiDate);
      var today = document.getElementById("interestToDate").value;
      todayDate=new Date(today);
       // alert(todayDate);

   

if(todayDate<emiDate)
{
   // alert("lessthan");
 $('#myDialog').modal('show');
 
}
else if(todayDate>emiDate)
{
   // alert("greater");
    document.getElementById("penaltyAmount").removeAttribute("readonly");
   
}
 else{
   // alert("equal");
   document.getElementById("penaltyAmount").setAttribute("readonly", true);
 
 
}
     
  }
  
  window.onload=Validate1();

 </script>
 

<?php  include 'footer.php';  ?>