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
                        <h3 class="card-title">Add Bank</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/bank/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Farmer*:</label>
                                <select class="form-control select2" style="width: 100%;" name="farmer">
                                    <option selected="selected">Select Farmer</option>
                                    <?php foreach ($farmers as $farmer) { ?>
                                        <option value="<?= $farmer->id ?>"><?= $farmer->user_name ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('farmer_error'); ?></div>
                            </div>
                            <div class="form-group">
                                <label for="">Bank Name*:</label>
                                <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Bank IFSC Code *:</label>
                                <input type="text" name="b_ifsc" class="form-control" placeholder="Enter Bank IFSC Code">
                                <div class="text-danger"><?php echo $session->getFlashdata('ifsc_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Bank Account No*:</label>
                                <input type="number" name="b_account" class="form-control" placeholder="Enter Bank Account No.">
                                <div class="text-danger"><?php echo $session->getFlashdata('account_error'); ?></div>
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