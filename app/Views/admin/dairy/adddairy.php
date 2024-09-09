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
                        <h3 class="card-title">Add Branch</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/dairy/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Branch Name*:</label>
                                <input type="text" name="d_name" class="form-control" placeholder="Enter Branch Name">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Branch Contact No*:</label>
                                <input type="number" name="d_contact" class="form-control" placeholder="Enter Branch Contact No.">
                                <div class="text-danger"><?php echo $session->getFlashdata('contact_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Branch Address*:</label>
                                <textarea name="d_address" id="" cols="20" rows="5" class="form-control" placeholder="Enter Branch Address"></textarea>
                                <div class="text-danger"><?php echo $session->getFlashdata('address_error');?></div>
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