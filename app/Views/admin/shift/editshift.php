<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 ">
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/shift/view") ?>">Back</a>
                </div>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Shift</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/shift/update/' .$data->id) ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Shift Name*:</label>
                                <input type="text" name="s_name" class="form-control" value = "<?= $data->shift_name?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Shift Start Time*:</label>
                                <input type="time" name="start_time" class="form-control" value = "<?= $data->start_time?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('start_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Shift End Time*:</label>
                                <input type="time" name="end_time" class="form-control" value = "<?= $data->end_time?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('end_error'); ?></div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-center mb-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
</section>

<?php echo view("admin/layout/footer.php"); ?>
<?php echo view("admin/layout/script.php"); ?>