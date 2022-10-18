
<?php


include_once('/../../database/DatabaseConfig.php');
$sql = "SELECT loan_id as LoanNo, loan_date as LoanDate, loan_grand_amount as LoanGrandAmount, interest_type as  InterestType, interest_percentage as InterestPercentage,
month_interest_amount as MonthInterestAmount, daily_interest_amount as DailyInterestAmount ,first_month_interest_received as FirstMonthInterestReceived ,
 receipt_mode as ReceiptMode , loan_received_amount as LoanReceivedAmount ,customer_name as customerName ,gender as Gender , phone_no as PhoneNo ,aadhar_no as AadharNo , address as Address ,reference as Reference FROM business_loan where status='Active';
 
$qur = mysqli_query($conn,$sql);

// echo $qur;

$filename = "BusinessLoanReport.xls"; // File Name

// Download file
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");

// Write data to file
$flag = false;
while($row = mysqli_fetch_assoc($qur)) {
    if(!$flag) {
      // display field/column names as first row
      echo implode("\t", array_keys($row)) . "\r\n";
      $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
  }
?>


 
