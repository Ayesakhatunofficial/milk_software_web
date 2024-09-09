<?php echo view("admin/layout/head.php"); ?>

<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-12">
      <h2 class="page-header">
        <small class="float-right">Date: <?= date('d-m-Y'); ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      From
      <address>
        <strong><?= $setting->name; ?></strong><br>
        Address: <?= $setting->address; ?><br>
        Phone: <?= $setting->mobile_no; ?><br>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      To
      <address>
        <strong><?= $result->user_name; ?></strong><br>
        Address: <?= $result->user_address; ?><br>
        Phone: <?= $result->user_mobile ?><br>
        Email: <?= $result->user_email ?><br>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <b>Invoice <?php echo '#INV0' . $result->id; ?></b><br>
      <b>Invoice Date:</b> <?= date('d-m-Y', strtotime($result->date)); ?><br>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Sl. No.</th>
            <th>Item Type</th>
            <th>Item</th>
            <th>Qty</th>
            <th>Amount</th>
            <th style="text-align: right;">Linetotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($datas as $data) { ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $result->sale_type; ?></td>
              <td><?php
                  if ($result->sale_type == 'milk') {
                    echo $data->milk_type;
                  }
                  if ($result->sale_type == 'product') {
                    foreach ($types as $type) {
                      if ($data->product_type == $type->id) {
                        echo $type->name;
                      }
                    }
                  }
                  ?></td>
              <td><?= $data->quantity; ?></td>
              <td><?= $data->price; ?></td>
              <td style="text-align: right;"><?= $data->price; ?></td>
            </tr>
          <?php $i++;
          }
          ?>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- /.col -->
    <div class="col-7"></div>
    <div class="col-5">

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td style="text-align: right;font-weight: bold;"><?= $result->subtotal; ?></td>
          </tr>
          <tr>
            <th>Discount:</th>
            <td style="text-align: right;"><?= $result->discount; ?></td>
          </tr>

          <tr>
            <th>Total:</th>
            <td style="text-align: right;font-weight: bold;"><?= $result->total_amount; ?></td>
          </tr>
          <tr>
            <th>Paid Amount:</th>
            <td style="text-align: right;"><?= $result->paid_amount; ?></td>
          </tr>
          <tr>
            <th>Due Amount:</th>
            <td style="text-align: right;"><?= $result->due_amount; ?></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

<script>
  window.addEventListener("load", window.print());
</script>