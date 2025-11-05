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
    <li class="nav-item {{ Request::is('admin/loaisanpham*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#loaisanpham" aria-expanded="true"
            aria-controls="loaisanpham">
            <span>Loại Sản Phẩm</span>
        </a>

        <div id="loaisanpham" class="collapse {{ Request::is('admin/loaisanpham*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::routeIs('loaisanpham') ? 'active' : '' }}"
                    href="{{ route('admin.loaisanpham') }}">Danh sách</a>
                <a  class="collapse-item"
                    href="{{ route('admin.loaisanpham.them') }}">Thêm</a>
            </div>
        </div>
    </li>

    

</ul>