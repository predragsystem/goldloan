
<?php

include_once('/home/lwnts2yp/public_html/jewelleryloan/database/DatabaseConfig.php');

if(isset($_GET['fromDate']) && isset($_GET['toDate']) )
{     
  $status = "";
  if (!isset($_GET['vId']) || empty($_GET['vId'])) { 
    $status = "";
  }else{
    $status = " and bl.status = '".$_GET['vId']."'";
  } 
  $inter = "";
  if (!isset($_GET['ItId']) || empty($_GET['ItId'])) { 
    $inter = "";
  }else{
    $inter = " and bl.interest_type = '".$_GET['ItId']."'";
  }
$sql = "SELECT DISTINCT bl.loan_id as LOANNO,bl.loan_date as LOAN_DATE,bl.loan_grand_amount as LOANGRANDAMOUNT, bl.interest_percentage as INTERESTPERCENT,
bl.daily_interest_amount as DAILYNTEREST,bl.month_interest_amount as MonthlyInerest,bl.receipt_mode as RECEIPTMODE,  bl.interest_type as interest_type,
bl.customer_name as CUSTOMERNAME, bl.phone_no as PHONENO,bl.aadhar_no as AADHARNO,bl.paid_amount as PADIAMOUNT,date(blc.closing_date) as CLOSEDATE,blc.loan_balance as LOANBAL ,blc.total_pay as TOTALPAY,bl.status as STATUS FROM business_loan bl 
left join business_loan_close blc on blc.loan_id = bl.loan_id where bl.loan_date > '".$_GET['fromDate']."' and 
  bl.loan_date < '".$_GET['toDate']."' ".$status." ".$inter."   order by bl.loan_id asc";



$qur = mysqli_query($conn,$sql);

$today = date("m.d.y");
}

?>
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 
<title>BusinessLoanPdf</title>
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
          <th>LoanGrantAmount</th>
          <th>InterestPercent</th> 
          <th>DailyInerest</th>
          <th>MonthlyInerest</th>
          <th>InterestType</th>
         
         
          <th>CustomerName</th>
          <th>PhoneNo</th>
           <th>PadiAmt</th>
            <th>CloseDate</th>
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
         $totalDailyInterest=0.00;
       
         $totalPaidAmt=0.00;
          $totalPay=0.00;
          while($result = mysqli_fetch_array($qur)) {

            $totalNoPerson++;
            $totalDailyInterest = $totalDailyInterest + $result["DAILYNTEREST"];
          
            $totalPaidAmt = $totalPaidAmt + $result["PADIAMOUNT"];
              $totalPay = $totalPay + $result["TOTALPAY"];
        
          ?>
            <tr>          
              <td><?php echo $result["LOANNO"];?></td> 
             <td ><?php $date = DateTime::createFromFormat('Y-m-d',  $result["LOAN_DATE"]);
                    echo $date->format('d/m/Y');?></td>
              <td align="right"><?php echo $result["LOANGRANDAMOUNT"];?></td>
              <td  align="right"><?php echo number_format($result["INTERESTPERCENT"],2,'.','');?></td>  
              <td align="right"><?php echo number_format($result["DAILYNTEREST"],2,'.','');?></td>
               <td align="right"><?php echo number_format($result["MonthlyInerest"],2,'.','');?></td>
              <td align="right"><?php echo $result["interest_type"];?></td>
              
             
              <td ><?php echo $result["CUSTOMERNAME"];?></td>
              <td ><?php echo $result["PHONENO"];?></td>
               <td align="right"><?php echo number_format($result["PADIAMOUNT"],2,'.','');?></td>
                <td ><?php if($result["CLOSEDATE"]==null){
                echo "-----";}else{ 

$date = DateTime::createFromFormat('Y-m-d',  $result["CLOSEDATE"]); 
                    echo $date->format('d/m/Y'); }?></td>
               <td ><?php echo number_format($result["TOTALPAY"],2,'.','');?></td>
              
              
            </tr>

          <?php 
            }
          ?> 

         <tr> 
            <td colspan="11" class="boldText">TOTAL NO OF PERSON </td>
            <td align="right"> <?php echo number_format($totalNoPerson,2,'.',''); ?> </td>
         </tr>

       
          <tr> 
            <td colspan="11" class="boldText">TOTAL PADI AMT </td>
            <td align="right"><?php echo number_format($totalPaidAmt,2,'.',''); ?> </td>
         </tr>

        
          <tr> 
            <td colspan="11" class="boldText">TOTAL PAY </td>
            <td align="right"><?php echo number_format($totalPay,2,'.',''); ?> </td>
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