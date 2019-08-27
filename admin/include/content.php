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