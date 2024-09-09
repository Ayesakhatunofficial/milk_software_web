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
                        <h3 class="card-title">Add Employee</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/employee/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Employee Name*:</label>
                                <input type="text" name="e_name" class="form-control" placeholder="Enter Employee Name">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Employee Email:</label>
                                <input type="email" name="e_email" class="form-control" placeholder="Enter Employee Email">
                            </div>

                            <div class="form-group">
                                <label for="">Employee Contact No*:</label>
                                <input type="number" name="e_contact" class="form-control" placeholder="Enter Employee Contact No.">
                                <div class="text-danger"><?php echo $session->getFlashdata('contact_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Employee Address*:</label>
                                <textarea name="e_address" id="" cols="20" rows="5" class="form-control" placeholder="Enter Employee Address"></textarea>
                                <div class="text-danger"><?php echo $session->getFlashdata('address_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Password*:</label>
                                <input type="password" name="e_password" class="form-control" placeholder="Enter Password">
                                <div class="text-danger"><?php echo $session->getFlashdata('password_error');?></div>
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