<?= view('home/dash_header'); 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1>General Form</h1> -->
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
						<li class="breadcrumb-item active">Create Bid</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row" id="import_profiles">
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Create Bid</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createBid" method="post" action="<?= site_url('bid/create_bid'); ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Type <span class="mandatory"> * </span></label>
											<select class="form-control" name="bid_type">
												<option value="">Please bid type</option>
												<option value="RA">RA</option>
												<option value="PAC">PAC</option>
												<option value="Regular Bid">Regular Bid</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Bid No. <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="bid no..." name="bid_lead_ref">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Bid End Date/Time <span class="mandatory"> * </span></label>
											<input type="text" class="form-control datepicker" placeholder="select Date/Time" id="date1" name="bid_endDate">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Bid Opening Date/Time <span class="mandatory"> * </span></label>
											<input type="text" class="form-control datepicker" placeholder="select Date/Time" id="date" name="bid_openDate">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label>Bid validity ( from End Date ) <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="In Days" name="bid_validity" >
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Region<span class="mandatory"> * </span></label> 
											<select class="form-control" name="bid_region">
												<option value="">Please select</option>
												<?php foreach ($all_region as $ckey) { ?>
													<option value="<?php echo $ckey['reg_id']?>"><?php echo $ckey['reg_name']?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Client Name <span class="mandatory"> * </span> </label> <a href="<?= site_url('master/register_clients'); ?>"> New Client ?</a>
											<select class="form-control" name="bid_client">
												<option value="">Please select</option>
												<?php foreach ($client_details as $ckey) { ?>
													<option value="<?php echo $ckey['client_id']?>"><?php echo $ckey['client_name']?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Department <span class="mandatory"> * </span><span class="" data-toggle="modal" data-target="#newDepartment" data-id="" style="color:#007bff;font-weight: 400;cursor: pointer;">New Department ?</span>
											</label>
											<select name="bid_dept" class="form-control">
												<option value="">Please select</option>
												<?php foreach($departments as $dept){ ?>
													<option value="<?= $dept['dept_id']; ?>"><?= $dept['dept_name']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>									
								</div>
								<div class="row">
									<div class="col-sm-3">
										<label>EMD <span class="mandatory"> * </span></label>
										<select class="form-control" name="bid_emd">
											<option value="">Please select</option>
											<option value="Yes">Yes</option>
											<option value="No">No</option>
										</select>										
									</div>
									<div class="col-sm-3 hidden" id="bid_emd_val">
										<div class="form-group">
											<label>EMD <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="EMD" name="bid_emd_val" >
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>EPBG <span class="mandatory"> * </span></label>
											<select class="form-control" name="bid_epbg">
												<option value="">Please select</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3 hidden" id="bid_epbg_val">
										<div class="form-group">
											<label>EPBG <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="EPBG" name="bid_epbg_val" >
										</div>
									</div>
								</div>
								<br>								
								<div class="row" style="background: #007bff75;padding: .5vw 1.5vw;font-size: 1.1rem;">
									<div class="col-sm-6">
										<h3 style="font-size: 1.3rem;margin-bottom: 0;">Bid Products</h3>									
									</div>
									<div class="col-sm-6 text-right">
										<span class="btn btn-success btn-sm add_row" style="border-color: #a9e050;background-color: #a9e050;color: #000;font-weight: 600;" id="add_row">Add New Product</span>
										<span class="btn btn-warning btn-sm" id="delete_row" onclick="deleteRow('stock')" style="color: #000;font-weight: 600;">Delete Product</span>
									</div>					
								</div>
								<div class="table-responsive p-2">
									<table class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Product</th>
												<th>Quantity</th>
												<th>Specification</th>
												<th>Make and model</th>
												<th>Budget</th>
												<th>GEM Link</th>
												<th>Transfer Price</th>
												<th>Quoated Price</th>
											</tr>
										</thead>
										<tbody id="stock">
											<tr id="org">
												<td style="padding: 0;text-align: center;"><input type="checkbox"></td>
												<td  style="padding: 0;vertical-align: top;" id="item">
													<select class="form-control bidprod_product_id" name="bidprod_product_id[0]" required>
														<option value="">- Choose item -</option>
														<?php foreach($all_products as $key) {?>
															<option value="<?php echo $key['product_id'];?>"><?php echo $key['product_name'];?></option>
														<?php } ?>
													</select>
												</td>
												<td  style="padding: 0;vertical-align: top;" id="bidprod_qty">
													<input type="text" class="form-control bidprod_qty" name="bidprod_qty[0]">
												</td>
												<td style="padding: 0;vertical-align: top;" id="bidprod_spcification"><textarea  class="form-control bidprod_spcification" name="bidprod_spcification[0]" rows="1"></textarea></td>
												<td style="padding: 0;vertical-align: top;" id="bidprod_mm"><textarea rows="1" class="form-control bidprod_mm" name="bidprod_mm[0]"></textarea></td>
												<td style="padding: 0;vertical-align: top;" id="bidprod_budget"><input type="text" class="form-control bidprod_budget" name="bidprod_budget[0]"></td>
												<td style="padding: 0;vertical-align: top;" id="bidprod_gem"><input type="text" class="form-control bidprod_gem" name="bidprod_gem[0]"></td>
												<td style="padding: 0;vertical-align: top;" id="bidprod_tprice"><input type="text" class="form-control bidprod_tprice" name="bidprod_tprice[0]"></td>
												<td style="padding: 0;vertical-align: top;" id="bidprod_qprice"><input type="text" class="form-control bidprod_qprice" name="bidprod_qprice[0]"></td>
											</tr>											
										</tbody>                            
									</table>
								</div>
								<div class="row" style="background: #007bff75;padding: .5vw 1.5vw;font-size: 1.1rem;">
									<div class="col-sm-6">
										<h3 style="font-size: 1.3rem;margin-bottom: 0;">Bid Eligibility Criteria</h3>						
									</div>					
								</div>
								<div class="table-responsive p-2">
									<table class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th>Name</th>
												<th>Value</th>
												<th>Document Required</th>
												<th>Document List</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($eligibility as $eligi){ ?>
											<tr>
												<td class="text-center p-0">
													<input type="checkbox" name="be_eligibility_id[]" value="<?= $eligi['el_id']?>">
												</td>
												<td class="p-0" style="vertical-align: middle;padding-left: .5% !important;"><?= $eligi['el_name']; ?></td>
												<td class="p-0" style="vertical-align: top;">
													<textarea rows="1" class="form-control" name="be_value[]"></textarea>
												</td>
												<td class="p-0" style="vertical-align: top;">
													<select class="form-control" name="be_doc_required[]">
														<option value="">Please select</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
												</td>
												<td class="p-0" style="vertical-align: top;">
													<select class="form-control" name="be_doc_name[]">
														<option value="">Please select</option>
														<option value=""></option>
													</select>
												</td>
											</tr>	
											<?php } ?>									
										</tbody>                            
									</table>
								</div>
								<div class="row" style="background: #007bff75;padding: .5vw 1.5vw;font-size: 1.1rem;">
									<div class="col-sm-6">
										<h3 style="font-size: 1.3rem;margin-bottom: 0;">Terms and Conditions</h3>						
									</div>					
								</div>
								<div class="table-responsive p-2">
									<table class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th>Name</th>
												<th>Value</th>
												<th>Document Required</th>
												<th>Document Remark</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($terms as $term){ ?>
											<tr>
												<td class="text-center p-0">
													<input type="checkbox" name="bt_term_id[]" value="<?= $term['term_id']?>">
												</td>
												<td class="p-0" style="vertical-align: middle;padding-left: .5% !important;"><?= $term['term_name']; ?></td>
												<td class="p-0" style="vertical-align: top;">
													<textarea rows="1" class="form-control" name="bt_value[]"></textarea>
												</td>
												<td class="p-0" style="vertical-align: top;">
													<select class="form-control" name="bt_doc_required[]">
														<option value="">Please select</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
												</td>
												<td class="p-0" style="vertical-align: top;">
													<textarea rows="1" class="form-control" name="bt_doc_remark[]"></textarea>
												</td>
											</tr>	
											<?php } ?>									
										</tbody>                            
									</table>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer text-right">
								<button type="reset" class="btn btn-default">Reset</button>
								<button type="submit" class="btn btn-primary">Create Bid</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
				<!-- /.row -->
				<div class="modal fade" id="newDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form role="form" id="masterData" method="post" action="<?= site_url('master/departments'); ?>">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Register New Department</h5>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-sm-12">
											<!-- text input -->
											<div class="form-group">
												<label>Department Name <span class="mandatory"> * </span></label> 
												<input type="text" class="form-control" placeholder="Name ..." name="dept_name" >
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-primary">Create Department</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal fade" id="newContactPersons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document" style="max-width:50%;">
						<div class="modal-content">
							<form role="form" id="contactData" method="post" action="<?= site_url('master/departments'); ?>">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Register New Contact Person</h5>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-sm-4">
											<!-- text input -->
											<div class="form-group">
												<label>First Name <span class="mandatory"> * </span></label> 
												<input type="text" class="form-control" placeholder="First Name ..." name="cp_first_name" >
											</div>
										</div>
										<div class="col-sm-4">
											<!-- text input -->
											<div class="form-group">
												<label>Middle Name </label> 
												<input type="text" class="form-control" placeholder="Middle Name ..." name="cp_middle_name" >
											</div>
										</div>
										<div class="col-sm-4">
											<!-- text input -->
											<div class="form-group">
												<label>Last Name <span class="mandatory"> * </span></label> 
												<input type="text" class="form-control" placeholder="Last Name ..." name="cp_last_name" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<!-- text input -->
											<div class="form-group">
												<label>Mobile No. <span class="mandatory"> * </span></label> 
												<input type="text" class="form-control" placeholder="Contact Number" name="cp_mobile" >
											</div>
										</div>
										<div class="col-sm-4">
											<!-- text input -->
											<div class="form-group">
												<label>Email ID <span class="mandatory"> * </span></label> 
												<input type="email" class="form-control" placeholder="Email ID" name="cp_email">
											</div>
										</div>
										<div class="col-sm-4">
											<!-- text input -->
											<div class="form-group">
												<label>Department <span class="mandatory"> * </span></label> 
												<select class="form-control" name="cp_department">
													<option value="">Please select</option>
													<?php foreach ($departments as $dept){ ?>
														<option value="<?= $dept['dept_id']; ?>"><?= $dept['dept_name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-primary">Create Contact Person</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<?= view('bid/bid_footer'); ?>