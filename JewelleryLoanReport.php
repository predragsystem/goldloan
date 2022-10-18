<?php include 'header.php'; 
include 'database/DatabaseConfig.php'; ?>
<script type="text/javascript">
	function downloadBusiness(reportType){


		var fromDate = document.getElementById("fromDate").value;
		var toDate = document.getElementById("toDate").value;
		var status = document.getElementById("status").value;
		if(reportType == 'XL'){

			if(status == 'ACTIVE'){

				
				window.location.href = "xlReport/JewelleryReport/JewelleryLoanCloseReportXL.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&vId="+status;
				

			}else{
				
				window.location.href = "xlReport/JewelleryReport/JewelleryLoanCloseReportXL.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&vId="+status;
				
			}
		}else{
			if(status == 'ACTIVE'){

				
				window.location.href = "xlReport/JewelleryReport/JewelleryLoanCloseReportPDF.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&vId="+status;
				
				
				
			}else{
				
				window.location.href = "xlReport/JewelleryReport/JewelleryLoanCloseReportPDF.php?fromDate="+fromDate+" 00:00:00&toDate="+toDate+" 23:59:59&vId="+status;
				

			}

		}
	}
</script>
<div class="app-content content container-fluid">
	<div class="content-wrapper">

		<div class="content-header row">
			<div class="content-header-left col-md-6 col-xs-12 mb-1">
				<h3 class="content-header-title" style=" color: #EB5E28;">Jewellery Loan Report</h3>
			</div>

		</div>
		<div class="card card-with-shadow">
			<!-- Basic Tables start -->
			<div class="card" data-radius="none">
				<div class="content">
					<div class="container-fluid">
						<br>
						<!-- <u><a href='xlReport/JewelleryReport/JewelleryLoanReportXL.php' target="_blank" style="color: #1570f7;
							font-weight: bold;">
							JewelleryLoanReport-XL</a></u>  <br><br>
							
							
							<u><a href='xlReport/JewelleryReport/JewelleryLoanReportPDF.php' target="_blank" style="color: #1570f7;
								font-weight: bold;">
								JewelleryLoanReport-PDF</a></u>  <br><br>


								<u><a href='xlReport/JewelleryReport/JewelleryLoanCloseReportXL.php' target="_blank" style="color: #1570f7;
									font-weight: bold;">
									JewelleryLoanCloseReport-XL</a></u>  <br><br>

									<u><a href='xlReport/JewelleryReport/JewelleryLoanCloseReportPDF.php' target="_blank" style="color: #1570f7;
										font-weight: bold;">
										JewelleryLoanCloseReport-PDF</a></u>  <br><br>





										<u><a href='xlReport/JewelleryReport/JewelleryLoan-PDF.php' target="_blank" style="color: #1570f7;font-weight: bold;">
											JewelleryLoan-PDF</a></u>  <br><br>



											<u><a href='xlReport/JewelleryReport/JewelleryLoan-XL.php' target="_blank" style="color: #1570f7;font-weight: bold;">
												JewelleryLoan-XL</a></u>  <br><br>

 -->

												<u><a href="#" style="color: #1570f7;
													font-weight: bold;" data-target="#monthlySalesReport" data-toggle="modal" >
													Jewellery Loan</a></u>  <br><br>

												</div>
											</div>
										</div>
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
										
										<div style="text-align: center; font-size: 20px;"   >
											<label class="modal-title text-text-bold-300"
											id="myModalLabel33" >Jewellery Loan Report	 
										</label>										
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
												type="date" id="fromDate" name="fromDate"   
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
												type="date" id="toDate" name="toDate" 
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
												<select id="status" name="status" class="form-control border-primary">
													<option value="ACTIVE">Active</option>
													<option value="CLOSED">Closed</option>
												</select>
												
											</div>	
										</div>					
									</div>				
									<br> 											

									<div class="modal-footer" style="text-align: center;" ><br>
										
										<input type="button" name="submit"
										class="btn btn-outline-success" 
										value="Generate XL" onclick="downloadBusiness('XL');" >
										<input type="button" name="submit"
										class="btn btn-outline-success" 
										value="Generate PDF" onclick="downloadBusiness('PDF');" 
										>
									</div>
								</div>										
							</form>
						</div>
					</div>
				</div>


				<!-- Modal -->





				<?php  include 'footer.php';  ?>