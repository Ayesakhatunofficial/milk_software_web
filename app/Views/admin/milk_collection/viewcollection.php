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
                        <a class="btn btn-primary" href="<?= base_url("/milk/create") ?>">
                            <i class="fas fa-plus"></i> Add Collection
                        </a>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover" style="table-layout: fixed; width: 100%;">
                            <thead>
                                <tr>
                                    <th>F. Code</th>
                                    <th width="15%">F. Name</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th width="5%">Shift</th>
                                    <th width="3%">Qty.</th>
                                    <th>Fat</th>
                                    <th>CNF</th>
                                    <th>Per Lt. Price</th> 
                                    <th>Price</th> 
                                    <th>Due</th> 
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?php $code = $row->farmer_code;
                                        $code_1 = substr($code, 2);
                                        echo $code_1; ?></td>
                                        <td><?= $row->farmer_name; ?><br> Mobile : <?= $row->farmer_mobile; ?></td>
                                        <td><?= $row->col_name; ?></td>
                                        <td><?= date('d-m-y', strtotime($row->date)); ?></td>
                                        <td><?= $row->shift_name; ?><br><?= $row->type; ?></td>
                                        <td><?= $row->milk_quantity; ?></td>
                                        <td><?= $row->fat; ?></td>
                                        <td><?= $row->cnf; ?></td>
                                        <td><?= $row->per_liter_price; ?></td>
                                        <td><?= $row->price; ?></td>
                                        <td><?= $row->due_amount; ?></td>
                                        <td>
                                            <a href="<?= base_url('milk/edit/' . $row->id) ?>" class="btn btn-primary btn-sm mr-3 mb-1">Edit</a>
                                            <a href="<?= base_url('milk/delete/' . $row->id) ?>" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Do You Want to Delete?')">Delete</a>
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