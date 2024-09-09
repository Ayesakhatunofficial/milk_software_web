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
                        <a class="btn btn-primary" href="<?= base_url("/advance/create") ?>">
                            <i class="fas fa-plus"></i> Add Advance
                        </a>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Reference Code</th>
                                    <th>Farmer Name</th>
                                    <th>Farmer Mobile</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Interest Rate</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row->ref_code; ?></td>
                                        <td><?= $row->user_name; ?></td>
                                        <td><?= $row->farmer_mobile; ?></td>
                                        <td><?= $row->date; ?></td>
                                        <td><?= $row->amount; ?></td>
                                        <td><?= $row->interest_rate; ?></td>
                                        <td><?= $row->comment; ?></td>
                                        <td>
                                            <?php if ($row->is_exists == 0) { ?>
                                                <a href="<?= base_url('advance/edit/' . $row->id) ?>" class="btn btn-primary btn-sm mr-3 mb-1">Edit</a>
                                            <?php } ?>
                                            <a href="<?= base_url('advance/delete/' . $row->id) ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Do You Want to Delete?')">Delete</a>
                                            <a href="<?= base_url('advance/viewcollect/' . $row->ref_code) ?>" class="btn btn-info btn-sm mr-3 mb-1">Collect</a>
                                        </td>

                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>

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
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>