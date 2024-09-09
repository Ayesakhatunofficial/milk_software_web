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
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/rate_chart/view/" . $data1->ref_id) ?>">Back</a>
                </div>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Rate Chart</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/rate_chart/update/' . $data1->id) ?>" method="POST">
                        <div class="card-body">
                            <input type="hidden" name="ref_id" class="form-control" value="<?= $data1->ref_id ?>" readonly>

                            <div class="form-group">
                                <label for="">Fat*:</label>
                                <input type="number" name="fat" class="form-control" value="<?= $data1->fat ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('fat_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">CNF*:</label>
                                <input type="number" name="cnf" class="form-control" value="<?= $data1->cnf ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('cnf_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Price*:</label>
                                <input type="number" name="price" value="<?= $data1->price ?>" class="form-control">
                                <div class="text-danger"><?php echo $session->getFlashdata('price_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label>Shift*:</label>
                                <select class="form-control select2" style="width: 100%;" name="shift" disabled>
                                    <option selected="selected">Select Shift</option>
                                    <?php foreach ($data as $shift) { ?>
                                        <option value="<?= $shift->id ?>" <?= ($shift->id == $data1->shift_id) ? 'selected' : ''; ?>><?= $shift->shift_name ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('shift_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label>Milk_Type*:</label>
                                <select class="form-control" style="width: 100%;" name="type" disabled>
                                    <option selected="selected">Select Type</option>
                                    <?php foreach ($milk_type as $type) { ?>
                                        <option value="<?= $type->id ?>" <?= ($type->id == $data1->milk_type_id) ? 'selected' : ''; ?>><?= $type->type ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('type_error'); ?></div>
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
