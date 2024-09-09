<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/collection/view") ?>">Back</a>
                </div>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Collection Boy</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form autocomplete="off" action="<?= base_url('/collection/update/' . $data->id) ?>" method="POST">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <label for="">Collection Boy Name*:</label>
                                <input type="text" name="c_name" class="form-control" value="<?= $data->user_name ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Collection Boy Email:</label>
                                <input type="email" name="c_email" class="form-control" value="<?= $data->user_email?>">
                            </div>

                            <div class="form-group">
                                <label for="">Collection Boy Contact No*:</label>
                                <input type="number" name="c_contact" class="form-control" value="<?= $data->user_mobile ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('contact_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Collection Boy Address*:</label>
                                <textarea name="c_address" id="" cols="20" rows="5" class="form-control"><?= $data->user_address ?></textarea>
                                <div class="text-danger"><?php echo $session->getFlashdata('address_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Password:</label>
                                <input type="password" name="c_password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Branch*:</label>
                                <select class="form-control select2" style="width: 100%;" name="branch">
                                    <option selected="selected"></option>
                                    <?php foreach ($branches as $branch) { ?>
                                        <option value="<?= $branch->id; ?>" <?= ($branch->id == $data->branch_id) ? 'selected' : ''; ?>> <?= $branch->dairy_name; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('branch_error'); ?></div>
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