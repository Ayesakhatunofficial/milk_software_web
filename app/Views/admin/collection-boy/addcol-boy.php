<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Collection Boy</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/collection/add') ?>" method="POST">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <label for="">Collection Boy Name*:</label>
                                <input type="text" name="c_name" class="form-control" placeholder="Enter Collection Boy Name">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Collection Boy Email:</label>
                                <input type="email" name="c_email" class="form-control" placeholder="Enter Collection Boy Email">
                            </div>

                            <div class="form-group">
                                <label for="">Collection Boy Contact No*:</label>
                                <input type="number" name="c_contact" class="form-control" placeholder="Enter Collection Boy Contact No.">
                                <div class="text-danger"><?php echo $session->getFlashdata('contact_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Collection Boy Address*:</label>
                                <textarea name="c_address" id="" cols="20" rows="5" class="form-control" placeholder="Enter Collection Boy Address"></textarea>
                                <div class="text-danger"><?php echo $session->getFlashdata('address_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Password*:</label>
                                <input type="password" name="c_password" class="form-control" placeholder="Enter Password">
                                <div class="text-danger"><?php echo $session->getFlashdata('password_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label>Branch*:</label>
                                <select class="form-control select2" style="width: 100%;" name="branch">
                                    <option selected="selected">Select Branch</option>
                                    <?php foreach ($branches as $branch) { ?>
                                        <option value="<?= $branch->id; ?>"> <?= $branch->dairy_name; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('branch_error'); ?></div>
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