<?= view('home/dash_header'); 
use \App\Models\BideligibilityModel;
use \App\Models\BidTermsModel;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			
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
							<h3 class="card-title">OEM Association For <span style="color: #a4db52;font-weight: 800;"><?= $bid['bid_lead_ref']; ?></span></h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createBid" method="post" action="<?= site_url('bid/'.service('uri')->getSegment(2).'/oem_details'); ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Type <span class="mandatory"> * </span></label>
											<select class="form-control" name="bid_type" disabled="">
												<option value="">Please bid type</option>
												<?php foreach($bid_type as $btype){ ?>
													<option value="<?= $btype['btype_name']; ?>" <?php if($btype['btype_name'] == $bid['bid_type']){ echo "selected"; } ?>><?= $btype['btype_name']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Bid No. <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="bid no..." name="bid_lead_ref" value="<?= $bid['bid_lead_ref']; ?>" disabled>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Bid End Date/Time <span class="mandatory"> * </span></label>
											<input type="text" class="form-control datepicker" placeholder="select Date/Time" id="date1" name="bid_endDate" value="<?= date('d/m/Y H:i', strtotime($bid['bid_endDate']))  ?>" disabled>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Bid Opening Date/Time <span class="mandatory"> * </span></label>
											<input type="text" class="form-control datepicker" placeholder="select Date/Time" id="date" name="bid_openDate" value="<?= date('d/m/Y H:i', strtotime($bid['bid_openDate']))  ?>" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label>Bid validity ( from End Date ) <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="In Days" name="bid_validity" value="<?= $bid['bid_validity'] ?>" disabled>
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Region<span class="mandatory"> * </span></label> 
											<select class="form-control" name="bid_region" disabled>
												<option value="">Please select</option>
												<?php foreach ($all_region as $ckey) { ?>
													<option value="<?php echo $ckey['reg_id']?>" <?php if($ckey['reg_id'] == $bid['bid_region']){ echo "selected"; } ?>><?php echo $ckey['reg_name']?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Client Name <span class="mandatory"> * </span> </label> 
											<select class="form-control" name="bid_client" disabled="">
												<option value="">Please select</option>
												<?php foreach ($client_details as $ckey) { ?>
													<option value="<?php echo $ckey['client_id']?>" <?php if($ckey['client_id'] == $bid['bid_client']){ echo "selected"; } ?>><?php echo $ckey['client_name']?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Department <span class="mandatory"> * </span>
											</label>
											<select name="bid_dept" class="form-control" disabled="">
												<option value="">Please select</option>
												<?php foreach($departments as $dept){ ?>
													<option value="<?= $dept['dept_id']; ?>" <?php if($dept['dept_id'] == $bid['bid_dept']){ echo "selected"; } ?>><?= $dept['dept_name']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>									
								</div>
								<div class="row">
									<div class="col-sm-3">
										<label>EMD <span class="mandatory"> * </span></label>
										<select class="form-control" name="bid_emd" disabled="">
											<option value="">Please select</option>
											<option value="Yes" <?php if($bid['bid_emd'] == 'Yes'){ echo "selected"; } ?>>Yes</option>
											<option value="No" <?php if($bid['bid_emd'] == 'No'){ echo "selected"; } ?>>No</option>
										</select>										
									</div>
									<div class="col-sm-3 <?php if($bid['bid_emd'] == 'No'){ echo "hidden"; } ?>" id="bid_emd_val">
										<div class="form-group">
											<label>EMD <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="EMD" name="bid_emd_val" value="<?= $bid['bid_emd_val']; ?>" disabled="">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>EPBG <span class="mandatory"> * </span></label>
											<select class="form-control" name="bid_epbg" disabled="">
												<option value="">Please select</option>
												<option value="Yes" <?php if($bid['bid_epbg'] == 'Yes'){ echo "selected"; } ?>>Yes</option>
												<option value="No" <?php if($bid['bid_epbg'] == 'No'){ echo "selected"; } ?>>No</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3 <?php if($bid['bid_epbg'] == 'No'){ echo "hidden"; } ?>" id="bid_epbg_val">
										<div class="form-group">
											<label>EPBG <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="EPBG" name="bid_epbg_val" value="<?= $bid['bid_epbg_val']; ?>" disabled="">
										</div>
									</div>
								</div>
								<br>								
								<div class="row" style="background: #007bff75;padding: .5vw 1.5vw;font-size: 1.1rem;">
									<div class="col-sm-12">
										<h3 style="font-size: 1.3rem;margin-bottom: 0;">Bid Products</h3>									
									</div>				
								</div>
								<div class="table-responsive p-2">
									<table class="table table-striped table-bordered" style="width:100%">
										<tbody style="border-top: 1px solid #dee2e6;">
											<?php $pro = 0;$i = 1; foreach($bid_product as $bidProdu){ ?>
											<tr>
												<td rowspan="5" style="border-bottom: 2px solid #000000;">
													<?= $i++; ?>
												</td>
												<tr>
													<td colspan="2" style="border-top: 0;"> 
														Product : <span><?php foreach($all_products as $key) {
															if($bidProdu['bidprod_product_id'] == $key['product_id']){ echo $key['product_name']; 
															} 
														} ?></span>
													</td>
													<td colspan="2" style="border-top: 0;"> 
														Quantity : <span><?= $bidProdu['bidprod_qty']; ?></span>
													</td>
													<td colspan="2" style="border-top: 0;"> 
														Budgets : <span><?= $bidProdu['bidprod_budget'] ." /-"; ?></span>
													</td>
													<td colspan="2" style="border-top: 0;"> 
														Transfer Price : <span><?= $bidProdu['bidprod_tprice'] ." /-"; ?></span>
													</td>
													<td colspan="2" style="border-top: 0;"> 
														Quoted Price : <span><?= $bidProdu['bidprod_qprice'] ." /-"; ?></span>
													</td>
													<td colspan="2" style="border-top: 0;">
														M&M : <span><?= $bidProdu['bidprod_mm']; ?></span>
													</td>
												</tr>
												<tr>													
													<td colspan="12">
														Specification : <span><?= $bidProdu['bidprod_spcification']; ?></span>
													</td>
												</tr>
												<tr>
													<td colspan="12">
														GEM Link : <span><a href="<?= $bidProdu['bidprod_gem']; ?>" target="_blank"><?= $bidProdu['bidprod_gem']; ?></a></span>
													</td>
												</tr>
												<tr style="border-bottom: 3px solid;">
													<td  colspan="2" style="vertical-align: top;">
														<input type="text" class="form-control hidden" name="bidprod_id[]" value="<?= $bidProdu['bidprod_id']; ?>">
														<div class="form-group">
															<label>OEM Lock <span class="mandatory"> * </span></label>
															<select class="form-control" name="bidprod_lock[]">
																<option value="">Please select</option>
																<option value="Yes" <?php if($bidProdu['bidprod_lock'] == 'Yes'){ echo "selected"; } ?>>Yes</option>
																<option value="No" <?php if($bidProdu['bidprod_lock'] == 'No'){ echo "selected"; } ?>>No</option>
															</select>
														</div>
													</td>
													<td colspan="2" style="vertical-align: top;">
														<div class="form-group">
															<label>Email Send <span class="mandatory"> * </span></label>
															<select class="form-control" name="bidprod_mail[]">
																<option value="">Please select</option>
																<option value="Yes" <?php if($bidProdu['bidprod_mail'] == 'Yes'){ echo "selected"; } ?>>Yes</option>
																<option value="No" <?php if($bidProdu['bidprod_mail'] == 'No'){ echo "selected"; } ?>>No</option>
															</select>
														</div>
													</td>
													<td colspan="4" style="vertical-align:top;padding-bottom: 0;">
														<div class="form-group">
															<label>Status <span class="mandatory"> * </span></label>
															<textarea class="form-control" name="bidprod_status[]"><?= $bidProdu['bidprod_status'] ?></textarea>
														</div>
													</td>
													<td colspan="4" style="vertical-align:top;padding-bottom: 0;">
														<div class="form-group">
															<label>Remark <span class="mandatory"> * </span></label>
															<textarea class="form-control" name="bidprod_remark[]"><?= $bidProdu['bidprod_remark'] ?></textarea>
														</div>
													</td>
												</tr>
											</tr>
											<?php $pro++; } ?>										
										</tbody>                            
									</table>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer text-right">
								<button type="reset" class="btn btn-default">Reset</button>
								<button type="submit" class="btn btn-primary">Update OEM</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
				<!-- /.row -->
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<?= view('bid/bid_footer'); ?>