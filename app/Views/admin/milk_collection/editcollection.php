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
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/milk/view") ?>">Back</a>
                </div>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Milk Collection</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" id="user_code" class="form-control" placeholder="user code">
                            <button id="searchButton" onclick="getResult()">Search</button>
                        </div>
                    </div>
                    <form autocomplete="off" action="<?= base_url('/milk/update/' . $result->id) ?>" method="POST">
                        <div class="card-body row">
                            <input type="hidden" name="id" class="form-control" id="id" value="<?= $result->user_id ?>" readonly>

                            <div class="form-group col-xl-4 col-12">
                                <label for="">Farmer Name*:</label>
                                <input type="text" name="f_name" class="form-control" id="name" value="<?= $result->user_name ?>" readonly>
                            </div>

                            <div class="form-group col-xl-4 col-12">
                                <label for="">Farmer Contact No*:</label>
                                <input type="number" name="contact" class="form-control" id="contact" value="<?= $result->farmer_mobile ?>" readonly>
                            </div>
                            <div class="form-group col-xl-4 col-12">
                                <label for="">Date*:</label>
                                <input type="date" name="date" value="<?= $result->date ?>" class="form-control">
                                <div class="text-danger"><?php echo $session->getFlashdata('date_error'); ?></div>
                            </div>

                            <div class="form-group col-xl-4 col-12">
                                <label>Shift*:</label>
                                <select class="form-control select2" style="width: 100%;" name="shift" id="shift" onchange="getPrice()">
                                    <option selected="selected">Select Shift</option>
                                    <?php foreach ($data as $shift) { ?>
                                        <option value="<?= $shift->id ?>" <?= ($shift->id == $result->shift_id) ? 'selected' : ''; ?>><?= $shift->shift_name ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('shift_error'); ?></div>
                            </div>

                            <div class="form-group col-xl-4 col-12">
                                <label>Type*:</label>
                                <select class="form-control" style="width: 100%;" name="milk_type" id="milk_type" onchange="getPrice()">
                                    <option selected="selected">Select type</option>
                                    <?php foreach ($milk_type as $type) { ?>
                                        <option value="<?= $type->id ?>" <?= ($type->id == $result->milk_type) ? 'selected' : ''; ?>><?= $type->type ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('milk_error'); ?></div>
                            </div>

                            <div class="form-group col-xl-4 col-12">
                                <label for="">Quantity*:</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" value="<?= $result->milk_quantity ?>" onkeyup="getPrice()">
                                <div class="text-danger"><?php echo $session->getFlashdata('quantity_error'); ?></div>
                            </div>

                            <div class="form-group col-xl-4 col-12">
                                <label>Fat*:</label>
                                <select class="form-control select2" style="width: 100%;" name="fat" id="fat" onchange="getPrice()">
                                    <option selected="selected">Select Fat</option>
                                    <?php foreach ($fat as $fat_1) { ?>
                                        <option value="<?= $fat_1->id ?>" <?= ($fat_1->id == $result->fat_id) ? 'selected' : ''; ?>><?= $fat_1->fat ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('fat_error'); ?></div>
                            </div>

                            <div class="form-group col-xl-4 col-12">
                                <label>CNF*:</label>
                                <select class="form-control select2" style="width: 100%;" name="cnf" id="cnf" onchange="getPrice()">
                                    <option selected="selected">Select CNF</option>
                                    <?php foreach ($cnf as $cnf_1) { ?>
                                        <option value="<?= $cnf_1->id ?>" <?= ($cnf_1->id == $result->cnf_id) ? 'selected' : ''; ?>><?= $cnf_1->cnf ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('cnf_error'); ?></div>
                            </div>

                            <div class="form-group col-xl-4 col-12">
                                <label for="">Per Liter Price*:</label>
                                <input type="number" id="per_liter_price" name="per_liter_price" value="<?=$result->per_liter_price?>" class="form-control" readonly>
                            </div>

                            <div class="form-group col-8"></div>

                            <div class="form-group col-xl-4 col-12">
                                <label for="">Price*:</label>
                                <input type="number" id="price" name="price" value="<?= $result->price ?>" class="form-control" readonly>
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
    window.onload = function() {
        getResult();
    }

    function getResult() {

        var user_code = document.getElementById("user_code").value;
        //alert(user_code);
        if (user_code) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('/search/farmer') ?>',
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
                    }
                }
            });
        }
    }

    function getPrice() {
        var milk_type = document.getElementById("milk_type").value;
        var quantity = document.getElementById("quantity").value;
        var fat = document.getElementById("fat").value;
        var cnf = document.getElementById("cnf").value;
        var shift = document.getElementById("shift").value;
        $.ajax({
            type: 'POST',
            url: '<?= base_url('/milk/getprice') ?>',
            data: {
                quantity: quantity,
                milk_type: milk_type,
                fat: fat,
                cnf: cnf,
                shift: shift
            },
            dataType: "json",
            success: function(data) {

                if(data.pricePerLiter == '0'){
                    alert('data not found');
                }
                
                document.getElementById("per_liter_price").value = data.pricePerLiter;
                document.getElementById("price").value = data.totalPrice;
            },
            // error: function(error) {
                
            // }
        });
    }
</script>