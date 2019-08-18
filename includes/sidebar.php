  <!-- Left side column. contains the logo and sidebar -->

  <?php
  if ($_SESSION['role_id'] == 1) {?>
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li>
            <a href="?m=krk_usr">
              <i class="fa fa-user"></i> 
              <span>Pengguna</span>
            </a>
          </li>
          <li>
            <a href="?m=krk_data">
              <i class="fa fa-database"></i>
              <span>Data KRK</span>
            </a>
          </li>
          <li>
            <a href="?m=krk_laporan">
              <i class="fa fa-pie-chart"></i>
              <span>Laporan</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
  <?php } elseif ($_SESSION['role_id'] == 2) { ?>
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li>
            <a href="?m=krk_data">
              <i class="fa fa-database"></i>
              <span>Data KRK</span>
            </a>
          </li>
          <li>
            <a href="?m=krk_laporan">
              <i class="fa fa-pie-chart"></i>
              <span>Laporan</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
  <?php } elseif ($_SESSION['role_id'] == 3) { ?>
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li>
            <a href="?m=krk_data">
              <i class="fa fa-database"></i>
              <span>Data KRK</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
  <?php }?>