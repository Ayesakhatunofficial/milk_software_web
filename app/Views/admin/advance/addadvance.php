<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 ">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Advance</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" id="user_code" class="form-control" placeholder="Farmer Code">
                            <button id="searchButton" onclick="getResult()">Search</button>
                        </div>
                    </div>
                    <form autocomplete="off" action="<?= base_url('/advance/add') ?>" method="POST">
                        <div class="card-body">
                            <input type="hidden" name="id" class="form-control" id="id" readonly>

                            <div class="form-group">
                                <label for="">Farmer Name*:</label>
                                <input type="text" name="f_name" class="form-control" id="name" readonly>
                            </div>

                            <div class="form-group">
                                <label for="">Farmer Contact No*:</label>
                                <input type="number" name="contact" class="form-control" id="contact" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Date*:</label>
                                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                <div class="text-danger"><?php echo $session->getFlashdata('date_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Amount*:</label>
                                <input type="number" name="amount" class="form-control" placeholder="Enter Amount">
                                <div class="text-danger"><?php echo $session->getFlashdata('amount_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Interest Rate:</label>
                                <input type="number" name="interest_rate" class="form-control" placeholder="Enter Interest Rate">
                            </div>

                            <div class="form-group">
                                <label for="">Comment:</label>
                                <textarea name="comment" id="" cols="20" rows="5" class="form-control" placeholder="Enter Your Comment"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-center mb-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
</section>

<?php echo view("admin/layout/footer.php"); ?>
<?php echo view("admin/layout/script.php"); ?>

<script>
    function getResult() {

        var user_code = document.getElementById("user_code").value;
        //alert(user_code);
        if (user_code) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('advance/search/farmer') ?>',
                data: {
                    user_code: user_code
                },
                dataType: "json",
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $('#contact').val(data.mobile);
                        console.log(data);
                        
                    }
                }
            });
        }
    }
</script>