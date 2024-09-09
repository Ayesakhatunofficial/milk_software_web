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
                        <h3 class="card-title">Add Sale Rate</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/salerate/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Type*:</label>
                                <select class="form-control select2" style="width: 100%;" name="type">
                                    <option selected="selected">Select type</option>
                                    <option value="Cow">Cow</option>
                                    <option value="Buffalo">Buffalo</option>
                                    <option value="Both">Both</option>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('type_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Quantity Per Liter*:</label>
                                <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity">
                                <div class="text-danger"><?php echo $session->getFlashdata('quantity_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Sale Rate*:</label>
                                <input type="number" name="rate" class="form-control" placeholder="Enter Sale Rate">
                                <div class="text-danger"><?php echo $session->getFlashdata('rate_error'); ?></div>
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