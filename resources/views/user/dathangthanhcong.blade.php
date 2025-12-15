@extends('layouts.frontend.app')
@section('title', 'Trang chủ')
@section('content')
    <!-- Page content -->
    <main class="content-wrapper">
        <section class="container mt-4 mb-4">
            <div class="position-relative overflow-hidden rounded-5 p-4 p-sm-5"
                style="background-color:var(--cz-success-border-subtle)">
                <div class="position-relative z-2 text-center py-4 py-md-5 my-md-2 my-lg-5 mx-auto" style="max-width:536px">
                    <h1 class="pt-xl-4 mb-4">Cảm ơn bạn đã đặt hàng!</h1>
                    <p class="text-dark-emphasis pb-3 pb-sm-4">Đơn hàng <span class="fw-semibold">#234000</span> đã được
                        chấp nhận và sẽ được xử lý sớm. Dự kiến thời gian nhận hàng trước <span class="fw-semibold">Chủ
                            Nhật, ngày 9 tháng 11 năm 2025.</span></p>
                    <a class="btn btn-lg btn-dark rounded-pill mb-xl-4" href="{{ route('frontend.home') }}">Tiếp tục mua
                        sắm</a>
                </div>
               
            </div>
        </section>
    </main>
@endsection