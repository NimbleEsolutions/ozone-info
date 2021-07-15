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
                  <h3 class="card-title">Terms And Conditions</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" >
                  <table class="table table-head-fixed text-nowrap table-striped table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 2%;">Sr No.</th>
                        <th style="text-align: left;">Terms & Conditions </th>
                        <th style="width:2%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>   
                    <?php if(empty($terms)) { ?>
                        <tr><td colspan="3" style="color: red;font-size: large;font-weight: bold;text-align: center;">No Records Found...!!</td></tr>
                    <?php } else{ $i=0; foreach (array_reverse($terms) as $term) { ?>
                        <tr>
                          <td><center><?php echo ++$i;?></center></td>
                          <td><?php echo $term['term_name']; ?></td>                         
                          <td><center><a href="#"><span class="btn btn-primary btn-sm"><i class="fa fa-trash fa-sm" title="Edit Terms"></i></span></a></center></td>
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
                  <h3 class="card-title">New Terms and Conditions</h3>
                </div>
                <!-- /.card-header -->
                <form role="form" id="masterData" method="post" action="<?= site_url('master/terms'); ?>">
                  <div class="card-body p-0" >
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-8">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Title <span class="mandatory"> * </span></label> 
                            <input type="text" class="form-control" placeholder="Name ..." name="term_name">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer" style="text-align: right;">
                    <button type="submit" class="btn btn-primary">Create Term</button>
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
    <?= view('masters/master_footer'); ?>