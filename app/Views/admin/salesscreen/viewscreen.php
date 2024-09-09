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
                        <a class="btn btn-primary" href="<?= base_url("/screen/create") ?>">
                            <i class="fas fa-plus"></i> Add Sale Screen
                        </a>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-fixed table-hover" style="table-layout: fixed; width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Sale Type</th>
                                    <th>Shift</th>
                                    <th>Price</th>
                                    <th>Dis</th>
                                    <th>Total</th>
                                    <th>Paid </th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row->user_name; ?><br><?=$row->user_code;?></td>
                                        <td><?= date('d-m-y', strtotime($row->date)); ?></td>
                                        <td><?= $row->sale_type; ?></td>
                                        <td><?= $row->shift_name; ?></td>
                                        <td><?= $row->subtotal; ?></td>
                                        <td><?= $row->discount; ?></td>
                                        <td><?= $row->total_amount; ?></td>
                                        <td><?= $row->paid_amount; ?></td>
                                        <td><?= $row->due_amount; ?></td>
                                        <td>
                                            <a href="<?= base_url('screen/edit/' . $row->id) ?>" class="btn btn-primary btn-sm mr-3 mb-1">Edit</a>
                                            <a href="<?= base_url('screen/invoice/' . $row->id) ?>" class="btn btn-success btn-sm mr-3 mb-1">View</a>
                                            <a href="<?= base_url('screen/delete/' . $row->id) ?>" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Do You Want to Delete?')">Delete</a>
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