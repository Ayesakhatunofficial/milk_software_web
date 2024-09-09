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
                        <a class="btn btn-primary" href="<?= base_url("/customer/create") ?>">
                            <i class="fas fa-plus"></i> Add Customer
                        </a>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Customer Code</th>
                                    <th>Customer Name</th>
                                    <th>Customer Mobile No</th>
                                    <th>Customer Address</th>
                                    <th>Customer Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?php $code = $row->user_code; 
                                        $code_1 = substr($code, 3);
                                        echo $code_1;
                                        ?></td>
                                        <td><?= $row->user_name; ?></td>
                                        <td><?= $row->user_mobile; ?></td>
                                        <td><?= $row->user_address; ?></td>
                                        <td><?= $row->user_email; ?></td>
                                        <td>
                                            <a href="<?= base_url('customer/edit/' . $row->id) ?>" class="btn btn-primary btn-sm mr-3 mb-1">Edit</a>
                                            <a href="<?= base_url('customer/delete/' . $row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Do You Want to Delete?')">Delete</a>
                                        </td>

                                    </tr>
                                <?php
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