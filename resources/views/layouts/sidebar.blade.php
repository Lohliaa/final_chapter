<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/home" class="brand-link">
    {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8"> --}}
    <span class="brand-text font-weight-dark">WIP SYSTEM</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ url('/home') }}" class="d-block">DASHBOARD</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li
          class="nav-item has-treeview {{ Request::is('properti_single', 'properti_nonsingle', 'item', 'harga', 'umh_master') ? 'menu-open' : '' }}">
          <a href="#"
            class="nav-link {{ Request::is('properti_single', 'properti_nonsingle', 'item', 'harga', 'umh_master') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Update Database
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('properti_single') }}"
                class="nav-link {{ Request::is('properti_single') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Properti Single
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('properti_nonsingle') }}" class="nav-link {{ Request::is('properti_nonsingle') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Properti Non-Single
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('item') }}" class="nav-link {{ Request::is('item') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Data Item
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('harga') }}" class="nav-link {{ Request::is('harga') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Daftar Harga
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('umh_master') }}" class="nav-link {{ Request::is('umh_master') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Daftar UMH
                </p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview {{ Request::is('material', 'database_konversi') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('material', 'database_konversi') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Material
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="{{ url('database_konversi') }}" class="nav-link {{ Request::is('database_konversi') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Database Konversi
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="{{ url('material') }}" class="nav-link {{ Request::is('material') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Material
                </p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview {{ Request::is('area_final', 'area_preparation') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('area_final', 'area_preparation') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Hasil STO
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="{{ url('area_final') }}" class="nav-link {{ Request::is('area_final') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Area Final
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="{{ url('area_preparation') }}" class="nav-link {{ Request::is('area_preparation') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Area Preparation
                </p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ Request::is('report') ? 'menu-open' : '' }}">
          <a href="{{ url('report') }}" class="nav-link {{ Request::is('report') ? 'active' : '' }}">
            <i class="fas fa-circle nav-icon"></i>
            <p>Unduh Report</p>
          </a>
        </li>
      
        <li class="nav-item {{ Request::is('online-user*') ? 'menu-open' : '' }}">
          @if (auth()->check() && auth()->user()->role == 'admin')
          <a href="{{ url('online-user') }}" class="nav-link {{ Request::is('online-user') ? 'active' : '' }}">
            <i class="fas fa-circle nav-icon"></i>
            <p>Kelola Akun</p>
          </a>
          @endif
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>