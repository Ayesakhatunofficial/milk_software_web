<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h3 class="card-title">View Dairy List</h3> -->
                        <div class="d-flex justify-content-between mb-3">
                            <a class="btn btn-danger btn-sm" href="<?= base_url("/fermer/view") ?>">Back</a>
                        </div>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Bank Name</th>
                                    <th>Bank IFSC Number</th>
                                    <th>Bank Account No</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <?php $i = 1;
                            foreach ($data as $row) { ?>
                                <tbody>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row->bank_name; ?></td>
                                        <td><?= $row->ifsc_code; ?></td>
                                        <td><?= $row->ac_number; ?></td>
                                        <td><button class="btn btn-success btn-sm"><?= $row->status; ?> </button></td>
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
