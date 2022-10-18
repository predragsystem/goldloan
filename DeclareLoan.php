<?php  include 'header.php'; 
 include 'database/DatabaseConfig.php'; ?><br><br><br><br><br><br>

<script type="text/javascript">
 
   
    
function select_value(value){
           var getvalue=document.getElementById("interestType").value ;
            // alert(getvalue);
        if(getvalue=="30")
        {
           // alert("daily");

           // alert("calculate1");
           calculate1();
           document.getElementById("monthInterestAmount").value ="0";

          

    var input = document.getElementById("interestPercentage");
input.addEventListener("keyup", function () {
  calculate1()
});
       }
        else{
           // alert("monthly");

           // alert("calculate");

        calculate();
document.getElementById("dailyInterestAmount").value ="0";

    var input = document.getElementById("interestPercentage");
input.addEventListener("keyup", function () {
  calculate()
});

      } 





}




function select_loanvalue(value){
           var getvalue=document.getElementById("loanType").value ;
            // alert(getvalue);
        if(getvalue=="jewelloan")
        {
          
          
           document.getElementById("noOfGrams").value ="";
        document.getElementById("amountPerGram").value ="";

 }
        else{
           // alert("monthly");

           // alert("calculate");
document.getElementById("noOfGrams").value ="0";
document.getElementById("amountPerGram").value ="0";
       


      } 





}



function calculate1()
           {
            // alert("daily ok")
               p = document.getElementById("loanGrandAmount").value;
               n = document.getElementById("year").value=1; // no. of compoundings per year
               t = document.getElementById("interestType").value; // no. of months
               r = document.getElementById("interestPercentage").value;
               result = document.getElementById("result");

               // The equation is A = p * [[1 + (r/n)] ^ nt]
               A = (p* Math.pow((1 + (r/( t*100))), ( n )));
               // alert(A);
               R=(A.toFixed(2) - p).toFixed(2); 
               // alert(R);
           document.getElementById("dailyInterestAmount").value = Math.round(R) ;

          


            
 }



function calculate()
           {
            // alert("month okey");

               p = document.getElementById("loanGrandAmount").value;
               n = document.getElementById("year").value=1; // no. of compoundings per year
               t = document.getElementById("interestType").value; // no. of months
               r = document.getElementById("interestPercentage").value;
               result = document.getElementById("result");

               // The equation is A = p * [[1 + (r/n)] ^ nt]
               A = (p* Math.pow((1 + (r/(n*100))), (n*t)));
               // alert(A);
               S=(A.toFixed(2) - p).toFixed(2); 
           document.getElementById("monthInterestAmount").value =  Math.round(S);
               

              
              
           }


function interestrecived(value){
  var getvalueint=document.getElementById("firstMonthInterestReceived").value ;

    // alert("recive1");
     if(getvalueint=="YES")
        {
            // alert("yes");
       receiveyes();
           }
else
{
     // alert("no");
receiveno();
}


}

 function receiveyes(){
        var reciveloan = document.getElementById("loanGrandAmount").value - document.getElementById("monthInterestAmount").value;

           document.getElementById("loanReceiveAmount").value = reciveloan;
       }
 

 function receiveno(){
    // alert("no");

        var receiveno = document.getElementById("loanGrandAmount").value;
     
           document.getElementById("loanReceiveAmount").value = receiveno;

}



    

     function getjewellloan(){
        
        var total=noOfGrams.value * amountPerGram.value;
    document.getElementById("loanGrandAmount").value =  Math.round(total);

    // alert(total);
    }


function businesstype(){


}





</script>
<?php 

if(isset($_POST['submit'])== 'Save') { 
    $query = "insert into loan_master(loan_date,loan_type,no_of_grams,amount_per_gram,loan_grand_amount,
        interest_type,interest_percentage,month_interest_amount,daily_interest_amount,first_month_interest_received,receipt_mode,loan_receive_amount,customer_name,gender,phone_no,address,aadhar_no,reference,created_date,created_by,modified_date, modified_by,status,paid_amt) 
        values('".$_POST['loanDate']."','".$_POST['loanType']."', ".$_POST['noOfGrams'].",".$_POST['amountPerGram'].",".$_POST['loanGrandAmount'].",'".$_POST['interestType']."', ".$_POST['interestPercentage'].", ".$_POST['monthInterestAmount'].", ".$_POST['dailyInterestAmount'].", '".$_POST['firstMonthInterestReceived']."', '".$_POST['receiptMode']."',".$_POST['loanReceiveAmount'].",'".$_POST['customerName']."','".$_POST['gender']."',".$_POST['phoneNo'].",'".$_POST['address']."',".$_POST['aadharNo'].",'".$_POST['reference']."',now(),1,now(),1,'ACTIVE',0)";
        // echo $query;
        $sql=mysqli_query($conn,$query);
}

            
?>

<div class="container">
        <h4 class="card-title" id="basic-layout-colored-form-control">Loan Master</h4><br>
        <a class="heading-elements-toggle">
            <i class="icon-ellipsis font-medium-3"></i>
        </a>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="loanmaster">

                <div class="row">
                <div class="col-sm-4">
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
                        <label for="Loan Type">Loan Type<span class="spanColor">*</span></label> 
                        <div style="border: 1px solid #ccc5b9;" "> 
                           <select name="loanType" class="selectpicker"  onchange="changeCodeType(true);select_loanvalue(value);" id="loanType" autocomplete="off"  data-style="no-style form-control" data-menu-style="" required >
                                <option value="">Loan Type</option>
                                <option value="jewelloan">Jewell Loan</option>
                                <option value="business">Business</option>
                            </select>
                            </div>
                           <span id="loanTypeError" style="color:red"></span>

                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                    <label for="No Of Grams">No Of Grams<span class="spanColor">*</span></label> 
                            <input type="text"  placeholder="No Of Grams" class="form-control border-input" id="noOfGrams" name="noOfGrams" autocomplete="off" maxlength="250" readonly onkeyup ="getjewellloan();" required="">
                        </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="Amount Per Gram">Amount Per Gram<span class="spanColor">*</span></label> 
                            <input type="text"  placeholder="Amount Per Gram" id="amountPerGram" name="amountPerGram" autocomplete="off" class="form-control border-input" readonly onkeyup ="getjewellloan();" required>
                          
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
                            <select name="interestType" class="selectpicker" onchange="changeBarCodeType(true);select_value(value);" id="interestType" autocomplete="off"  data-style="no-style form-control" data-menu-style="" required>
                                <option value="" disabled selected> Interest Type</option>
                                <option value="30" >Daily</option>
                                <option value="1" >Monthly</option>
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
                        <label for="Amount Per Gram">Month Interest Amount<span class="spanColor">*</span></label> 
                            <input type="text" value="" placeholder="Month Interest Amount" id="monthInterestAmount" name="monthInterestAmount" autocomplete="off" class="form-control border-input"   onkeyup="calculate();" readonly="true">
                        </div>
                </div>
              
                
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                    <label for="No Of Grams">Daily Interest Amount<span class="spanColor">*</span></label> 
                            <input type="text" value="0.00"  placeholder="Daily Interest Amount" class="form-control border-input" id="dailyInterestAmount" name="dailyInterestAmount" autocomplete="off" maxlength="250"   onkeyup="calculate1();" readonly="true">
                        </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="Amount Per Gram">First Month Interest Received<span class="spanColor">*</span></label> 
                            <div style="border: 1px solid #ccc5b9;"> 
                            <select name="firstMonthInterestReceived" class="selectpicker" 
                            id="firstMonthInterestReceived" autocomplete="off"  data-style="no-style form-control" onchange="interestrecived(value);" data-menu-style=""    required>
                                <option value="" >Choose</option>
                                <option value="YES">Yes</option>
                                <option value="NO" >No</option>
                            </select>
                            </div>
                        </div>
                </div>
                <div class="col-sm-4">
            <div class="form-group">
                        <label for="Loan Grand Amount">Receipt Mode</label> 
                            <div style="border: 1px solid #ccc5b9;"> 
                            <select name="receiptMode" class="selectpicker" 
                            id="receiptMode" autocomplete="off"  data-style="no-style form-control" data-menu-style="" >
                                <option disabled selected>Choose</option>
                                <option value="CASH" selected>Cash</option>
                                <option value="CARD">Card</option>
                            </select>
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                    <label for="No Of Grams">Loan Received Amount<span class="spanColor">*</span></label> 
                            <input type="text" value="" placeholder="Loan Receive Amount" class="form-control border-input" id="loanReceiveAmount" name="loanReceiveAmount" autocomplete="off" maxlength="250" readonly="true">
                            
                        </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="Amount Per Gram">Customer Name</label> 
                            <input type="text"  placeholder="Customer Name" id="customerName" name="customerName" autocomplete="off" class="form-control border-input" required>
                        </div>
                </div>
                <div class="col-sm-4">
            <div class="form-group">
                        <label for="Loan Grand Amount">Gender</label> 
                            <div style="border: 1px solid #ccc5b9;"> 
                            <select name="gender" class="selectpicker" 
                            id="gender" autocomplete="off" data-style="no-style form-control" data-menu-style="" required>
                                <option value="" selected="selected">Choose</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            </div>
                        </div>
                </div>
            </div>
  <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                    <label for="phone_no">Phone Number</label> 
                            <input type="text" value="" placeholder="phone_no" class="form-control border-input" id="phoneNo" name="phoneNo" autocomplete="off" maxlength="250" required>
                        </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="Address">Address</label> 
                                <textarea name="address" id="address" class="form-control border-primary" maxlength="250" required></textarea> 
                        </div>
                </div>
                <div class="col-sm-4">
            <div class="form-group">
                        <label for="Loan Grand Amount">Aadhar No<span class="spanColor">*</span></label> 
                            <input type="text" value="" placeholder="Aadhar No" id="aadharNo" name="aadharNo" autocomplete="off"  class="form-control border-input" required>
                        </div>
                </div>
                
            </div>
            <div class="row">
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
            $('#dailyInterestAmount').prop('readOnly', true);           
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