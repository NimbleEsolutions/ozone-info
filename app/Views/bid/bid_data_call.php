<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\UserModel;
use \App\Models\LeadRequirementModel;
use \App\Models\ProductModel;
?>

<?= view('home/dash_header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container">

		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-8">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><b>Lead History Details</b></h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-responsive table-head-fixed text-nowrap table-striped table-bordered">
								<thead>
									<tr>
										<th style="width: 1%;text-align: center;">#</th>
										<th>Date</th>
										<th>Action</th>
										<th>Remark</th>
										<th>Action By</th>
									</tr>					
								</thead>
								<tbody>   
									<?php if(empty($dataCall)) { ?>
										<tr><td colspan="5" style="color: red;font-size: large;font-weight: bold;text-align: center;">No Records Found...!!</td></tr>
									<?php } else{ $i=0; foreach(array_reverse($dataCall) as $data_call) { 
										$call_person = (new UserModel())->where(array('user_id'=>$data_call['dc_createdBy']))->findAll();
									?>										
										<tr>
											<td><?= ++$i;?></td>
											<td><?= $data_call['dc_date']; ?></td>
											<td><?= $data_call['dc_action']; ?></td>
											<td><?= $data_call['dc_remark']; ?></td>
											<td><?= $call_person[0]['user_firstName']." ".$call_person[0]['user_lastName']; ?></td>
										</tr>
									<?php } } ?>			
								</tbody>
							</table>
						</div>              
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><b>New History Details</b></h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="masterData" method="post" action="<?= site_url('bid/'.(service('uri'))->getSegment(2).'/bid_progress'); ?>">
							<div class="card-body p-0" >
								<div class="card-body">
									<div class="row hidden">
										<div class="col-sm-12">
											<!-- text input -->
											<div class="form-group">
												<label>Lead <span class="mandatory"> * </span></label> 
												<input type="text" name="dc_lead_id" class="form-control" readonly="" value="<?= (service('uri'))->getSegment(2); ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<!-- text input -->
											<div class="form-group">
												<label>Call On <span class="mandatory"> * </span></label> 
												<input type="text" name="dc_date" class="form-control datepicker" placeholder="please select date..." readonly="" value="<?= date('Y-m-d'); ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<!-- text input -->
											<div class="form-group">
												<label>Action <span class="mandatory"> * </span></label> 
												<select class="form-control" name="dc_action">
													<option value="">Please select action</option>
													<option value="Visit">Visit</option>
													<option value="Call">Call</option>
													<option value="Outdoor meeting">Outdoor meeting</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<!-- text input -->
											<div class="form-group">
												<label>Remark <span class="mandatory"> * </span></label> 
												<textarea class="form-control" placeholder="Action Remark ..." name="dc_remark"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer" style="text-align: right;">
								<button type="submit" class="btn btn-primary">Add History</button>
								<button type="reset" class="btn btn-default">Reset</button>
							</div>
						</form>             
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
	<div class="p-3">
		<h5>Title</h5>
		<p>Sidebar content</p>
	</div>
</aside>
<!-- /.control-sidebar -->
<?= view('sales/sales_footer'); ?>