@extends('layouts.frontend.app')
@section('title', 'Trang chủ')
@section('content')
    <!-- Page content -->
    <main class="content-wrapper">
        <!-- Hero slider -->
        <section class="container pt-3 mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="position-relative">
                        <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none-dark rtl-flip"
                            style="background:linear-gradient(90deg, #accbee 0%, #e7f0fd 100%)"></span>
                        <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none d-block-dark rtl-flip"
                            style="background:linear-gradient(90deg, #1b273a 0%, #1f2632 100%)"></span>
                        <div class="row justify-content-center position-relative z-2">
                            <div class="col-xl-5 col-xxl-4 offset-xxl-1 d-flex align-items-center mt-xl-n3">
                                <!-- Text content master slider -->
                                <div class="swiper px-5 pe-xl-0 ps-xxl-0 me-xl-n5"
                                    data-swiper='{"spaceBetween": 64, "loop": true, "speed": 400, "controlSlider": "#sliderImages", "autoplay": {"delay": 5500, "disableOnInteraction": false}, "scrollbar": {"el": ".swiper-scrollbar"}}'>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                            <p class="text-body">Cảm nhận âm thanh thực sự</p>
                                            <h2 class="display-4 pb-2 pb-xl-4">Headphones ProMax</h2>
                                            <a class="btn btn-lg btn-primary" href="#">
                                                Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                            </a>
                                        </div>
                                        <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                            <p class="text-body">Ưu đãi trong tuần</p>
                                            <h2 class="display-4 pb-2 pb-xl-4">Powerful iPad Pro M2</h2>
                                            <a class="btn btn-lg btn-primary" href="#">
                                                Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                            </a>
                                        </div>
                                        <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                            <p class="text-body">Kính thực tế ảo</p>
                                            <h2 class="display-4 pb-2 pb-xl-4">Experience New Reality</h2>
                                            <a class="btn btn-lg btn-primary" href="#">
                                                Mua ngay <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 col-sm-7 col-md-6 col-lg-5 col-xl-7">
                                <!-- Binded images (controlled slider) -->
                                <div class="swiper user-select-none" id="sliderImages"
                                    data-swiper='{"allowTouchMove": false, "loop": true, "effect": "fade", "fadeEffect": {"crossFade": true}}'>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide d-flex justify-content-end">
                                            <div class="ratio rtl-flip"
                                                style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                                <img src="{{ asset('assets/img/slider/01.png') }}" alt="Image" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide d-flex justify-content-end">
                                            <div class="ratio rtl-flip"
                                                style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                                <img src="{{ asset('assets/img/slider/02.png') }}" alt="Image" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide d-flex justify-content-end">
                                            <div class="ratio rtl-flip"
                                                style="max-width:495px; --cz-aspect-ratio:calc(537 / 495 * 100%)">
                                                <img src="{{ asset('assets/img/slider/03.png') }}" alt="Image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Scrollbar -->
                        <div class="row justify-content-center" data-bs-theme="dark">
                            <div class="col-xxl-10">
                                <div class="position-relative mx-5 mx-xxl-0">
                                    <div class="swiper-scrollbar mb-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Brands -->
        <section class="container mb-2">
            <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false">
                <div class="row row-cols-6 g-0" style="min-width:960px">
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('assets/img/brands/apple-light-mode.svg') }}" class="d-none-dark"
                                alt="Apple" />
                            <img src="{{ asset('assets/img/brands/apple-dark-mode.svg') }}" class="d-none d-block-dark"
                                alt="Apple" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('assets/img/brands/motorola-light-mode.svg') }}" class="d-none-dark"
                                alt="Motorola" />
                            <img src="{{ asset('assets/img/brands/motorola-dark-mode.svg') }}" class="d-none d-block-dark"
                                alt="Motorola" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('assets/img/brands/xiaomi-light-mode.svg') }}" class="d-none-dark"
                                alt="Xiaomi" />
                            <img src="{{ asset('assets/img/brands/xiaomi-dark-mode.svg') }}" class="d-none d-block-dark"
                                alt="Xiaomi" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('assets/img/brands/canon-light-mode.svg') }}" class="d-none-dark"
                                alt="Canon" />
                            <img src="{{ asset('assets/img/brands/canon-dark-mode.svg') }}" class="d-none d-block-dark"
                                alt="Canon" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('assets/img/brands/samsung-light-mode.svg') }}" class="d-none-dark"
                                alt="Samsung" />
                            <img src="{{ asset('assets/img/brands/samsung-dark-mode.svg') }}" class="d-none d-block-dark"
                                alt="Samsung" />
                        </a>
                    </div>
                    <div class="col">
                        <a class="d-flex justify-content-center py-3 px-2 px-xl-3" href="#">
                            <img src="{{ asset('assets/img/brands/sony-light-mode.svg') }}" class="d-none-dark"
                                alt="Sony" />
                            <img src="{{ asset('assets/img/brands/sony-dark-mode.svg') }}" class="d-none d-block-dark"
                                alt="Sony" />
                        </a>
                    </div>
                </div>
            </div>
        </section>

        @foreach ($loaisanpham as $lsp)
            <!-- Products (Grid) Điện thoại -->
            <section class="container pt-2 mt-2 mb-3">
                <!-- Heading -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3 pb-md-4">
                    <h2 class="h3 mb-0">{{ $lsp->tenloai }}</h2>
                    <div class="nav ms-3">
                        <a class="nav-link animate-underline px-0 py-2"
                            href=" {{ route('frontend.sanpham.phanloai', ['tenloai_slug' => $lsp->tenloai_slug]) }}">
                            <span class="animate-target">Xem tất cả</span> <i class="ci-chevron-right fs-base ms-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Product grid -->

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pt-4">
                    <!-- Item -->
                    @foreach ($lsp->SanPham as $sp)
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
                                                    <a class="dropdown-item" href="#"><i class="ci-heart fs-sm ms-n1 me-2"></i> Thêm vào
                                                        yêu thích</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i class="ci-refresh-cw fs-sm ms-n1 me-2"></i> So
                                                        sánh</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="{{ route('frontend.sanpham.chitiet', [
                            'tenloai_slug' => $sp->loaisanpham->tenloai_slug,
                            'tensanpham_slug' => $sp->tensanpham_slug
                        ]) }}">
                                            @if($sp->khuyenmai > 0)
                                                <span
                                                    class="badge bg-info position-absolute top-0 start-0 mt-2 ms-2 mt-lg-3 ms-lg-3 z-3">New</span>
                                                <Span class="badge bg-danger position-absolute top-3 start-0 mt-5 ms-2 mt-lg-3 ms-lg-3 z-3">
                                                    -{{ $sp->khuyenmai }}%</Span>
                                            @else
                                                <span
                                                    class="badge bg-info position-absolute top-0 start-0 mt-2 ms-2 mt-lg-3 ms-lg-3 z-3">New</span>
                                            @endif

                                            <div class="ratio" style="--cz-aspect-ratio:calc(240 / 258 * 100%)">
                                                <img src="{{ asset('storage/' . $sp->hinhanh) }}" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <div class="d-flex gap-1 fs-xs">
                                                <i class="ci-star-filled text-warning"></i>
                                                <i class="ci-star-filled text-warning"></i>
                                                <i class="ci-star-filled text-warning"></i>
                                                <i class="ci-star-filled text-warning"></i>
                                                <i class="ci-star text-body-tertiary opacity-75"></i>
                                            </div>
                                            <span class="text-body-tertiary fs-xs">(123)</span>
                                        </div>
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

                                            <form action="{{ route('frontend.giohang.them') }}" method="POST" class="add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="tensanpham_slug" value="{{ $sp->tensanpham_slug }}">

                                                <button type="submit"
                                                    class="product-card-button btn btn-icon btn-secondary animate-slide-end ms-2 position-relative">
                                                    <i class="ci-shopping-cart fs-base"></i>
                                                    
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </section>
        @endforeach
    </main>
@endsection

{{-- Thay toàn bộ đoạn cũ của bạn bằng đoạn này --}}
@section('javascript')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const button = this.querySelector('button');
                    const badge = button.querySelector('.added-notice');

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
                                // Cập nhật số lượng giỏ hàng ở header/offcanvas
                                document.querySelectorAll('.cart-count').forEach(el => {
                                    el.textContent = data.count;
                                });

                                // Hiệu ứng tick xanh
                                badge.classList.remove('d-none');
                                setTimeout(() => badge.classList.add('d-none'), 2000);

                                // Nếu offcanvas đang mở → reload để cập nhật (hoặc nâng cao hơn là AJAX load)
                                const offcanvas = document.getElementById('shoppingCart');
                                if (offcanvas && offcanvas.classList.contains('show')) {
                                    location.reload();
                                }

                                // Toast thông báo đẹp như Shopee
                                showToast(data.message);
                            }
                        })
                        .catch(err => console.error('Lỗi AJAX:', err));
                });
            });
        });

        // Hàm toast chuẩn Bootstrap 5 – đẹp lung linh
        function showToast(message) {
            const toastHTML = `
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
                    <div class="toast align-items-center text-white bg-success border-0 shadow-lg" role="alert">
                        <div class="d-flex">
                            <div class="toast-body fw-medium">
                                ${message}
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