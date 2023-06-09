<?php

session_start();

include './includes/header.php';
include './includes/sidebar.php';
include './includes/connection.php';
include './includes/function.php';

$sql = "select * from `salesman` order by id asc;";
$res = mysqli_query($con, $sql);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Salesman </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./index.php"> Home </a></li>
            <li class="breadcrumb-item active"><a href="./salesman.php"></a> Salesman </li>
            <li class="breadcrumb-item active"> Manage Salesman </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"> Manage Salesman </h3>
              <a href="./add_salesman.php" class="btn btn-primary float-right">
                <i class="fas fa-plus-circle">&nbsp;&nbsp;</i> Add Salesman
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                      <thead>
                        <tr>
                          <th class="sorting">#</th>
                          <th class="sorting">Name</th>
                          <th class="sorting">Phone</th>
                          <th class="sorting">Ret. Type</th>
                          <th class="sorting">Route</th>
                          <th class="sorting">Status</th>
                          <th class="sorting">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                          <tr>
                            <th><?php echo $i ?></th>
                            <td><a href="view_retailers.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></td>
                            <td><?php echo $row['phone'] ?></td>
                            <td><?php echo $row['retailer_type'] ?></td>
                            <td><?php echo $row['route'] ?></td>
                            <td>
                              <?php
                              if ($row['status'] == 1) {
                                echo '<span class="badge badge-success">Active</span>';
                              } else {
                                echo '<span class="badge badge-danger">Inactive</span>';
                              }
                              ?>
                            </td>
                            <td class="text-center">
                              <a href="add_retailers.php?id=<?php echo $row['id'] ?>" class="btn btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                          <?php $i++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include './includes/footer.php'; ?>