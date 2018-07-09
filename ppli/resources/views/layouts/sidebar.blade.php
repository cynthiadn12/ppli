  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{ route('user-management.index') }}"><i class="fa fa-user"></i> <span>User Management</span></a></li>
        <li><a href="{{ route('customer-management.index') }}"><i class="fa fa-cube"></i> <span>Customer Management</span></a></li>
        <li><a href="{{ route('vendor-management.index') }}"><i class="fa fa-truck"></i> <span>Vendor Management</span></a></li>
        <li><a href="{{ route('fish-management.index') }}"><i class="fa fa-cubes"></i> <span>Fish Management</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Location</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('flocation-management.index') }}">First Location</a></li>
            <li><a href="{{ route('slocation-management.index') }}">Second Location</a></li>
          </ul>
        </li>
        <li><a href="{{ route('warehouse-management.index') }}"><i class="fa fa-cubes"></i> <span>Warehouse Management</span></a></li>
        <li><a href="{{ route('measurement-management.index') }}"><i class="fa fa-cubes"></i> <span>Measurement Management</span></a></li>
        <li><a href="{{ route('sourcing-dashboard.index') }}"><i class="fa fa-link"></i> <span>Sourcing Management</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>