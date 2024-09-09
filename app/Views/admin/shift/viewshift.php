<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php if (session()->has('success')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo session('success'); ?>
                        </div>
                    <?php } else if (session()->has('wrong')) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo session('wrong'); ?>
                        </div>
                    <?php }
                    ?>
                    <div class="card-header">
                        <!-- <h3 class="card-title">View Dairy List</h3> -->
                        <a class="btn btn-primary" href="<?= base_url("/shift/create") ?>">
                            <i class="fas fa-plus"></i> Add Shift
                        </a>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Shift Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php $i = 1;
                            foreach ($data as $row) { ?>
                                <tbody>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row->shift_name; ?></td>
                                        <td><?= $row->start_time; ?></td>
                                        <td><?= $row->end_time; ?></td>
                                        <td>
                                            <a href="<?= base_url('shift/edit/' . $row->id) ?>" class="btn btn-primary btn-sm mr-3">Edit</a>
                                            <a href="<?= base_url('shift/delete/' .$row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Do You Want to Delete?')">Delete</a>
                                        </td>

                                    </tr>
                                </tbody>
                            <?php $i++;
                            } ?>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?php echo view("admin/layout/footer.php"); ?>
<?php echo view("admin/layout/script.php"); ?>