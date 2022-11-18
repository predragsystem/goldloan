<?php include 'header.php'; 
 include 'database/DatabaseConfig.php';?>
 <style type="text/css">
 	.mobileview {
    margin-right: 0px;
    margin-left: 0px;
}
 </style>
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


                $sqlQuery="SELECT  lt.trans_date,jl.*,(loan_grand_amount-paid_amt ) AS loan_bal_amt, paid_amt,loan_grand_amount FROM jewellery_loan as jl inner join jewellery_loan_transaction as lt on lt.loan_id=jl.loan_id ";

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

   if(isset($_POST['action'])== 'Save') {
      $ldate=date('Y-m-d',strtotime($_POST['loanDate']));
      $lid = $_POST['loan_id'];
      $today = date('Y-m-d');
      $result="insert into jewellery_loan_transaction(loan_id,trans_date,grandamt,trasactionType) values(".$lid.",'".$_POST['interestToDate']."',".$_POST['reqLoanAmt'].",'Additional Loan')";
      $jewell = mysqli_query($conn,$result);
      $finalAmt = ($_POST['loan_grand_amount'] + $_POST['reqLoanAmt']);
      $extraAmt = 'update jewellery_loan set loan_grand_amount='.$finalAmt.'
                     where loan_id = '.$_REQUEST["loan_id"];

     $sqlQuery1=mysqli_query($conn,$extraAmt);
     
      }  
   

         ?>
 <div class="container">
    <h4>Additional Loan
    <span style="text-align: right;margin-left: 30%;">
    <a href="" class="btn btn-sm">View Trasaction</a></span>
    </h4>
    <div class="row">
     
                <div class="col-sm-3">

                    <div class="form-group">
                        <label for="Loan No">Loan No<span class="spanColor">*</span></label> 
                           <input type="text" value="<?php echo $result["loan_id"];?>" placeholder="Loan No" id="loan_id" name="loan_id" autocomplete="off" maxlength="250" class="form-control border-input"><br>
                        
                           
                        </div>
                       
                </div>
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
   </div>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="row">
    <div class="col-sm-3">
                    <div class="form-group">
                        <input type="hidden" name="loan_id" id="loan_id" value="<?php echo $result["loan_id"];?>">
                        <input type="hidden" name="total_month" id="total_month" value="<?php echo $totalday;?>">
                        <input type="hidden" name="loan_grand_amount" id="loan_grand_amount" value="<?php echo $result["loan_grand_amount"];?>">
                        <input type="hidden" name="action" id="action" value="Save"> 
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
                            <input type="date"  id="interestToDate" name="interestToDate" autocomplete="off" maxlength="250" class="form-control border-input" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                </div>
           

           <div class="row">
               <div class="col-sm-3">
                      <div class="form-group">
                        <label for="Loan Grand Amount">Loan Grand Amount</label> 
                            <input type="text" value="<?php echo $result["loan_grand_amount"];?>" id="loanGrandAmount" placeholder="Loan Grand Amount" class="form-control border-input" readonly>
                        </div>
                     </div>
                     <div class="col-sm-3">
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
                      <div class="col-sm-3">
                      <div class="form-group">
                        <label>Required Loan</label> 
                       
                            <input type="text"  id="reqLoanAmt" name="reqLoanAmt" class="form-control border-input">
                        </div>
                     </div>

           </div>
           <div class="row">
               
               
               <div class="button" align="center">
                        <input type="submit" class="btn btn-success" value="Save" name="submit"  id="buttonId" >
                                        
                                    
                                    <button type="reset" class="btn btn-warning mr-1" >
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    </div>
                  </div>
         </form>
<script type="text/javascript">
    
       $(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;    
    $('#interestToDate').attr('max', maxDate);
});
</script>