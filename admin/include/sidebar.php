  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      <ul class="sidebar-menu" data-widget="tree" id="menu">
        <li class="header">MAIN NAVIGATION</li>
        <?php
        if ($_SESSION['role_id'] == 1) {?>
          <li id="user">
            <a id="user" href="user">
              <i class="fa fa-user"></i> 
              </i>Pengguna</a>
          </li>
          <li id="krk">
            <a id="krk" href="krk">
              <i class="fa fa-database"></i>
              <span>Data KRK</span>
            </a>
          </li>
          <li id="report">
            <a id="report" href="report">
              <i class="fa fa-pie-chart"></i>
              <span>Laporan</span>
            </a>
          </li>
        <?php } elseif ($_SESSION['role_id'] == 2) { ?>
          <li id="krk">
            <a id="krk" href="krk">
              <i class="fa fa-database"></i>
              <span>Data KRK</span>
            </a>
          </li>
          <li id="report">
            <a id="report" href="report">
              <i class="fa fa-pie-chart"></i>
              <span>Laporan</span>
            </a>
          </li>
        <?php } elseif ($_SESSION['role_id'] == 3) { ?>
          <li id="krk">
            <a id="krk" href="krk">
              <i class="fa fa-database"></i>
              <span>Data KRK</span>
            </a>
          </li>
        <?php }?>        
            
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
