<?php

session_start();

include './includes/header.php';
include './includes/sidebar.php';
include './includes/connection.php';
include './includes/function.php';

$company = '';
$brand = '';
$status = '';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from brands where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $company = $row['company'];
        $brand = $row['brand'];
        $status = $row['status'];
    } else {
        echo "<script type='text/javascript'>";
        echo "window.location = 'brands.php';";
        echo "</script>";
    }
}

$msg = '';
if (isset($_POST['submit'])) {
    $company = get_safe_value($con, $_POST['company']);
    $brand = get_safe_value($con, $_POST['brand']);
    $status = get_safe_value($con, $_POST['status']);

    $res = mysqli_query($con, "select * from brands where company='$company'");
    $check = mysqli_num_rows($res);

    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = 'GST slab already exist';
            }
        } else {
            $msg = 'GST slab already exist';
        }
    }

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $query = "UPDATE brands SET company='$company', brand='$brand', `status`='$status' WHERE id='$id'";
            mysqli_query($con, $query);
        } else {
            $query = "INSERT INTO brands(id, company, brand, `status`, created_at) VALUES (DEFAULT,'$company','$brand','$status',DEFAULT)";
            mysqli_query($con, $query);
        }
        echo "<script type='text/javascript'>";
        echo "window.location = 'brands.php';";
        echo "</script>";
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php 
    // include('message.php'); 
    ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Brands</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php"> Home </a></li>
                        <li class="breadcrumb-item"><a href="./brands.php">Brands</a></li>
                        <li class="breadcrumb-item active"> Add Brands </li>
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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Brands Information</h3>
                            <a href="./brands.php" class="float-right">
                                <button class="btn btn-primary">
                                    <i class="fas fa-flip-horizontal fa-fw fa-share"></i>&nbsp; Back
                                </button>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Company<span class="text-danger">*</span></label>
                                            <input type="text" name="company" class="form-control" placeholder="Enter Company Name" value="<?php echo $company ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Brand<span class="text-danger">*</span></label>
                                            <input type="text" name="brand" class="form-control" placeholder="Enter Brand Name" value="<?php echo $brand ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Status<span class="text-danger">*</span></label>
                                            <select name="status" class="form-control select2" required>
                                                <option value="1" <?php if ($status == "1") echo 'selected="selected"'; ?>>Active</option>
                                                <option value="0" <?php if ($status == "0") echo 'selected="selected"'; ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-danger ml-3 mb-2"><b><?php echo $msg ?></b></div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" name="submit" class="btn bg-primary btn-block">
                                            <i class="fas fa-save">&nbsp;</i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card -->
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