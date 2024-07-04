    <?php
    session_start();
    include 'config.php';
    if (!$conn) {
      die("<script>alert('Gagal tersambung dengan database.')</script>");
    }
    // Jika tidak bisa login maka balik ke login.php
    // jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
    if ($_SESSION['login'] != true) {
      echo '<script>window.location = "login.php"</script>';
    }
    
    
    
    // Mendapatkan total data dan menghitung jumlah halaman
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM images");
    $row = mysqli_fetch_assoc($result);
    $total_data = $row['total'];
    $limit = 10; // Data per halaman
    
    $total_pages = ceil($total_data / $limit);
    
    $tampil = mysqli_query($conn, "SELECT * FROM images ORDER BY id LIMIT 0, $limit");
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    
    
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Dashboard</title>
    
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- JQVMap -->
      <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/adminlte.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    
    
      <!-- Daterange picker -->
      <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
      <!-- summernote -->
      <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    
      <!-- jQuery -->
    
      <script src="plugins/jquery/jquery.min.js"></script>
    </head>
    
    
    <body class="hold-transition sidebar-mini layout-fixed">
    
      <div class="wrapper">
    
    
        <!-- Preloader -->
    
        <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
    
    
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="index.php" class="nav-link">Home</a>
            </li>
            <!--<li class="nav-item d-none d-sm-inline-block">-->
    
            <!--  <a href="#" class="nav-link">Contact</a>-->
            <!--</li>-->
          </ul>
    
          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
    
            <!-- Navbar Search -->
            <!--<li class="nav-item">-->
            <!--  <a class="nav-link" data-widget="navbar-search" href="#" role="button">-->
            <!--    <i class="fas fa-search"></i>-->
            <!--  </a>-->
            <!--  <div class="navbar-search-block">-->
    
            <!--    <form class="form-inline">-->
    
    
            <!--      <div class="input-group input-group-sm">-->
            <!--        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">-->
            <!--        <div class="input-group-append">-->
            <!--          <button class="btn btn-navbar" type="submit">-->
            <!--            <i class="fas fa-search"></i>-->
            <!--          </button>-->
            <!--          <button class="btn btn-navbar" type="button" data-widget="navbar-search">-->
            <!--            <i class="fas fa-times"></i>-->
            <!--          </button>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--    </form>-->
            <!--  </div>-->
            <!--</li>-->
          </ul>
        </nav>
        <!-- /.navbar -->
    
    
    
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
              </div>
              <img src="dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
              <div class="info">
                <a href="#" class="d-block">
                  <?php echo $_SESSION['user']; ?>
                </a>
              </div>
            </div>
    
            <!-- SidebarSearch Form -->
            <!--<div class="form-inline">-->
            <!--  <div class="input-group" data-widget="sidebar-search">-->
            <!--    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">-->
            <!--    <div class="input-group-append">-->
            <!--      <button class="btn btn-sidebar">-->
            <!--        <i class="fas fa-search fa-fw"></i>-->
            <!--      </button>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
    
            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
    
                <li class="nav-item menu-open">
    
                <li class="nav-header">Menu</li>
    
                <li class="nav-item">
    
                  <a href="logout.php" class="nav-link">
                    <i class="nav-icon ion ion-log-out"></i>
                    <p>Log Out</p>
                  </a>
    
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>
    
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
    
            <div class="container-fluid">
    
              <div class="row mb-2">
                <div class="col-sm-6">
    
                  <h1 class="m-0">Dashboard</h1>
    
                </div><!-- /.col -->
    
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
    
                    <li class="breadcrumb-item active">Dashboard v1</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
    
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
    
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3 id="update-info">
                      </h3>
                      <p>Detected</p>
                    </div>
                    <div class="icon">
    
                      <i class="ion ion-person"></i>
                    </div>
                  </div>
    
    
                </div>
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-danger">
                    <div class="inner">
    
                      <h3 id="update-today"></h3>
    
                      <p>Today</p>
    
    
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
    
                </div>
    
                <!-- ./col -->
              </div>
    
              <!-- /.row -->
    
              <!-- Main row -->
    
            </div>
    
            <div class="card">
              <div class="content-header">
                <h1> Tabel</h1>
              </div>
              <div class="container-fluid">
                <div class="row">
    
                  <div class="col-12">
                    <div class="card">
                      <!-- /.card-header -->
    
                      <div class="card-body">
    
                        <table id="example2" class="table table-bordered table-hover">
                          <thead>
    
    
                            <tr>
                              <th>No.</th>
                              <th>Time Detected</th>
    
    
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody id="realtime">
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_array($tampil)) {
                              echo "<tr>";
                              echo "<td>" . $no++ . "</td>";
                              echo "<td>" . $row['upload_time'] . "</td>";
    
                              echo '<td><a href="show.php?id=' . $row['id'] . '">Details</a> | <a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
                              echo "</tr>";
                            }
                            ?>
    
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right" id="pagination">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li class='page-item'><a href='#' class='page-link' data-page='$i'>$i</a></li>";
        }
        ?>
    </ul>
</div>

    
                    </div>
                    <!-- Left col -->
                  </div><!-- /.container-fluid -->
    
                </div>
              </div>
    
            </div>
          </section>
<script>
$(document).ready(function() {
    var currentPage = 1;
    var autoUpdateInterval;

    function loadTable(page) {
        $.ajax({
            url: "load_table.php",
            type: "GET",
            data: { page: page },
            success: function(response) {
                $('#realtime').html(response);
                currentPage = page;
            }
        });
    }

    $(document).on('click', '#pagination a', function(e) {
        e.preventDefault();
        clearInterval(autoUpdateInterval);
        var page = $(this).data('page');
        loadTable(page);
        startAutoUpdate(page);
    });

    function startAutoUpdate(page) {
        autoUpdateInterval = setInterval(function() {
            loadTable(page);
            updateInfo();
            updateToday();
        }, 1000);
    }

    loadTable(currentPage);
    startAutoUpdate(currentPage);

    function updateInfo() {
        $.ajax({
            url: "update-info.php",
            type: "GET",
            success: function(response) {
                $('#update-info').html(response);
            }
        });
    }

    function updateToday() {
        $.ajax({
            url: "today.php",
            type: "GET",
            success: function(response) {
                $('#update-today').html(response);
            }
        });
    }
});
</script>
    
          <!-- /.content -->
        </div>
    
        <!-- /.content-wrapper -->
        <footer class="main-footer">
          <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    
          All rights reserved.
          <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
    
          </div>
        </footer>
    
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->
    
    
      <!-- jQuery UI 1.11.4 -->
      <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
        $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap 4 -->
    
      <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    
      <!-- ChartJS -->
      <script src="plugins/chart.js/Chart.min.js"></script>
      <!-- Sparkline -->
      <script src="plugins/sparklines/sparkline.js"></script>
      <!-- JQVMap -->
      <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    
      <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
      <!-- jQuery Knob Chart -->
      <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
      <!-- daterangepicker -->
      <script src="plugins/moment/moment.min.js"></script>
      <script src="plugins/daterangepicker/daterangepicker.js"></script>
    
      <!-- Tempusdominus Bootstrap 4 -->
      <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
      <!-- Summernote -->
    
      <script src="plugins/summernote/summernote-bs4.min.js"></script>
      <!-- overlayScrollbars -->
      <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
      <!-- AdminLTE App -->
      <script src="dist/js/adminlte.js"></script>
    </body>
    
    </html>