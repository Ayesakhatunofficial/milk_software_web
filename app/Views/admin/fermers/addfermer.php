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
                        <h3 class="card-title">Add Farmer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/fermer/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Farmer Name*:</label>
                                <input type="text" name="f_name" class="form-control" placeholder="Enter Farmer Name">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Farmer Email:</label>
                                <input type="email" name="f_email" class="form-control" placeholder="Enter Farmer Email">
                            </div>

                            <div class="form-group">
                                <label for="">Farmer Contact No*:</label>
                                <input type="number" name="f_contact" class="form-control" placeholder="Enter Farmer Contact No.">
                                <div class="text-danger"><?php echo $session->getFlashdata('contact_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Farmer Address*:</label>
                                <textarea name="f_address" id="" cols="20" rows="5" class="form-control" placeholder="Enter Farmer Address"></textarea>
                                <div class="text-danger"><?php echo $session->getFlashdata('address_error');?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Farmer Aadhar No:</label>
                                <input type="number" name="f_adhar" class="form-control" placeholder="Enter Farmer Aadhar No.">
                                <!-- <div class="text-danger"><?//php echo $session->getFlashdata('adhar_error');?></div> -->
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