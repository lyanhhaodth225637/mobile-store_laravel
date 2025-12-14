@extends('layouts.frontend.app')
@section('title', "$loaisanpham->tenloai")
@section('content')
    <!-- Page content -->
    <main class="content-wrapper">
        <nav class="container pt-3 my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
        </nav>
        <h1 class="h3 container mb-3">{{ $loaisanpham->tenloai }}</h1>
        <br>

        <section class="container mb-5">
            <div class="row g-4">
                <!-- Sidebar Filter -->
                <aside class="col-lg-3">
                    <div class="bg-white rounded-3 p-4 sticky-top" style="top: 20px;">
                        <h5 class="fw-bold mb-4">Bộ lọc sản phẩm</h5>

                        <form id="filterForm" method="GET"
                            action="{{ route('frontend.sanpham.loc', ['tenloai_slug' => $loaisanpham->tenloai_slug]) }}">

                            <!-- Brand Filter -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3">Hãng sản xuất</h6>
                                <select class="form-select fs-sm" name="hangsanxuat" id="hangsanxuat">
                                    <option value="">-- Chọn hãng sản xuất --</option>
                                    @foreach($hangsanxuat as $hsx)
                                        <option value="{{ $hsx->id }}" @if(request()->filled('hangsanxuat') && request('hangsanxuat') == $hsx->id) selected @endif>
                                            {{ $hsx->tenhang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <hr class="my-4">

                            <!-- Price Filter -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3">Mức giá</h6>
                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="priceAll" name="mucgia" value=""
                                            @if(!request()->filled('mucgia')) checked @endif>
                                        <label class="form-check-label fs-sm" for="priceAll">
                                            Tất cả
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="priceLow" name="mucgia"
                                            value="0-5000000" @if(request('mucgia') == '0-5000000') checked @endif>
                                        <label class="form-check-label fs-sm" for="priceLow">
                                            Dưới 5 triệu
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="priceMid1" name="mucgia"
                                            value="5000000-10000000" @if(request('mucgia') == '5000000-10000000') checked
                                            @endif>
                                        <label class="form-check-label fs-sm" for="priceMid1">
                                            Từ 5 - 10 triệu
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="priceMid2" name="mucgia"
                                            value="10000000-20000000" @if(request('mucgia') == '10000000-20000000') checked
                                            @endif>
                                        <label class="form-check-label fs-sm" for="priceMid2">
                                            Từ 10 - 20 triệu
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="priceHigh" name="mucgia"
                                            value="20000000-" @if(request('mucgia') == '20000000-') checked @endif>
                                        <label class="form-check-label fs-sm" for="priceHigh">
                                            Trên 20 triệu
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- trangthai Filter -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3">Tình trạng</h6>
                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="trangthaiAll" name="trangthai"
                                            value="" @if(!request()->filled('trangthai')) checked @endif>
                                        <label class="form-check-label fs-sm" for="trangthaiAll">
                                            Tất cả
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="trangthaiInStock" name="trangthai"
                                            value="1" @if(request('trangthai') == '1') checked @endif>
                                        <label class="form-check-label fs-sm" for="trangthaiInStock">
                                            <i class="ci-check-circle text-success me-2"></i>Đang bán
                                        </label>
                                    </div>

                                    <div class="form-check" hidden>
                                        <input class="form-check-input" type="radio" id="trangthaiOutStock" name="trangthai"
                                            value="0" @if(request()->filled('trangthai') && request('trangthai') == '0')
                                            checked @endif>
                                        <label class="form-check-label fs-sm" for="trangthaiOutStock">
                                            <i class="ci-close-circle text-danger me-2"></i>Ngưng bán
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="trangthaiPreorder" name="trangthai"
                                            value="2" @if(request('trangthai') == '2') checked @endif>
                                        <label class="form-check-label fs-sm" for="trangthaiPreorder">
                                            <i class="ci-clock text-warning me-2"></i>Đặt trước
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Promotion Filter -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3">Khuyến mãi</h6>
                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="khuyenmaiAll" name="khuyenmai"
                                            value="" @if(!request()->filled('khuyenmai')) checked @endif>
                                        <label class="form-check-label fs-sm" for="khuyenmaiAll">
                                            Tất cả
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="hasPromo" name="khuyenmai"
                                            value="1" @if(request('khuyenmai') == '1') checked @endif>
                                        <label class="form-check-label fs-sm" for="hasPromo">
                                            <i class="ci-lightning text-warning me-2"></i>Có khuyến mãi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="khuyenmai10" name="khuyenmai"
                                            value="10" @if(request('khuyenmai') == '10') checked @endif>
                                        <label class="form-check-label fs-sm" for="khuyenmai10">
                                            Giảm 10%+
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="khuyenmai20" name="khuyenmai"
                                            value="20" @if(request('khuyenmai') == '20') checked @endif>
                                        <label class="form-check-label fs-sm" for="khuyenmai20">
                                            Giảm 20%+
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="khuyenmai30" name="khuyenmai"
                                            value="30" @if(request('khuyenmai') == '30') checked @endif>
                                        <label class="form-check-label fs-sm" for="khuyenmai30">
                                            Giảm 30%+
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- sapxep Options -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3">Sắp xếp</h6>
                                <select class="form-select form-select-sm" id="sapxepSelect" name="sapxep">
                                    <option value="newest" @if(!request()->filled('sapxep') || request('sapxep') == 'newest')
                                    selected @endif>Mới nhất</option>
                                    <option value="price-low" @if(request('sapxep') == 'price-low') selected @endif>Giá: Thấp
                                        đến cao</option>
                                    <option value="price-high" @if(request('sapxep') == 'price-high') selected @endif>Giá: Cao
                                        đến thấp</option>
                                    <option value="popular" @if(request('sapxep') == 'popular') selected @endif>Phổ biến nhất
                                    </option>
                                    <option value="rating" @if(request('sapxep') == 'rating') selected @endif>Đánh giá cao
                                        nhất</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary w-100 fw-semibold btn-sm">
                                    <i class="ci-check me-2"></i>Áp dụng
                                </button>
                                <a href="{{ route('frontend.sanpham.loc', ['tenloai_slug' => $loaisanpham->tenloai_slug]) }}"
                                    class="btn btn-outline-secondary w-100 fw-semibold btn-sm">
                                    <i class="ci-trash me-2"></i>Xóa
                                </a>
                            </div>
                        </form>
                    </div>
                </aside>

                <!-- Products Grid -->
                <div class="col-lg-9">
                    <!-- Filter Results Info -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <p class="text-body-secondary mb-0">
                                Hiển thị <span id="resultCount">{{ $sanpham->count() }}</span> sản phẩm
                            </p>
                        </div>
                        <button class="btn btn-icon btn-sm btn-outline-secondary d-lg-none" data-bs-toggle="offcanvas"
                            data-bs-target="#filterOffcanvas">
                            <i class="ci-sliders-horizontal"></i> Lọc
                        </button>
                    </div>

                    <!-- Products Grid -->
                    <div class="row row-cols-2 row-cols-md-3 g-4" id="productsGrid">
                        @foreach ($sanpham as $sp)
                                            <div class="col">
                                                <div class="product-card animate-underline hover-effect-opacity bg-body rounded">
                                                    <div class="position-relative">
                                                        <div class="position-absolute top-0 end-0 z-2 hover-effect-target opacity-0 mt-3 me-3">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button type="button"
                                                                    class="btn btn-icon btn-secondary animate-pulse d-none d-lg-inline-flex">
                                                                    <i class="ci-heart fs-base animate-target"></i>
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-icon btn-secondary animate-rotate d-none d-lg-inline-flex">
                                                                    <i class="ci-refresh-cw fs-base animate-target"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown d-lg-none position-absolute top-0 end-0 z-2 mt-2 me-2">
                                                            <button type="button" class="btn btn-icon btn-sm btn-secondary bg-body"
                                                                data-bs-toggle="dropdown">
                                                                <i class="ci-more-vertical fs-lg"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end fs-xs p-2" style="min-width:auto">
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i class="ci-heart fs-sm ms-n1 me-2"></i>
                                                                        Thêm vào
                                                                        yêu thích</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ci-refresh-cw fs-sm ms-n1 me-2"></i> So
                                                                        sánh</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="{{ route('frontend.sanpham.chitiet', [
                                'tenloai_slug' => $sp->loaisanpham->tenloai_slug,
                                'tensanpham_slug' => $sp->tensanpham_slug
                            ]) }}">
                                                            @if($sp->khuyenmai > 0)

                                                                <Span
                                                                    class="badge bg-danger position-absolute top-3 start-0 mt-5 ms-2 mt-lg-3 ms-lg-3 z-3">
                                                                    -{{ $sp->khuyenmai }}%</Span>
                                                            @else

                                                            @endif

                                                            <div class="ratio" style="--cz-aspect-ratio:calc(240 / 258 * 100%)">
                                                                <img src="{{ asset('storage/' . $sp->hinhanh) }}" />
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3">
                                                        
                                                        <h3 class="pb-1 mb-2">
                                                            <a class="d-block fs-sm fw-medium text-truncate" href="{{ route('frontend.sanpham.chitiet', [
                                'tenloai_slug' => $sp->loaisanpham->tenloai_slug,
                                'tensanpham_slug' => $sp->tensanpham_slug
                            ]) }}">
                                                                <span class="animate-target">{{ $sp->tensanpham }}</span>
                                                            </a>
                                                        </h3>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            @if ($sp->khuyenmai > 0)
                                                                <div class="h5 lh-1 mb-0">{{ number_format($sp->gia_khuyenmai, 0, ',', '.') }} <del
                                                                        class="text-body-tertiary fs-sm fw-normal">{{ number_format($sp->gia, 0, ',', '.') }}</del>
                                                                </div>
                                                            @else
                                                                <div class="h5 lh-1 mb-0">{{ number_format($sp->gia, 0, ',', '.') }} </div>
                                                            @endif

                                                            <form action="{{ route('frontend.giohang.them') }}" method="POST"
                                                                class="add-to-cart-form">
                                                                @csrf
                                                                <input type="hidden" name="tensanpham_slug" value="{{ $sp->tensanpham_slug }}">
                                                                @if($sp->trangthai == 1)
                                                                    <button type="submit"
                                                                        class="product-card-button btn btn-icon btn-secondary animate-slide-end ms-2 position-relative">
                                                                        <i class="ci-shopping-cart fs-base"></i>
                                                                    </button>
                                                                @elseif($sp->trangthai == 0)
                                                                    <span>Ngưng bán</span>
                                                                @elseif($sp->trangthai == 2)
                                                                    <span>Đặt trước</span>
                                                                @endif

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        @endforeach

                    </div>

                    <nav class="pt-4 mt-2 mt-sm-3" aria-label="Pagination">
                        {{ $sanpham->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
            </div>
        </section>
    </main>

@endsection
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Xử lý sự kiện thêm vào giỏ hàng
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // Chặn load lại trang

                    // Gửi Ajax
                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: new FormData(this)
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // 1. Cập nhật số lượng trên icon giỏ hàng
                                document.querySelectorAll('.cart-count').forEach(el => {
                                    el.textContent = data.count;
                                });

                                // 2. Nếu Offcanvas giỏ hàng đang mở thì reload lại nội dung
                                const offcanvas = document.getElementById('shoppingCart');
                                if (offcanvas && offcanvas.classList.contains('show')) {
                                    location.reload();
                                }

                                // 3. Hiển thị thông báo thành công (Toast)
                                showToast(data.message);
                            }
                        })
                        .catch(err => console.error('Lỗi AJAX:', err));
                });
            });
        });

        // Hàm hiển thị Toast chuẩn, tự đóng sau 3s
        function showToast(message) {
            const toastHTML = `
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
                        <div class="toast align-items-center text-white bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body fw-medium">
                                    <i class="ci-check-circle me-2"></i> ${message}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>`;

            const wrapper = document.createElement('div');
            wrapper.innerHTML = toastHTML;
            document.body.appendChild(wrapper);

            const toastEl = wrapper.querySelector('.toast');
            const bsToast = new bootstrap.Toast(toastEl, {
                delay: 3000,
                autohide: true
            });

            bsToast.show();

            toastEl.addEventListener('hidden.bs.toast', () => wrapper.remove());
        }
    </script>
@endsection