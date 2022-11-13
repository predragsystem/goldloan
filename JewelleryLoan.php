
<?php include 'header.php'; 
 include 'database/DatabaseConfig.php';?>
 <style type="text/css">
 	.mobileview {
    margin-right: 0px;
    margin-left: 0px;
}
 </style>
<?php
class jewelleryObj{
public $jewelleryId;
public $jewelleryName;
}
$sql1 = mysqli_query($conn,"select * from jewellery_type order by jewellery_name asc"); 	  

$jewelleryObjArray = array();


echo"<SCRIPT LANGUAGE='JavaScript'>
var jewelleryList = [];
</SCRIPT>";

while($result1 = mysqli_fetch_array($sql1)) {
$jewelleryName = $result1["jewellery_name"];
$jewelleryId = $result1["id"];
echo"<SCRIPT LANGUAGE='JavaScript'>
var jewellery_type = {id: $jewelleryId, jewellery_name:'".$jewelleryName."'}; 
jewelleryList.push(jewellery_type); 

</SCRIPT>";

$jewelleryObj = new jewelleryObj;
$jewelleryObj->jewelleryId = $jewelleryId;
$jewelleryObj->jewelleryName = $jewelleryName;  
$jewelleryObjArray[] = $jewelleryObj;

}
class jewellQualityObj{
public $qualityId;
public $qualityName;
}
$sql1 = mysqli_query($conn,"select * from jewellery_quality order by quality_name asc"); 	  

$qualityObjArray = array();


echo"<SCRIPT LANGUAGE='JavaScript'>
var qualityList = [];
</SCRIPT>";

while($result1 = mysqli_fetch_array($sql1)) {
$qualityName = $result1["quality_name"];
$qualityId = $result1["id"];
echo"<SCRIPT LANGUAGE='JavaScript'>
var quality = {id: $qualityId, quality_name:'".$qualityName."'}; 
qualityList.push(quality); 

</SCRIPT>";

$qualityObj = new jewellQualityObj;
$qualityObj->qualityId = $qualityId;
$qualityObj->qualityName = $qualityName;  
$qualityObjArray[] = $qualityObj;

}

//JewelleryLoan Insert
							
if(isset($_POST['action'])== 'Save') {

$noOfItems = $_POST['noOfItems'];
$totalQty= $_POST['totalQuality']; 
$totalGrams= $_POST['totalGrams']; 
$parentSqlQuery = "insert into jewellery_loan( loan_date,customer_name,gender,phone,
address,reference,aadhar_no,no_of_grams,loan_grand_amount ,interest_percentage,month_interest_amount,receipt_mode,created_date,created_by,modified_date, modified_by, paid_amt,status,total_qty,no_of_items,userpic)  values 
('".$_POST['loanDate']."','".$_POST['customerName']."','".$_POST['gender']."','".$_POST['phoneNo']."' ,'".$_POST['address']."', 
'', '',".$totalGrams.",".$_POST['loanGrandAmount'].",".$_POST['interestPercentage'].",".$_POST['monthInterestAmount'].",
'',
now(),".$_SESSION['userId'].",now(),".$_SESSION['userId'].",0.00,'ACTIVE',".$totalQty.",".$noOfItems.",'".$_POST['capture_pic']."')";


$query = mysqli_query($conn,$parentSqlQuery);

 $fetch=mysqli_fetch_array(mysqli_query($conn,"select max(loan_id) as mloanid from jewellery_loan"));
    $lid=$fetch['mloanid'];
    
    $ldate=date('Y-m-d',strtotime($_POST['loanDate']));
   	$today = date('Y-m-d');
     echo $result="insert into jewellery_loan_transaction(loan_id,trans_date,grandamt,trasactionType) values(".$lid.",'".$_POST['loanDate']."',".$_POST['loanGrandAmount'].",'Loan Approved')";
    
$jewell = mysqli_query($conn,$result);


$id=mysqli_insert_id($conn);  

if($id!=null){
	echo "hello";
	$gridSize = $_POST['gridSize'];

	for($i = 1; $i<=$gridSize; $i++ ) {
		

	if(isset($_POST['rowHiddenId_'.$i]) && 
	$_POST['rowHiddenId_'.$i] != ''){ 

	$jewellType= $_POST['jewelleryTypeGrid_'.$i];    
	$description =$_POST['description_'.$i];
	$quality = 0;
	$quantity =$_POST['quantityGrid_'.$i];
	$otalGramsGrid = $_POST['totalGramsGrid_'.$i];
	$location = $_POST['location_'.$i];
 	
	$childSqlQuery = "insert into jewellery_loan_item( jewellery_loan_id,jewellery_type_id,quality,quantity,total_grams,location,description) 
	values(".$id.",'".$jewellType."',".$quality.",".$quantity .",".$otalGramsGrid.",'".$location."',
	'".$description."')"; 
	$query2 =mysqli_query($conn,$childSqlQuery);	

	}
}


}

if ($query2 == true) {
	echo "<SCRIPT LANGUAGE='JavaScript'>                   
                    showSucessMessage('Jewellery Loan Successfully Saved');
                     window.location.href='ViewLoan.php';
                </SCRIPT>";


}

	

}



?>

<!-- / main menu-->

<div class="container">
  
<div class="row mobileview">
	<h4>Jewellery Loan </h4><br>	
		<form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="formId" name="formId" > 
			<input type="hidden" name="gridSize" id="gridSize" >
		<input type="hidden" name="itemGridSize" id="itemGridSize" value="0">
		<input type="hidden" name="action" id="action" value="Save"> 
		<input type="hidden" name="capture_pic" id="img_path" value="">	

			<div class="form-body">	
				<div class="row">
					<div class="col-sm-3"> 
						<div class="form-group">
							<label for="productBrand">
								Loan No
							</label> 
							 <input type="text" class="form-control border-input" placeholder="Loan No" id="loanNo" name="loanNo" readonly="true" >
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="loanDate">
								Loan Date<span class="spanColor">*</span>
							</label> 
							 <input type="date" class="form-control border-input" placeholder="Loan Date" id="loanDate" name="loanDate" required="required" value="<?php echo date('Y-m-d'); ?>">
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<label for="productBrand">
								Customer Name<span class="spanColor">*</span>
							</label> 
							 <input type="text" class="form-control border-input" placeholder="Customer Name" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "150" id="customerName" name="customerName" required="required">
						</div>
					</div>

													
					
					<div class="col-sm-3">
						<div class="form-group">
							<label for="productBrand">
								Phone No<span class="spanColor">*</span>
							</label> 
							 <input type="text" class="form-control border-input" placeholder="Phone No"  class="form-control border-input" id="phoneNo" name="phoneNo" autocomplete="off"  maxlength="10" id="phoneNo" name="phoneNo" required="required" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
						</div>
					</div> 

					<div class="col-sm-3"> 
						<div class="form-group">
                        <label for="gender">Gender</label> <span class="spanColor">*</span>
                          <div style="border: 1px solid #ccc5b9;"> 
                              <select name="gender"  class="form-control  border-primary" data-style="no-style "  id="gender" required="required">
                                <option value="" selected="selected">Choose</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            </div>
                            </div>
                        </div>
				

					<!--<div class="col-sm-3"> 
						<div class="form-group">
							<label for="productBrand">
								Aadhar No<span class="spanColor">*</span>
							</label> 
							 <input type="text" class="form-control border-input" placeholder="Aadhar No" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "12" id="aadhaNo" name="aadhaNo" required="required">
						</div>
					</div>-->

					<div class="col-sm-3">
						<div class="form-group" style="display: flex; margin: 20px;">
						 <!-- 	<button href="#fakelink" class="btn btn-success"></button> -->
						 	<button type="button" id="submit" 
						 	name="submit" 
						 
						 	class="btn btn-success" value="ADD" 
						 	onclick="addThisItem();" />
							 <i class="icon-check2"></i> Add Jewellery Item
							</button>&nbsp;
							<input type="button" class="btn btn-success" value="Open Camera" onClick="configure()">


<!-- CSS -->
<style>
#my_camera{
    width: 148px;
    height: 107px;
    border: 1px solid black;
}
</style>

<!-- -->
 
 
 <!-- Script -->
<script type="text/javascript" src="assets/js/webcam.min.js"></script>

 <!-- Code to handle taking the snapshot and displaying it locally -->
 <script language="JavaScript">
 
 // Configure a few settings and attach camera
 function configure(){
 	$('#camera').css('display','block');
    Webcam.set({
       width: 145,
       height: 108,
       image_format: 'jpeg',
       jpeg_quality: 90
    });
    Webcam.attach( '#my_camera' );
 }
 // A button for taking snaps


 // preload shutter audio clip
 var shutter = new Audio();
 shutter.autoplay = false;
 shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

 function take_snapshot() {
    // play sound effect
    shutter.play();
    
    // take snapshot and get image data
    Webcam.snap( function(data_uri) {
       // display results in page
       document.getElementById('results').innerHTML = 
           '<img id="imageprev" src="'+data_uri+'"/>';
           
     } );

     Webcam.reset();
 }

function saveSnap(){
   // Get base64 value from <img id='imageprev'> source
   var base64image = document.getElementById("imageprev").src;

   Webcam.upload( base64image, 'upload.php', function(code, text) {
       // console.log(code);
       document.getElementById('img_path').value = text;
   });

}
</script>

						</div>

						</div>
<div style="position: absolute;left: 35%;top: 96px;display: none;" id="camera">						
<div id="my_camera"></div>
<div class="button-area" style="position: absolute;
    top: 10px;
    left: 152px">
 <input type="button" class="btn btn-success" value="Take Photo" onClick="take_snapshot()" style="margin-bottom: 10px;">
 <input type="button" class="btn btn-danger" value="Save Photo" onClick="saveSnap()">
 </div>
 <div id="results" style="position: absolute;
    top: 1px;
    left: 310px;"></div>

</div>
				
				
<div class="row">
<div class="col-sm-12">
<div class="card">	            
<div class="card-body collapse in" 
 style="border: 1px solid #0cad43;">	
   <div class="table-responsive" style="height: 250px; display: inline-block;">
                        <table class="table"  id="tab_logic" style="overflow-x: scroll hidden!important;">
                            <thead>
                                <tr>
                                  <th width="2%" scope="col"><b>#</b></th>
				                <th width="20%" scope="col"><b>JEWELLERY TYPE</b></th>
				                <th width="20%" scope="col"><b>DESCRIPTION</b></th>
				                <th width="20%" scope="col"><b>LOCATION</b></th>
				                <th width="15%" scope="col"><b>QUANTITY</b></th>
				                <th width="20%" scope="col"><b>TOTAL GRAMS</b></th>
				                
				                
                                </tr>
                            </thead>
                            <tbody>
                          
                            </tbody>
                        </table>
                        </div>						

</div>
</div>
</div>										
</div>
<div class="row">
<div class="col-sm-2"> 
						<div class="form-group">
						<label>No Of Items</label>
							<p id="noOfItemsLable" style="font-size: 25px" >
							<strong>0</strong>
						</p>	
						
						</div>
					</div>
					<div class="col-sm-2"> 
						<div class="form-group">
						<label>Total Quality</label>
							<p id="totalQualityLable" style="font-size: 25px">
							<strong>0</strong>
						</p>	
							
							
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="totalGramsLabel">
								Total Grams 
							</label> 
							 <p id="totalGramsLabel"  style="font-size: 25px">
							<strong>0.00</strong>
						</p>
						<input type="hidden" id="noOfItems" name="noOfItems" value="0" >
						<input type="hidden" id="totalGrams" name="totalGrams" value="0.00" >
						<input type="hidden" id="totalQuality" name="totalQuality" value="0">		
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							 <label for="Loan Grand Amount">Loan Grand Amount<span class="spanColor">*</span></label> 
                            <input type="text"  placeholder="Loan Grand Amount" id="loanGrandAmount" name="loanGrandAmount" autocomplete="off"  class="form-control border-input" required >
						</div>
					</div>

					<!--<div class="col-sm-3">
						<div class="form-group">
							<label for="productBrand">
								Amount Per Gram <span class="spanColor">*</span>
							</label> 
							 <input type="text" class="form-control border-input" placeholder="Amount Per Gram" id="amountPerGrams" name="amountPerGrams" required="required" onkeyup="calculateOrderSummary();" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
						</div>
					</div>-->
					<div class="col-sm-3"> 
						<div class="form-group">
						  <label for="InterestPercentage">Interest Percentage<span class="spanColor">*</span></label> 
                            <input type="text" value="" placeholder="Interest Percentage" id="interestPercentage" name="interestPercentage" autocomplete="off"  class="form-control border-input" required onkeyup="calculatePercentage();" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        </div>
						</div>

					
					

</div>
<br>

<div class="row">
					
					
					<div class="col-sm-3">
						<div class="form-group">
							<label for="Amount Per Gram">Month Interest Amount</label> 
                            <input type="text" value="" placeholder="Month Interest Amount" id="monthInterestAmount" name="monthInterestAmount" autocomplete="off" class="form-control border-input"   onkeyup="calculate();" readonly="true">
                        </div>
						</div>
					<!--<div class="col-sm-3">
						<div class="form-group">
							 <label for="Loan Grand Amount">Receipt Mode<span class="spanColor">*</span></label> 
                            <div style="border: 1px solid #ccc5b9;"> 
                            <select name="receiptMode" class="form-control  border-primary"
                            id="receiptMode" autocomplete="off"  data-style="no-style form-control" data-menu-style="" >
                                <option disabled selected>Choose</option>
                                <option value="CASH" selected>Cash</option>
                                <option value="CARD">Card</option>
                            </select>
                            </div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="loanEndOn">
								Loan End On<span class="spanColor">*</span>
							</label> 
							 <input type="date" class="form-control border-input" placeholder="Loan Date" id="loanEndOn" name="loanEndOn" required="required">
						</div>
					</div>-->
					<div class="col-sm-3">
						<div class="form-group">
							<label for="address">Address<span class="spanColor">*</span></label> 
                            <textarea name="address" id="address" class="form-control border-primary" maxlength="250" required></textarea>
                        </div>
					</div>
					</div>
					<br>
					<!--<div class="row">
					
					
					<div class="col-sm-3">
						<div class="form-group">
							 <label for="reference">Reference</label> 
                            <textarea name="reference" id="reference" class="form-control border-primary" maxlength="250"></textarea> 
                            </div>
						</div>
						</div>-->
					

					
					</div>

<div class="row">
					
					
					<div class="button-box" align="center">
                        <input type="submit" class="btn btn-success btn-fill btn-lg" value="Save" name="submit"  id="buttonId"  disabled="true">
                                        
                                    
                                    <button type="reset" class="btn btn-warning mr-1 btn-lg" >
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    </div>
						</div>
						</div>
					
</form>
</div>
</div>


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

$('#itemGridSize').val();

var i=1;
function addThisItem(){ 

var jewelleryOptions= '<option value="" selected="">Choose</option>';
for(var k = 0; k < jewelleryList.length; k++){
var jewelleryType = jewelleryList[k];
jewelleryOptions = jewelleryOptions + '<option value="'+jewelleryType.id+'" >'+jewelleryType.jewellery_name+'</option>';
}
var qualityOption= '<option value="" selected="">Choose</option>';
for(var k = 0; k < qualityList.length; k++){
var qualityType = qualityList[k];
qualityOption = qualityOption + '<option value="'+qualityType.id+'" >'+qualityType.quality_name+'</option>';
}

var trText = "<td> <div class='form-group'><strong><input type='hidden' id='rowHiddenId_"+i+"' name='rowHiddenId_"+i+"' value='"+i+"' ><input type='hidden' id='itemGridId_"+i+"' name='itemGridId_"+i+"' >"+i+"</strong></div></td> <td> <div class='form-group'> <input id='jewelleryTypeGrid_"+i+"' name='jewelleryTypeGrid_"+i+"'class='selectpicker form-control border-input'  data-style='no-style form-control'  data-menu-style='' required>"+"</select> </div></td> <td> <div class='form-group'> <input id='description_"+i+"' name='description_"+i+"'class=' form-control border-input'  autocomplete='off'  data-style='no-style form-control'  data-menu-style='' > </div></td><td> <div class='form-group'> <select id='location_"+i+"' name='location_"+i+"'class=' form-control border-input'  autocomplete='off'  data-style='no-style form-control'  data-menu-style='' ><option value='Home'>Home</option><option value='Locker'>Shop</option><option value='Home'>Locker</option> </select></div></td> <td> <div class='form-group'><input class='form-control border-input' type='text' placeholder='QUANTITY' id='quantityGrid_"+i+"' value='0'  name='quantityGrid_"+i+"' onkeyup='calculateOrderSummary();' required > </div> </td><td> <div class='form-group'><input class='form-control border-input' type='text' placeholder='TOTAL GRAMS'  id='totalGramsGrid_"+i+"' name='totalGramsGrid_"+i+"' value='0.00' onkeyup='calculateOrderSummary();'> </div></td><td> <div class='form-group'> <div class='modal fade' id='smallAlertModal_"+i+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' ><div class='modal-dialog modal-small'><div class='modal-content'><div class='modal-header no-border-header'> <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button></div><div class='modal-body text-center'><h5>Do you want to delete this item!</h5></div><div class='modal-footer'> <center><button type='button'class='btn btn-danger' data-dismiss='modal' onclick='removeItem(this,"+i+");'>OK</button></center> </div> </div></div></div><button class='btn btn-danger btn-fill'  type='button'   onclick='removeItem(this,"+i+");'><i class='fa fa-trash' style='font-size:30px;color:white' aria-hidden='true'></i></button></div> </td>";

$('#tab_logic').append('<tr id="addr' + i + '">"'+ trText+ '"</tr>');

$('#gridSize').val(i);

i++;

 setTimeout(function() {
        calculateOrderSummary();
    });	




}




   

function calculateOrderSummary(){
	

	var totalQtyLabel = 0;
	var noOfItemLabel = 0;
	var totalGramsLabel=0.00;

	for(var j=1;j<=i;j++){ 
		

		if( document.getElementById("rowHiddenId_"+j) != null && 
			document.getElementById("rowHiddenId_"+j) != undefined && 
			document.getElementById("rowHiddenId_"+j).value != null){

			var qty = document.getElementById('quantityGrid_'+j).value;
			var totalGrams = document.getElementById('totalGramsGrid_'+j).value;
			
		

			noOfItemLabel++;
			totalQtyLabel = totalQtyLabel + parseInt(qty);

			totalGramsLabel = totalGramsLabel + parseFloat(totalGrams);



		//var gramsAmount=document.getElementById("amountPerGrams").value;
	//var totalAmount = parseFloat(totalGramsLabel*gramsAmount); 
	
	//	document.getElementById("loanGrandAmount").value=totalAmount.toFixed(2);
	
	document.getElementById("noOfItemsLable").innerHTML = "<strong>"+noOfItemLabel+"</strong>";
	
	document.getElementById("noOfItems").value = parseInt(noOfItemLabel);
	document.getElementById("totalQuality").value = parseInt(totalQtyLabel);
	document.getElementById("totalQualityLable").innerHTML = "<strong>"+totalQtyLabel+"</strong>";
	
	document.getElementById("totalGrams").value = parseFloat(totalGramsLabel);
	document.getElementById("totalGramsLabel").innerHTML = "<strong>"+totalGramsLabel.toFixed(3)+"</strong>";
	
		if(totalGrams <0){
		
		document.getElementById("buttonId").disabled = true;
	}else{
		
		document.getElementById("buttonId").disabled = false;
	}
			

		}
	}

	
}

function calculatePercentage()
           {
            
              principal = document.getElementById("loanGrandAmount").value;
              rate = document.getElementById("interestPercentage").value;
              	
               res = (principal* ((rate/100))/ ( 1 ));
               result=Math.round( res*100)/100,2;
           document.getElementById("monthInterestAmount").value = result;
  
 }



function removeItem(button,index) {


var row = $(button).closest("TR"); 
var name = $("TD", row).eq(0).html();


var table = $("#tab_logic")[0];
//Delete the Table row using it's Index.
table.deleteRow(row[0].rowIndex);


};



</script>
 <?php include 'footer.php'; ?>