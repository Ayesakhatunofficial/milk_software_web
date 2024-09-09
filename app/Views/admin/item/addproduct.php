<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/product/add') ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Item*:</label>
                                <select class="form-control select2" style="width: 100%;" name="item">
                                    <option selected="selected" value="">Select Item</option>
                                    <?php foreach ($items as $item) { ?>
                                        <option value="<?= $item->id ?>"><?= $item->name?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger"><?php echo $session->getFlashdata('item_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Date*:</label>
                                <input type="date" name="date" id="date" class="form-control" value="<?=date('Y-m-d')?>">
                                <div class="text-danger"><?php echo $session->getFlashdata('date_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Milk Quantity*:</label>
                                <input type="text" name="milk_quantity" class="form-control" placeholder="Enter MIlk Quantity">
                                <p>Available Milk Quantity <span id="milk"></span>  Liter</p>
                                <input type="hidden" id='hidden' name='milk'>
                                <div class="text-danger"><?php echo $session->getFlashdata('milk_error'); ?></div>
                            </div>

                            <div class="form-group">
                                <label for="">Product Quantity*:</label>
                                <input type="text" name="product_quantity" class="form-control" placeholder="Enter Product Quantity">
                                <div class="text-danger"><?php echo $session->getFlashdata('product_error'); ?></div>
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
    window.onload = function() {
        getMilk(); 
    };

    function getMilk(){
        var date = document.getElementById('date').value;
        //alert(date);
        $.ajax({
            type: 'POST',
            url: '<?= base_url('/product/getMilk') ?>',
            data: {
                date: date,
            },
            dataType: "json",
            success: function(data) {
                if(data.milkDue == 0){
                    document.getElementById("milk").innerText = "0";
                    document.getElementById("hidden").value = "0";
                }
                document.getElementById("milk").innerText = data.milkDue;
                document.getElementById("hidden").value = data.milkDue;
            },
        });
    }
</script>