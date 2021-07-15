    <?= view('home/dash_header'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"> </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item">Masters</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Department Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" >
                  <table class="table table-head-fixed text-nowrap table-striped table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 2%;">Sr No.</th>
                        <th style="text-align: left;">Department </th>
                        <th style="width:2%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>   
                      <?php if(empty($departments)) { ?>
                        <tr><td colspan="3" style="color: red;font-size: large;font-weight: bold;text-align: center;">No Records Found...!!</td></tr>
                      <?php } else{ $i=0; foreach (array_reverse($departments) as $dept) { ?>
                        <tr>
                          <td><center><?php echo ++$i;?></center></td>
                          <td><?php echo $dept['dept_name']; ?></td>                         
                          <td><center><a href="#"><span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#deleteDept" data-id="<?= $dept['dept_id']; ?>"><i class="fa fa-trash fa-sm" title="Delete Department"></i></span></a></center></td>
                        </tr>
                      <?php } } ?>			
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">New Department</h3>
                </div>
                <!-- /.card-header -->
                <form role="form" id="masterData" method="post" action="<?= site_url('master/departments'); ?>">
                  <div class="card-body p-0" >
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-8">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Department Name <span class="mandatory"> * </span></label> 
                            <input type="text" class="form-control" placeholder="Name ..." name="dept_name" >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer" style="text-align: right;">
                    <button type="submit" class="btn btn-primary">Create Department</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </form>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
          <div class="modal fade" id="deleteDept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form role="form" id="masterData" method="get" action="<?= site_url('master/departments'); ?>">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete depatment ?</h5>
                  </div>
                  <div class="modal-body hidden">
                    <input type="text" name="dept_id" class="form-control">
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