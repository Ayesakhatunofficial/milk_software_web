<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
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
                        <h3 class="card-title">View Farmer Payment</h3>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S. No</th>
                                    <th>Farmer Code</th>
                                    <th>Farmer Name</th>
                                    <th>Farmer Mobile</th>
                                    <th>Total Qty.</th>
                                    <th>Total Amt.</th>
                                    <th>Total Paid</th>
                                    <th>Total Due.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($data as $row) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row->user_code; ?></td>
                                        <td><?= $row->user_name; ?></td>
                                        <td><?= $row->farmer_mobile; ?></td>
                                        <td><?= $row->total_qty; ?></td>
                                        <td><?= round($row->t_amount, 2); ?></td>
                                        <td><?php
                                        echo round($row->t_amount-$row->d_amount, 2);
                                        ?></td>
                                        <td><?= round($row->d_amount, 2); ?></td>
                                        <td>
                                            <a href="<?= base_url('payment/farmer/pay/' . $row->farmer_id) ?>" class="btn btn-success btn-sm mr-3 mb-1">Pay</a>

                                            <a href="<?= base_url('payment/farmer/viewfarmerpay/' . $row->farmer_id) ?>" class="btn btn-primary btn-sm mr-3 mb-1">View</a>
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