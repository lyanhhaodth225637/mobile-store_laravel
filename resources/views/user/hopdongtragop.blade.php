@extends('layouts.frontend.app')
@section('title', 'Hồ sơ khách hàng')
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

        <div class="container mt-4 mb-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Đăng ký hợp đồng trả góp</h3>
                        <p class="text-muted">Vui lòng điền đầy đủ thông tin để hoàn tất đăng ký</p>
                    </div>

                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="ci-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="ci-close-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Form Card -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-sm-5">
                            <form action="{{ route('user.hopdong.tragop.luu') }}" method="POST">
                                @csrf

                                <!-- Thông tin sản phẩm -->
                                <div class="mb-4">
                                    <h6 class="mb-3 text-primary">
                                        <i class="ci-package me-2"></i>Thông tin sản phẩm
                                    </h6>
                                    <div class="p-3 bg-light rounded">
                                        @if($sanpham->khuyenmai > 0)
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-medium">{{ $sanpham->tensanpham }}</span>
                                                <span
                                                    class="text-danger fw-bold">{{ number_format($sanpham->gia_khuyenmai) }}đ</span>
                                            </div>
                                            @if($sanpham->gia)
                                                <small
                                                    class="text-muted text-decoration-line-through">{{ number_format($sanpham->gia) }}đ</small>
                                            @endif
                                            <input type="hidden" name="sanpham_id" value="{{ $sanpham->id }}">
                                        @else
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-medium">{{ $sanpham->tensanpham }}</span>
                                                <span class="text-dark fw-bold">{{ number_format($sanpham->gia) }}đ</span>
                                            </div>
                                            <input type="hidden" name="sanpham_id" value="{{ $sanpham->id }}">
                                        @endif
                                    </div>
                                </div>

                                <!-- Thông tin cá nhân -->
                                <div class="mb-4">
                                    <h6 class="mb-3 text-primary">
                                        <i class="ci-user me-2"></i>Thông tin cá nhân
                                    </h6>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                            <input type="text" name="ho_ten" class="form-control"
                                                placeholder="Nhập họ và tên đầy đủ" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Số CCCD <span class="text-danger">*</span></label>
                                            <input type="text" name="cccd" class="form-control" placeholder="Nhập số CCCD"
                                                required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Số điện thoại <span
                                                    class="text-danger">*</span></label>
                                            <input type="tel" name="sdt" class="form-control"
                                                placeholder="Nhập số điện thoại" required>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                                            <textarea name="dia_chi" class="form-control" rows="2"
                                                placeholder="Nhập địa chỉ đầy đủ" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thông tin trả góp -->
                                <div class="mb-4">
                                    <h6 class="mb-3 text-primary">
                                        <i class="ci-card me-2"></i>Thông tin trả góp
                                    </h6>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Trả trước (%) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="tra_truoc" class="form-control" min="0" max="100"
                                                placeholder="0 - 100" required>
                                            <small class="text-muted">Tối thiểu 0%, tối đa 100%</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Thời hạn trả góp <span
                                                    class="text-danger">*</span></label>
                                            <select name="thoi_han" class="form-select" required>
                                                <option value="">-- Chọn thời hạn --</option>
                                                <option value="3">3 tháng</option>
                                                <option value="6">6 tháng</option>
                                                <option value="9">9 tháng</option>
                                                <option value="12">12 tháng</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Điều khoản -->
                                <div class="mb-4">
                                    <div class="card bg-light border-0">
                                        <div class="card-body">
                                            <h6 class="mb-3">Điều khoản và điều kiện</h6>
                                            <div class="small text-muted mb-3" style="max-height: 150px; overflow-y: auto;">
                                                <ul class="mb-0 ps-3">
                                                    <li>Khách hàng cam kết cung cấp thông tin chính xác và đầy đủ.</li>
                                                    <li>Thanh toán đúng hạn theo lịch trả góp đã thỏa thuận.</li>
                                                    <li>Chịu trách nhiệm về các khoản phí phát sinh nếu chậm trễ thanh toán.
                                                    </li>
                                                    <li>Tuân thủ các điều khoản và điều kiện của hợp đồng trả góp.</li>
                                                    <li>Cửa hàng có quyền thu hồi sản phẩm nếu vi phạm điều khoản.</li>
                                                </ul>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">
                                                    Tôi đã đọc và đồng ý với <a href="#"
                                                        class="text-decoration-underline">điều khoản và điều kiện</a> của
                                                    hợp đồng trả góp <span class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="ci-check me-2"></i>Tạo hợp đồng trả góp
                                    </button>
                                </div>

                                <p class="text-center text-muted small mt-3 mb-0">
                                    <i class="ci-security me-1"></i>Thông tin của bạn được bảo mật an toàn
                                </p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection

@section('floating-button')
    <!-- Sidebar navigation offcanvas toggle -->
    <button type="button"
        class="fixed-bottom z-sticky w-100 btn btn-lg btn-dark border-0 border-top border-light border-opacity-10 rounded-0 pb-4 d-lg-none"
        data-bs-toggle="offcanvas" data-bs-target="#accountSidebar" data-bs-theme="light">
        <i class="ci-sidebar fs-base me-2"></i> Quản lý tài khoản
    </button>
@endsection