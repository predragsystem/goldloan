<?php


include_once('/../../database/DatabaseConfig.php');

$sql = "SELECT DISTINCT jewellery_loan_transaction.loan_id as LoanNo,loan_date as LoanDate,customer_name as CustomerName,phone as Phone,address as Address,aadhar_no as AadharNo,no_of_grams as NoOfGram,amount_per_gram as AmountPerGram,loan_grand_amount as LoanGrandAmount,interest_percentage as InterestPercentage,month_interest_amount as MonthInterstAmount,receipt_mode as ReceiptMode,paid_amt as PaidAmt,total_qty as TotalQty,no_of_items as NoOfItems,jewellery_loan_transaction.trans_date as TransactionDate,jewellery_loan_transaction.interest_pay as InterestPay,jewellery_loan_transaction.total_pay as TotalPay,jewellery_loan_transaction.loan_balance as LoanBalance  FROM jewellery_loan inner join jewellery_loan_transaction on jewellery_loan.loan_id=jewellery_loan_transaction.loan_id and status='ACTIVE' order by jewellery_loan.loan_id asc";

$qurery = mysqli_query($conn,$sql);

$today = date("m.d.y");

$filename='JewelleryLoanReport-'.$today.'.xls';  

// Download file
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");

// Write data to file
$flag = false;
while($row = mysqli_fetch_assoc($qurery)) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\r\n";
      $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
  }
?>


