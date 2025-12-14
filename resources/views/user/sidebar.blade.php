<aside class="col-lg-3">
    <div class="offcanvas-lg offcanvas-start pe-lg-0 pe-xl-4" id="accountSidebar">
        <!-- Header -->

        <!-- Body (Navigation) -->
        <div class="offcanvas-body d-block pt-2 pt-lg-4 pb-lg-0">
            <nav class="list-group list-group-borderless">
                <a class="list-group-item list-group-item-action d-flex align-items-center "
                    href="{{ route('user.hoso') }}">
                    <i class="ci-user fs-base opacity-75 me-2"></i> Hồ sơ cá nhân
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center"
                    href="{{ route('user.mspay') }}">
                    <i class="ci-credit-card fs-base opacity-75 me-2"></i> Ví MSPay
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center"
                    href="{{ route('user.donhang') }}">
                    <i class="ci-shopping-bag fs-base opacity-75 me-2"></i> Đơn hàng của tôi
                    <!-- <span class="badge bg-primary rounded-pill ms-auto">0</span> -->
                </a>

                <a class="list-group-item list-group-item-action d-flex align-items-center"
                    href="{{ route('user.voucher') }}">
                    <i class="ci-map-pin fs-base opacity-75 me-2"></i> Voucher
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" href="{{ route('user.hoso.tragop') }}">
                    <i class="ci-credit-card fs-base opacity-75 me-2"></i> Hồ sơ trả góp
                </a>
                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                    <i class="ci-credit-card fs-base opacity-75 me-2"></i> Phương thức thanh toán
                </a>

                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">
                    <i class="ci-bell fs-base opacity-75 mt-1 me-2"></i> Cài đặt thông báo
                </a>
            </nav>
            <nav class="list-group list-group-borderless pt-3">
                <a class="list-group-item list-group-item-action d-flex align-items-center" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="ci-log-out fs-base opacity-75 me-2"></i> Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>
    </div>
</aside>