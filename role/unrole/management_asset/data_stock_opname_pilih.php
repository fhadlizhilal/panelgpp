<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pilih Data Stock Opname</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Stock Opname</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- ///.card-header -->
              <div class="card-body">
                <div class="row">
                  
                  <?php
                    $q_get_entitas = mysqli_query($conn, "SELECT * FROM asset_db_entitas ORDER BY id ASC");
                    while($get_entitas = mysqli_fetch_array($q_get_entitas)){
                  ?>
                      <div class="col-6">
                        <a href="index.php?pages=stockopname&entitas=<?php echo $get_entitas['id']; ?>">
                          <div class="info-box mb-3 bg-warning">
                            <span class="info-box-icon"><i class="fa fa-cube"></i></span>
                            <div class="info-box-content">
                              <div style="font-weight: bold;">DATA STOCK OPNAME <?php echo strtoupper($get_entitas['entitas']); ?></div>
                            </div>
                          </div>
                        </a>
                      </div>
                  <?php } ?>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>