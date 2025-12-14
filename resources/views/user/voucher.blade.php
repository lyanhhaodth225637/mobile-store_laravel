@extends('layouts.frontend.app')
@section('title', 'Voucher')
@section('content')
    <main class="content-wrapper">
        <nav class="container pt-3 my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Khách hàng</a></li>
                <li class="breadcrumb-item active">Voucher</li>
            </ol>
        </nav>

        <div class="container mt-4">
            <div class="row">
                <!-- Sidebar -->
                @include('user.sidebar')

                <!-- Main content -->
                <div class="col-lg-9">
                    <h1 class="h2 mb-4">Voucher Của Tôi</h1>

                    <!-- Points Exchange Section -->
                    <div class="card border-0 shadow-sm mb-4 bg-gradient-primary text-white">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="card-title mb-2">Đổi Điểm Lấy Voucher</h5>
                                    <p class="card-text mb-3">Tích lũy điểm từ mỗi đơn hàng và đổi lấy voucher giảm giá</p>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="bg-white bg-opacity-20 p-3 rounded">
                                                <small class="d-block opacity-75">Điểm hiện có</small>
                                                <h4 class="mb-0">{{ auth()->user()->points ?? 0 }} <span
                                                        class="fs-6">điểm</span></h4>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-white bg-opacity-20 p-3 rounded">
                                                <small class="d-block opacity-75">Giá trị quy đổi</small>
                                                <h4 class="mb-0">
                                                    {{ number_format((auth()->user()->points ?? 0) * 100, 0, ',', '.') }}
                                                    <span class="fs-6">đ</span>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <form action="{{ route('user.voucher') }}" method="POST"
                                        class="d-flex flex-column gap-2">
                                        @csrf
                                        <label>Chọn mức đổi:</label>
                                        <select name="points" class="form-select mb-2">
                                            <option value="100">10.000đ (100 điểm)</option>
                                            <option value="200">20.000đ (200 điểm)</option>
                                            <option value="500">50.000đ (500 điểm)</option>
                                            <option value="1000">100.000đ (1.000 điểm)</option>
                                            <option value="2000">200.000đ (2.000 điểm)</option>
                                            <option value="5000">500.000đ (5.000 điểm)</option>
                                        </select>
                                        <button type="submit" class="btn btn-light btn-lg">
                                            <i class="ci-gift me-2"></i> Đổi điểm lấy voucher
                                        </button>
                                    </form>


                                    <button class="btn btn-light btn-outline-light btn-lg mt-2" data-bs-toggle="modal"
                                        data-bs-target="#exchangeHistoryModal">
                                        <i class="ci-history me-2"></i> Lịch sử đổi điểm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vouchers List -->
                    <div class="row g-3">
                        @forelse($vouchers ?? [] as $uv)
                            @php
                                $voucher = $uv->voucher;
                            @endphp

                            <div class="col-md-6 voucher-item" data-status="{{ $voucher->trang_thai }}">
                                <div class="card border-2 border-primary h-100 position-relative overflow-hidden">

                                    <!-- Ribbon Status -->
                                    <div class="position-absolute top-0 end-0">
                                        @if($voucher->trang_thai == 0 || $voucher->so_luong == 0)
                                            <span class="badge bg-danger rounded-0 rounded-start-3 p-2">Hết hạn</span>
                                        @else
                                            <span class="badge bg-success rounded-0 rounded-start-3 p-2">Còn hiệu lực</span>
                                        @endif
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title mb-2">{{ $voucher->ma_voucher }}</h5>
                                        <p class="text-muted small mb-2">Điểm cần đổi: {{ $voucher->diem_can_doi }}</p>

                                        <div class="mb-3 p-3 bg-light rounded">
                                            <p class="mb-1 text-muted small">Giá trị voucher</p>
                                            <h4 class="mb-0 text-primary">{{ number_format($voucher->gia_tri, 0, ',', '.') }}đ
                                            </h4>
                                        </div>

                                        <div class="small">
                                            <div class="mb-1">
                                                <span class="text-muted">Số lượng:</span>
                                                <span class="fw-semibold">{{ $voucher->so_luong }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <span class="text-muted">Hết hạn:</span>
                                                <span class="fw-semibold">
                                                    {{ \Carbon\Carbon::parse($voucher->het_han)->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer bg-white border-top">
                                        @if($voucher->trang_thai == 1 && $voucher->so_luong > 0)
                                            <button class="btn btn-sm btn-primary w-100 copy-voucher"
                                                data-code="{{ $voucher->ma_voucher }}">
                                                <i class="ci-copy me-1"></i> Sao chép mã
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-secondary w-100 disabled" disabled>
                                                <i class="ci-lock me-1"></i> Không thể sử dụng
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info d-flex align-items-center" role="alert">
                                    <i class="ci-info me-2"></i>
                                    <div>
                                        Bạn chưa có voucher nào.
                                        <a href="{{ route('frontend.home') }}" class="alert-link">Khám phá sản phẩm</a>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>


                </div>
            </div>
        </div>
    </main>
@endsection