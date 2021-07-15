<?= view('home/dash_header'); 
	use App\models\HomeModel;
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
						<li class="breadcrumb-item active">Lead Update</li>
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
							<h3 class="card-title">Update Lead</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createLead" method="post" action="<?= site_url('sales/save_lead_update'); ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Customer Name <span class="mandatory"> * </span></label> <!--a href="<?= site_url('master/update_cust/'.$lead_details[0]['lead_client'].'/'.$lead_details[0]['lead_id']); ?>">Update Customer?</a-->
											<select class="form-control" name="lead_client">
												<option value="">Please select</option>
												<?php foreach ($client_details as $ckey) { 
												if($lead_details[0]['lead_client'] == $ckey['client_id']){ ?>
													<option selected="" value="<?php echo $ckey['client_id']?>"><?php echo $ckey['client_name']?></option>
												<?php } else {?>
													<option  value="<?php echo $ckey['client_id']?>"><?php echo $ckey['client_name']?></option>
												<?php } } ?>
											</select>
										</div>
									</div>
									<?php 
									//echo $lead_details[0]['lead_client'];
									$client=(new HomeModel())->getData(array('client_id'=> $lead_details[0]['lead_client']),'sales_client');
									$contact_person=(new HomeModel())->getData(array('cp_id'=> $lead_details[0]['lead_contact_person']),'sales_contact_person');
									//print_r($contact_person); //echo $client[0]['client_contact'];
									?>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Contact No</label>
											<input type="text" class="form-control" placeholder="contact no..." name="client_contact" readonly="" value="<?php if(!empty($client)){ echo $client[0]['client_contact']; }else { echo ''; } ?>">
											<input type="hidden" class="form-control" name="lead_id" readonly="" value="<?php echo $lead_details[0]['lead_id']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Email</label>
											<input type="text" class="form-control" placeholder="email..." name="client_email" readonly=""  value="<?php if(!empty($client)){ echo $client[0]['client_email']; }else { echo ''; } ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Region<span class="mandatory"> * </span></label> 
											<select class="form-control" name="lead_region">
												<option value="">Please select</option>
												<?php foreach ($all_region as $ckey) { 
													if($ckey['reg_id']== $lead_details[0]['lead_region']) { ?>
													<option  selected="" value="<?php echo $ckey['reg_id']?>"><?php echo $ckey['reg_name']?></option>
												<?php }else { ?>
													<option  value="<?php echo $ckey['reg_id']?>"><?php echo $ckey['reg_name']?></option>
												<?php } } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label>Department<span class="mandatory"> * </span></label>
											<select name="lead_dept" class="form-control">
												<option value="">Please select</option>
												<?php foreach ($dept_details as $ckey) { 
												if($lead_details[0]['lead_dept'] == $ckey['dept_id']){ ?>
													<option selected="" value="<?php echo $ckey['dept_id']?>"><?php echo $ckey['dept_name']?></option>
												<?php } else {?>
													<option  value="<?php echo $ckey['dept_id']?>"><?php echo $ckey['dept_name']?></option>
												<?php } } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Contact Person<span class="mandatory"> * </span></label>
											<select class="form-control" name="cp_contact_person">
												<option value="">Please select</option>
												<?php foreach ($cp_details as $ckey) { 
												if($lead_details[0]['lead_contact_person'] == $ckey['cp_id']){ ?>
													<option selected="" value="<?php echo $ckey['cp_id']; ?>"><?php echo $ckey['cp_first_name'].' '.$ckey['cp_middle_name'].' '.$ckey['cp_last_name']; ?></option>
												<?php } else {?>
													<option value="<?php echo $ckey['cp_id']; ?>"><?php echo $ckey['cp_first_name'].' '.$ckey['cp_middle_name'].' '.$ckey['cp_last_name'];?></option>
												<?php } } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Lead Generated Date<span class="mandatory"> * </span></label>
											<input type="text" placeholder="enter lead generated date" class="form-control datepicker" name="lead_generated_date" value="<?php echo $lead_details[0]['lead_generated_date']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Lead Due Date</label>
											<input type="text" placeholder="enter lead due date" class="form-control datepicker" name="lead_due_date"  value="<?php echo $lead_details[0]['lead_due_date']; ?>" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label>Lead Budget <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="Enter budget" name="lead_budget" value="<?php echo $lead_details[0]['lead_budget']; ?>">
										</div>
									</div>
								</div>
		                        <div class="row text-right" style="border:none; padding: 5px;">
		                        	<div class="col-sm-12" style="text-align: right; ">
		                        		<span class="btn btn-success add_row" style="border-color: #a9e050;background-color: #a9e050;" id="add_row">Add New Product</span>
		                             <span class="btn btn-warning" id="delete_row" onclick="deleteRow('stock')">Delete</span>
		                             <input type="hidden" id="initialCnt" name="initialCnt" value="<?php echo count($product_details);?>">
		                        	</div>									
								</div>
								
								<div class="table-responsive">
		                            <table class="table table-striped table-bordered" style="width:100%">
			                            <thead>
			                                <tr>
			                                    <th>#</th>
			                                    <th>Product</th>
			                                    <th>Quantity</th>
			                                    <th>Proposed Product</th>
			                                    <th>Product Specification</th>
			                                    <th>Product GEM Link</th>
			                                </tr>
			                            </thead>
			                            <tbody id="stock">
			                            <?php // print_r($product_details); 
			                            $k=0;
			                            	foreach ($product_details as $pkey) {  ?>
		                            		<tr>
		                            			<td>
		                            				<span class="button deleteProd" name="delete" id="<?php echo $pkey['lr_id'];?>"><i class="fa fa-trash" style="color:black"></i></span>
		                            				<input type="hidden" class="form-control lr_id" name="lr_id[<?php echo $k;?>]" value="<?php echo  $pkey['lr_id'];?>">
		                            			</td>
		                            			 <td id="item">
		                                        <select class="form-control lr_product_id" name="lr_product_id[<?php echo $k;?>]" required>
		                                            <option value="">- Choose item -</option>
		                                            <?php foreach($all_products as $key) { if($pkey['lr_product_id'] == $key['product_id']) {?>
		                                                <option  selected="" value="<?php echo $key['product_id'];?>"><?php echo $key['product_name'];?></option>
		                                                <?php } else { ?>     
		                                                  <option value="<?php echo $key['product_id'];?>"><?php echo $key['product_name'];?></option>
		                                            <?php } } ?>
		                                        </select>
		                                    	</td>
		                                    	 <td id="lr_quantity">
			                                      	<input type="text" class="form-control lr_quantity" name="lr_quantity[<?php echo $k;?>]" value="<?php echo  $pkey['lr_quantity'];?>">
			                                    </td>
			                                    <td id="lr_proposed_product"><input type="text" class="form-control lr_proposed_product" name="lr_proposed_product[<?php echo $k;?>]" value="<?php echo  $pkey['lr_proposed_product'];?>"></td>
			                                    <td id="lr_product_specification"><input type="text" class="form-control lr_product_specification" name="lr_product_specification[<?php echo $k;?>]" value="<?php echo  $pkey['lr_product_specification'];?>"></td>
			                                    <td id="lr_product_gem_link"><input type="text" class="form-control lr_product_gem_link" name="lr_product_gem_link[<?php echo $k;?>]" value="<?php echo  $pkey['lr_product_gem_link'];?>"></td>
		                            		</tr>
			                            		
			                             <?php $k++; } ?> 			                              
			                            </tbody>                            
		                            </table>
                        		</div>

							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Update Lead</button>
								<button type="reset" class="btn btn-default">Reset</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
			
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= view('sales/lead/update_lead_footer'); ?>