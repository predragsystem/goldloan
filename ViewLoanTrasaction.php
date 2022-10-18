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
table th{
  background-color: #eee;
}
table td{
  background-color: #d1dddd;
}
 </style>
 <body>

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


                $sqlQuery="SELECT  lt.*,Jl.*,jt.* FROM jewellery_loan as jl 
                inner join jewellery_loan_transaction as lt on lt.loan_id=jl.loan_id 
                inner join jewellery_loan_item as jt on jt.jewellery_loan_id=lt.id";

                if(isset($_GET['loan_id']) && $_GET['loan_id'] !="" ){
                    $sqlQuery=$sqlQuery." where jl.loan_id = ".$_GET['loan_id']." 
                    and status = 'Active' ";

                      $loanTransactionDate = "select * FROM jewellery_loan_transaction where loan_id = ".$_REQUEST['loan_id']."  ";  
              $loanTD = mysqli_query($conn,$loanTransactionDate);
           //  $res = mysqli_fetch_array($loanTD);  
    
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
 

 <div class="container">
    <div class="row">
    <h4 >Customer Details</h4>
     <div style="display:flex;">
         <img src="upload/<?php echo $result["userpic"];?>">
        <span style="text-align: right;margin-left: 77%;" >

        <a href="JewelleryLoanPayment.php?loan_id='<?php echo $result["loan_id"];?>'" class="btn btn-md btn-success" style="margin-bottom: 10px;">लोन भरणे </a>
        <a href="NewExtraLoan.php?loan_id='<?php echo $result["loan_id"];?>'" class="btn btn-md btn-warning">वाढीव लोन द्या </a></span></div>
        <br>
         <table class="table">
          <tr>
             <th>Loan ID</th><td><?php echo $result["loan_id"];?></td>
           <th>Customer Name</th><td><?php echo $result["customer_name"];?></td>
           <th>Contact Number</th><td><?php echo $result["phone"];?></td>
           <th>Loan Date</th><td><?php echo $result["loan_date"];?></td>
          </tr>
        
        </table>
        <h4>Loan Details</h4>
        <table class="table">
          <tr>
           <th>Item</th><td><?php echo $result["jewellery_type_id"];?></td>
           <th>Description</th><td><?php echo $result["description"];?></td>
           <th>Weight</th><td><?php echo $result["total_grams"];?></td>
           <th>Location</th><td><?php echo $result["location"];?></td>
           
          </tr>
          <tr>
            <th>Loan Amount</th><td><?php echo round($result["loan_grand_amount"]);?></td>
            <th>Interest %</th><td><?php echo $result["interest_percentage"];?></td>
            <th>Paid Amount</th><td><?php echo round($result["paid_amt"]);?></td>
            <th>Pending Amount</th><td><?php
                $now = time(); // or your date as well
                        $loanDate = strtotime($result["loan_date"]);
                        $dayCalculate = $now - $loanDate;
                        $amount = (int)$result['loan_grand_amount'];
                        $rate = $result['interest_percentage'];
                        $totalday = round($dayCalculate / (60 * 60 * 24));
                        
                        //$totalday = (($dayCalculate) / 60 / 60 / 24);

                    $years = round((int)$totalday / 365, 4);
                    $interest = round($amount * ($rate) / 100, 2);
                    $interestperday = ((int)($interest) / (int)(30));
                    //echo $amount." ".$rate." ".$totalday." ".$interestperday."<br>";
                    $finalinterest = $totalday * $interestperday;
                    
                    $finalinterest = round($finalinterest,2);
                     echo round(($result['loan_grand_amount'] + ($finalinterest) - $result['paid_amt']),2);
            ?></td>
          </tr>
        </table>
        <h4>Trasaction Details</h4>
            <table class="table">
          <tr>
            <th>Trasaction Date</th>
            <th>Remark</th>
            <th>Debit</th>
            <th>Credit</th>
          </tr>
          <?php 
          $balance = 0;
          while($result1 = mysqli_fetch_array($loanTD)) { ?>
            <tr>
              <td><?php echo $result1['trans_date']; ?></td>
              <td><?php echo $result1['trasactionType']; ?></td>
              <td><?php 
              if($result1['trasactionType'] != 'Amount Paid'){ 
                 echo $result1['grandamt'];
               } ?></td>
              <td><?php 
              if($result1['trasactionType'] == 'Amount Paid'){
                  echo round($result1['loan_pay']); 
              } 
             
            ?></td>

              

            </tr>
           
          <?php } ?>
           <tr style="font-weight: bold;"><td colspan="2"></td>
              <td>Balance</td>
              <td><?php echo round(($result['loan_grand_amount'] + ($finalinterest) - $result['paid_amt']),2); ?></td>
            </tr>
        </table>
               
               
 </div>
</div>

</body>
