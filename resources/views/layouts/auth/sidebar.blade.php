<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin') }}" class="brand-link">
        <span class="brand-text font-weight-light">Universitas Diponegoro</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a class="d-block">{{ Auth::user()->nama }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if ('admin')
                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <!-- Change Link -->
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            Kelola Mahasiswa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <!-- Change Link -->
                        <i class="nav-icon fas fa-check"></i>
                        <p>
                            Verifikasi (?)
                        </p>
                    </a>
                </li>
                    
                @endif

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            Kelola Portofolio
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/prestasi" class="nav-link">
                                <i class="fas fa-medal nav-icon"></i>
                                <p>Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/project" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Project</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/verifikasi" class="nav-link">
                                <i class="fas fa-paper-plane nav-icon"></i>
                                <p>Ajukan Verifikasi</p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
