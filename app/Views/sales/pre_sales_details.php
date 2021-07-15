<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\LeadRequirementModel;
use \App\Models\ProductModel;
?>

    <?= view('home/dash_header'); ?>
    <style type="text/css">
      .field_value{
        color: #000;
        font-size: larger;
        font-weight: 600;
      }      
    </style>
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
            <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lead Details</h3>

                <div class="card-tools">
				  
                  <div class="input-group input-group-sm">
				            <a href="<?= site_url('sales/create_lead') ?>"><span class="btn btn-primary btn-sm"> <i class="fas fa-plus fa-sm"></i> New Lead </span></a>
                  </div>
				  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <div class="row" style="margin-left: 0px;margin-right: 0px;">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-8">
                    <form role="form" action="<?= site_url('sales/pre-sales'); ?>" method="post">
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Client</label>
                            <select class="form-control" name="sales_client">
                              <option value="">Select client</option>
                              <?php foreach ($clients as $client) {?>
                                <option value="<?=$client['client_id']; ?>"><?=$client['client_name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Department</label>
                            <select class="form-control" name="sales_dept">
                              <option value="">Select department</option>
                              <?php foreach ($departments as $dept) {?>
                                <option value="<?=$dept['dept_id']; ?>"><?=$dept['dept_name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="sales_status">
                              <option value="">Select status</option>
                              
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-3" style="padding-top: 2vw;text-align: center;">
                          <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="row" style="margin-left: 0px;margin-right: 0px;">
                  <div class="col-sm-12" style="text-align:right;bottom: 1px;">
                    <span class="btn btn-primary btn-sm" style="background-color:green !important; border-color: green !important;"><i class="fas fa-headset fa-sm" title="Data on Call"></i> < 10 days</span> 
                    <span class="btn btn-primary btn-sm" style="background-color:orange !important; border-color: orange !important;"><i class="fas fa-headset fa-sm" title="Data on Call"></i> > 10 days && < 30 days</span>
                    <span class="btn btn-primary btn-sm" style="background-color:red !important; border-color: red !important;"><i class="fas fa-headset fa-sm" title="Data on Call"></i> > 30 days</span>
                  </div>
                </div>
                <table class="table table-responsive table-head-fixed table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 1%;text-align: center;">#</th>
                      <th>Client Name <span style="float:right" id="clientName"><i class="fas fa-sort"></i></span></th>
                      <th class="text-nowrap">Deparment <span style="float:right" id="deptName"><i class="fas fa-sort"></i></span></th>
                      <th>Contact Details</th>
                      <th>Products</th>
                      <th style="text-align: center;">Exp. Closer <br>Date <span style="float:right" id="expCloserDate"><i class="fas fa-sort"></i></span></th>
                      <th style="text-align: center;">Budget <span style="float:right" id="budget"><i class="fas fa-sort"></i></span></th>
                      <th>Status</th>
                      <th style="text-align: center;">Actions</th>
                    </tr>					
                  </thead>
                  <tbody>   
                  <?php if(empty($lead_details)) { ?>
                      <tr><td colspan="12" style="color: red;font-size: large;font-weight: bold;text-align: center;">No Records Found...!!</td></tr>
                  <?php } else{ $i=1; foreach($lead_details as $lkey) { 
                      $client=(new HomeModel())->getData(array('client_id'=>$lkey['lead_client']),'sales_client');
                      $contact_person=(new HomeModel())->getData(array('cp_company'=>$lkey['lead_client'],'cp_department'=>$lkey['lead_dept']),'sales_contact_person');
                      $dept=(new HomeModel())->getData(array('dept_id'=>$lkey['lead_dept']),'sales_department');
                      $lead_products=(new LeadRequirementModel())->where('lr_lead_id', $lkey['lead_id'])->findAll();

                    ?>
                      <tr>
                        <td><?php echo $i++;?></td>
                        <td>
                          <button type="button" data-toggle="modal" data-id="<?php echo $lkey['lead_id'].'*'.$lkey['lead_client'].'*'.$lkey['lead_dept'].'*'.$lkey['lead_contact_person'].'*'.$lkey['lead_region']; ?>" data-target="#leadDetails" style="background-color: transparent;border:none;text-align: initial;">
                            <?php echo $client[0]['client_name']; ?>
                          </button>
                        </td>
                        <td><?= $dept[0]['dept_name']; ?></td>
                        <td><?php echo $contact_person[0]['cp_last_name'].' '.$contact_person[0]['cp_first_name'].'<br>'.$contact_person[0]['cp_email'].'<br>'.$contact_person[0]['cp_mobile']; ?></td>
                        <td>
                          <?php $j = 1; foreach($lead_products as $lprod){ 
                            $products = (new ProductModel())->where('product_id',$lprod['lr_product_id'])->findAll();
                            if($j == 1){
                              echo $products[0]['product_name'];
                            }else{
                              echo ", <br>".$products[0]['product_name'];
                            }
                            $j++;
                          } ?>
                        </td>
                        <td class="text-nowrap" style="text-align: center;"><?php echo date('d M Y', strtotime($lkey['lead_due_date']));?></td>
                        <td class="text-nowrap" style="text-align: center;"><?php echo $lkey['lead_budget']." /-" ;?></td>
                        <td><?php echo $lkey['lead_file_status']; ?></td>
                        <td style="text-align: center;" class="text-nowrap">
                          <a href="<?php echo site_url('sales/update_lead_open/'.$lkey['lead_id'].''); ?>"><span class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt fa-sm" title="Edit Lead"></i></span></a>
                          <?php $date_diff = date_diff(date_create(date('Y-m-d', strtotime($lkey['lead_createdOn']))), date_create(date('Y-m-d')));
                          ?>
                          <a href="<?= site_url('sales/'.$lkey['lead_id'].'/lead_progress') ?>"><span class="btn btn-primary btn-sm" style="<?php if($date_diff->format("%a") <= 10){ echo "background-color:green !important; border-color: green !important;"; }else if($date_diff->format("%a") <= 30){ echo "background-color:orange !important; border-color: orange !important;"; }else if($date_diff->format("%a") > 30){ echo "background-color:red !important; border-color: red !important;"; }?>"><i class="fas fa-headset fa-sm" title="Data on Call"></i></span></a>
                        </td>
                      </tr>
                  <?php } } ?>			
                  </tbody>
                </table>
                <?php echo $pager->links(); ?>
              </div>              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
		  <div class="modal fade" id="leadDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document" style="max-width: 50%;font-size: small;">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lead Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row  p-1">
                      <div class="col-sm-12">
                        Client : <span class="client_name field_value">Central Public Works Department</span>
                      </div>
                    </div>
                    <div class="row  p-1">
                      <div class="col-sm-6">
                        Department : <span class="dept_name field_value"></span>
                      </div>
                      <div class="col-sm-6">
                        Region : <span class="region_name field_value"></span>
                      </div>
                    </div>
                    <div class="row p-1">
                      <div class="col-sm-6">
                        Contact No : <span class="contact_no field_value">9890575638</span>
                      </div>
                      <div class="col-sm-6">
                        Email : <span class="contact_email field_value">Department@gmail.com</span>
                      </div>
                    </div>
                    <div class="row p-1">
                      <div class="col-sm-6">
                        Exp. Closer Date : <span class="lead_date field_value"></span>
                      </div>
                      <div class="col-sm-6">
                        Budgets : <span class="lead_budget field_value"></span>
                      </div>
                    </div>
                    <div class="row p-1" style="margin-top: 1rem;">
                      <div class="col-sm-12" style="background: gray;color: #ffffff;font-size:medium;padding: .1rem .2rem .3rem .9rem;">
                        Contact Person Details : 
                      </div>
                    </div>
                    <div class="row p-1">
                      <div class="col-sm-6">
                        Name : <span class="contact_person_name field_value"></span>
                      </div>
                      <div class="col-sm-6">
                        Contact No. : <span class="contact_person_no field_value"></span>
                      </div>
                    </div>
                    <div class="row p-1">
                      <div class="col-sm-6">
                        Email ID : <span class="contact_person_email field_value"></span>
                      </div>
                    </div>
                    <div class="row p-1" style="margin-top: 1rem;">
                      <div class="col-sm-12" style="background: gray;color: #ffffff;font-size: medium;padding: .1rem .2rem .3rem .9rem;">
                        Lead Product Details : 
                      </div>
                    </div>
                    <div class="row p-1">
                      <div class="col-sm-12">
                        <table class="table table-responsive table-head-fixed text-nowrap table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Sr. No</th>
                              <th>Product</th>
                              <th>Quantity</th>
                              <th>Praposed Product</th>
                              <th>OEM Involved</th>
                            </tr>
                          </thead>
                          <tbody class="product_data">
                            
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="row p-1" style="margin-top: 1rem;">
                      <div class="col-sm-12" style="background: gray;color: #ffffff;font-size: medium;padding: .1rem .2rem .3rem .9rem;">
                        Actions Taken: 
                      </div>
                    </div>
                    <div class="row p-1">
                      <div class="col-sm-12">
                        <table class="table table-responsive table-head-fixed text-nowrap table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Sr. No</th>
                              <th>Action</th>
                              <th>Action Details</th>
                              <th>When</th>
                              <th>By</th>
                            </tr>
                          </thead>
                          <tbody class="action_data">
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
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