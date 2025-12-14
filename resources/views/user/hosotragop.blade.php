@extends('layouts.frontend.app')
@section('title', 'Hợp đồng trả góp')
@section('content')
    <!-- Page content -->
    <main class="content-wrapper">
        <nav class="container pt-3 my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Khách hàng</a></li>
                <li class="breadcrumb-item active">Hợp đồng trả góp</li>
            </ol>
        </nav>

        <div class="container mt-4">
            <div class="row">
                <!-- Sidebar navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
                @include('user.sidebar')
                
                <!-- Personal info content -->
                <div class="col-lg-9">
                    <!-- Page title -->
                    <h1 class="h2 mb-1 mb-sm-2">Hợp đồng trả góp của tôi</h1>

                    <div class="ps-lg-3 ps-xl-0">

                        <!-- Basic info -->
                        <div class="border-bottom py-4">
                            @if(session('error'))
                                <div class="alert d-flex alert-danger" role="alert">
                                    <i class="ci-banned fs-lg pe-1 mt-1 me-2"></i>
                                    <div>{{ session('error') }}</div>
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert d-flex alert-success" role="alert">
                                    <i class="ci-check-circle fs-lg pe-1 mt-1 me-2"></i>
                                    <div>{{ session('success') }}</div>
                                </div>
                            @endif

                            <!-- Danh sách hợp đồng -->
                            @if($hopDongs->count() > 0)
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle mb-0">
                                                <thead class="bg-light">
                                                    <tr class="text-nowrap">
                                                        <th class="ps-4 py-3">Mã HĐ</th>
                                                        <th class="py-3">Sản phẩm</th>
                                                        <th class="py-3 d-none d-md-table-cell">Ngày tạo</th>
                                                        <th class="py-3 d-none d-lg-table-cell">Thời hạn</th>
                                                        <th class="py-3 d-none d-md-table-cell">Trả mỗi tháng</th>
                                                        <th class="py-3">Trạng thái</th>
                                                        <th class="pe-4 py-3 text-end">Chi tiết</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($hopDongs as $hd)
                                                        <tr>
                                                            <!-- Mã hợp đồng -->
                                                            <td class="ps-4 py-4">
                                                                <div class="fw-bold text-primary">
                                                                    #{{ $hd->id }}
                                                                </div>
                                                                <!-- Thông tin mobile -->
                                                                <div class="d-md-none small text-muted mt-1">
                                                                    {{ $hd->created_at->format('d/m/Y') }}
                                                                </div>
                                                                <div class="d-md-none mt-2">
                                                                    <span class="badge 
                                                                        @if($hd->duyet == 0) bg-warning
                                                                        @elseif($hd->duyet == 1) bg-success
                                                                        @else bg-danger
                                                                        @endif">
                                                                        @if($hd->duyet == 0)
                                                                            Chờ duyệt
                                                                        @elseif($hd->duyet == 1)
                                                                            Đã duyệt
                                                                        @else
                                                                            Từ chối
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </td>

                                                            <!-- Sản phẩm -->
                                                            <td class="py-4">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <img src="{{ asset('storage/' . $hd->sanpham->hinhanh) }}" 
                                                                         width="50" height="50"
                                                                         class="rounded border object-fit-cover" 
                                                                         alt="{{ $hd->sanpham->tensanpham }}">
                                                                    <div>
                                                                        <div class="fw-medium">{{ Str::limit($hd->sanpham->tensanpham, 30) }}</div>
                                                                        <small class="text-muted">{{ number_format($hd->gia_san_pham, 0, ',', '.') }} VNĐ</small>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <!-- Ngày tạo -->
                                                            <td class="d-none d-md-table-cell py-4">
                                                                <div>{{ $hd->created_at->format('d/m/Y') }}</div>
                                                                <small class="text-muted">{{ $hd->created_at->format('H:i') }}</small>
                                                            </td>

                                                            <!-- Thời hạn -->
                                                            <td class="d-none d-lg-table-cell py-4">
                                                                <span class="badge bg-info">{{ $hd->thoi_han }} tháng</span>
                                                            </td>

                                                            <!-- Trả mỗi tháng -->
                                                            <td class="d-none d-md-table-cell py-4 fw-bold text-danger">
                                                                {{ number_format($hd->so_tien_tra_moi_thang, 0, ',', '.') }} VNĐ
                                                            </td>

                                                            <!-- Trạng thái duyệt -->
                                                            <td class="py-4">
                                                                <div class="d-flex flex-column gap-1">
                                                                    <!-- Trạng thái duyệt -->
                                                                    <span class="badge d-none d-lg-inline-block
                                                                        @if($hd->duyet == 0) bg-warning
                                                                        @elseif($hd->duyet == 1) bg-success
                                                                        @else bg-danger
                                                                        @endif">
                                                                        @if($hd->duyet == 0)
                                                                            <i class="ci-time me-1"></i>Chờ duyệt
                                                                        @elseif($hd->duyet == 1)
                                                                            <i class="ci-check me-1"></i>Đã duyệt
                                                                        @else
                                                                            <i class="ci-close me-1"></i>Từ chối
                                                                        @endif
                                                                    </span>
                                                                    
                                                                    <!-- Trạng thái hợp đồng -->
                                                                    @if($hd->duyet == 1)
                                                                        <span class="badge d-none d-lg-inline-block
                                                                            @if($hd->trang_thai_hop_dong == 0) bg-primary
                                                                            @else bg-secondary
                                                                            @endif">
                                                                            @if($hd->trang_thai_hop_dong == 0)
                                                                                <i class="ci-refresh me-1"></i>Đang trả góp
                                                                            @else
                                                                                <i class="ci-check-circle me-1"></i>Hoàn thành
                                                                            @endif
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </td>

                                                            <!-- Nút xem chi tiết -->
                                                            <td class="py-4 text-end pe-4">
                                                                <button type="button" 
                                                                        class="btn btn-sm btn-outline-primary"
                                                                        data-bs-toggle="modal" 
                                                                        data-bs-target="#modalChiTiet{{ $hd->id }}">
                                                                    <i class="ci-eye me-1"></i>
                                                                    <span class="d-none d-sm-inline">Xem</span>
                                                                </button>
                                                            </td>
                                                        </tr>

                                                        <!-- Modal chi tiết -->
                                                        @include('user.hopdongchitiet', ['hd' => $hd])
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phân trang -->
                                <div class="mt-4">
                                    {{ $hopDongs->links() }}
                                </div>
                            @else
                                <!-- Không có hợp đồng -->
                                <div class="card border-0 shadow-sm text-center py-5">
                                    <div class="card-body">
                                        <i class="ci-document fs-1 text-muted mb-3 d-block"></i>
                                        <h5 class="mb-2">Chưa có hợp đồng trả góp</h5>
                                        <p class="text-muted mb-4">Bạn chưa đăng ký hợp đồng trả góp nào.</p>
                                        <a href="{{ route('frontend.home') }}" class="btn btn-primary">
                                            <i class="ci-cart me-2"></i>Mua sắm ngay
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('floating-button')
    <!-- Sidebar navigation offcanvas toggle that is visible on screens < 992px wide (lg breakpoint) -->
    <button type="button"
        class="fixed-bottom z-sticky w-100 btn btn-lg btn-dark border-0 border-top border-light border-opacity-10 rounded-0 pb-4 d-lg-none"
        data-bs-toggle="offcanvas" data-bs-target="#accountSidebar" data-bs-theme="light">
        <i class="ci-sidebar fs-base me-2"></i> Quản lý tài khoản
    </button>
@endsection