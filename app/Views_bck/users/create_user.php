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
						<li class="breadcrumb-item active">User Profiles</li>
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
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Create User Profile</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createProfile" method="post" action="<?= site_url('user/create_user'); ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-4">
										<!-- text input -->
										<div class="form-group">
											<label>First Name <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="Enter first name ..." name="user_firstName">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Middle Name</label>
											<input type="text" class="form-control" placeholder="Enter middle name..." name="user_middleName">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Last Name <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="Enter last name..." name="user_lastName">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<!-- text input -->
										<div class="form-group">
											<label>Email Id <span class="mandatory"> * </span></label>
											<input type="email" class="form-control" placeholder="Enter email..." name="user_email">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Mobile No. <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="Enter ..." name="user_mobile">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>User Type <span class="mandatory"> * </span></label>
											<select class="form-control" name="user_role_id">
												<option value="" disabled="" selected="">Please select user</option>
												<?php foreach ($user_role as $key) { ?>
													<option value="<?php echo $key['role_id'] ?>"><?php echo $key['role_name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<!-- text input -->
										<div class="form-group">
											<label>Password <span class="mandatory"> * </span></label>
											<input type="password" class="form-control" placeholder="Enter .." name="user_password">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Confirm Password <span class="mandatory"> * </span></label>
											<input type="password" class="form-control" placeholder="Enter ..." name="user_cfm_password">
										</div>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Create Profile</button>
								<button type="reset" class="btn btn-default">Reset</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="card card-default">
						<div class="card-header">
							<h3 class="card-title">All User Profiles</h3>
							<div class="card-tools">
								<span class="btn btn-primary btn-xs" id="import_users"><i class="fas fa-plus fa-xs"></i> New Profiles</span>
							</div>
						</div>
						<!-- /.card-header -->
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Role</th>
									<th>Name</th>
									<th>Mobile</th>
									<th>Email</th>
									<th></th>
									<th style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;foreach (array_reverse($all_user) as $key) {
								if (session()->get('id') != $key['user_id']) {
									$role = (new HomeModel())->getData(array('role_id'=>$key['user_role_id']),'sales_user_role');
								?>
								<tr>
									<td><?= $i++; ?></td>
									<td><?= $role[0]['role_name'];?></td>
									<td><?= $key['user_firstName']." ".$key['user_lastName']; ?></td>
									<td><?= $key['user_email']; ?></td>
									<td><?= $key['user_mobile']; ?></td>
									<td></td>
									<td style="text-align: center;">
										<span class="btn btn-icon btn-xs"><i class="fa fa-trash-alt" title="Delete Profile"></i></span>
										<span class="btn btn-icon btn-xs"><i class="fa fa-unlock-alt" title="Change Password"></i></span>
									</td>
								</tr>
								<?php } } ?>
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