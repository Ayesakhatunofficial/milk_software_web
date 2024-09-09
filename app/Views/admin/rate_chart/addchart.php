<?php
//echo UPLOAD_PATH;die;
echo view("admin/layout/head.php"); ?>
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
                        <h3 class="card-title">Add Rate Chart</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/rate_chart/add') ?>" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Select Rate Chart *:</label>
                                <input type="file" name="file" class="form-control">
                                <div class="text-danger"><?php echo $session->getFlashdata('file_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label>Shift*:</label>
                                <select class="form-control" style="width: 100%;" name="shift">
                                    <option selected="selected">Select Shift</option>
                                    <?php foreach ($data as $shift) { ?>
                                        <option value="<?= $shift->id ?>"><?= $shift->shift_name ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('shift_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label>Milk_Type*:</label>
                                <select class="form-control" style="width: 100%;" name="type">
                                    <option selected="selected">Select Type</option>
                                    <?php foreach ($milk_type as $type) { ?>
                                        <option value="<?= $type->id ?>"><?= $type->type ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('type_error'); ?></div>
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