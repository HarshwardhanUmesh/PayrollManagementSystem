<?php
$user = 'root';
$password = '';
$database = 'test';
$servername = 'localhost:3306';
$mysqli = new mysqli(
  $servername,
  $user,
  $password,
  $database
);

if ($mysqli->connect_error) {
  die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$table_query = "show tables;";
$tables = $mysqli->query($table_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
  <style>
    div.alert {
      width: 25%;
      position: fixed;
      right: 10px;
      bottom: 10px;
    }

    .pen {
      display: none;
      width: 20px;
      position: absolute;
      right: 10px;
    }

    td:hover>.pen {
      display: inline;
    }

    td {
      position: relative;
    }
  </style>
</head>

<body class="sidebar-mini">
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
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="src\images\logo_admin.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              <strong>USER : </strong>Admin</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <!-- <a href="#" class="nav-link active"> -->
              <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <a href="index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard</p>
              </a>
              </a>
            </li>
            <!-- <li class="nav-item">
            <a href="tablelist.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Tables</p>
            </a>
          </li> -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Tables
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: block;">
                <?php
                $row = 0;
                while ($table = $tables->fetch_array()) {
                ?>
                  <li class="nav-item">
                    <?php if($_GET["table"] == $table[0]){?>
                    <a href="table.php?table=<?php echo $table[0] ?>" class="nav-link active">
                    <?php }else{?>
                    <a href="table.php?table=<?php echo $table[0] ?>" class="nav-link">
                    <?php }?>
                      <i class="far fa-circle nav-icon"></i>
                      <p><?php echo $table[0] ?></p>
                    </a>
                  </li>
                <?php
                } ?>
              </ul>
            </li>
            <li class="nav-header">UTILITIES</li>
            <li class="nav-item">
              <a href="pages/calendar.html" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Calendar
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logs.php" class="nav-link">
              <i class="nav-icon fa-solid fa-file-lines"></i>
                <p>
                  Logs
                  <!-- <span class="badge badge-info right"></span> -->
                </p>
              </a>
            </li>
          </ul>
          </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- /.content-header -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>DataTables</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="./tablelist.php">DataTables</a></li>
                  <li class="breadcrumb-item active"><?php echo $tablename = $_GET["table"]; ?></li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <?php
        if (isset($_GET["table"])) {
        ?>
          <!-- Main content -->
          <section class="content">
            <?php
            $tablename = $_GET["table"];
            $column_query = " DESC $tablename";
            $row_query = " SELECT * FROM $tablename";
            $foreign_col = [];
            $db = "test";
            $q = "select table_name,column_name,referenced_table_name,referenced_column_name from information_schema.key_column_usage where referenced_table_name is not null and table_schema = 'test' and table_name = " . "'$tablename'";
            $res = $mysqli->query($q);
            if (!$res) {
              die("query failed" . $mysqli->error);
            } else {
              while ($x = $res->fetch_assoc()) {
                array_push($foreign_col, $x['column_name']);
              }
            }
            $columns = $mysqli->query($column_query); //col table 
            $rows = $mysqli->query($row_query); //row table 
            $col = [];
            $col_type = [];
            $col_key = [];
            while ($x = $columns->fetch_assoc()) {
              array_push($col, $x['Field']);
              array_push($col_type, $x['Type']);
              if (in_array($x["Field"], $foreign_col)) {
                array_push($col_key, "ForeignKey");
              } elseif ($x["Key"]) {
                array_push($col_key, "PrimaryKey");
              } else {
                array_push($col_key, "None");
              }
            }

            ?>


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="<?php echo $tablename . ' table table-bordered table-striped example1 ' ?> ">
                  <thead>
                    <tr>
                      <?php
                      foreach ($col as $x) {
                      ?>
                        <th><?php echo $x; ?></th>
                      <?php
                      }
                      ?>
                      <th>operation</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $row_index = 0;
                    while ($row = $rows->fetch_assoc()) {
                    ?>
                      <tr class="<?php echo $row_index; ?>">
                        <!-- columns per row -->
                        <?php
                        $col_index = 0;
                        foreach ($col as $x) {

                        ?>
                          <td class="v <?php echo $tablename . " " . $x . " " . $col_type[$col_index] . " " . $col_key[$col_index]; ?>"><?php echo $row[$x] . '<img class="pen" src=".\src\images\edit.png" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>'; ?></td>
                        <?php
                          $col_index++;
                        }
                        ?>
                        <td class="delete"><svg class="<?php echo $tablename ?> delete" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                          </svg>
                          <!-- <button class="Vock">h</button> -->
                        </td>
                      </tr>
                    <?php
                      $row_index++;
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <?php
                      foreach ($col as $x) {
                      ?>
                        <th><?php echo $x; ?></th>
                      <?php
                      }
                      ?>
                      <th class="col-1">operation</th>
                    </tr>
                  </tfoot>
                </table>
                <button class="create">create</button>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  </section>
<?php
        } else {
          echo "NOT found";
        }
?>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  $(function() {
    $(".example1").each((index, element) => {
      console.log(element)
      $(element).DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo($(element).parent().parent().parent().find('.col-sm-12.col-md-6:first-child'));
    });
  });
</script>
<script src="src/js/delete.js"></script>
<!-- <script src="src/js/insert.js"></script> -->
<script src="src/js/insertupdate.js"></script>
<script src="src/js/tableList.js"></script>
<
<script>
  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }
  window.onload = function() {
    if (sessionStorage.getItem("insert")) {
      console.log("Record inserted successfully.")
      sessionStorage.clear()
      $("body").append('<div class="alert alert-primary" role="alert">Record inserted successfully.</div>')
      sleep(2000);
      $(".alert").animate({
          opacity: 0
        },
        5000,
        function() {
          $(".alert.alert-primary").hide();
        }
      );
    }
    if (sessionStorage.getItem("delete")) {
      console.log("Record deleted successfully.")
      $("body").append('<div class="alert alert-primary" role="alert">Record deleted successfully.</div>')
      sessionStorage.clear()
      sleep(2000);
      $(".alert").animate({
          opacity: 0
        },
        5000,
        function() {
          $(".alert.alert-primary").hide();
        }
      );
    }
  }
</script>
<script>

</script>
</body>

</html>