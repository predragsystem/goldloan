
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
bl.daily_interest_amount as DAILYNTEREST,bl.receipt_mode as RECEIPTMODE,  bl.interest_type as interest_type,
bl.customer_name as CUSTOMERNAME, bl.phone_no as PHONENO,bl.aadhar_no as AADHARNO,bl.paid_amount as PADIAMOUNT,CASE WHEN blc.closing_date >0 THEN date(blc.closing_date) ELSE 0 END as CLOSEDDATE,CASE WHEN blc.total_pay >0 THEN blc.total_pay ELSE 0.00 END as TOTALPAY,bl.status as STATUS FROM business_loan bl 
left join business_loan_close blc on blc.loan_id = bl.loan_id where bl.loan_date > '".$_GET['fromDate']."' and 
  bl.loan_date < '".$_GET['toDate']."' ".$status." ".$inter."   order by bl.loan_id asc";


$qur = mysqli_query($conn,$sql);

$today = date("m.d.y");

$filename='DailyBusinessReport-'.$today.'.xls';  

// Download file
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");

// Write data to file
$flag = false;
while($row = mysqli_fetch_assoc($qur)) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\r\n";
      $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
  }
}
?>


