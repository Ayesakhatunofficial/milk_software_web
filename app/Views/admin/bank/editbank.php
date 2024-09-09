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
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/bank/view") ?>">Back</a>
                </div>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Bank</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/bank/update/' .$data->id) ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Bank Name*:</label>
                                <input type="text" name="bank_name" class="form-control" value="<?= $data->bank_name ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Bank IFSC Code *:</label>
                                <input type="text" name="b_ifsc" class="form-control" value="<?= $data->ifsc_code ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('ifsc_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Bank Account No*:</label>
                                <input type="number" name="b_account" class="form-control" value="<?= $data->ac_number ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('account_error'); ?></div>
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