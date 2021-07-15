<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\StatesModel;
use \App\Models\CitiesModel;
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
            <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Client Details</h3>

                <div class="card-tools">
				  
                  <div class="input-group input-group-sm">
					            <a href="<?= site_url('master/register_clients') ?>"><span class="btn btn-primary btn-sm"> <i class="fas fa-plus fa-xs"></i> New Client </span></a>
                  </div>
				  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <table class="table table-head-fixed text-nowrap table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 2%;">Sr No.</th>
                      <th>Client Name </th>
                      <th>E-mail</th>
                      <th>Contact No</th>
                      <th>Website</th>
                      <th>Address</th>
                      <th><center>Action</center></th>
                    </tr>
                  </thead>
                  <tbody>   
                  <?php if(empty($client_details)) { ?>
                      <tr><td colspan="4" style="color: red;font-size: large;font-weight: bold;text-align: center;">No Records Found...!!</td></tr>
                  <?php } else{ $i=0; foreach (array_reverse($client_details) as $lkey) { 
                      $client=(new HomeModel())->getData(array('client_id'=>$lkey['lead_client']),'sales_client');
                      $state=(new StatesModel())->find($lkey['client_state']);
                      $cities=(new CitiesModel())->find($lkey['client_city']);
                    ?>
                      <tr>
                        <td><center><?php echo ++$i;?></center></td>
                        <td><?php echo $lkey['client_name']; ?></td>
                        <td><?php echo $lkey['client_email']; ?></td>
                        <td><?php echo $lkey['client_contact']; ?></td>                       
                        <td><?php echo $lkey['client_website']; ?></td>                       
                        <td><?= $lkey['client_address']."<br>".$cities['ct_name'].", ".$state['st_name']." ".$lkey['client_pincode']; ?></td>                       
                        <td><center>
                          <a href="<?php echo site_url('master/'.$lkey['client_id'].'/update_clients'); ?>"><span class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt fa-sm" title="Edit Client"></i></span></a>
                          <span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#deleteClient" data-id="<?= $lkey['client_id']; ?>"><i class="fa fa-trash fa-sm" title="Delete Client"></i></span>
                        </center></td>
                      </tr>
                  <?php } } ?>			
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </div>
          <!-- /.row -->
          <div class="modal fade" id="deleteClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form role="form" id="masterData" method="get" action="<?= site_url('master/clients'); ?>">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete Client ?</h5>
                  </div>
                  <div class="modal-body hidden">
                    <input type="text" name="client_id" class="form-control">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes, Delete it.</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
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
    <?= view('masters/master_footer'); ?>