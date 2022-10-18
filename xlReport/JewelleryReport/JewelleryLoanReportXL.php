<?php


include_once('/home/lwnts2yp/public_html/jewelleryloan/database/DatabaseConfig.php');
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
jl.amount_per_gram as AmountPerGram,jl.loan_grand_amount as LoanGrandAmount,jl.interest_percentage as InterestPercentage,jl.month_interest_amount as MonthInterstAmount,jl.total_qty as TotalQty,jl.no_of_items as NoOfItems,jl.paid_amt as PaidAmount, CASE WHEN jlc.closing_date >0 THEN date(jlc.closing_date) ELSE 0 END as ClosingDate,CASE WHEN jlc.loan_balance >0 THEN date(jlc.loan_balance) ELSE 0.00 END as LoanBalance ,CASE WHEN jlc.total_pay >0 THEN date(jlc.total_pay) ELSE 0.00 END as TotalPay,jl.status as status FROM jewellery_loan  jl left join jewellery_loan_close jlc on jlc.loan_id=jl.loan_id where jl.loan_date > '".$_GET['fromDate']."' and 
 jl.loan_date < '".$_GET['toDate']."' ".$status." order by jl.loan_id asc";

$qurery = mysqli_query($conn,$sql);

$today = date("m.d.y");

$filename='JewelleryLoanClose-'.$today.'.xls';  

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
}
?>


