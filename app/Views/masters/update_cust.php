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
						<li class="breadcrumb-item"><a href="<?= site_url('master/customer_details') ?>">Home</a></li>
						<li class="breadcrumb-item active">New Customer</li>
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
							<h3 class="card-title">Update Customer</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createCustomer" method="post" action="<?= site_url('master/up_customer_save'); ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Customer Name <span class="mandatory"> * </span></label> 
											<input type="text" class="form-control" placeholder="name..." name="client_name" value="<?php echo $customer_details[0]['client_name']; ?>">
											<input type="hidden" class="form-control" placeholder="name..." name="client_id" value="<?php echo $customer_details[0]['client_id']; ?>">
											
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Contact No</label>
											<input type="text" class="form-control" placeholder="contact no..." name="client_contact"  value="<?php echo $customer_details[0]['client_contact']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Email</label>
											<input type="text" class="form-control" placeholder="email..." name="client_email"  value="<?php echo $customer_details[0]['client_email']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Other Contact No</label>
											<input type="text" class="form-control" placeholder="contact no..." name="client_other_contact"  value="<?php echo $customer_details[0]['client_other_contact']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Other Email</label>
											<input type="text" class="form-control" placeholder="email..." name="client_other_email"  value="<?php echo $customer_details[0]['client_other_email']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Website</label>
											<input type="text" class="form-control" placeholder="website..." name="client_website" value="<?php echo $customer_details[0]['client_website']; ?>" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>State<span class="mandatory"> * </span></label>
											<select class="form-control" name="client_state">
												<option>Please select</option>
												<?php foreach ($state as $skey) { 
													if($skey['st_id'] == $customer_details[0]['client_state'] ) { ?>
													<option  selected="" value="<?php echo $skey['st_id']; ?>"><?php echo $skey['st_name']; ?></option> 
												<?php }else { ?> 
													<option value="<?php echo $skey['st_id']; ?>"><?php echo $skey['st_name']; ?></option>
												<?php } } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>City<span class="mandatory"> * </span></label>
											<select class="form-control" name="client_city">
												<option>Please select</option>
											<?php foreach ($cities as $ckey) { 
												if($ckey['ct_id'] == $customer_details[0]['client_city']) { ?>
													<option selected="" value="<?php echo $ckey['ct_id']; ?>"><?php echo $ckey['ct_name']; ?></option>
												<?php } else{ ?> 
													<option value="<?php echo $ckey['ct_id']; ?>"><?php echo $ckey['ct_name']; ?></option>
												<?php } } ?> 
											</select>
										</div>
									</div>
									
									<div class="col-sm-3">
										<div class="form-group">
											<label>Address</label>
											<textarea placeholder="full address..." class="form-control" rows="2" name="client_address"></textarea>   
										</div>
									</div>	



									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Pincode<span class="mandatory"> * </span></label>
											<input type="text" placeholder="pincode..." class="form-control " name="client_pincode">
										</div>
									</div>								
								</div>
								<div class="row" > 
									<!-- style="background-color: #007bff1c;border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0; padding: 5px;" -->
									<div class="col-sm-10" >
										<h5>Contact Person Details</h5>
									</div>
									<div class="col-sm-2" style="text-align: right;">
										<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-id="<?php echo $lkey['cp_id'] ?>" data-target="#AddCP">Add New Contact Person</button>
									</div>
								</div>
								<div class="card-body table-responsive p-0" >
					                <table class="table table-head-fixed text-nowrap table-striped table-bordered">
					                  <thead>
					                    <tr>
					                      <th style="width: 2%;">Sr No.</th>
					                      <th>Name </th>
					                      <th>E-mail </th>
					                      <th>Contact No</th>
					                      <th>Department</th>
					                      <th>Actions</th>
					                    </tr>
										
					                  </thead>
					                  <tbody>   
					                  <?php 
					                  	// print_r($cp_details);
					                  if(empty($cp_details)) { ?>
					                      <tr><td colspan="12" style="color: red;font-size: large;font-weight: bold;text-align: center;">No Records Found...!!</td></tr>
					                  <?php } else{ $i=0; foreach (array_reverse($cp_details) as $lkey) { 
					                                    
					                      $dept=(new HomeModel())->getData(array('dept_id'=>$lkey['cp_department'],'dept_isDelete'=>0),'sales_department')
					                    ?>
					                      <tr style="text-align: center;">
					                        <td><?php echo ++$i;?></td>
					                        <td><?php echo $lkey['cp_first_name'].' '.$lkey['cp_middle_name'].' '.$lkey['cp_last_name'].'<br>'?></td>
					                        <td><?php echo $lkey['cp_email'];?></td>
					                        <td><?php echo $lkey['cp_mobile'];?></td>
					                        <td><?php echo $dept[0]['dept_name'];?></td>
					                      
					                        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-id="<?php echo $lkey['cp_id'] ?>" data-target="#deleteCP"><i class="fa fa-trash" title="Delete"></i>  </button></td>
					                      </tr>
					                  <?php } } ?>			
					                  </tbody>
					                </table>
					            </div>

								<div class="row hidden">
									<div class="col-sm-3">
										<div class="form-group">
											<label>First Name<span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="name..." name="cp_first_name">
										</div>											
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Middle Name<span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="name..." name="cp_middle_name">
										</div>											
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Last Name<span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="name..." name="cp_last_name">
										</div>											
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Mobile No<span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="name..." name="cp_mobile">
										</div>											
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Other Contact No<span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="name..." name="cp_other_contact">
										</div>											
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Email<span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="name..." name="cp_email">
										</div>											
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Department<span class="mandatory"> * </span></label>
											<select name="lead_dept" class="form-control">
												<option>Please select</option>
												<?php foreach ($departments as $dkey) { ?>
												<option value="<?php echo $dkey['dept_id'];?>"><?php echo $dkey['dept_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Update Customer</button>
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

	<div id="deleteCP" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('Master/delete_cp') ?>" style="position: relative;z-index: 10000;">
            <div class="modal-content">
                <div class="modal-body ">
                    <h4 class="modal-title">Are you sure you want to delete this ?</h4>
                    <div class="form-group hidden">
                        <input type="hidden" class="form-control" name="cp_id">
                         <input type="hidden" class="form-control" placeholder="name..." name="client_id" value="<?php echo $customer_details[0]['client_id']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        	</form>
        </div>
    </div>

    <div id="AddCP" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('Master/add_cp') ?>" style="position: relative;z-index: 10000;">
            <div class="modal-content">
                <div class="modal-body ">
                    <h4 class="modal-title" style="text-align: center;">Add New Contact Person</h4>
                    <div class="form-group hidden">
                       <input type="hidden" class="form-control" placeholder="name..." name="client_id" value="<?php echo $customer_details[0]['client_id']; ?>">
                      
                    </div>
                    <div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>First Name<span class="mandatory"> * </span></label>
								<input type="text" class="form-control" placeholder="name..." name="cp_first_name">
							</div>											
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Middle Name<span class="mandatory"> * </span></label>
								<input type="text" class="form-control" placeholder="name..." name="cp_middle_name">
							</div>											
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Last Name<span class="mandatory"> * </span></label>
								<input type="text" class="form-control" placeholder="name..." name="cp_last_name">
							</div>											
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Mobile No<span class="mandatory"> * </span></label>
								<input type="text" class="form-control" placeholder="name..." name="cp_mobile">
							</div>											
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Other Contact No<span class="mandatory"> * </span></label>
								<input type="text" class="form-control" placeholder="name..." name="cp_other_contact">
							</div>											
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Email<span class="mandatory"> * </span></label>
								<input type="text" class="form-control" placeholder="name..." name="cp_email">
							</div>											
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Department<span class="mandatory"> * </span></label>
								<select name="cp_department" class="form-control">
									<option>Please select</option>
									<?php foreach ($dept_details as $dkey) { ?>
									<option value="<?php echo $dkey['dept_id'];?>"><?php echo $dkey['dept_name'];?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        	</form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?= view('masters/master_footer'); ?>