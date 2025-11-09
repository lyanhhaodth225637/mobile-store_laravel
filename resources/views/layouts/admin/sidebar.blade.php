<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3">Mobile Store</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang Quản Trị</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::routeIs(['admin.loaisanpham*', 'admin.hangsanxuat*']) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#danhmuc" aria-expanded="true"
            aria-controls="loaisanpham">
            <span>Danh Mục</span>
        </a>

        <div id="danhmuc"
            class="collapse {{ Request::routeIs(['admin.loaisanpham*', 'admin.hangsanxuat*']) ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item {{ Request::routeIs('admin.loaisanpham') ? 'active' : '' }}"
                    href="{{ route('admin.loaisanpham') }}">Loại Sản Phẩm</a>
                <a class="collapse-item {{ Request::routeIs('admin.hangsanxuat') ? 'active' : '' }}"
                    href="{{ route('admin.hangsanxuat') }}">Hãng Sản Xuất</a>

            </div>
        </div>
    </li>
    <!-- === -->
    <li class="nav-item {{ Request::routeIs(['admin.loaisanpham*', 'admin.hangsanxuat*']) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#loaisanpham" aria-expanded="true"
            aria-controls="loaisanpham">
            <span>Sản Phẩm</span>
        </a>

        <div id="loaisanpham"
            class="collapse {{ Request::routeIs(['admin.sanpham*', 'admin.hangsanxuat*']) ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item {{ Request::routeIs('admin.sanpham') ? 'active' : '' }}"
                    href="{{ route('admin.sanpham') }}">Sản Phẩm</a>
                <a class="collapse-item {{ Request::routeIs('admin.sanpham.khuyenmai') ? 'active' : '' }}"
                    href="{{ route('admin.sanpham.khuyenmai') }}">Sản Phẩm Khuyến Mãi</a>

                <a hidden class="collapse-item {{ Request::routeIs('admin.loaisanpham') ? 'active' : '' }}"
                    href="{{ route('admin.loaisanpham') }}">Sản Phẩm Đặt Trước</a>


            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>