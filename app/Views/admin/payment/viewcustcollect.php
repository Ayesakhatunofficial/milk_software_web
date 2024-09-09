<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/payment/customer/view") ?>">Back</a>
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
                    <div class="card-header ">
                        <h3 class="card-title">View Customer Due Collect</h3>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S. No</th>
                                    <th>Cust. Code</th>
                                    <th>Cust. Name</th>
                                    <th>Cust. Mobile</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Collect Amount</th>
                                    <th>Due</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row->user_code; ?></td>
                                        <td><?= $row->user_name; ?></td>
                                        <td><?= $row->user_mobile; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row->date)); ?></td>
                                        <td><?= $row->total_amount; ?></td>
                                        <td><?= $row->collect_amount; ?></td>
                                        <td><?= $row->due; ?></td>
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