<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url() ?>public/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Admin</a>
      </div>
    </div>
    <!-- Sidebar -->


    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="<?= base_url('index') ?>" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <?php $session = session();
        $user_role = $session->get('user_role');
        if ($user_role == 'admin') {
        ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/category/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expense Category</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('bank/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Manage</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('shift/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shift Manage</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('salerate/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sale Rate Manage</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('/rate_chart/viewconfig') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rate Chart Configuration</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('/item/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Items</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('/product/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Converter</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Branch Manage
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/dairy/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Branch</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/dairy/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Branch</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Employee Manage
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('employee/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('employee/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Employee</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-child"></i>
              <p>
                Collection Boy Manage
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('collection/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Collection Boy</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('collection/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Collection Boy</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Farmers Manage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/fermer/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Farmer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/fermer/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Farmer</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Customer Manage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/customer/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/customer/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Customer</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Bank Manage
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('bank/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Bank</p>
                </a>
              </li>
              
            </ul>
          </li> -->

          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Shift Manage
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('shift/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Shift</p>
                </a>
              </li>
              
            </ul>
          </li> -->

          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Sale Rate Manage
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('salerate/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Sale Rate</p>
                </a>
              </li>
              
            </ul>
          </li> -->

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-stamp"></i>
              <p>
                Milk Collection
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/milk/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Collection</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/milk/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Collection</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-balance-scale"></i>
              <p>
                Sales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/screen/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/screen/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Sales</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('/product/totalview') ?>" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p> Stock </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Payment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/payment/customer/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Payment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/payment/farmer/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Farmer Payment</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-rupee-sign"></i>
              <p>
                Expense Manage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/expense/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Expense</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/expense/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Expense</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>
                Advance Manage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/advance/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Advance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/advance/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Advance</p>
                </a>
              </li>
            </ul>
          </li> -->

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/milkreport/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Milk Collection Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('/report/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Milk Sale Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('/productreport/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Sale Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('/setting/create') ?>" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Settings</p>
            </a>
          </li>

        <?php }


        if ($user_role == 'col_boy') {
        ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-balance-scale"></i>
              <p>
                Sales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/screen/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/screen/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Sales</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-stamp"></i>
              <p>
                Milk Collection
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/milk/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Collection</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/milk/view') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Collection</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('/milkreport/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Milk Collection Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('/report/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Milk Sale Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('/productreport/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Sale Report</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= $page_title ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('index') ?>">Home</a></li>
            <li class="breadcrumb-item active"><?= $page_title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->