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
              <!-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                <li class="breadcrumb-item active">Top Navigation</li>
              </ol> -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="row">
            <?php if(session()->get('role_id') == '3' || session()->get('role_id') == '2'){ ?>
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?= count($lead); ?></h3>

                  <p>Lead</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?= site_url("sales/pre-sales"); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <?php } ?>
            <!-- ./col -->
            <?php if(session()->get('role_id') == '3' || session()->get('role_id') == '2' || session()->get('role_id') == '4'){ ?>
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?= count($bid); ?></h3>
                  <p>Bid / Tender</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= site_url("bid/bid_details"); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right fa-sm"></i></a>
              </div>
            </div>
            <?php } ?>
            <!-- ./col -->
            <?php if(session()->get('role_id') == '3' || session()->get('role_id') == '2'){ ?>
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>0</h3>

                  <p>Order</p>
                </div>
                <div class="icon">
                  <!-- <i class="ion ion-pie-graph"></i> -->
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>0</h3>

                  <p>Delivery</p>
                </div>
                <div class="icon">
                  <i class="fas fa-truck"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>0</h3>

                  <p>Closer / Payment</p>
                </div>
                <div class="icon">
                  <!-- <i class="fas fa-closed-captioning"></i> -->
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>0</h3>

                  <p>Reports</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right fa-sm"></i></a>
              </div>
            </div>
            <?php } ?>
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
    <?= view('home/dash_footer'); ?>