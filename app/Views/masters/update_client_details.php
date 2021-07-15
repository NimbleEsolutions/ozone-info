<?= view('home/dash_header'); 
	use App\models\HomeModel;
	use App\models\CitiesModel;
	$cities = (new CitiesModel())->where('st_id',$client_details[0]['client_state'])->findAll();
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
							<h3 class="card-title">Update Client Details</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createClient" method="post" action="<?= site_url('master/'.(service('uri'))->getSegment(2).'/update_clients'); ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Client Name <span class="mandatory"> * </span></label> 
											<input type="text" class="form-control" placeholder="name..." name="client_name" value="<?php echo $client_details[0]['client_name']; ?>">
											<input type="hidden" class="form-control" name="client_id" value="<?php echo $client_details[0]['client_id']; ?>">
											<input type="hidden" class="form-control" name="lead_id" value="<?php echo $lead_details[0]['lead_id']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Contact No</label>
											<input type="text" class="form-control" placeholder="contact no..." name="client_contact"  value="<?php echo $client_details[0]['client_contact']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Email</label>
											<input type="text" class="form-control" placeholder="email..." name="client_email"  value="<?php echo $client_details[0]['client_email']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Other Contact No</label>
											<input type="text" class="form-control" placeholder="contact no..." name="client_other_contact"  value="<?php echo $client_details[0]['client_other_contact']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Other Email</label>
											<input type="text" class="form-control" placeholder="email..." name="client_other_email"  value="<?php echo $client_details[0]['client_other_email']; ?>">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Website</label>
											<input type="text" class="form-control" placeholder="website..." name="client_website" value="<?php echo $client_details[0]['client_website']; ?>" >
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
												<?php foreach ($state as $skey) { ?>
													<option value="<?php echo $skey['st_id']; ?>" <?php if($skey['st_id'] == $client_details[0]['client_state']) { echo "selected"; } ?>><?php echo $skey['st_name']; ?></option>
												<?php }?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>City<span class="mandatory"> * </span></label>
											<select class="form-control" name="client_city">
												<option value="">Please select</option>
												<?php foreach ($cities as $ckey) { ?>
													<option value="<?php echo $ckey['ct_id']; ?>" <?php if($ckey['ct_id'] == $client_details[0]['client_city']) { echo "selected"; } ?>><?php echo $ckey['ct_name']; ?></option>
												<?php } ?> 
											</select>
										</div>
									</div>									
									<div class="col-sm-3">
										<div class="form-group">
											<label>Address</label>
											<textarea placeholder="full address..." class="form-control" rows="2" name="client_address"><?= $client_details[0]['client_address']; ?>
											</textarea>   
										</div>
									</div>	
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Pincode<span class="mandatory"> * </span></label>
											<input type="text" placeholder="pincode..." class="form-control " name="client_pincode" value="<?php echo $client_details[0]['client_pincode']; ?>">
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
</div>
<!-- /.content-wrapper -->

<?= view('masters/master_footer'); ?>