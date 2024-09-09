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
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/category/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Category Name*:</label>
                                <input type="text" name="cat_name" class="form-control" placeholder="Enter Category Name">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error');?></div>
                            </div>

                            <div class="form-group">
                                <label>Status:</label>
                                <select class="form-control select2" style="width: 100%;" name="status">
                                    <option selected="selected">Select status</option>
                                    <option value="active" >Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
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