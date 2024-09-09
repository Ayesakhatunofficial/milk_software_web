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
                        <h3 class="card-title">Update Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/product/update/'.$data->id) ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Item*:</label>
                                <input type="text" name="item" class="form-control" value="<?=$data->name?>" readonly>
                                <div class="text-danger"><?php echo $session->getFlashdata('item_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Date*:</label>
                                <input type="date" name="date" id="date" class="form-control" value="<?=$data->date?>" readonly>
                                <div class="text-danger"><?php echo $session->getFlashdata('date_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Product Quantity*:</label>
                                <input type="text" name="product_quantity" class="form-control" value="<?=$data->product_quantity?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('product_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Remarks:</label>
                                <input type="text" name="remarks" class="form-control" placeholder="Enter Remarks">
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

