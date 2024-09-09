<?php echo view("admin/layout/head.php");
//print_r($result);

//echo $result[0]->ref_id;

//die;
?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/advance/view") ?>">Back</a>
                </div>
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
                        <a class="btn btn-primary" href="<?= base_url('/advance/collect/' . $ref_id) ?>">
                            <i class="fas fa-plus"></i> Add Payment
                        </a>
                    </div>


                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Reference ID</th>
                                    <th>Amount</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($result as $row) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row->ref_id; ?></td>
                                        <td><?= $row->amount; ?></td>
                                        <td><?= $row->comment; ?></td>

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