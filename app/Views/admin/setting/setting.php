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
                    <?php if (session()->has('success')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo session('success'); ?>
                        </div>
                    <?php } ?>
                    <div class="card-header">
                        <h3 class="card-title">Settings</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/setting/update') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Name*:</label>
                                <input type="text" name="name" class="form-control" value="<?=$data->name;?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Contact No*:</label>
                                <input type="text" name="contact" class="form-control" value="<?=$data->mobile_no;?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('contact_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Address*:</label>
                                <textarea name="address" id="" class="form-control"><?=$data->address;?></textarea>
                                <div class="text-danger"><?php echo $session->getFlashdata('address_error'); ?></div>
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