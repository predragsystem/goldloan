<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?>

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
 
  <?php
                $sqlQuery="SELECT loan_id,loan_date,customer_name,loan_grand_amount,interest_percentage,month_interest_amount,paid_amt FROM jewellery_loan WHERE status='ACTIVE' ";
                $query = mysqli_query($conn,$sqlQuery);
               
         ?>
        
        

<div class="container">
    <h4>View Loan</h4><br>
    <div class="row">
        <table class="table" id="mytable">
              <thead>
                <tr>
                    <th scope="col">Loan ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Loan Date</th>
                    <th scope="col">Loan Amount</th>
                    <th scope="col">Total Intrest</th>
                    <th scope="col">Paid Amount</th>
                    <th scope="col">Pending Amount</th>
                </tr>
              </thead>
              <tbody>
                   <?php 
                   while($data = mysqli_fetch_array($query)){ 
                    $loanUrl = "ViewLoanTrasaction.php?loan_id=".$data['loan_id'];
                    $now = time(); // or your date as well
                        $loanDate = strtotime($data["loan_date"]);
                        $dayCalculate = $now - $loanDate;
                        $amount = (int)$data['loan_grand_amount'];
                        $rate = $data['interest_percentage'];
                        $totalday = round($dayCalculate / (60 * 60 * 24));
                        
                        //$totalday = (($dayCalculate) / 60 / 60 / 24);

                    $years = round((int)$totalday / 365, 4);
                    $interest = round($amount * ($rate) / 100, 2);
                    $interestperday = ((int)($interest) / (int)(30));
                    //echo $amount." ".$rate." ".$totalday." ".$interestperday."<br>";
                    $finalinterest = $totalday * $interestperday;
                    
                    $finalinterest = round($finalinterest,2);
                    ?>
                    <tr>
                       <td><a href='<?=$loanUrl;?>'><?php echo $data['loan_id'];?></a></td>
                       <td><a href='<?=$loanUrl;?>'><?php echo $data['customer_name'];?></a></td>
                       <td><?php echo $data['loan_date'];?></td>
                       <td><?php echo round($data['loan_grand_amount']);?></td>
                       <td><?php echo $finalinterest;?></td>
                       <td><?php echo round($data['paid_amt'],2);?></td>
                       <td><?php 
                         $loanDate = date('d-m-Y',strtotime($data["loan_date"]));
                        $currentDate = date('d-m-Y');
                       
                        $toalMonth = (date('m',strtotime($currentDate)) - date('m',strtotime($data["loan_date"])));
                       echo round(($data['loan_grand_amount'] + ($finalinterest) - $data['paid_amt']),2);?></td>
                      
                       
                   </tr>
                  <?php } ?>
            </tbody>

        </table>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link  rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
    $('#mytable').DataTable();
} );
</script>
<?php  include 'footer.php';  ?>