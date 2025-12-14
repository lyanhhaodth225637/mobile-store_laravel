{{-- resources/views/user/donhang.blade.php --}}
@extends('layouts.frontend.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
    <main class="content-wrapper">
        <!-- Breadcrumb -->
        <nav class="container py-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                <li class="breadcrumb-item">Tài khoản</li>
                <li class="breadcrumb-item active">Đơn hàng</li>
            </ol>
        </nav>

        <div class="container pb-5 mb-lg-3">
            <div class="row g-4">
                <!-- Sidebar (trở thành offcanvas trên mobile) -->
                @include('user.sidebar')

                <!-- Nội dung chính -->
                <div class="col-lg-9">
                    <div class="ps-lg-4">
                        <h1 class="h2 mb-4">Đơn hàng của tôi</h1>

                        <!-- Nếu không có đơn hàng -->
                        @if($donhang->isEmpty())
                            <div class="text-center py-5 my-5">
                                
                                <h5 class="mb-3">Bạn chưa có đơn hàng nào</h5>
                                <a href="{{ route('frontend.home') }}" class="btn btn-primary px-4">Mua sắm ngay</a>
                            </div>
                        @else
                            <!-- Danh sách đơn hàng -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="bg-light">
                                                <tr class="text-nowrap">
                                                    <th class="ps-4 py-3">Mã đơn hàng</th>
                                                    <th class="py-3 d-none d-md-table-cell">Ngày đặt</th>
                                                    <th class="py-3 d-none d-lg-table-cell">Số lượng</th>
                                                    <th class="py-3 d-none d-md-table-cell">Tổng tiền</th>
                                                    <th class="py-3 d-none d-lg-table-cell">Trạng thái</th>
                                                    <th class="pe-4 py-3 text-end">Xem chi tiết</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($donhang as $dh)
                                                    <tr class="cursor-pointer" data-bs-toggle="offcanvas"
                                                        href="#orderDetail-{{ $dh->id }}">
                                                        <!-- Mã đơn + thông tin mobile -->
                                                        <td class="ps-4 py-4">
                                                            <div class="fw-bold text-primary">
                                                                #{{ str_pad($loop->iteration, 5, '0', STR_PAD_LEFT) }}</div>
                                                            <div class="d-md-none small text-muted mt-1">
                                                                {{ $dh->created_at->format('d/m/Y H:i') }}
                                                            </div>
                                                            <div class="d-md-none mt-2">
                                                                <span class="badge bg-{{ $dh->tinhtrang->mau ?? 'info' }} fs-xs">
                                                                    {{ $dh->tinhtrang->tinhtrang }}
                                                                </span>
                                                            </div>
                                                        </td>

                                                        <!-- Ngày đặt -->
                                                        <td class="d-none d-md-table-cell py-4">
                                                            {{ $dh->created_at->format('d/m/Y') }}
                                                            <small
                                                                class="text-muted d-block">{{ $dh->created_at->format('H:i') }}</small>
                                                        </td>

                                                        <!-- Số lượng sản phẩm -->
                                                        <td class="d-none d-lg-table-cell py-4">
                                                            {{ $dh->donhang_chitiet->sum('soluong') }} sản phẩm
                                                        </td>

                                                        <!-- Tổng tiền -->
                                                        <td class="d-none d-md-table-cell py-4 fw-bold text-danger">
                                                            {{ number_format($dh->tongtien) }}₫
                                                        </td>

                                                        <!-- Trạng thái -->
                                                        <td class="d-none d-lg-table-cell py-4">
                                                            <span class="badge bg-{{ $dh->tinhtrang->mau ?? 'secondary' }}">
                                                                {{ $dh->tinhtrang->tinhtrang }}
                                                            </span>
                                                        </td>

                                                        <!-- Nút xem chi tiết + hình nhỏ -->
                                                        <td class="py-4 text-end pe-4">
                                                            <div class="d-flex align-items-center justify-content-end gap-2">
                                                                <!-- Hình ảnh sản phẩm (tối đa 3) -->
                                                                @foreach($dh->donhang_chitiet->take(3) as $item)
                                                                    <img src="{{ asset('storage/' . $item->hinhanh) }}" width="40"
                                                                        height="40" class="rounded border object-fit-cover"
                                                                        alt="{{ $item->sanpham->tensanpham }}">
                                                                @endforeach
                                                                @if($dh->donhang_chitiet->count() > 3)
                                                                    <span
                                                                        class="badge bg-light text-dark">+{{ $dh->donhang_chitiet->count() - 3 }}</span>
                                                                @endif

                                                                <i class="ci-arrow-right ms-3 text-muted"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Phân trang -->
                            <div class="mt-4">
                                {{ $donhang->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== OFFCANVAS CHI TIẾT ĐƠN HÀNG (mỗi đơn 1 cái riêng) ==================== --}}
        @foreach($donhang as $dh)
            <div class="offcanvas offcanvas-end" tabindex="-1" id="orderDetail-{{ $dh->id }}" style="width: 480px;">
                <div class="offcanvas-header border-bottom">
                    <div>
                        <h5 class="offcanvas-title mb-1">
                            Đơn hàng #{{ str_pad($loop->iteration, 5, '0', STR_PAD_LEFT) }}
                        </h5>
                        <p class="mb-0 text-muted small">
                            Đặt lúc {{ $dh->created_at->format('H:i, d/m/Y') }}
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>

                <div class="offcanvas-body">
                    <!-- Trạng thái -->
                    <div class="d-flex align-items-center mb-4">
                        <span class="badge bg-{{ $dh->tinhtrang->mau ?? 'info' }} fs-6 px-3 py-2">
                            {{ $dh->tinhtrang->tinhtrang }}
                        </span>
                    </div>

                    <!-- Danh sách sản phẩm -->
                    <div class="mb-4">
                        <h6 class="mb-3">Sản phẩm ({{ $dh->donhang_chitiet->count() }})</h6>
                        @foreach($dh->donhang_chitiet as $item)
                            <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                                <a href="" class="flex-shrink-0">
                                    <img src="{{ asset('storage/' . $item->hinhanh) }}" width="72" height="72"
                                        class="rounded border" alt="{{ $item->sanpham->tensanpham }}">
                                </a>
                                <div class="flex-grow-1">
                                    <h6 class="fs-sm mb-1">
                                        <a href="" class="text-decoration-none">
                                            {{ Str::limit($item->sanpham->tensanpham, 50) }}
                                        </a>
                                    </h6>
                                    @if($item->bien_the)
                                        <small class="text-muted">{{ $item->bien_the }}</small><br>
                                    @endif
                                    <div class="d-flex justify-content-between mt-2">
                                        <span class="text-muted">x{{ $item->soluong }}</span>
                                        <span class="fw-bold text-danger">
                                            {{ number_format($item->gia_khuyenmai * $item->soluong) }}₫
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Thông tin giao hàng -->
                    <div class="bg-light rounded p-3 mb-4">
                        <h6 class="mb-3">Thông tin giao hàng</h6>
                        <div class="small">
                            <div><strong>Người nhận:</strong> {{ $dh->ten_nguoinhan ?? Auth::user()->name }}</div>
                            <div><strong>Điện thoại:</strong> {{ $dh->sodienthoai }}</div>
                            <div><strong>Địa chỉ:</strong> {{ $dh->diachi }}</div>
                        </div>
                    </div>

                    <!-- Tổng tiền -->
                    <div class="bg-dark text-white rounded p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính</span>
                            <span>{{ number_format($dh->tongtien - $dh->phivanchuyen) }}₫</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển</span>
                            <span>{{ $dh->phivanchuyen > 0 ? number_format($dh->phivanchuyen) . '₫' : 'Miễn phí' }}</span>
                        </div>
                        <div class="d-flex justify-content-between fs-5 fw-bold">
                            <span>Tổng cộng</span>
                            <span>{{ number_format($dh->tongtien) }}₫</span>
                        </div>
                    </div>
                </div>

                <!-- Footer nút hành động -->
                <div class="offcanvas-header border-top">
                    @if(in_array($dh->tinhtrang_id, [1, 2, 3])) {{-- Chờ xử lý, đang xử lý, đang giao --}}
                        <form action="" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100"
                                onclick="return confirm('Bạn chắc chắn muốn hủy đơn hàng này?')">
                                Hủy đơn hàng
                            </button>
                        </form>
                    @else
                        <button class="btn btn-secondary w-100" disabled>
                            {{ $dh->tinhtrang_id == 4 ? 'Đã giao thành công' : 'Đã hủy' }}
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </main>

    <!-- Nút mở menu trên mobile -->
    <button class="btn btn-dark position-fixed bottom-0 start-0 end-0 d-lg-none z-3 rounded-0 py-3"
        data-bs-toggle="offcanvas" data-bs-target="#accountSidebar">
        <i class="ci-menu me-2"></i> Menu tài khoản
    </button>
@endsection