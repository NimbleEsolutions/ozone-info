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
						<li class="breadcrumb-item active">Import User Profiles</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row" id="import_profiles" style="display: none;">
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="card card-default">
						<div class="card-header">
							<h3 class="card-title">Import User Profiles</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createProfile" method="post" action="<?= site_url('user/import_users'); ?>" enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-2"></div>
									<div class="col-sm-3">
										<!-- text input -->
										<label>User Profiles <span class="mandatory"> * </span></label>
										<div class="form-group">
						                    <div class="custom-file">
						                      <input type="file" class="custom-file-input" id="customFile" name="user_file">
						                      <label class="custom-file-label" for="customFile">Choose file</label>
						                    </div>
						                  </div>
										<!-- <div class="form-group">
											<input type="file" name="user_file" class="form-control" required>
										</div> -->									
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Vendor <span class="mandatory"> * </span></label>
											<select class="form-control" name="vendor_id">
												<option value="" disabled="" selected="">Please select vendor</option>
												<?php foreach ($vendor_details as $key) { ?>
													<option value="<?php echo $key['user_id'] ?>"><?php echo $key['user_firstName']." ".$key['user_lastName']; ?></option>
												<?php } ?>
											</select>
										</div>									
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<button type="submit" class="btn btn-primary" style="margin-top: 30px;">Import Profiles</button>
										</div>
									</div>
								</div>
							</div>
								<!-- /.card-body -->
						</form>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="card card-default">
						<div class="card-header">
							<h3 class="card-title">All User Profiles</h3>
							<div class="card-tools">
					            <span class="btn btn-primary btn-xs" id="import_users"><i class="fas fa-plus fa-xs"></i> Import Profiles</span>
				            </div>							
						</div>
						<!-- /.card-header -->
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Vendor</th>
									<th>Name</th>
									<th>Mobile</th>
									<th>Email</th>
									<th></th>
									<th style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;foreach (array_reverse($all_user) as $key) { 
									$vendor = (new HomeModel())->getData(array('user_id'=>$key['user_vendor_id']),'jinlms_user');
								?>
								<tr>
									<td><?= $i++; ?></td>
									<td><?= $vendor[0]['user_firstName']." ".$vendor[0]['user_lastName'];?></td>
									<td><?= $key['user_firstName']." ".$key['user_lastName']; ?></td>
									<td><?= $key['user_mobile']; ?></td>
									<td><?= $key['user_email']; ?></td>
									<td></td>
									<td style="text-align: center;">
										<span class="btn btn-icon btn-xs"><i class="fa fa-trash-alt" title="Delete Profile"></i></span>
										<span class="btn btn-icon btn-xs"><i class="fa fa-unlock-alt" title="Change Password"></i></span>
										<span class="btn btn-icon btn-xs"><i class="fa fa-sync-alt" title="Change Password"></i></span>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= view('users/user_footer'); ?>