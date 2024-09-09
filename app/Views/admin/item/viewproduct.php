<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/product/totalview") ?>">Back</a>
                </div>
                <div class="card card-primary">
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
                        <h3 class="card-title">View Product</h3>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row->date)); ?></td>
                                        <td><?= $row->name; ?></td>
                                        <td><?= $row->product_quantity; ?></td>
                                        <td><?= $row->remarks; ?></td>
                                        <td>
                                            <a href="<?= base_url('product/edit/' . $row->id) ?>" class="btn btn-primary btn-sm mr-1 mb-1">Edit</a>
                                            <a href="<?= base_url('product/delete/' . $row->id) ?>" class="btn btn-danger btn-sm mr-1 mb-1" onclick="return confirm('Do You Want to Delete?')">Delete</a>
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