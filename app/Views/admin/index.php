<?php echo view("admin/layout/head.php"); ?>
<?php echo view("admin/layout/header.php"); ?>
<?php echo view("admin/layout/sidebar.php"); ?>



<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $farmer[0]->total_farmer ?></h3>

            <p>Total Farmers</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $customer[0]->total_customer ?></h3>

            <p>Total Customer</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $col_boy[0]->total_col_boy ?></h3>

            <p>Total Collection Boy</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <h3>Today</h3>
    <!-- Small boxes (Stat box) -->
    <div class="row">

      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>₹<?php
                  //print_r($sales);die;
                  if ($sales[0]->total_price) {
                    echo $sales[0]->total_price;
                  } else {
                    echo '0';
                  } ?></h3>

            <p>Total Sale Amount</p>
          </div>
          <div class="icon">
            <i class="ion ion-cash"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>₹<?php if (!$sales[0]->total_paid_amount) {
                    echo '0';
                  } else {
                    echo $sales[0]->total_paid_amount;
                  } ?></h3>

            <p>Total Paid Amount</p>
          </div>
          <div class="icon">
            <i class="ion ion-cash"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>₹<?php if (!$sales[0]->total_due_amount) {
                    echo '0';
                  } else {
                    echo $sales[0]->total_due_amount;
                  } ?></h3>

            <p>Total Due Amount</p>
          </div>
          <div class="icon">
            <i class="ion ion-cash"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>
              <?php
              //print_r($sales);die;
              if ($milk_collect[0]->total_collect_milk) {
                echo $milk_collect[0]->total_collect_milk . 'L';
              } else {
                echo '0L';
              } ?>

            </h3>

            <p>Total Milk Collected</p>
          </div>
          <div class="icon">
            <i class="ion ion-beaker"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>
              <?php
              //print_r($sales);die;
              if ($milk_sale[0]->total_sale_quantity) {
                echo $milk_sale[0]->total_sale_quantity . 'L';
              } else {
                echo '0L';
              } ?>
            </h3>

            <p>Total Milk Sale</p>
          </div>
          <div class="icon">
            <i class="ion ion-beaker"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->




  </div><!-- /.container-fluid -->


  <div class="container-fluid">
    <h3>Total</h3>
    <!-- Small boxes (Stat box) -->
    <div class="row">

      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>₹<?= $total_sale[0]->total_price ?></h3>

            <p>Total Sale Amount</p>
          </div>
          <div class="icon">
            <i class="ion ion-cash"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>₹<?= $total_sale[0]->total_paid_amount ?></h3>

            <p>Total Paid Amount</p>
          </div>
          <div class="icon">
            <i class="ion ion-cash"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>₹<?= $total_sale[0]->total_due_amount ?></h3>

            <p>Total Due Amount</p>
          </div>
          <div class="icon">
            <i class="ion ion-cash"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo view("admin/layout/footer.php"); ?>
<?php echo view("admin/layout/script.php"); ?>
<!-- ./wrapper -->