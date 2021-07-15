<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\ClientModel;
use \App\Models\BidProductModel;
use \App\Models\ProductModel;
use \App\Models\UploadModel;
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
              <h3 class="card-title">Bid Details</h3>

              <div class="card-tools">

                <div class="input-group input-group-sm">
                  <a href="<?= site_url('bid/create_bid') ?>"><span class="btn btn-primary btn-sm"> <i class="fas fa-plus fa-sm"></i> New Bid </span></a>
                </div>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <div class="row p-2 hidden" style="margin-left: 0px;margin-right: 0px;">
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
              <table class="table table-responsive table-head-fixed text-nowrap table-striped table-bordered">
                <thead>
                  <tr>
                    <th style="width: 1%;text-align: center;">#</th>
                    <th style="text-align:center;">Bid No.</th>
                    <th>Client Name</th>
                    <th style="text-align: center;">Submission Date</th>
                    <th>Products</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Remark</th>
                    <th style="text-align: center;">Actions</th>
                  </tr>					
                </thead>
                <tbody>   
                  <?php if(empty($bids)) { ?>
                    <tr><td colspan="8" style="color: red;font-size: large;font-weight: bold;text-align: center;">No Records Found...!!</td></tr>
                  <?php } else{ $i=0; foreach($bids as $bkey) { 
                    $clientInfo = (new ClientModel())->find($bkey['bid_client']);
                    $bid_products=(new BidProductModel())->where('bidprod_bid_id', $bkey['bid_id'])->findAll();
                    $bidFile = (new UploadModel())->where(array('up_type'=>2,'up_type_id'=>$bkey['bid_id']))->findAll();
                    ?>
                    <tr>
                      <td><?php echo ++$i;?></td>
                      <td style="text-align: center;"><?= $bkey['bid_lead_ref'];?></td>
                      <td> <button type="button" data-toggle="modal" data-id="<?php echo $bkey['bid_id'].'*'.$bkey['bid_client'].'*'.$bkey['bid_dept'].'*'.$bkey['bid_contact_person'].'*'.$bkey['bid_region']; ?>" data-target="#bidDetails" style="background-color: transparent;border:none;">
                        <?php echo $clientInfo['client_name']; ?>
                      </button></td>
                      <td style="text-align: center;"><?= date('d M Y, h:i A', strtotime($bkey['bid_endDate']));?></td>
                      <td>
                        <?php $j = 1; foreach($bid_products as $bprod){ 
                          $products = (new ProductModel())->where('product_id',$bprod['bidprod_product_id'])->findAll();
                          if($j == 1){
                            echo $products[0]['product_name'];
                          }else{
                            echo ", <br>".$products[0]['product_name'];
                          }
                          $j++;
                        } ?>
                      </td>
                      <td style="text-align: center;"><?php if($lkey['lead_status'] == 0) { echo "In Progress";} ?></td>
                      <td style="text-align: center;"></td>
                      <td style="text-align: center;">
                        <a href="<?= site_url("bid/".$bkey['bid_id']."/update_details") ?>"><span class="btn btn-primary btn-sm" style="padding: .0rem .2rem;"><i class="fa fa-pencil-alt fa-sm" title="Edit Bid"></i></span></a>
                        <?php $date_diff = date_diff(date_create(date('Y-m-d', strtotime($lkey['bid_endDate']))), date_create(date('Y-m-d')));
                        ?>
                        <a href="<?= site_url('bid/'.$bkey['bid_id'].'/bid_progress') ?>"><span class="btn btn-primary btn-sm" style="padding: .0rem .2rem;<?php if($date_diff->format("%a") <= 10){ echo "background-color:green !important; border-color: green !important;"; }else if($date_diff->format("%a") <= 30){ echo "background-color:orange !important; border-color: orange !important;"; }else if($date_diff->format("%a") > 30){ echo "background-color:red !important; border-color: red !important;"; }?>"><i class="fas fa-headset fa-sm" title="Data on Call"></i></span></a>
                          <a href="<?= site_url("bid/".$bkey['bid_id']."/oem_details"); ?>"><span class="btn btn-primary btn-sm" style="padding: .0rem .2rem;"><i class="fab fa-product-hunt fa-md" title="OEM Association"></i></span></a>
                          <?php if(!empty($bidFile)){ ?>
                            <a href="<?= base_url()."/uploads/".$bidFile[0]['up_url']; ?>" download>
                              <span class="btn btn-success btn-sm" style="padding: .0rem .2rem;"><i class="fas fa-cloud-download-alt" title="Download Bid File"></i> </span>
                          </a>
                          <?php }else{ ?>
                            <button type="button" class="btn btn-primary btn-sm" data-id="<?= $bkey['bid_id']; ?>" data-toggle="modal" data-target="#bidFile" style="padding: .0rem .2rem;"><i class="fas fa-cloud-upload-alt" title="Upload Bid File"></i></button>
                          <?php } ?>
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
          <div class="modal fade" id="bidDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 50%;font-size: small;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Bid Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row  p-1">
                    <div class="col-sm-4">
                      Client : <span class="client_name field_value">Central Public Works Department</span>
                    </div>
                    <div class="col-sm-4">
                      Department : <span class="client_dept field_value">Department@gmail.com</span>
                    </div>
                    <div class="col-sm-4">
                      Bid No : <span class="bid_no field_value"></span>
                    </div>
                  </div>
                  <div class="row  p-1">
                    <div class="col-sm-4">
                      Bid End Date/Time : <span class="bid_end_date field_value"></span>
                    </div>
                    <div class="col-sm-4">
                      Bid Opening Date/Time : <span class="bid_open_date field_value"></span>
                    </div>
                    <div class="col-sm-4">
                      Validity : <span class="bid_validity field_value"></span>
                    </div>
                  </div>
                  <div class="row p-1">
                    <div class="col-sm-4">
                      EMD : <span class="bid_emd field_value"></span>
                    </div>
                    <div class="col-sm-4">
                      EPBG : <span class="bid_epbg field_value"></span>
                    </div>
                    <div class="col-sm-4">
                      Region : <span class="bid_region field_value"></span>
                    </div>

                  </div>
                  <div class="row p-1 hidden">

                    <div class="col-sm-6">
                      Budgets : <span class="lead_budget field_value"></span>
                    </div>
                  </div>
                  <div class="row p-1 hidden" style="margin-top: 1rem;">
                    <div class="col-sm-12" style="background: gray;color: #ffffff;font-size:medium;padding: .1rem .2rem .3rem .9rem;">
                      Contact Person Details : 
                    </div>
                  </div>
                  <div class="row p-1 hidden">
                    <div class="col-sm-6">
                      Name : <span class="contact_person_name field_value"></span>
                    </div>
                    <div class="col-sm-6">
                      Contact No. : <span class="contact_person_no field_value"></span>
                    </div>
                    <div class="col-sm-6">
                      Email ID : <span class="contact_person_email field_value"></span>
                    </div>
                  </div>
                  <div class="row p-1" style="margin-top: 1rem;">
                    <div class="col-sm-12" style="background: gray;color: #ffffff;font-size: medium;padding: .1rem .2rem .3rem .9rem;">
                      Bid Product Details : 
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
                            <th>Specification</th>
                            <th>Make & Model</th>
                            <th>Budget</th>
                            <th>GEM link</th>
                            <th>Quoted Price</th>
                          </tr>
                        </thead>
                        <tbody class="product_data">

                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row p-1" style="margin-top: 1rem;">
                    <div class="col-sm-12" style="background: gray;color: #ffffff;font-size:medium;padding: .1rem .2rem .3rem .9rem;">
                      Bid Eligibility Criteria : 
                    </div>
                  </div>

                  <div class="row p-1">
                    <div class="col-sm-12">
                      <table class="table table-responsive table-head-fixed text-nowrap table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Sr. No</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Document</th>
                          </tr>
                        </thead>
                        <tbody class="elegibility_data">

                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row p-1" style="margin-top: 1rem;">
                    <div class="col-sm-12" style="background: gray;color: #ffffff;font-size: medium;padding: .1rem .2rem .3rem .9rem;">
                      Terms and Conditions : 
                    </div>
                  </div>

                  <div class="row p-1">
                    <div class="col-sm-12">
                      <table class="table table-responsive table-head-fixed text-nowrap table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Sr. No</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Document</th>
                          </tr>
                        </thead>
                        <tbody class="terms_data">

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
          <div class="modal fade" id="bidFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form role="form" method="post" enctype="multipart/form-data" action="<?= site_url('bid/bid_details'); ?>">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bid File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8">
                          <div class="form-group">
                            <input type="text" name="up_type_id" class="form-control hidden">
                            <label>File <span class="mandatory"> * </span></label> 
                            <input type="file" class="form-control" name="up_file" accept="application/pdf" required style="border: none;">
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload File</button>
                  </div>
                </form>
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
    <?= view('bid/bid_footer'); ?>