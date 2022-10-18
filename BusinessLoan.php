<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?><br><br><br><br><br>


<script type="text/javascript">
 
 function Interest_type_value(value){
           var getvalue=document.getElementById("interestType").value ;
            // alert(getvalue);
        if(getvalue=="Daily")
        {
          // alert("daily");
          // alert("calculate1");
           dailycalculation();
           document.getElementById("monthInterestAmount").value ="0";
var input = document.getElementById("interestPercentage");
input.addEventListener("keyup", function () {
  dailycalculation()
});
       }
        else{
           // alert("monthly");
          // alert("calculate");

        monthlycalculation();
document.getElementById("dailyInterestAmount").value ="0";
 var input = document.getElementById("interestPercentage");
input.addEventListener("keyup", function () {
  monthlycalculation()
});
} 

}

function dailycalculation()
           {
            // alert("daily ok")
               principal = document.getElementById("loanGrandAmount").value;
               time = 365; // no. of months
               interest = document.getElementById("interestPercentage").value;
               dailyresult = (principal* ((interest/100))/ ( time ));
               result=Math.round(dailyresult*100)/100,2;
              document.getElementById("dailyInterestAmount").value = result;
            }




function monthlycalculation()
           {
            // alert("month okey");

               principal = document.getElementById("loanGrandAmount").value;
               year = document.getElementById("year").value=1; // no. of compoundings per year
               time =12; // no. of months
              interest= document.getElementById("interestPercentage").value;
               result = document.getElementById("result");
               monthlyresult= (principal* ((interest/100))/ (time));
               // alert(A);
               result=Math.round(monthlyresult*100)/100;
              document.getElementById("monthInterestAmount").value =result;
               

           }

function Firstinterestrecived(value){
  var getvalueint=document.getElementById("firstMonthInterestReceived").value ;

    // alert("recive1");
     if(getvalueint=="YES")
        {
            // alert("yes");
       interestreceiveyes();
           }
else
{
     // alert("no");
interestreceiveno();
}


}

 function interestreceiveyes(){
        var reciveloan = document.getElementById("loanGrandAmount").value - document.getElementById("monthInterestAmount").value;
         document.getElementById("loanReceiveAmount").value = reciveloan;
       }
 

 function interestreceiveno(){
    // alert("no");
    var receiveno = document.getElementById("loanGrandAmount").value;
     document.getElementById("loanReceiveAmount").value = receiveno;

}

</script>


<?php 

if(isset($_POST['submit'])== 'Save') { 
    $query = "insert into business_loan(loan_date,loan_grand_amount,interest_type,interest_percentage,month_interest_amount,daily_interest_amount,receipt_mode,customer_name,gender,phone_no,aadhar_no,address,reference,created_date,created_by,modified_date, modified_by,status,paid_amount)  values('".$_POST['loanDate']."', ".$_POST['loanGrandAmount'].",'".$_POST['interestType']."', ".$_POST['interestPercentage'].", ".$_POST['monthInterestAmount'].", ".$_POST['dailyInterestAmount'].", '".$_POST['receiptMode']."','".$_POST['customerName']."','".$_POST['gender']."',".$_POST['phoneNo'].",".$_POST['aadharNo'].",'".$_POST['address']."','".$_POST['reference']."',now(),1,now(),1,'ACTIVE',0)";
        // echo $query;
    
        // $sql=mysqli_query($conn,$query);
        $result=mysqli_query($conn,$query);
       $fetch=mysqli_fetch_array(mysqli_query($conn,"select max(loan_id) as mloanid from business_loan"));
    $lid=$fetch['mloanid'];
    $ldate=date('Y-m-d',strtotime($_POST['loanDate']));
  if($_POST['interestType']=='Monthly'){
     $duedate=date('Y-m-d',strtotime('+30 days',strtotime($_POST['loanDate'])));  
  }
 else{
   $duedate=date('Y-m-d',strtotime('+1 days',strtotime($_POST['loanDate']))); 
 }
  $result2=mysqli_query($conn,"insert into business_loan_transaction(loan_id,transaction_date,due_date) values(".$lid.",'".$ldate."','".$duedate."')");
if($result==true){
echo "<SCRIPT LANGUAGE='JavaScript'>                   
                 showSucessMessage('Business Loan Successfully Saved');
                </SCRIPT>";
}

}

?>


<div class="container">
        <h4>Business Loan</h4><br>
        <a class="heading-elements-toggle">
            <i class="icon-ellipsis font-medium-3"></i>
        </a>

 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="loanmaster">

    <div class="row">
                <div class="col-sm-4 ">
                    <div class="form-group">
                     <label for="Loan No">Loan No</label> 
                            <input type="text" value="" placeholder="Loan No" id="loanNo" name="loanNo" autocomplete="off" maxlength="250" class="form-control border-input" readonly >
                        </div>
                         <input type="hidden" value="" placeholder="year" id="year" name="year" autocomplete="off" maxlength="250" class="form-control border-input" >
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="Lone Date">Loan Date<span class="spanColor">*</span></label> 
                            <input type="date" value="" placeholder="Lone Date" id="loanDate" name="loanDate" autocomplete="off" maxlength="250" class="form-control border-input" required>
                        </div>
                </div>
                <div class="col-sm-4">
            <div class="form-group">
                        <label for="Loan Grand Amount">Loan Grand Amount<span class="spanColor">*</span></label> 
                            <input type="text"  placeholder="Loan Grand Amount" id="loanGrandAmount" name="loanGrandAmount" autocomplete="off"  class="form-control border-input" required>
                        </div>
                </div>
         </div>
           
  <div class="row">
                <div class="col-sm-4">
                   <div class="form-group">
                        <label for="Interest Type">Interest Type<span class="spanColor">*</span></label> 
                        <div style="border: 1px solid #ccc5b9;"> 
                            <select name="interestType"    class="form-control  border-primary" onchange="changeBarCodeType(true);Interest_type_value(value);" id="interestType" autocomplete="off"  data-style="no-style form-control" data-menu-style="" required>
                                <option value="" disabled selected> Choose</option>
                                <option value="Daily" >Daily</option>
                                <option value="Monthly" >Monthly</option>
                            </select>
                            </div>
                        </div>
                </div>
               <div class="col-sm-4">
            <div class="form-group">
                        <label for="InterestPercentage">Interest Percentage<span class="spanColor">*</span></label> 
                            <input type="text" value="" placeholder="Interest Percentage" id="interestPercentage" name="interestPercentage" autocomplete="off"  class="form-control border-input" required>
                        </div>
                </div>



                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="Amount Per Gram">Month Interest Amount</label> 
                            <input type="text" value="0.00" placeholder="Month Interest Amount" id="monthInterestAmount" name="monthInterestAmount" autocomplete="off" class="form-control border-input"   onkeyup="monthlycalculation();" readonly="true">
                        </div>
                </div>
              
          
          </div>
           
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                    <label for="No Of Grams">Daily Interest Amount</label> 
                            <input type="text" value="0.00"  placeholder="Daily Interest Amount" class="form-control border-input" id="dailyInterestAmount" name="dailyInterestAmount" autocomplete="off" maxlength="250"   onkeyup="dailycalculation();" readonly="true">
                        </div>
                </div>
                
                <div class="col-sm-4">
            <div class="form-group">
                        <label for="Loan Grand Amount">Receipt Mode<span class="spanColor">*</span></label> 
                            <div style="border: 1px solid #ccc5b9;"> 
                            <select name="receiptMode" class="form-control  border-primary" 
                            id="receiptMode" autocomplete="off"  data-style="no-style form-control" data-menu-style="" >
                                <option disabled selected>Choose</option>
                                <option value="CASH">Cash</option>
                                <option value="CARD">Card</option>
                            </select>
                            </div>
                        </div>
                </div>
                 <div class="col-sm-4">
                    <div class="form-group">
                        <label for="Amount Per Gram">Customer Name<span class="spanColor">*</span></label> 
                            <input type="text"  placeholder="Customer Name"  maxlength = "150" id="customerName" name="customerName" autocomplete="off" class="form-control border-input" required>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
            <div class="form-group">
                        <label for="Loan Grand Amount">Gender<span class="spanColor">*</span></label> 
                            <div style="border: 1px solid #ccc5b9;"> 
                            <select name="gender" class="form-control  border-primary" 
                            id="gender" autocomplete="off" data-style="no-style form-control" data-menu-style="" required>
                                <option value="" selected="selected">Choose</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            </div>
                        </div>
                </div>
                 <div class="col-sm-4">
                    <div class="form-group">
                    <label for="phone_no">Phone Number<span class="spanColor">*</span></label> 
                            <input type="text" value="" placeholder="Phone Number "  class="form-control border-input" id="phoneNo" name="phoneNo" autocomplete="off"  maxlength="10" required oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        </div>
                </div>
                  <div class="col-sm-4">
            <div class="form-group">
                        <label for="Loan Grand Amount">Aadhar No<span class="spanColor">*</span></label> 
                            <input type="text" value="" placeholder="Aadhar No"  maxlength = "12" id="aadharNo" name="aadharNo" autocomplete="off"  maxlength="12" class="form-control border-input" required oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        </div>
                </div>

            </div>
  <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="Address">Address<span class="spanColor">*</span></label> 
                                <textarea name="address" id="address" class="form-control border-primary" maxlength="250" required></textarea> 
                        </div>
                </div>
                 <div class="col-sm-4">
                    <div class="form-group">
                    <label for="No Of Grams">Reference</label> 
                            <textarea name="reference" id="reference" class="form-control border-primary" maxlength="250" required></textarea> 
                        </div>
                        </div>
            </div>
           
                        <div class="button" align="center">
                        <input type="submit" class="btn btn-success" value="Save" name="submit" >
                                        
                                    
                                    <button type="reset" class="btn btn-warning mr-1" >
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    </div>
            </form>
    
</div><br>


 



<script>





    function changeBarCodeType(forceEidt){

        var barcode=document.getElementById('interestType').value; 

        if(barcode=='monthly'){
            $('#monthInterestAmount').prop('required', true);
            $('#monthInterestAmount').prop('readOnly', false);
            $('#dailyInterestAmount').prpo('readOnly', true);           
            if(forceEidt == true){
                $('#monthInterestAmount').val('');
                $('#dailyInterestAmount').val('');
        }}else if(barcode=='daily'){
            $('#dailyInterestAmount').prop('required', true);
            $('#dailyInterestAmount').prop('readOnly', false);
            $('#monthInterestAmount').prop('readOnly', true);           
            if(forceEidt == true){
                $('#dailyInterestAmount').val('');
            }
        }
            
        }
    
function changeCodeType(force){
    var bar=document.getElementById('loanType').value; 
    if(bar=='jewelloan'){
            $('#noOfGrams').prop('readOnly', false);
            $('#amountPerGram').prop('readOnly', false);
            $('#loanGrandAmount').prop('readOnly', true);       
            if(force == true){
                $('#noOfGrams').val('');
                $('#amountPerGram').val('');
    }}else if(bar=='business'){
            $('#noOfGrams').prop('readOnly', true);
            $('#amountPerGram').prop('readOnly', true);
                $('#loanGrandAmount').prop('readOnly', false);
                        
            if(force == false){
                $('#noOfGrams').val('');
                $('#amountPerGram').val('');
        } 


    
}
}
</script>
<?php  include 'footer.php';  ?>


 