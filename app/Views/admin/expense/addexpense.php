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
                        <h3 class="card-title">Add Expense</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/expense/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category*:</label>
                                <select class="form-control select2" style="width: 100%;" name="category">
                                    <option selected="selected">Select Category</option>
                                    <?php foreach ($category as $cat) { ?>
                                        <option value="<?= $cat->id; ?>"> <?= $cat->name; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('cat_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Date*:</label>
                                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                <div class="text-danger"><?php echo $session->getFlashdata('date_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Party Name*:</label>
                                <input type="text" name="p_name" class="form-control" placeholder="Enter Party Name">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error'); ?></div>
                            </div>

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