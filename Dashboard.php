<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?>


<body onload="">
<div class="wrapper demo-wrapper dashboard">
    <div class="main">
       
            <div class="container tim">
                <div class="row ">
                    
                     <article class=" col-md-3 card shadow bg-img">
    <h1 class="card__title"><a href='JewelleryLoan.php'>नवीन लोण </a></h1>
   
  </article>
  <article class="col-md-3  card shadow bg-img">
    <h1 class="card__title"> <a href="ViewLoan.php">लोण पहा </a></h1>
    
  </article>
  <article class="col-md-3 card shadow bg-img">
    <h1 class="card__title"><a href="JewelleryLoanPayment.php"> लोण भरणे </a></h1>
   
  </article>

                </div>
                <?php 
                        $loanData = mysqli_query($conn,"select SUM(loan_grand_amount)  as total_loan, sum(paid_amt) as paid from jewellery_loan WHERE status='ACTIVE'"); 
                        $rowData = mysqli_fetch_assoc($loanData); 
                        $sumData = round($rowData['total_loan'],0);
                        $paidLoan = round($rowData['paid'],0);
                        ?>
                <div class="row">
                    <article class=" col-md-3 card shadow text-center">
                        <img src="assets/img/logo/logo5.png" width="80">
                        <h5 class="card__title bold">Total Loan</h5>
                        
                        <span>₹&nbsp;<?=$sumData;?></span>
                    </article>
                     <article class=" col-md-3 card shadow text-center">
                        <img src="assets/img/logo/logo10.png" width="80">
                        <h5 class="card__title bold">Total Paid</h5>
                        
                        <span>₹&nbsp;<?=$paidLoan;?></span>
                    </article>
                </div>
            </div>
       
    </div>
</div>
      

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    // $(document).ready(function () {

    //  $("#loan_no").on('keyup', function (e) {
    //      if (e.keyCode == 13) {            
    //          window.location.href="LoanReport.php?loan_no="+$('#loan_no').val();
    //      }   
    //  });

        

    // });
        function tableDataView() {

    var loan_no = $('#loan_no').val();  
          
    window.location.href="LoanReport.php?loan_no="+loan_no;
    
}   
// function tableDataedit() {

    // var loan_no = $('#loan_date').val(); 
          
    // window.location.href="LoanReport.php?loan_date="+loan_date;
    
// }    

// function showdate(){
        // var fromDate = document.getElementById("fromDate").value;
    // var toDate = document.getElementById("toDate").value;
      // window.location.href = "LoanReport.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59";
    
    // }
function showdate(){

    var fromDate = document.getElementById("fromDate").value;
    var toDate = document.getElementById("toDate").value;
    var loan_no = $('#loan_no').val();  
    
    window.location.href = "LoanReport.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&loan_no="+loan_no;
    
}
</script>   

</body>

<?php  include 'footer.php';  ?>