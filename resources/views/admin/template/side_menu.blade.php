<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin')}}" class="brand-link">
        <img src="{{asset('assets/img/logo_p.jpg')}}" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Perpustakaan 2.0</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('admin')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/master/books')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/borrow')}}" class="nav-link">
                        <i class="nav-icon fab fa-superpowers"></i>
                        <p>History Pinjaman Buku</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hat-cowboy-side"></i>
                        <p>
                            Master
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/master/procurements')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jenis Pengadaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/master/collection_types')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jenis Koleksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/master/categories')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kategori Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/master/authors')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Penulis Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/master/currencies')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mata Uang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/master/penalties')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Denda</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->hasAnyRole('admin|staff_teknis'))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Management
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Keanggotaan</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Hak Akses
                                    <i class="right fas fa-angle-left"></i>
                                    <span class="badge badge-info right">3</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('admin/management/role_management/permissions')}}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Permission</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/management/role_management/roles')}}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Role</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/management/role_management/users')}}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
