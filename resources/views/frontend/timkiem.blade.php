@extends('layouts.frontend.app')
@section('title', "Tìm kiếm")
@section('content')
    <!-- Page content -->
    <main class="content-wrapper">
        <nav class="container pt-3 my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
        </nav>
        <h1 class="h3 container mb-3">Kết quả tìm kiếm</h1>
        <br>
        <section class="container mb-5">
            <div class="row g-4">
                <!-- Products Grid -->
                <div class="col-lg-12">
                    <!-- Filter Results Info -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="text-body-secondary mb-0">
                            Hiển thị <span id="resultCount">{{ $sanpham->count() }}</span> sản phẩm
                        </p>
                        <button class="btn btn-icon btn-sm btn-outline-secondary d-lg-none" data-bs-toggle="offcanvas"
                            data-bs-target="#filterOffcanvas">
                            <i class="ci-sliders-horizontal"></i> Lọc
                        </button>
                    </div>

                    <!-- Products Grid - 4 Columns -->
                    <div class="row row-cols-2 row-cols-md-4 g-4" id="productsGrid">
                        @foreach ($sanpham as $sp)
                                            <div class="col">
                                                <div class="product-card animate-underline hover-effect-opacity bg-body rounded h-100">
                                                    <div class="position-relative">
                                                        <!-- Badge khuyến mãi -->
                                                        @if($sp->khuyenmai > 0)
                                                            <span class="badge bg-danger position-absolute top-0 start-0 m-2 z-3">
                                                                -{{ $sp->khuyenmai }}%
                                                            </span>
                                                        @endif

                                                        <!-- Hình sản phẩm -->
                                                        <a href="{{ route('frontend.sanpham.chitiet', [
                                'tenloai_slug' => $sp->loaisanpham->tenloai_slug,
                                'tensanpham_slug' => $sp->tensanpham_slug
                            ]) }}" class="d-block overflow-hidden">
                                                            <div class="ratio" style="--cz-aspect-ratio:calc(240 / 258 * 100%)">
                                                                <img src="{{ asset('storage/' . $sp->hinhanh) }}"
                                                                    class="w-100 h-100 object-fit-cover" alt="{{ $sp->tensanpham }}">
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="p-2 p-sm-3">
                                                        <!-- Tên sản phẩm -->
                                                        <h3 class="fs-sm fw-medium text-truncate mb-2">
                                                            <a href="{{ route('frontend.sanpham.chitiet', [
                                'tenloai_slug' => $sp->loaisanpham->tenloai_slug,
                                'tensanpham_slug' => $sp->tensanpham_slug
                            ]) }}">{{ $sp->tensanpham }}</a>
                                                        </h3>

                                                        <!-- Giá -->
                                                        <div class="mb-2">
                                                            @if($sp->khuyenmai > 0)
                                                                <span class="h6 text-danger">{{ number_format($sp->gia_khuyenmai, 0, ',', '.') }}
                                                                    VNĐ</span>
                                                                <del class="text-muted">{{ number_format($sp->gia, 0, ',', '.') }} VNĐ</del>
                                                            @else
                                                                <span class="h6">{{ number_format($sp->gia, 0, ',', '.') }} VNĐ</span>
                                                            @endif
                                                        </div>

                                                        <!-- Đánh giá -->
                                                        <div class="d-flex align-items-center gap-1 mb-2 fs-xs">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $sp->avg_rating)
                                                                    <i class="ci-star-filled text-warning"></i>
                                                                @else
                                                                    <i class="ci-star text-muted"></i>
                                                                @endif
                                                            @endfor
                                                            <span class="text-body-tertiary">({{ $sp->danhgia_count ?? 0 }})</span>
                                                        </div>

                                                        <!-- Nút mua / trạng thái -->
                                                        @if($sp->trangthai == 1)
                                                            <form action="{{ route('frontend.giohang.them') }}" method="POST"
                                                                class="add-to-cart-form">
                                                                @csrf
                                                                <input type="hidden" name="tensanpham_slug" value="{{ $sp->tensanpham_slug }}">
                                                                <button type="submit" class="btn btn-sm btn-primary w-100">
                                                                    <i class="ci-shopping-cart"></i> Thêm vào giỏ
                                                                </button>
                                                            </form>
                                                        @elseif($sp->trangthai == 0)
                                                            <span class="badge bg-secondary w-100 text-center">Ngưng bán</span>
                                                        @elseif($sp->trangthai == 2)
                                                            <span class="badge bg-info w-100 text-center">Đặt trước</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                        @endforeach
                    </div>

                    <!-- Phân trang -->
                    <div class="mt-4">
                        {{ $sanpham->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </section>
    </main>

@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.add-to-cart-form');

            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const button = this.querySelector('button[type="submit"]');
                    const originalText = button.innerHTML;
                    button.disabled = true;
                    button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Đang thêm...';

                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new FormData(this)
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Cập nhật số lượng giỏ hàng
                                document.querySelectorAll('.cart-count').forEach(el => {
                                    el.textContent = data.count;
                                });

                                // Hiển thị thông báo
                                showToast(data.message, 'success');

                                // Reset button
                                button.disabled = false;
                                button.innerHTML = originalText;
                            }
                        })
                        .catch(err => {
                            console.error('Lỗi:', err);
                            showToast('Có lỗi xảy ra khi thêm vào giỏ hàng!', 'danger');
                            button.disabled = false;
                            button.innerHTML = originalText;
                        });
                });
            });
        });

        function showToast(message, type = 'success') {
            const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
            const icon = type === 'success' ? 'ci-check-circle' : 'ci-close-circle';

            const toastHTML = `
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
                        <div class="toast align-items-center text-white ${bgClass} border-0 shadow-lg" role="alert">
                            <div class="d-flex">
                                <div class="toast-body fw-medium">
                                    <i class="${icon} me-2"></i> ${message}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                            </div>
                        </div>
                    </div>`;

            const wrapper = document.createElement('div');
            wrapper.innerHTML = toastHTML;
            document.body.appendChild(wrapper);

            const toastEl = wrapper.querySelector('.toast');
            const bsToast = new bootstrap.Toast(toastEl, { delay: 3000 });
            bsToast.show();

            toastEl.addEventListener('hidden.bs.toast', () => wrapper.remove());
        }
    </script>
@endsection