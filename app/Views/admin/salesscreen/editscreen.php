<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 ">
                <?php if (session()->has('success')) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo session('success'); ?>
                    </div>
                <?php } ?>
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/screen/view") ?>">Back</a>
                </div>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Sale Update</h3>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" id="user_input" class="form-control" placeholder="User Code / User Mobile">
                            <button id="searchButton" onclick="getResult()">Search</button>
                        </div>

                        <div class="card-body" id="add_butn">
                            <button type="button" id="customer_button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Customer</button>

                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form autocomplete="off" id="form1" action="<?= base_url('/screen/addcustomer') ?>" method="POST">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="">Customer Name*:</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter Customer Name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Customer Email:</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Enter Customer Email">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Customer Contact No*:</label>
                                                    <input type="number" name="contact" class="form-control" placeholder="Enter Customer Contact No." required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Customer Address*:</label>
                                                    <textarea name="address" id="" cols="20" rows="5" class="form-control" placeholder="Enter Customer Address" required></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Password*:</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required>

                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <!-- <div class="card-footer text-center mb-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div> -->
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form autocomplete="off" action="<?= base_url('/screen/update/' . $result->id) ?>" method="POST">
                            <div class="card-body row">
                                <input type="hidden" name="id" value="<?= $result->user_id ?>" class="form-control" id="id" readonly>

                                <div class="form-group col-xl-3 col-12">
                                    <label for="">Customer Name*:</label>
                                    <input type="text" name="f_name" class="form-control" id="name" value="<?= $result->user_name ?>" readonly>
                                </div>
                                <div class="form-group col-xl-3 col-12">
                                    <label for="">Mobile Number*:</label>
                                    <input type="text" value="<?= $result->user_mobile ?>" name="f_number" class="form-control" id="contact" readonly>
                                </div>

                                <div class="form-group col-xl-3 col-12">
                                    <label for="">Date*:</label>
                                    <input type="date" name="date" value="<?= $result->date; ?>" class="form-control">
                                    <div class="text-danger"><?php echo $session->getFlashdata('date_error'); ?></div>
                                </div>

                                <div class="form-group col-xl-3 col-12">
                                    <label>Shift*:</label>
                                    <select class="form-control select2" style="width: 100%;" name="shift">
                                        <option selected="selected" value="">Select Shift</option>
                                        <?php foreach ($data as $shift) { ?>
                                            <option value="<?= $shift->id ?>" <?= ($result->shift_id == $shift->id) ? 'selected' : ''; ?>><?= $shift->shift_name ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="text-danger"><?php echo $session->getFlashdata('shift_error'); ?></div>
                                </div>

                                <div class="form-group col-xl-3 col-12">
                                    <label>Sale Type*:</label>
                                    <select class="form-control select2" style="width: 100%;" name="sale_type" id="sale_type" onchange="getField()">
                                        <option selected="selected" value="">Select Sale Type</option>
                                        <option value="milk" <?php if ($result->sale_type == 'milk') echo 'selected'; ?>>Milk</option>
                                        <option value="product" <?php if ($result->sale_type == 'product') echo 'selected'; ?>>Product</option>
                                    </select>
                                    <div class="text-danger"><?php echo $session->getFlashdata('sale_error'); ?></div>
                                </div>


                                <div id="milk_sale" class="col-xal-12 col-12 row">
                                    <?php foreach ($items as $item) { ?>
                                        <div class="form-group col-xl-3 col-12">
                                            <label>Milk Type*:</label>
                                            <select class="form-control" style="width: 100%;" name="milk_type" id="milk_type" onchange="getPrice()">
                                                <option selected="selected" value="">Select type</option>
                                                <option value="Cow" <?php if ($item->milk_type == 'Cow') echo 'selected'; ?>>Cow</option>
                                                <option value="Buffalo" <?php if ($item->milk_type == 'Buffalo') echo 'selected'; ?>>Buffalo</option>
                                                <option value="Both" <?php if ($item->milk_type == 'Both') echo 'selected'; ?>>Both</option>
                                            </select>
                                            <div class="text-danger"><?php echo $session->getFlashdata('milk_error'); ?></div>
                                        </div>

                                        <div class="form-group col-xl-3 col-12">
                                            <label for="">Milk Quantity*:</label>
                                            <input type="text" name="milk_quantity" id="quantity" class="form-control" value="<?php if ($result->sale_type == 'milk') {
                                                                                                                                    echo $item->quantity;
                                                                                                                                } ?>" placeholder="Enter Quantity" onkeyup="getPrice()">
                                            <div class="text-danger"><?php echo $session->getFlashdata('milk_quantity_error'); ?></div>
                                        </div>

                                        <div class="form-group col-xl-3 col-12">
                                            <label for="">Per Liter Price*:</label>
                                            <input type="number" name="price_per_liter" value="<?php if ($result->sale_type == 'milk') {
                                                                                                    echo $item->per_price;
                                                                                                } ?>" id="per_liter_price" class="form-control" readonly>
                                        </div>

                                        <div class="form-group col-xl-3 col-12">
                                            <label for="">Price*:</label>
                                            <input type="number" id="price" name="milk_price" value="<?php if ($result->sale_type == 'milk') {
                                                                                                            echo $item->price;
                                                                                                        } ?>" class="form-control" readonly>
                                        </div>
                                    <?php } ?>

                                    <div class="form-group col-6"></div>

                                    <div class="form-group col-xl-3 col-12">
                                        <label for="">Discount:</label>
                                        <input type="text" id="discount" name="milk_discount" class="form-control" onkeyup="getPrice()" placeholder="Enter Discount Amount" value="<?php if ($result->sale_type == 'milk') {
                                                                                                                                                                                        echo $result->discount;
                                                                                                                                                                                    } ?>" readonly>
                                    </div>

                                    <div class="form-group col-xl-3 col-12">
                                        <label for="">Total Amount*:</label>
                                        <input type="number" id="total_amount" name="milk_total_amount" class="form-control" value="<?php if ($result->sale_type == 'milk') {
                                                                                                                                        echo $result->total_amount;
                                                                                                                                    } ?>" readonly>
                                    </div>

                                    <div class="form-group col-6"></div>

                                    <div class="form-group col-xl-3 col-12">
                                        <label for="">Paid Amount*:</label>
                                        <input type="text" id="paid_amount" name="milk_paid_amount" class="form-control" placeholder="Enter amount" value="<?php if ($result->sale_type == 'milk') {
                                                                                                                                                                echo $result->paid_amount;
                                                                                                                                                            } ?>" onkeyup="getPrice()" readonly>
                                    </div>

                                    <div class="form-group col-xl-3 col-12">
                                        <label for="">Due Amount:</label>
                                        <input type="number" id="due_amount" name="milk_due_amount" class="form-control" value="<?php if ($result->sale_type == 'milk') {
                                                                                                                                    echo $result->due_amount;
                                                                                                                                } ?>" readonly>
                                    </div>
                                </div>

                                <div id="product_sale" class="col-xl-12 col-12 row">
                                    <div class="product1 col-xl-11 col-12">
                                        <div class="row">
                                            <div class="form-group col-xl-3 col-12">
                                                <label>Product Type*:</label>
                                            </div>

                                            <div class="form-group col-xl-3 col-12">
                                                <label for="">Product Quantity*:</label>
                                            </div>

                                            <div class="form-group col-xl-3 col-12">
                                                <label for="">Per Product Price*:</label>
                                            </div>

                                            <div class="form-group col-xl-2 col-12" width=100%>
                                                <label for="">Price*:</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="product col-xl-11 col-12" id="product-form">
                                        <?php foreach ($items as $item) { ?>

                                            <div class="form-block row" id="form-container">
                                                <div class="form-group col-xl-3 col-12">
                                                    <select class="form-control product_type " style="width: 100%;" name="product_type[]">
                                                        <option selected="selected" value="">Select Product</option>
                                                        <?php foreach ($types as $type) { ?>
                                                            <option value="<?= $type->id ?>" <?= ($type->id == $item->product_type) ? 'selected' : ''; ?>><?= $type->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="text-danger"><?php echo $session->getFlashdata('product_error'); ?></div>
                                                </div>

                                                <div class="form-group col-xl-3 col-12">
                                                    <input type="text" name="quantity[]" class="form-control product_quantity" placeholder="Enter Quantity" value="<?php if ($result->sale_type == 'product') {
                                                                                                                                                                        echo $item->quantity;
                                                                                                                                                                    } ?>">
                                                    <div class="text-danger"><?php echo $session->getFlashdata('quantity_error'); ?></div>
                                                </div>

                                                <div class="form-group col-xl-3 col-12">
                                                    <input type="number" name="single_price[]" class="form-control per_price" value="<?php if ($result->sale_type == 'product') {
                                                                                                                                            echo $item->per_price;
                                                                                                                                        } ?>" readonly>
                                                </div>

                                                <div class="form-group col-xl-2 col-12" width=100%>
                                                    <input type="number" name="price[]" class="form-control price" value="<?php if ($result->sale_type == 'product') {
                                                                                                                                echo $item->price;
                                                                                                                            } ?>" readonly>
                                                </div>

                                                <div class="col-xl-1 col-12">
                                                    <button class="btn btn-danger  ml-3 btn-sm remove">Remove</button>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>

                                    <div class="col-xl-1 col-12">
                                        <button class="btn btn-primary ml-3 btn-sm add">Add</button>
                                    </div>
                                    <div class="form-group col-8"></div>

                                    <div class="form-group col-xl-3 col-12">
                                        <label for="">Sub Total:</label>
                                        <input type="text" id="sub_total" name="sub_total" class="form-control" value="<?php if ($result->sale_type == 'product') {
                                                                                                                            echo $result->subtotal;
                                                                                                                        } ?>" readonly>
                                    </div>

                                    <div class="form-group col-5"></div>

                                    <div class="form-group col-xl-3 col-12">
                                        <label for="">Discount:</label>
                                        <input type="text" id="product_discount" name="discount" class="form-control" placeholder="Enter Discount Amount" value="<?php if ($result->sale_type == 'product') {
                                                                                                                                                                        echo $result->discount;
                                                                                                                                                                    } ?>" readonly>
                                    </div>

                                    <div class="form-group col-xl-3 col-12">
                                        <label for="">Total Amount*:</label>
                                        <input type="number" id="product_total_amount" name="total_amount" class="form-control" value="<?php if ($result->sale_type == 'product') {
                                                                                                                                            echo $result->total_amount;
                                                                                                                                        } ?>" readonly>
                                    </div>

                                    <div class="form-group col-5"></div>

                                    <div class="form-group col-xl-3 col-12">
                                        <label for="">Paid Amount*:</label>
                                        <input type="number" id="product_paid_amount" name="paid_amount" class="form-control" placeholder="Enter amount" value="<?php if ($result->sale_type == 'product') {
                                                                                                                                                                    echo $result->paid_amount;
                                                                                                                                                                } ?>" readonly>
                                    </div>

                                    <div class="form-group col-xl-3 col-12">
                                        <label for="">Due Amount:</label>
                                        <input type="number" id="product_due_amount" name="due_amount" class="form-control" value="<?php if ($result->sale_type == 'product') {
                                                                                                                                        echo $result->due_amount;
                                                                                                                                    } ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center mb-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>


<?php echo view("admin/layout/footer.php"); ?>
<?php echo view("admin/layout/script.php"); ?>

<script>
    $(".remove:first").hide();
    $(document).ready(function() {
        function removeFormBlock() {
            $(this).closest(".form-block").remove();
            calculateTotalAmount();
        }
        $(".add").click(function(event) {
            event.preventDefault();

            var clonedForm = $(".form-block:first").clone();
            clonedForm.find('input').val('');
            clonedForm.find('select').val('');
            clonedForm.appendTo(".product");

            clonedForm.find(".remove").show();
            clonedForm.find(".remove").click(removeFormBlock);
        });
        $(".product").on("click", ".remove", removeFormBlock);

        $("#product-form").on("change", ".product_type", function() {
            var productType = $(this).val();
            var quantity = $(this).closest(".form-block").find(".product_quantity").val();
            
            //alert(discount);
            var row = $(this).closest(".form-block");

            if (quantity == '') {
                quantity = 0;
            }

            $.ajax({
                url: "<?= base_url('/screen/getperproductprice') ?>",
                method: "POST",
                data: {
                    product_type: productType,
                    quantity: quantity,
                },
                dataType: "json",
                success: function(data) {
                    row.find(".per_price").val(data.price);
                    row.find(".price").val(data.totalPrice);
                    
                    calculateTotalAmount();
                }
            });  

        });

        $("#product-form").on("keyup", ".product_quantity", function() {
            var quantity = $(this).val();
            //alert(quantity);
            var perProductPrice = $(this).closest(".form-block").find(".per_price").val();
            //alert(perProductPrice);
            var row = $(this).closest(".form-block");

            $.ajax({
                url: "<?= base_url('/screen/getproductprice') ?>",
                method: "POST",
                data: {
                    quantity: quantity,
                    per_product_price: perProductPrice
                },
                dataType: "json",
                success: function(data) {
                    row.find(".price").val(data.totalPrice);
                    calculateTotalAmount();
                }
            });
            var product_total_amount = document.getElementById("product_total_amount").value;

            var product_paid_amount = document.getElementById("product_paid_amount").value;
            //alert(product_paid_amount);
            if (product_paid_amount === '') {
                product_paid_amount = 0;
            }
            var totalDue = product_total_amount - product_paid_amount;
            $("#product_due_amount").val(totalDue);

            var discount = document.getElementById("product_discount").value;
            var sub_total = document.getElementById("sub_total").value;

            if (discount === '') {
                discount = 0;
            }
            var totalAmount = sub_total - discount;

            $("#product_total_amount").val(totalAmount);
        });

        function calculateTotalAmount() {
            var totalAmount = 0;
            var product_paid_amount = document.getElementById("product_paid_amount").value;
            var discount = document.getElementById("product_discount").value;
            $(".price").each(function() {
                var price = parseFloat($(this).val()) || 0;
                totalAmount += price;
            });
            $("#sub_total").val(totalAmount);
            totalAmt = totalAmount - discount;
            $("#product_total_amount").val(totalAmt);
            var totalDue = totalAmount - product_paid_amount;
            $("#product_due_amount").val(totalDue);
        }

        // $("#product_sale").on("keyup", "#product_discount", function() {
        //     var discount = document.getElementById("product_discount").value;
        //     var sub_total = document.getElementById("sub_total").value;

        //     if (discount === '') {
        //         discount = 0;
        //     }
        //     var totalAmount = sub_total - discount;

        //     $("#product_total_amount").val(totalAmount);
        //     // $("#product_due_amount").val(totalAmount);

        // });

        $("#product_sale").on("keyup", "#product_paid_amount", function() {
            var product_total_amount = document.getElementById("product_total_amount").value;

            var product_paid_amount = document.getElementById("product_paid_amount").value;
            //alert(product_paid_amount);
            if (product_paid_amount === '') {
                product_paid_amount = 0;
            }
            var totalDue = product_total_amount - product_paid_amount;
            $("#product_due_amount").val(totalDue);
        });

    });

    window.onload = function() {

        document.getElementById("milk_sale").style.display = "none";
        document.getElementById("product_sale").style.display = "none";
        document.getElementById("add_butn").style.display = "none";

        var sale_type = document.getElementById("sale_type").value;
        if (sale_type == 'milk') {
            document.getElementById("milk_sale").style.display = "";
            document.getElementById("product_sale").style.display = "none";
        }
        if (sale_type == 'product') {
            document.getElementById("milk_sale").style.display = "none";
            document.getElementById("product_sale").style.display = "";
        }
        document.getElementById("add_butn").style.display = "none";
    }

    function getResult() {

        var user_input = document.getElementById("user_input").value;
        //alert(user_input);
        if (user_input) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('/search/customer') ?>',
                data: {
                    user_input: user_input
                },
                dataType: "json",
                success: function(data) {
                    if (data.error) {
                        //alert(data.error); 
                        document.getElementById("add_butn").style.display = "block";
                        document.getElementById("id").value = "";
                        document.getElementById("user_role").value = "";
                        document.getElementById("name").value = "";
                    } else {
                        $('#id').val(data.id);
                        $('#contact').val(data.user_mobile)
                        $('#name').val(data.name);
                        document.getElementById("add_butn").style.display = "none";
                    }
                }
            });
        }
    }

    function getPrice() {
        var milk_type = document.getElementById("milk_type").value;
        var quantity = document.getElementById("quantity").value;
        var discount = document.getElementById("discount").value;
        var paid_amount = document.getElementById("paid_amount").value;
        if (quantity == '') {
            quantity = 0;
        }
        if (paid_amount == '') {
            paid_amount = 0;
        }
        $.ajax({
            type: 'POST',
            url: '<?= base_url('/screen/getprice') ?>',
            data: {
                quantity: quantity,
                discount: discount,
                milk_type: milk_type,
                paid_amount: paid_amount,
            },
            dataType: "json",
            success: function(data) {
                document.getElementById("price").value = data.totalPrice;
                document.getElementById("per_liter_price").value = data.price;
                document.getElementById("total_amount").value = data.total_amount;
                document.getElementById("due_amount").value = data.totaldue;
            }
        });
    }

    function getField() {
        var sale_type = document.getElementById("sale_type").value;
        if (sale_type == 'milk') {
            document.getElementById("milk_sale").style.display = "";
            document.getElementById("product_sale").style.display = "none";
        }
        if (sale_type == 'product') {
            document.getElementById("milk_sale").style.display = "none";
            document.getElementById("product_sale").style.display = "";
        }
    }
</script>