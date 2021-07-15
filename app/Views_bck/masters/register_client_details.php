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
						<li class="breadcrumb-item"><a href="<?= site_url('master/client_details') ?>">Home</a></li>
						<li class="breadcrumb-item active">New Client</li>
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
							<h3 class="card-title">Create Client</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createClient" method="post" action="<?= site_url('master/register_clients'); ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Client Name <span class="mandatory"> * </span></label> 
											<input type="text" class="form-control" placeholder="name..." name="client_name" >
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Contact No</label>
											<input type="text" class="form-control" placeholder="contact no..." name="client_contact">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" placeholder="email..." name="client_email">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Other Contact No</label>
											<input type="text" class="form-control" placeholder="contact no..." name="client_other_contact">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Other Email</label>
											<input type="email" class="form-control" placeholder="email..." name="client_other_email">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Website</label>
											<input type="text" class="form-control" placeholder="website..." name="client_website">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>State<span class="mandatory"> * </span></label>
											<select class="form-control" name="client_state">
												<option value="">Please select</option>
												<?php foreach ($state as $skey) { 
													//if($skey['st_id'] == 22) { ?>
													<!-- <option  selected="" value="<?php echo $skey['st_id']; ?>"><?php echo $skey['st_name']; ?></option> -->
												<?php //}else { ?> 
													<option value="<?php echo $skey['st_id']; ?>"><?php echo $skey['st_name']; ?></option>
												<?php } //} ?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>City<span class="mandatory"> * </span></label>
											<select class="form-control" name="client_city">
												<option value="">Please select</option>			
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
								<div class="row" style="background-color: #007bff1c;border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0; padding: 5px;">
									<div class="col-sm-12" >
										<h5>Contact Person Details</h5>
									</div>
								</div>

								<div class="row">
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
											<input type="email" class="form-control" placeholder="name..." name="cp_email">
										</div>											
									</div>
									<?php //print_r($departments); ?>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Department<span class="mandatory"> * </span></label>
											<select name="cp_department" class="form-control">
												<option value="">Please select</option>
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
								<button type="submit" class="btn btn-primary">Create Client</button>
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

<?= view('masters/master_footer'); ?>