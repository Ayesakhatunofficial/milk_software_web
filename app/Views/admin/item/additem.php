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
                        <h3 class="card-title">Add Item</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/item/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Item Name*:</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Item Name">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error');?></div>
                            </div>

                            <!-- <div class="form-group">
                                <label for="">Item Quantity*:</label>
                                <input type="text" name="quantity" class="form-control" placeholder="Enter Item Quantity">
                                <div class="text-danger"><?//php echo $session->getFlashdata('quantity_error');?></div>
                            </div> -->

                            <div class="form-group">
                                <label for="">Item Rate*:</label>
                                <input type="text" name="rate" class="form-control" placeholder="Enter Item Rate">
                                <div class="text-danger"><?php echo $session->getFlashdata('rate_error');?></div>
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