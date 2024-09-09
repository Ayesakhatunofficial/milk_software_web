<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php");
$session = session(); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Milk Sale Report</h3>
                    </div>
                    <div class="mt-3 ml-2">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- <label>From Date:</label> -->
                                        <input type="date" class=form-control id="from_date">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- <label>To Date:</label> -->
                                        <input type="date" class=form-control id="to_date" value="<?=date('Y-m-d')?>">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- <label>Farmer Code:</label> -->
                                        <input type="text" placeholder="customer code" class="form-control" id="user_code">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- <label>Shift:</label> -->
                                        <select class="select2 form-control" style="width: 100%;" id="shift" onchange="getResult()">
                                            <option value="" selected>select shift</option>
                                            <?php foreach ($shift as $data) { ?>
                                                <option value="<?= $data->id ?>"><?= $data->shift_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <!-- <label>Milk Type:</label> -->
                                        <select class="select2 form-control" style="width: 100%;" id="milk_type" onchange="getResult()">
                                            <option value="" selected>Select Type</option>
                                            <option value="Cow">Cow</option>
                                            <option value="Buffalo">Buffalo</option>
                                            <option value="Both">Both</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2" >
                                    <button class="btn btn-success btn-sm " onclick="getResult()" style = "width: 90%;">
                                        Search
                                    </button>
                                </div>

                                <div class="col-md-3">
                                    Total Sale Quantity:
                                    <input type="text" value="" id="total_quantity" readonly /><b> L</b>
                                </div>

                                <div class="col-md-3">
                                    Total Sale Amount:
                                    <input type="text" value="" id="total_amount" readonly />
                                </div>
                                

                                <div class="col-md-3">
                                    Total Paid Amount:
                                    <input type="text" value="" id="total_paid" readonly />
                                </div>
                                <div class="col-md-3">
                                    Total Due Quantity:
                                    <input type="text" value="" id="total_due" readonly />
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
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
    function getResult() {
        var from_date = document.getElementById('from_date').value;
        var to_date = document.getElementById('to_date').value;
        var user_code = document.getElementById('user_code').value;
        var shift = document.getElementById('shift').value;
        var milk_type = document.getElementById('milk_type').value;

        $.ajax({
            type: 'POST',
            url: '<?= base_url('/search/salereport') ?>',
            data: {
                from_date: from_date,
                to_date: to_date,
                user_code: user_code,
                milk_type: milk_type,
                shift: shift,
            },
            dataType: "json",
            success: function(data) {
                var table = $("#example2");
                var totalAmount = 0;
                var totalQuantity = 0;
                var totalPaid = 0;
                var totalDue = 0;
                table.empty();
                if (data.length > 0) {
                    var headerRow = "<tr><th>User Code</th><th>Customer</th><th>Date</th><th>Shift</th><th>Milk Type</th><th>Qty.</th><th>Per Price</th><th>Amount</th><th>Discount</th><th>Total</th><th>Paid Amount</th><th>Due Amount</th></tr>";
                    table.append(headerRow);

                    data.forEach(function(item) {
                        var row = "<tr><td>" + item.user_code + "</td><td>" + item.user_name + "</td><td>" + item.date + "</td><td>" + item.shift_name + "</td><td>" + item.milk_type + "</td><td>" + item.quantity + "</td><td>" +item.per_price + "</td><td>" + item.price + "</td><td>" + item.discount + "</td><td>" + item.total_amount + "</td><td>" + item.paid_amount + "</td><td>" + item.due_amount + "</td></tr>";
                        table.append(row);

                        totalAmount += parseFloat(item.total_amount);
                        totalQuantity += parseFloat(item.quantity);
                        totalPaid += parseFloat(item.paid_amount);
                        totalDue += parseFloat(item.due_amount);
                    });

                    document.getElementById('total_amount').value = totalAmount;
                    document.getElementById('total_quantity').value = totalQuantity;
                    document.getElementById('total_paid').value = totalPaid;
                    document.getElementById('total_due').value = totalDue;


                } else {
                    document.getElementById('total_amount').value = '';
                    document.getElementById('total_quantity').value = '';
                    document.getElementById('total_paid').value = '';
                    document.getElementById('total_due').value = '';
                    table.append("<tr><td colspan='5'>No results found</td></tr>");
                }
            },
            error: function(data) {
                console.log("Error:", data);
            }
        });

    }
</script>