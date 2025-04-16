 <!-- Sidebar Start -->
 <aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="" class="text-nowrap logo-img">
        <img src="{{ asset('Modernize/src/assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <br>
        {{-- <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li> --}}
        {{-- <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">AUTH</span>
        </li> --}}
        </li>
        @if(Auth::check() && Auth::user()->role === 'staff')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('pengaduan.staff.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-alert-circle"></i>
            </span>
            <span class="hide-menu">Pengaduan</span>
          </a>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role === 'guest')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('pengaduan.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-alert-circle"></i>
            </span>
            <span class="hide-menu">Pengaduan</span>
          </a>
        </li>
        @endif

        @if(Auth::check() && Auth::user()->role === 'head_staff')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Register</span>
            </a>
        </li>
        @endif

      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->