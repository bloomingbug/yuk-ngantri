<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-0 pb-0" href="/">
        <div class="sidebar-brand-icon">
            <i class="fas fa-solid fa-door-open"></i>
            {{-- <img src="{{ asset('img/ubp-rc.jpg') }}" alt="Logo UBP RC" width="75" class="rounded-circle"> --}}
        </div>
        <div class="sidebar-brand-text mx-1">Yuk-Ngantri</div>
    </a>
    {{-- <div class="d-flex align-items-center justify-content-center nav-item mb-0 mt-4 py-0 text-center">
        <a href="/dashboard" class="nav-link my-0 py-0 text-center">
            <span>UBP RC</span></a>
    </div>
    <div class="d-flex align-items-center justify-content-center nav-item my-0 py-0 text-center">
        <a href="/dashboard" class="nav-link mt-0 pt-0 text-center">
            <span>(Room Class)</span></a>
    </div> --}}

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-table"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @can('admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            ADMIN
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a href="/users" class="nav-link">
                <i class="fas fa-user"></i>
                <span>User</span></a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a href="/matkul-admin" class="nav-link">
                <i class="fas fa-wave-square mx-0"></i>
                <span>Mata Kuliah</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a href="/jadwal" class="nav-link">
                <i class="fas fa-calendar"></i>
                <span>Jadwal</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a href="/ruangan" class="nav-link">
                <i class="fas fa-chalkboard mx-0"></i>
                <span>Ruangan</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a href="/sesi-perkuliahan" class="nav-link">
                <i class="fas fa-user-clock mx-0"></i>
                <span>Sesi Perkuliahan</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
    @endcan

    @can('dosen')
        <!-- Heading -->
        <div class="sidebar-heading">
            DOSEN
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a href="/ruangan" class="nav-link">
                <i class="fas fa-chalkboard mx-0"></i>
                <span>Ruangan</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a href="/matkul/mk-diampu/{{ Auth::user()->slug }}" class="nav-link">
                <i class="fas fa-wave-square mx-0"></i>
                <span>Mata Kuliah</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endcan

    @can('mahasiswa')
        {{-- Heading --}}
        <div class="sidebar-heading">
            MAHASISWA
        </div>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a href="/matkul" class="nav-link">
                <i class="fas fa-wave-square mx-0"></i>
                <span>Mata Kuliah</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endcan

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
