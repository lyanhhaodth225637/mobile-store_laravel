@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard Quản Trị</h1>
        </div>

        <!-- Content Row - Statistics Cards -->
        <div class="row">
            <!-- Doanh Thu Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng Doanh Thu
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($tong_doanhthu ?? 0) }} đ
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Đơn Hàng Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Tổng Đơn Hàng
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($tong_donhang ?? 0) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sản Phẩm Đã Bán Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Sản Phẩm Đã Bán
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($tong_spdaban ?? 0) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Người Dùng Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Tổng Người Dùng
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($tong_nguoidung ?? 0) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row - Rating Stats -->
        <div class="row">
            <!-- Thống Kê Đánh Giá Card -->
            <div class="col-xl-8 col-lg-8 mb-4 mx-auto">
                <div class="card shadow h-100">
                    <div class="card-header py-3 bg-gradient-primary">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-star mr-2"></i>Thống Kê Đánh Giá
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Rating Average -->
                            <div class="col-md-6 text-center border-right">
                                <div class="mb-3">
                                    <h2 class="display-4 text-warning mb-0">
                                        {{ number_format($tb_danhgia ?? 0, 1) }}
                                    </h2>
                                    <div class="text-warning mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($tb_danhgia ?? 0))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-muted mb-0">Đánh giá trung bình</p>
                                </div>
                            </div>

                            <!-- Total Reviews -->
                            <div class="col-md-6 text-center">
                                <div class="mb-3">
                                    <h2 class="display-4 text-primary mb-2">
                                        {{ number_format($tong_danhgia ?? 0) }}
                                    </h2>
                                    <p class="text-muted mb-0">Tổng lượt đánh giá</p>
                                </div>
                            </div>
                        </div>

                        <!-- Rating Bars -->
                        @if(isset($rating_data) && is_array($rating_data))
                            <hr class="my-4">
                            <div class="px-3">
                                @for($i = 5; $i >= 1; $i--)
                                    @php
                                        $count = $rating_data[$i - 1] ?? 0;
                                        $percentage = $tong_danhgia > 0 ? ($count / $tong_danhgia) * 100 : 0;
                                    @endphp
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="text-sm">
                                                {{ $i }} <i class="fas fa-star text-warning"></i>
                                            </span>
                                            <span class="text-sm text-muted">{{ $count }} đánh giá</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}"
                                                aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection