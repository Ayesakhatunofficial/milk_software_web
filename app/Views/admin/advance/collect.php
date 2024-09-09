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
                        <h3 class="card-title">Payment Collect</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/advance/addcollect') ?>" method="POST">
                        <div class="card-body">
                            <input type="hidden" name='ref_id' value = "<?= $ref_id ?>">
                            
                            <div class="form-group">
                                <label for="">Amount*:</label>
                                <input type="number" name="amount" class="form-control" placeholder="Enter Amount">
                                <div class="text-danger"><?php echo $session->getFlashdata('amount_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Comment:</label>
                                <textarea name="comment" id="" cols="20" rows="5" class="form-control" placeholder="Enter Your Comment"></textarea>
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