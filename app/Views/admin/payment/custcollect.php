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
                    <a class="btn btn-danger btn-sm" href="<?= base_url("/payment/customer/view") ?>">Back</a>
                </div>
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Customer Due Collect </h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form autocomplete="off" action="<?= base_url('/payment/customer/addcustpay/') ?>" method="POST">
                        <div class="card-body row">

                            <input type="hidden" name="cust_id" class="form-control" id="id" value="<?= $cust_id ?>" readonly>

                            <div class="form-group col-xl-6 col-12">
                                <label for="">Customer Code*:</label>
                                <input type="text" name="code" class="form-control" id="code" value="<?= $data->user_code ?>" readonly>
                            </div>

                            <div class="form-group col-xl-6 col-12">
                                <label for="">Customer Name*:</label>
                                <input type="text" name="c_name" value="<?= $data->user_name ?>" class="form-control" id="name" readonly>
                            </div>
                            <div class="form-group col-xl-6 col-12">
                                <label for="">Mobile Number*:</label>
                                <input type="text" name="c_number" value="<?= $data->user_mobile ?>" class="form-control" id="contact" readonly>
                            </div>

                            <div class="form-group col-xl-6 col-12">
                                <label>Invoice*:</label>
                                <select class="select2" name="invoice[]" multiple="multiple" data-placeholder="Select Invoice" style="width: 100%;">
                                    <?php foreach ($invoice as $due) { ?>
                                        <option value="<?= $due->id ?>"><?php echo "INV0" . $due->id . ' => ' . $due->due_amount  ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-xl-6 col-12">
                                <label for="">Date*:</label>
                                <input type="date" name="date" value="<?= date('Y-m-d')?>" class="form-control">
                            </div>

                            <div class="form-group col-xl-6 col-12">
                                <label for="">Total Amount to Collect*:</label>
                                <input type="number" id="total_amount" name="total_amount" value="<?= $data->t_amount?>" class="form-control" readonly>
                            </div>
                            
                            <div class=" col-6"></div>

                            <div class="form-group col-xl-6 col-12">
                                <label for="">Paid Amount*:</label>
                                <input type="text" id="paid_amount" name="paid_amount" class="form-control" placeholder="Enter amount">
                                <div class="text-danger"><?php echo $session->getFlashdata('amount_error'); ?></div>
                            </div>
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
<!-- Select2 -->
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

    $(document).ready(function() {
        $('.select2').on('change', function() {
            calculateSum();
        });
        // $('#paid_amount').on('keyup', function(){
        //     calculateSum();
        // });
    });

    function calculateSum() {
        var selectedValues = $('.select2').val();
        var cust_id = document.getElementById('id').value;
       // if (selectedValues) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('/payment/customer/calculateSum') ?>',
                data: {
                    selectedValues: JSON.stringify(selectedValues),
                    cust_id: cust_id
                },
                traditional: true,
                dataType: "json",
                success: function(data) {
                    document.getElementById("total_amount").value = data.totalDue;
                }
            });
        // } else {

        //     document.getElementById("total_amount").value = '';
        // }

    }
</script>