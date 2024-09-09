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
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/expense/view") ?>">Back</a>
                </div>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Expense</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/expense/update/'.$data->id) ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category*:</label>
                                <select class="form-control select2" style="width: 100%;" name="category">
                                    <option selected="selected">Select Category</option>
                                    <?php foreach ($category as $cat) { ?>
                                        <option value="<?= $cat->id; ?>" <?= ($cat->id == $data->category_id) ? 'selected' : ''; ?>> <?= $cat->name; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('cat_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Date*:</label>
                                <input type="date" name="date" class="form-control" value="<?= $data->date ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('date_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Party Name*:</label>
                                <input type="text" name="p_name" class="form-control" value="<?= $data->party_name ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('name_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Amount*:</label>
                                <input type="number" name="amount" class="form-control" value="<?= $data->amount ?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('amount_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Comment:</label>
                                <textarea name="comment" id="" cols="20" rows="5" class="form-control"><?= $data->comment ?></textarea>
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