@extends('layouts.frontend.app')
@section('title', '403 - Truy cập bị từ chối')
@section('content')
    <!-- Page content -->
    <main class="content-wrapper">
        <div class="container py-5 mb-lg-3">
            <div class="row justify-content-center pt-lg-4 text-center">
                <div class="col-lg-5 col-md-7 col-sm-9">
                    <!-- Error code -->
                    <h1 class="display-1 text-primary mb-4" style="font-size: 7rem; font-weight: 300;">403</h1>

                    <!-- Error icon -->
                    <div class="mb-4">
                        <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="d-inline-block">
                            <circle cx="60" cy="60" r="55" stroke="#fe696a" stroke-width="4" fill="none" opacity="0.2" />
                            <path
                                d="M60 30C43.43 30 30 43.43 30 60C30 76.57 43.43 90 60 90C76.57 90 90 76.57 90 60C90 43.43 76.57 30 60 30ZM60 82C47.85 82 38 72.15 38 60C38 47.85 47.85 38 60 38C72.15 38 82 47.85 82 60C82 72.15 72.15 82 60 82Z"
                                fill="#fe696a" />
                            <path
                                d="M60 45C58.34 45 57 46.34 57 48V60C57 61.66 58.34 63 60 63C61.66 63 63 61.66 63 60V48C63 46.34 61.66 45 60 45Z"
                                fill="#fe696a" />
                            <circle cx="60" cy="72" r="3" fill="#fe696a" />
                        </svg>
                    </div>

                    <!-- Error title -->
                    <h2 class="h4 mb-3">Truy cập bị từ chối!</h2>

                    <!-- Error message -->
                    <p class="text-muted pb-2">
                        Xin lỗi, bạn không có quyền truy cập vào trang này.
                        Vui lòng liên hệ quản trị viên nếu bạn cho rằng đây là lỗi.
                    </p>

                   

                    <!-- Help text -->
                    <div class="pt-5 mt-2">
                        <p class="text-muted small mb-0">
                            Cần trợ giúp?
                            <a href="{{ route('frontend.lienhe') }}" class="text-decoration-underline">Liên hệ với chúng tôi</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection