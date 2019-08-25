<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="konten">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Chart Of Account</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><a style="cursor : pointer; color: #fff;" id="receivable" onclick="openReceivable()">&nbsp;</a></h3>

              <p><a style="cursor : pointer; color: #fff;" id="receivable" onclick="openReceivable()">Receivable</a></p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><a style="cursor : pointer; color: #fff;" id="bill" onclick="openBills()">&nbsp;</a></h3>

              <p><a style="cursor : pointer; color: #fff;" id="bill" onclick="openBills()">Bill Receipts</a></p>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><a style="cursor : pointer; color: #fff;" id="payable" onclick="openPayable()">&nbsp;</a></h3>

              <p><a style="cursor : pointer; color: #fff;" id="payable" onclick="openPayable()">Payable</a></p>
            </div>
            <div class="icon">
              <i class="ion ion-card"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i>Profit &amp; Loss</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="re1venue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-c1hart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i>User Activity</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="reve1nue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-ch1art" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    function openReceivable(){
      $("#konten").load("pages/user/user.php");
    }
    function openPayable(){
      $("#konten").load("pages/payable/payment.php");
    }
    function openCOA(){
      $("#konten").load("pages/coa/coa.php");
    }

    function openBills(){
      $("#konten").load("pages/payable/bill.php");
    }
  </script>