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
                        <a class="btn btn-primary" href="<?= base_url("/item/create") ?>">
                            <i class="fas fa-plus"></i> Add Item
                        </a>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Item Name</th>
                                    <!-- <th>Item Quantity</th> -->
                                    <th>Item Rate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row->name; ?></td>
                                        <!-- <td><?//= $row->quantity; ?></td> -->
                                        <td><?= $row->rate; ?></td>
                                        <td>
                                            <a href="<?= base_url('item/edit/' . $row->id) ?>" class="btn btn-primary btn-sm mr-1 mb-1">Edit</a>
                                            <a href="<?= base_url('item/delete/' . $row->id) ?>" class="btn btn-danger btn-sm mr-1 mb-1" onclick="return confirm('Do You Want to Delete?')">Delete</a>
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