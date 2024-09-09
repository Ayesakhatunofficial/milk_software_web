<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php"); 
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 ">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Shift</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/shift/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Shift Name*:</label>
                                <input type="text" name="s_name" class="form-control" placeholder="Enter Shift Name">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Shift Start Time*:</label>
                                <input type="time" name="start_time" class="form-control">
                                <div class="text-danger"><?php echo $session->getFlashdata('start_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Shift End Time*:</label>
                                <input type="time" name="end_time" class="form-control">
                                <div class="text-danger"><?php echo $session->getFlashdata('end_error');?></div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-center mb-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
</section>

<?php echo view("admin/layout/footer.php"); ?>
<?php echo view("admin/layout/script.php"); ?>