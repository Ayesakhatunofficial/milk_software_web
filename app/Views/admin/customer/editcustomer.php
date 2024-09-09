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
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/customer/view") ?>">Back</a>
                </div>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Customer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/customer/update/' .$data->id) ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Customer Name*:</label>
                                <input type="text" name="name" class="form-control" value="<?= $data->user_name ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Customer Email:</label>
                                <input type="email" name="email" class="form-control" value="<?= $data->user_email?>">
                            </div>

                            <div class="form-group">
                                <label for="">Customer Contact No*:</label>
                                <input type="number" name="contact" class="form-control" value="<?= $data->user_mobile ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('contact_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Customer Address*:</label>
                                <textarea name="address" id="" cols="20" rows="5" class="form-control"><?= $data->user_address ?></textarea>
                                <div class="text-danger"><?php echo $session->getFlashdata('address_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Password:</label>
                                <input type="password" name="password" class="form-control">
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