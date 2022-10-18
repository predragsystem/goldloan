
<?php

include_once('../../database/DatabaseConfig.php');
if(isset($_GET['fromDate']) && isset($_GET['toDate']) )
{     
  $status = "";
  if (!isset($_GET['vId']) || empty($_GET['vId'])) { 
    $status = "";
  }else{
    $status = " and jl.status = '".$_GET['vId']."'";
  } 
$sql = "SELECT DISTINCT jl.loan_id as LoanNo,date(loan_date) as LoanDate,
jl.customer_name as CustomerName,jl.phone as Phone,jl.aadhar_no as AadharNo,jl.no_of_grams as NoOfGram,
jl.amount_per_gram as AmountPerGram,jl.loan_grand_amount as LoanGrandAmount,jl.interest_percentage as InterestPercentage,jl.month_interest_amount as MonthInterstAmount,jl.total_qty as TotalQty,jl.no_of_items as NoOfItems,jl.paid_amt as PaidAmount, date(jlc.closing_date) as ClosingDate,jlc.total_pay as TotalPay,jl.status as status FROM jewellery_loan  jl Left join jewellery_loan_close jlc on jl.loan_id=jlc.loan_id where jl.loan_date > '".$_GET['fromDate']."' and 
 jl.loan_date < '".$_GET['toDate']."' ".$status." order by jl.loan_id asc";

  $qur = mysqli_query($conn,$sql);

$today = date("m.d.y");
}
?>


<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 
<title>FINANACE</title>
<link rel="apple-touch-icon" sizes="60x60" href="app-assets/images/ico/apple-icon-60.png">
<link rel="apple-touch-icon" sizes="76x76" href="app-assets/images/ico/apple-icon-76.png">
<link rel="apple-touch-icon" sizes="120x120" href="app-assets/images/ico/apple-icon-120.png">
<link rel="apple-touch-icon" sizes="152x152" href="app-assets/images/ico/apple-icon-152.png">
<link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
<link rel="shortcut icon" type="image/png" href="app-assets/images/ico/favicon-32.png">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
 
</head>
<body onload="window.print();">
    
    <table border="1"  style="border-collapse: collapse;">
        <thead>          
        <th>LoanNo</th> 
          <th>LoanDate</th>
          <th>CustomerName</th>
           <th>PhoneNo</th>
            <th>NoOfGrams</th>
          <th>LoanGrandAmount</th>
         <th>InterestPercent</th>
           <th>MonthlyInterstAmt</th>
         
            <th>PaidAmount</th>
           <th>ClosingDate</th>
          <th>TotalPay</th>
          
        </thead>

        <?php 

         $count = mysqli_num_rows($qur);  
         if($count == 0) {
          ?>
           <tr>          
              <td colspan="12"> No Record Found </td>
            </tr>
          <?php
         }else{
          $totalNoPerson= 0;
         $totalgrandamount=0.00;
         $totalMonthInterest=0.00;
       
         $totalqty=0.00;
         $totalpay=0.00;
         $totalloanbalance=0.00;




          while($result = mysqli_fetch_array($qur)) {

            $totalNoPerson++;
            $totalgrandamount = $totalgrandamount + $result["LoanGrandAmount"];
            $totalMonthInterest = $totalMonthInterest + $result["MonthInterstAmount"];
           

            // $totalqty = $totalqty + $result["TotalQty"];

            $totalpay = $totalpay + $result["TotalPay"];
          

           
        
          ?>


 


            <tr>   
                   
             <td align="right"><?php echo $result["LoanNo"];?></td> 
             
   <td><?php $date = DateTime::createFromFormat('Y-m-d',  $result["LoanDate"]); 
                    echo $date->format('d/m/Y');?></td> 
               <td ><?php echo $result["CustomerName"];?></td>
               <td ><?php echo $result["Phone"];?></td>
               <td align="right"><?php echo number_format($result["NoOfGram"],3,'.','');?></td>
               <td align="right"><?php echo number_format($result["LoanGrandAmount"],2,'.','');?></td>
              <td  align="right"><?php echo $result["InterestPercentage"];?></td>  
               <td align="right"><?php echo number_format($result["MonthInterstAmount"],2,'.','');?></td>

              
               <td align="right"><?php echo number_format($result["PaidAmount"],2,'.','');?></td>
              <td ><?php if($result["ClosingDate"]==null){
                echo "-----";}else{
$date = DateTime::createFromFormat('Y-m-d',  $result["ClosingDate"]);
                    echo $date->format('d/m/Y');
                    }?></td>
              <td align="right"><?php if($result["TotalPay"]==null){
                echo "0.00";}else{ echo number_format($result["TotalPay"],2,'.','');}?></td>
             
              
            </tr>

          <?php 
            }
          ?>


         <tr> 
            <td colspan="10" class="boldText">TOTAL NO OF PERSON </td>
            <td align="right"> <?php echo number_format( $totalNoPerson,2,'.',''); ?> </td>
         </tr>

         <tr>
             
            <td colspan="10" class="boldText">TOTAL GRAND AMOUNT </td>
            <td align="right"><?php echo number_format( $totalgrandamount,2,'.',''); ?> </td>
         </tr>


         <tr>
             
            <td colspan="10" class="boldText">TOTAL MONTH INTEREST </td>
            <td align="right"><?php echo number_format( $totalMonthInterest,2,'.',''); ?> </td>
         </tr>

       

        <!--  <tr>
             
            <td colspan="10" class="boldText">TOTAL LOAN QUANTITY</td>
            <td align="right"><?php echo $totalqty; ?> </td>
         </tr> -->

        

         <tr> 
            <td colspan="10" class="boldText">TOTAL PAY</td>
            <td align="right"><?php echo number_format($totalpay,2,'.',''); ?> </td>
         </tr>

       

         <tr> 
        

        <?php
       }
         ?>

    </table>

  <style type="text/css">
    
    .boldText{
      font-weight: bold;
      text-align: right;
    }
    tbody tr:nth-child(odd) {background-color: #f2f2f2;};
     tbody tr:nth-child(even) {background-color: #f5f5f0;};


  </style>
</body>