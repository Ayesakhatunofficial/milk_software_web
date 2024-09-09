<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 ">
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/advance/view") ?>">Back</a>
                </div>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Advance</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" id="user_code" class="form-control" placeholder="Farmer Code">
                            <button id="searchButton" onclick="getResult()">Search</button>
                        </div>
                    </div>
                    <form autocomplete="off" action="<?= base_url('/advance/update/'.$data->id) ?>" method="POST">
                        <div class="card-body">
                            <input type="hidden" name="id" class="form-control" id="id"
                            value="<?=$data->user_id?>" readonly>

                            <div class="form-group">
                                <label for="">Farmer Name*:</label>
                                <input type="text" name="f_name" class="form-control" id="name" value="<?=$data->user_name?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="">Farmer Contact No*:</label>
                                <input type="number" name="contact" class="form-control" id="contact" value="<?=$data->farmer_mobile?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Date*:</label>
                                <input type="date" name="date" value="<?=$data->date?>" class="form-control">
                                <div class="text-danger"><?php echo $session->getFlashdata('date_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Amount*:</label>
                                <input type="number" name="amount" value="<?=$data->amount?>" class="form-control">
                                <div class="text-danger"><?php echo $session->getFlashdata('amount_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Interest Rate:</label>
                                <input type="number" name="interest_rate" value="<?=$data->interest_rate?>" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Comment:</label>
                                <textarea name="comment" id="" cols="20" rows="5" class="form-control"><?=$data->comment?></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-center mb-2">
                            <button type="submit" class="btn btn-primary">Update</button>
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