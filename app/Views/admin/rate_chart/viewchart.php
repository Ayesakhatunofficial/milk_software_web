<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-danger btn-sm mt-1 ml-1" href="<?= base_url("/rate_chart/viewconfig/") ?>">Back</a>
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
                        <h3 class="card-title">View Rate Chart <?= $name->shift_name ?> and Milk Type <?= $name->type ?></h3>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Fat</th>
                                    <th>CNF</th>
                                    <th>Price</th>
                                    <th>Shift</th>
                                    <th>Milk Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row->fat; ?></td>
                                        <td><?= $row->cnf; ?></td>
                                        <td><?= $row->price; ?></td>
                                        <td><?= $row->shift_name; ?></td>
                                        <td><?= $row->type; ?></td>
                                        <td>
                                            <a href="<?= base_url('rate_chart/edit/' . $row->id) ?>" class="btn btn-primary btn-sm mr-3 mb-1">Edit<a>
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