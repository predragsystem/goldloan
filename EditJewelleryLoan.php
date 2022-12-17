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
    $lid = isset($_GET['loan_id']) ? $_GET['loan_id'] : $_POST['loan_id'];
    $toalMonth = 0;
    $sqlQuery="SELECT  lt.*,jl.*,jt.* FROM jewellery_loan as jl 
                inner join jewellery_loan_transaction as lt on jl.loan_id = lt.loan_id 
                inner join jewellery_loan_item as jt on jt.jewellery_loan_id=lt.id 

            where jl.loan_id = ".$lid." and jl.status = 'Active' ";
    $query = mysqli_query($conn,$sqlQuery);
    $result = mysqli_fetch_array($query);
    
    $loanTransactionDate = "select * FROM jewellery_loan_transaction where loan_id = ".$result['loan_id']."  ";  
    $loanTD = mysqli_query($conn,$loanTransactionDate);
    $loanTD1 = mysqli_query($conn,$loanTransactionDate);

    if(empty($result)){
        echo "<SCRIPT LANGUAGE='JavaScript'>                   
            $('#smallAlertModal').modal('show');
        </SCRIPT>";
    }
   
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php
if(isset($_POST['submit']) == 'update') {

  $loanId = $_POST['loan_id'];
  $updateLoanData = "update jewellery_loan set loan_date = '".$_POST['loanDate']."',customer_name = '".$_POST['customerName']."',phone = '".$_POST['contact']."'  WHERE loan_id = ".$loanId." ";
    $sqlQuery1=mysqli_query($conn,$updateLoanData);
   
    $totalItem = count($_POST['jewellerytypeId']);
    for($i=1;$i<=$totalItem;$i++)
    {
        $updateLoanItem = "update jewellery_loan_item set jewellery_type_id = '".$_POST['jewelleryTypeGrid_'.$i]."',description = '".$_POST['jewelleryDesc_'.$i]."',location = '".$_POST['jewelleryloc_'.$i]."',total_grams = '".$_POST['jewelleryGram_'.$i]."',isreturn = '".$_POST['jewelleryrereturn_'.$i]."'  WHERE load_id = ".$_POST['jewTypeId_'.$i]." ";
       $sqlQuery1=mysqli_query($conn,$updateLoanItem);
    }

    echo $totalTrasaction = count($_POST['TrascId']);
    for($i=1;$i<=$totalTrasaction;$i++)
    {
        echo $updateLoanTras = "update jewellery_loan_transaction set trans_date = '".$_POST['TrasactionDate_'.$i]."' WHERE id = ".$_POST['TrascId_'.$i]." ";
       $sqlQuery1=mysqli_query($conn,$updateLoanTras);

    }
    
    echo "<SCRIPT LANGUAGE='JavaScript'>                   
                 showSucessMessage('Record Updated Successfully');
                  window.location.href='ViewLoanTrasaction.php?loan_id=$loanId';
                </SCRIPT>";
    }
  
?>

 <div class="container">
    <h4>Edit Loan
    <span style="text-align: right;margin-left: 40%;"><a href="NewExtraLoan.php?loan_id='<?php echo $result["loan_id"];?>'" class="btn btn-sm btn-success">वाढीव लोन</a>
    <a href="ViewLoanTrasaction.php?loan_id='<?php echo $result["loan_id"];?>'" class="btn btn-sm btn-warning">माहिती पहा</a></span>
    </h4>
    <div class="row">
     
                <div class="col-sm-3">

                    <div class="form-group">
                        <label for="Loan No">Loan No<span class="spanColor">*</span></label> 
                           <input type="text" value="<?php echo $result["loan_id"];?>" placeholder="Loan No" id="loan_id" name="loan_id" autocomplete="off" maxlength="250" class="form-control border-input" readonly><br>
                           <center>
                           <button type="button" class="btn btn-warning mr-1 mobileView" onclick="loan();">Look Up</button>
                           </center>
                        </div>
                       
                </div>
                <div class="col-sm-3">
                    
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                    <div class="form-group">
                        <input type="hidden" name="loan_id" id="loan_id" value="<?php echo $result["loan_id"];?>">
                        <input type="hidden" name="total_month" id="total_month" value="<?php echo $totalday;?>">
                        <label for="Lone Date">Loan Date<small>(dd-mm-yyyy)</small></label> 
                            <input type="date" value="<?php if(!empty($result["loan_date"])){
                            echo $result["loan_date"];}?>" placeholder="Loan Date" id="loanDate" name="loanDate" autocomplete="off" maxlength="250" class="form-control border-input" >
                        </div>
                </div>
                <div class="col-sm-3">
                      <div class="form-group">
                        <label for="Loan Type">Customer Name</label> 
                            <input type="text" value="<?php echo $result["customer_name"];?>" placeholder="Customer Name" id="customerName" name="customerName" autocomplete="off" maxlength="250" class="form-control border-input" >
                        </div>
                </div>
                <div class="col-sm-3">
                      <div class="form-group">
                        <label for="Contact">Contact<span class="spanColor">*</span></label> 
                            <input type="text"  id="contact" name="contact" autocomplete="off" maxlength="250" class="form-control border-input" value="<?php echo $result["phone"];?>">
                        </div>
                </div>
            </div>
            
           <div class="row">
               <table class="table">
                  <tr>
                   <th>SrNo</th>
                   <th>Item</th>
                   <th>Description</th>
                   <th>Weight</th>
                   <th>Location</th>
                   <th>Item Return to customer?</th>
                   <?php 
                    $sqlTrasactionItem = "SELECT * FROM jewellery_loan_item WHERE jewellery_loan_id = ".$result['jewellery_loan_id']."  ";
                     $loanItem = mysqli_query($conn,$sqlTrasactionItem);
                     $count =0 ;
                   while($itemdata = mysqli_fetch_array($loanItem)) {  
                    $count++; 

                    ?>
                    <tr>
                        <td><?php echo $count; ?>
                            <input type="hidden" value='<?php echo $itemdata[0];?>' name='jewellerytypeId[]'>
                            <input type="hidden" value='<?php echo $itemdata[0];?>' name='jewTypeId_<?=$count;?>'>
                        </td>
                        <td><input type="text" value='<?php echo $itemdata['jewellery_type_id'];?>' name='jewelleryTypeGrid_<?=$count;?>' class=' form-control border-input'></td>
                        <td><input type="text" value='<?php echo $itemdata['description'];?>' name='jewelleryDesc_<?=$count;?>' class=' form-control border-input'></td>
                        <td><input type="text" value='<?php echo $itemdata['total_grams'];?>' name='jewelleryGram_<?=$count;?>' class=' form-control border-input'></td>
                        <td><select name='jewelleryloc_<?=$count;?>' class=' form-control border-input'>
                            <option value="Home" <?php if($itemdata['location'] == "Home"){ echo "Selected"; } ?>>Home</option>
                            <option value="Locker" <?php if($itemdata['location'] == "Locker"){ echo "Selected"; } ?>>Locker</option>
                            <option value="Shop" <?php if($itemdata['location'] == "Shop"){ echo "Selected"; } ?>>Shop</option>
                        </select></td>
                        <td><select name='jewelleryrereturn_<?=$count;?>' class=' form-control border-input'>
                            
                            <option value="No" <?php if($itemdata['isreturn'] == "No"){ echo "selected"; } ?>>No</option>
                            <option value="Yes" <?php if($itemdata['isreturn'] == "Yes"){ echo "selected"; } ?>>Yes</option>
                            
                            </select></td>
                      </tr>
                   <?php } ?>
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
          $count = 0;
          while($result1 = mysqli_fetch_array($loanTD1)) { 
            $count++;
            ?>
            <tr>
              <td>
                <input type="hidden" value="<?php echo $result1['id']; ?>" name="TrascId[]">
                <input type="hidden" value="<?php echo $result1['id']; ?>" name="TrascId_<?php echo $count; ?>">
                <input type="date" value="<?php echo $result1['trans_date']; ?>" name="TrasactionDate_<?php echo $count; ?>"></td>
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
          
        </table>

       
    </div>
               
            <center>
           <input type="submit" class="btn btn-success" value="Update" name="submit" >

              <button type="reset" class="btn btn-warning mr-1" align="right" >
                  <i class="icon-cross2"></i> Clear
              </button>
              </center>

    </form>
 </div>
</div>

</body>

 <br>
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
    $('#loanDate').attr('max', maxDate);
});
   

    
function totalAmount(){
   
       var interest = Number(document.getElementById("interestPay").value);
       var loan =  Number(document.getElementById("loanPay").value);
       var penalty =  Number(document.getElementById("penalty").value);
          total = interest + loan + penalty;
          document.getElementById("totalPay").value = total;
      }

window.onload = pageOnLoad;
function pageOnLoad()
           {
             var  Amount = document.getElementById("loanGrandAmount").value;
             var  Month = document.getElementById("total_month").value; // no. of months
             var  InterestPer = document.getElementById("interest").value;
           
               // The equation is A = p * [[1 + (r/n)] ^ nt]
              res = (Amount* Month* ((InterestPer/100))* 1/365);
               //alert(r);
                result=Math.round( res*100)/100,2;
         //  document.getElementById("interestBalance").value =result;

           

   var date = new Date();
 
// GET YYYY, MM AND DD FROM THE DATE OBJECT
var yyyy = date.getFullYear().toString();
var mm = (date.getMonth()+1).toString();
var dd  = date.getDate().toString();
 
// CONVERT mm AND dd INTO chars
var mmChars = mm.split('');
var ddChars = dd.split('');
 
// CONCAT THE STRINGS IN YYYY-MM-DD FORMAT

var emi = document.getElementById("duedate").value;
       emiDate=new Date(emi);
      //alert(emiDate);
       var today = document.getElementById("loanDate").value;
       todayDate=new Date(today);
        // alert(todayDate);

     

 if(todayDate<emiDate)
{
    // alert("lessthan");
   document.getElementById("myDialog").showModal(); 
   
}
else if(todayDate>emiDate)
{
    // alert("greater");
     document.getElementById("penalty").removeAttribute("readonly");
    
}
  else{
    // alert("equal");
    document.getElementById("penalty").setAttribute("readonly", true);
   
}  


           }



 </script>
<?php  include 'footer.php';  ?>