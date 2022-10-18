<?php include 'header.php'; 
include 'database/DatabaseConfig.php'; ?>
<script type="text/javascript">
function downloadBusiness(reportType){

var interestType = document.getElementById("interestType").value;
var fromDate = document.getElementById("fromDate").value;
var toDate = document.getElementById("toDate").value;
var status = document.getElementById("status").value;
if(reportType == 'XL'){

	if(status == 'ACTIVE'){

		if(interestType == '365'){
			window.location.href = "xlReport/BusinessReport/BusinessReportXL.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&ItId="+interestType;
		}else{
			window.location.href = "xlReport/BusinessReport/BusinessReportXL.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&ItId="+interestType;
		}

	}else{
		if(interestType == '365'){
			window.location.href = "xlReport/BusinessReport/BusinessReportXL.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&vId="+status;
		}else{
			window.location.href = "xlReport/BusinessReport/BusinessReportXL.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&vId="+status;
		}

	}
}else{
	if(status == 'ACTIVE'){

		if(interestType == 'Daily'){
			window.location.href = "xlReport/BusinessReport/BusinessReportPdf.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&ItId="+interestType;
		}else{
			window.location.href = "xlReport/BusinessReport/BusinessReportPdf.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&ItId="+interestType;
		}

	}else{
		if(interestType == '365'){
			window.location.href = "xlReport/BusinessReport/BusinessReportPdf.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&vId="+status;
		}else{
			window.location.href = "xlReport/BusinessReport/BusinessReportPdf.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&vId="+status;
		}

	}

}
}



function downloadJewellery(reportType){


		var jlfromDate = document.getElementById("Jl-fromDate").value;
		var jltoDate = document.getElementById("Jl-toDate").value;
		var jlstatus = document.getElementById("Jl-status").value;
		if(reportType == 'XL'){

			if(jlstatus == 'ACTIVE'){

				
				window.location.href = "xlReport/JewelleryReport/JewelleryLoanReportXL.php?fromDate="+jlfromDate+" 00:00:00&toDate="+jltoDate+" 23:59:59&vId="+jlstatus;
				

			}else{
				
				window.location.href = "xlReport/JewelleryReport/JewelleryLoanReportXL.php?fromDate="+jlfromDate+" 00:00:00&toDate="+jltoDate+" 23:59:59&vId="+jlstatus;
				
			}
		}else{
			if(jlstatus == 'ACTIVE'){

				
				window.location.href = "xlReport/JewelleryReport/JewelleryLoanReportPDF.php?fromDate="+jlfromDate+" 00:00:00&toDate="+jltoDate+" 23:59:59&vId="+jlstatus;
				
				
				
			}else{
				
				window.location.href = "xlReport/JewelleryReport/JewelleryLoanReportPDF.php?fromDate="+jlfromDate+" 00:00:00&toDate="+jltoDate+" 23:59:59&vId="+jlstatus;
				

			}

		}
	}
</script>
<div class="app-content content container-fluid" style="margin-top: 100px">
<div class="content-wrapper">

<div class="content-header row">
	<div class="content-header-left col-md-6 col-xs-12 mb-1">
		<h4 class="card-title" id="basic-layout-colored-form-control"> Report</h4>
	</div>

</div>
<div class="card card-with-shadow">
	<!-- Basic Tables start -->
	<div class="card" data-radius="none">
		<div class="content">
			<div class="container-fluid">
				<br>
										<u><a href='#' data-target="#smallAlertModal" data-toggle="modal" style="color: #1570f7;
									font-weight: bold;">
											Business Loan Report
										</a></u>  <br><br>
										<u><a href="#" style="color: #1570f7;
													font-weight: bold;" data-target="#monthlySalesReport" data-toggle="modal" >
													Jewellery Loan Report</a></u>  <br><br>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="smallAlertModal" tabindex="-1" r<div class="modal fade" id="classicModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3 class="modal-title" id="myModalLabel" style=" color: #EB5E28;">Business Loan Report</h3>
									</div><div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-6">
												<label><strong>Interest Type</strong></label>	
											</div>
											<div class="col-md-6"> 
												<select id="interestType" name="interestType" 
												class="form-control border-primary" required="required" >
												<option value="" selected="" >All</option>
												<option value="Daily">Daily</option>
												<option value="Monthly">Monthly</option>
											</select>
										</div>
									</div>	
								</div>					
								<br>
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-6">
											<label><strong>From Date</strong></label>	
										</div>
										<div class="col-md-6"> 
											<input class="form-control border-primary" 
											type="date" id="fromDate" name="fromDate"   
											required  value="<?php echo date('Y-m-d', strtotime('-10 days')); ?>">
										</div>
									</div>	
								</div>					
								<br>
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-6">
											<label><strong>To Date</strong></label>	
										</div>
										<div class="col-md-6">
											<input class="form-control border-primary" 
											type="date" id="toDate" name="toDate" value="<?php echo date('Y-m-d'); ?>" >
										</div>
									</div>	
								</div>					

								<br>
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-6">
											<label><strong>Status </strong></label>	
										</div>
										<div class="col-md-6"> 
											<select id="status" name="status" 
											class="form-control border-primary" required="required" >
											<option value="ACTIVE">ACTIVE</option>
											<option value="CLOSED">CLOSED</option>
										</select>
									</div>
								</div>	
							</div> 											

						</div>				

						<div class="modal-footer ">
						<br>
						
							<center>
								<input type="button" name="submit"
								class="btn btn-success btn-lg" 
								value="Generate XL" onclick="downloadBusiness('XL');">
								<input type="button" name="submit"
								class="btn btn-success btn-lg" 
								value="Generate PDF"  
								onclick="downloadBusiness('PDF');"></center>

							</div>
							<br>

						</div>
					</div>
				</div>

							<div class="modal fade text-xs-left" id="monthlySalesReport" tabindex="-1"
							role="dialog" aria-labelledby="myModalLabel33"
							aria-hidden="true">
							<div class="modal-dialog" role="document"  >
								<div class="modal-content" >
									<form action="#" method="POST" id="paymentForm" name="paymentForm" >
										<div class="modal-header">


											<button type="button" class="close" data-dismiss="modal"
											aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>						
										
										<div style="text-align: center; font-size: 15px;color: #EB5E28;"  >
											<h3>Jewellery Loan Report	 
									</h3>		
									</div>
								</div>
								
								<div class="col-lg-12"></div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-6">
												<label><strong>From Date</strong></label>	
											</div>
											<div class="col-md-6"> 
												<input class="form-control border-primary" 
												type="date" id="Jl-fromDate" name="Jl-fromDate"   
												required value="<?php echo date('Y-m-d', strtotime('-10 days')); ?>" >
											</div>
										</div>	
									</div>					
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-6">
												<label><strong>To Date</strong></label>	
											</div>
											<div class="col-md-6">
												<input class="form-control border-primary" 
												type="date" id="Jl-toDate" name="Jl-toDate" 
												value="<?php echo date('Y-m-d'); ?>">
											</div>
										</div>	
									</div>					
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-6">
												<label  for="Status"><strong>Status</strong></label>	
											</div>
											<div class="col-md-6">							
												<select id="Jl-status" name="Jl-status" class="form-control border-primary">
													<option value="ACTIVE">Active</option>
													<option value="CLOSED">Closed</option>
												</select>
												
											</div>	
										</div>					
									</div>				
									<br> 											

									<div class="modal-footer" style="text-align: center;" ><br>
										
										<input type="button" name="submit"
										class="btn btn-success" 
										value="Generate XL" onclick="downloadJewellery('XL');" >
										<input type="button" name="submit"
										class="btn btn-success" 
										value="Generate PDF" onclick="downloadJewellery('PDF');" 
										>
									</div>
								</div>										
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>

<?php  include 'footer.php';  ?>