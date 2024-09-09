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
                        <h3 class="card-title">Add Customer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/customer/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Customer Name*:</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Customer Name">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Customer Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Customer Email">
                            </div>

                            <div class="form-group">
                                <label for="">Customer Contact No*:</label>
                                <input type="number" name="contact" class="form-control" placeholder="Enter Customer Contact No.">
                                <div class="text-danger"><?php echo $session->getFlashdata('contact_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Customer Address*:</label>
                                <textarea name="address" id="" cols="20" rows="5" class="form-control" placeholder="Enter Customer Address"></textarea>
                                <div class="text-danger"><?php echo $session->getFlashdata('address_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Password*:</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
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