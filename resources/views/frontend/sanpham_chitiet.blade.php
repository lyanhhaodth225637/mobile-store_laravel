@extends('layouts.frontend.app')

@section('title', 'Chi tiết sản phẩm')

@section('styles')
    <style>
        #star-rating {
            gap: 12px;
        }

        #star-rating i {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        #star-rating i:hover {
            transform: scale(1.3);
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <!-- Page content -->
    <main class="content-wrapper">
        <nav class="container pt-3 my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                <li class="breadcrumb-item active">Chi tiết</li>
            </ol>
        </nav>

        <h1 class="h3 container mb-3">{{ $sanpham->tensanpham }}</h1>

        <section class="container position-relative z-2 pb-4 pb-md-5 mb-2 mb-md-0">
            <div class="border-bottom">
                <ul class="nav nav-underline flex-nowrap gap-4" id="productTabs" role="tablist">
                    <li class="nav-item me-sm-2" role="presentation">
                        <a class="nav-link active" id="basic-tab" data-bs-toggle="tab" href="#basic" role="tab">
                            Thông tin cơ bản
                        </a>
                    </li>
                    <li class="nav-item me-sm-2" role="presentation">
                        <a class="nav-link" id="specs-tab" data-bs-toggle="tab" href="#specs" role="tab">
                            Thông số kỹ thuật
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab">
                            Đánh giá ({{ $soBinhLuan }})
                        </a>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Product details + Sticky sidebar -->
        <section class="container pb-2 mb-2 mb-md-3">
            <div class="row">
                <!-- Sticky product preview (desktop) -->
                <aside class="col-md-5 col-xl-4 offset-xl-1 order-md-2 mb-5 mb-md-0" id="scrollPastPoint"
                    style="margin-top:-100px">
                    <div class="position-sticky top-0 ps-md-3 ps-lg-4 ps-xl-0" style="padding-top:100px">
                        <div class="border rounded p-3 p-lg-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="ratio ratio-1x1 flex-shrink-0" style="width:110px">
                                    <img src="{{ asset('storage/' . $sanpham->hinhanh) }}" width="110" alt="iPhone 14" />
                                </div>
                                <div class="w-100 min-w-0 ps-2 ps-sm-3">

                                    <h4 class="fs-sm fw-medium mb-2">{{ $sanpham->tensanpham }}</h4>
                                    @if ($sanpham->khuyenmai > 0 && $sanpham->gia_khuyenmai)
                                        <div class="h5 mb-0">
                                            <del class="text-muted me-2 fs-6">{{ number_format($sanpham->gia, 0, ',', '.') }}
                                                ₫</del>
                                            <span class="badge bg-danger ms-2">-{{ $sanpham->khuyenmai }}%</span>

                                            <br>
                                            <span class="text-danger">{{ number_format($sanpham->gia_khuyenmai, 0, ',', '.') }}
                                                ₫</span>
                                        </div>
                                    @else
                                        <div class="h5 mb-0">{{ number_format($sanpham->gia, 0, ',', '.') }} ₫</div>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex gap-2 gap-lg-3">
                                <!-- Form thêm giỏ hàng -->
                                <form action="{{ route('frontend.giohang.them') }}" method="POST"
                                    class="add-to-cart-form flex-grow-1">
                                    @csrf
                                    <input type="hidden" name="tensanpham_slug" value="{{ $sanpham->tensanpham_slug }}">

                                    @if($sanpham->trangthai == 1)
                                        <button type="submit" class="btn btn-primary w-100 animate-slide-end">
                                            <i class="ci-shopping-cart fs-base animate-target ms-n1 me-2"></i>
                                            Thêm vào giỏ hàng
                                        </button>
                                    @elseif($sanpham->trangthai == 0)
                                        <span class="badge bg-secondary w-100 d-block text-center py-2">Ngưng bán</span>
                                    @elseif($sanpham->trangthai == 2)
                                        <span class="badge bg-warning text-dark w-100 d-block text-center py-2">Đặt trước</span>
                                    @endif
                                </form>

                                <!-- Nút yêu thích -->
                                <button type="button" class="btn btn-icon btn-secondary animate-pulse"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm"
                                    data-bs-title="Thêm vào yêu thích">
                                    <i class="ci-heart fs-base animate-target"></i>
                                </button>

                                <!-- Nút so sánh -->
                                <button type="button" class="btn btn-icon btn-secondary animate-rotate"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm"
                                    data-bs-title="So sánh">
                                    <i class="ci-refresh-cw fs-base animate-target"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Mobile sticky banner -->
                <section class="sticky-product-banner sticky-top d-md-none start-0 ms-n4" data-sticky-element>
                    <div class="sticky-product-banner-inner start-0 pt-5">
                        <div class="vw-100 bg-body border-bottom border-light border-opacity-10 shadow pt-4 pb-2">
                            <div class="container d-flex align-items-center">
                                <div class="d-flex align-items-center min-w-0 ms-n2 me-3">
                                    <div class="ratio ratio-1x1 flex-shrink-0" style="width:50px">
                                        <img src="assets/img/shop/10.png" alt="iPhone 14" />
                                    </div>
                                    <div class="w-100 min-w-0 ps-2">
                                        <h4 class="fs-sm fw-medium text-truncate mb-1">{{ $sanpham->tensanpham }}</h4>
                                        <div class="h6 mb-0">{{ $sanpham->gia }}</div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 ms-auto">
                                    <button type="button" class="btn btn-icon btn-secondary animate-pulse">
                                        <i class="ci-heart fs-base animate-target"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary animate-slide-end d-none d-sm-inline-flex">
                                        <i class="ci-shopping-cart fs-base animate-target ms-n1 me-2"></i> Thêm vào giỏ hàng
                                    </button>
                                    <button type="button" class="btn btn-icon btn-primary animate-slide-end d-sm-none">
                                        <i class="ci-shopping-cart fs-lg animate-target"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tab content -->
                <div class="col-md-7 order-md-1 tab-content" id="productTabContent">
                    <!-- Thông tin cơ bản -->
                    <div class="tab-pane fade show active" id="basic" role="tabpanel">
                        <h2 class="h3 pb-2 pb-md-3">Thông tin cơ bản</h2>
                        <h5>{{ $sanpham->tensanpham }}</h5>
                        <h6>Đã bán: {{ $sanpham->daban }} sản phẩm</h6>
                        @if($sanpham->mota)
                            <p>{{ $sanpham->mota }}</p>
                        @else
                            <p>Sản phẩm đang cập nhật</p>
                        @endif
                    </div>
                    <!-- Thông số kỹ thuật -->
                    <div class="tab-pane fade" id="specs" role="tabpanel">
                        <h2 class="h3 pb-2 pb-md-3">Thông số kỹ thuật</h2>
                        <h3 class="h6">Thông số chung</h3>
                        <ul class="list-unstyled d-flex flex-column gap-3 fs-sm pb-3 m-0 mb-2 mb-sm-3">
                            @foreach ($sanpham->thongso as $key => $value)
                                <li class="d-flex align-items-center position-relative pe-4">
                                    <span>{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                    <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                                    <span class="text-dark-emphasis fw-medium text-end">{{ $value }}.</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="alert d-flex alert-info" role="alert">
                            <i class="ci-info fs-lg pe-1 me-2" style="margin-top:.125rem"></i>
                            <div class="fs-sm">Thông số kỹ thuật có thể thay đổi mà không báo trước.</div>
                        </div>
                    </div>

                    <!-- Đánh giá -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <h2 class="h3 pb-2 pb-md-3">Đánh giá</h2>

                        <!-- Tổng quan đánh giá -->
                        <div class="d-flex align-items-center gap-3 mb-4 pb-2">
                            <div class="d-flex gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($trungBinhSao))
                                        <i class="ci-star-filled fs-base text-warning"></i>
                                    @elseif ($i - $trungBinhSao < 1)
                                        <i class="ci-star-half-filled fs-base text-warning"></i>
                                    @else
                                        <i class="ci-star fs-base text-body-tertiary opacity-75"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="h3 mb-0">{{ $trungBinhSao }}</span>
                            <span class="text-body-tertiary fs-sm pt-1">({{ $soBinhLuan }} đánh giá)</span>
                        </div>


                        <!-- Form viết đánh giá -->
                        <h3 class="h5 mb-3">Viết đánh giá của bạn</h3>
                        <form id="form-binhluan" method="POST" class="mb-5">
                            @csrf
                            <input type="hidden" name="sanpham_id" value="{{ $sanpham->id }}">
                            <input type="hidden" name="parent_id" value="">
                            <div class="row g-3">
                                <div class="col-12">
                                    <!-- Star Rating -->
                                    <div class="d-flex gap-3 mb-3" id="star-rating">
                                        <i class="ci-star fs-2 text-body-tertiary cursor-pointer" data-value="1"></i>
                                        <i class="ci-star fs-2 text-body-tertiary cursor-pointer" data-value="2"></i>
                                        <i class="ci-star fs-2 text-body-tertiary cursor-pointer" data-value="3"></i>
                                        <i class="ci-star fs-2 text-body-tertiary cursor-pointer" data-value="4"></i>
                                        <i class="ci-star fs-2 text-body-tertiary cursor-pointer" data-value="5"></i>
                                    </div>
                                    <input type="hidden" name="danhgia" id="so_sao_input" value="0">

                                    <textarea class="form-control" name="noidung" rows="5"
                                        placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm này..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary animate-slide-end">
                                        Gửi đánh giá
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Danh sách bình luận -->
                        <div id="ds-binhluan">
                            @foreach($binhluans as $binhluan)
                                <div class="border-bottom pb-4 mb-4">
                                    <div class="d-flex gap-3 mb-4">
                                        <img src="{{ asset('storage/' . $binhluan->user->hinhanh) }}" class="rounded-circle"
                                            style="object-fit: cover;
                                                                                                                                                width: 50px;
                                                                                                                                                height: 50px;"
                                            alt="Avatar" "
                                                                                                                    class="
                                            rounded-circle border border-2 border-primary" style="object-fit: cover;"
                                            alt="Avatar" />
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <div>
                                                    <h6 class="mb-1">{{ $binhluan->user->name }}</h6>
                                                    <div class="d-flex gap-1 fs-xs">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $binhluan->danhgia)
                                                                <i class="ci-star-filled text-warning"></i>
                                                            @else
                                                                <i class="ci-star text-body-tertiary opacity-75"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <span
                                                    class="text-body-tertiary fs-sm">{{ $binhluan->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="mb-2">{{ $binhluan->noidung }}</p>
                                            <!-- <div class="d-flex gap-3 fs-sm" hidden>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <i class="ci-thumbs-up me-1"></i> Hữu ích ()
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <i class="ci-thumbs-down me-1"></i> Không hữu ích
                                                    ()
                                                </button>
                                            </div> -->

                                            {{-- Hiển thị reply con nếu có --}}
                                            @if($binhluan->replies->count() > 0)
                                                <div class="mt-3 ps-4 border-start">
                                                    @foreach($binhluan->replies as $reply)
                                                        <div class="mb-2">
                                                            <strong>{{ $reply->user->name }}</strong>
                                                            <span
                                                                class="text-body-tertiary fs-sm">{{ $reply->created_at->diffForHumans() }}</span>
                                                            <p>{{ $reply->noidung }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </section>

        <!-- Sản phẩm liên quan -->
        <section class="container pb-5 mb-2 mb-md-3">
            <h2 class="h3 border-bottom pb-4 mb-4">Sản phẩm yêu thích</h2>
            <!-- Carousel giữ nguyên như cũ -->
            <div class="swiper"
                data-swiper='{"slidesPerView":2,"spaceBetween":24,"loop":true,"navigation":{"prevEl":".viewed-prev","nextEl":".viewed-next"},"breakpoints":{"768":{"slidesPerView":3},"992":{"slidesPerView":4}}}'>
                <div class="swiper-wrapper">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pt-4">
                        @foreach ($sanPhamYeuThich as $sp)
                            <div class="col">
                                <div class="product-card animate-underline hover-effect-opacity bg-body rounded">
                                    <div class="position-relative">
                                        <!-- Action buttons for desktop -->
                                        <div class="position-absolute top-0 end-0 z-2 hover-effect-target opacity-0 mt-3 me-3">
                                            <div class="d-flex flex-column gap-2">
                                                <button type="button"
                                                    class="btn btn-icon btn-secondary animate-pulse d-none d-lg-inline-flex"
                                                    aria-label="Yêu thích">
                                                    <i class="ci-heart fs-base animate-target"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-icon btn-secondary animate-rotate d-none d-lg-inline-flex"
                                                    aria-label="So sánh">
                                                    <i class="ci-refresh-cw fs-base animate-target"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Dropdown for mobile -->
                                        <div class="dropdown d-lg-none position-absolute top-0 end-0 z-2 mt-2 me-2">
                                            <button type="button" class="btn btn-icon btn-sm btn-secondary bg-body"
                                                data-bs-toggle="dropdown" aria-label="Tùy chọn">
                                                <i class="ci-more-vertical fs-lg"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end fs-xs p-2" style="min-width:auto">
                                                <li>
                                                    <a class="dropdown-item" href="#!">
                                                        <i class="ci-heart fs-sm ms-n1 me-2"></i> Yêu thích
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#!">
                                                        <i class="ci-refresh-cw fs-sm ms-n1 me-2"></i> So sánh
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Product image -->
                                        <a class="d-block rounded-top overflow-hidden p-3 p-sm-4"
                                            href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $sp->loaisanpham->tenloai_slug, 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                                            @if($sp->khuyenmai > 0)
                                                <span
                                                    class="badge bg-info position-absolute top-0 start-0 mt-2 ms-2 mt-lg-3 ms-lg-3 z-3">New</span>
                                                <span
                                                    class="badge bg-danger position-absolute top-0 start-0 mt-5 ms-2 mt-lg-5 ms-lg-3 z-3">-{{ $sp->khuyenmai }}%</span>
                                            @else
                                                <span
                                                    class="badge bg-info position-absolute top-0 start-0 mt-2 ms-2 mt-lg-3 ms-lg-3 z-3">New</span>
                                            @endif

                                            <div class="ratio" style="--cz-aspect-ratio:calc(240 / 258 * 100%)">
                                                <img src="{{ asset('storage/' . $sp->hinhanh) }}" alt="{{ $sp->tensanpham }}"
                                                    loading="lazy" />
                                            </div>
                                        </a>
                                    </div>

                                    <!-- Product info -->
                                    <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3">
                                        <!-- Rating -->


                                        <!-- Product name -->
                                        <h3 class="pb-1 mb-2">
                                            <a class="d-block fs-sm fw-medium text-truncate"
                                                href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $sp->loaisanpham->tenloai_slug, 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                                                <span class="animate-target">{{ $sp->tensanpham }}</span>
                                            </a>
                                        </h3>

                                        <!-- Price & Add to cart -->
                                        <div class="d-flex align-items-center justify-content-between">
                                            @if ($sp->khuyenmai > 0)
                                                <div class="h5 lh-1 mb-0">
                                                    {{ number_format($sp->gia_khuyenmai, 0, ',', '.') }}₫
                                                    <del
                                                        class="text-body-tertiary fs-sm fw-normal">{{ number_format($sp->gia, 0, ',', '.') }}₫</del>
                                                </div>
                                            @else
                                                <div class="h5 lh-1 mb-0">{{ number_format($sp->gia, 0, ',', '.') }}₫</div>
                                            @endif

                                            <form action="{{ route('frontend.giohang.them') }}" method="POST"
                                                class="add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="tensanpham_slug" value="{{ $sp->tensanpham_slug }}">
                                                @if($sp->trangthai == 1)
                                                    <button type="submit"
                                                        class="product-card-button btn btn-icon btn-secondary animate-slide-end ms-2"
                                                        aria-label="Thêm vào giỏ hàng">
                                                        <i class="ci-shopping-cart fs-base"></i>
                                                    </button>
                                                @elseif($sp->trangthai == 0)
                                                    <span class="badge bg-secondary">Ngưng bán</span>
                                                @elseif($sp->trangthai == 2)
                                                    <span class="badge bg-warning text-dark">Đặt trước</span>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ===================== Star Rating =====================
            const stars = document.querySelectorAll('#star-rating i');
            const ratingInput = document.getElementById('so_sao_input');

            function updateStars(rating) {
                stars.forEach(star => {
                    const value = parseInt(star.getAttribute('data-value'));
                    if (value <= rating) {
                        star.classList.remove('ci-star', 'text-body-tertiary');
                        star.classList.add('ci-star-filled', 'text-warning');
                    } else {
                        star.classList.remove('ci-star-filled', 'text-warning');
                        star.classList.add('ci-star', 'text-body-tertiary');
                    }
                });
                ratingInput.value = rating;
            }

            stars.forEach(star => {
                star.addEventListener('click', function () {
                    updateStars(this.getAttribute('data-value'));
                });
                star.addEventListener('mouseover', function () {
                    updateStars(this.getAttribute('data-value'));
                });
            });

            document.getElementById('star-rating').addEventListener('mouseleave', function () {
                updateStars(ratingInput.value || 0);
            });

            updateStars(0);

            // ===================== AJAX Submit Bình luận =====================
            const form = document.getElementById('binhluan-form');
            const commentList = document.getElementById('comment-list');

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Thông báo thành công
                            alert('Bình luận đã gửi!');

                            // Reset form
                            form.querySelector('textarea[name="noidung"]').value = '';
                            updateStars(0);

                            // Thêm bình luận mới vào danh sách
                            const comment = data.comment;
                            const newComment = `
                                                                                                        <div class="d-flex gap-3 mb-4">
                                                                                                            <img class="rounded-circle flex-shrink-0" src="assets/img/avatars/01.jpg" width="48" alt="Avatar">
                                                                                                            <div class="flex-grow-1">
                                                                                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                                                                                    <div>
                                                                                                                        <h6 class="mb-1">Bạn</h6>
                                                                                                                        <div class="d-flex gap-1 fs-xs">
                                                                                                                            ${'<i class="ci-star-filled text-warning"></i>'.repeat(comment.danhgia)}
                                                                                                                            ${'<i class="ci-star text-body-tertiary opacity-75"></i>'.repeat(5 - comment.danhgia)}
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <span class="text-body-tertiary fs-sm">Vừa xong</span>
                                                                                                                </div>
                                                                                                                <p class="mb-2">${comment.noidung}</p>
                                                                                                                <div class="d-flex gap-3 fs-sm">
                                                                                                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                                                                        <i class="ci-thumbs-up me-1"></i> Hữu ích (0)
                                                                                                                    </button>
                                                                                                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                                                                        <i class="ci-thumbs-down me-1"></i> Không hữu ích (0)
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    `;
                            commentList.insertAdjacentHTML('afterbegin', newComment);
                        } else {
                            alert('Gửi bình luận thất bại!');
                        }
                    })
                    .catch(err => console.log(err));
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('#star-rating i');
            const ratingInput = document.getElementById('so_sao_input');
            const form = document.getElementById('form-binhluan');

            // ===================== Star Rating =====================
            function updateStars(rating) {
                stars.forEach(star => {
                    const value = parseInt(star.getAttribute('data-value'));
                    if (value <= rating) {
                        star.classList.remove('ci-star', 'text-body-tertiary');
                        star.classList.add('ci-star-filled', 'text-warning');
                    } else {
                        star.classList.remove('ci-star-filled', 'text-warning');
                        star.classList.add('ci-star', 'text-body-tertiary');
                    }
                });
            }

            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const value = this.getAttribute('data-value');
                    ratingInput.value = value;
                    updateStars(value);
                });

                star.addEventListener('mouseover', function () {
                    const value = this.getAttribute('data-value');
                    updateStars(value);
                });
            });

            document.getElementById('star-rating').addEventListener('mouseleave', function () {
                updateStars(ratingInput.value || 0);
            });

            updateStars(0);

            // ===================== AJAX Submit Bình luận =====================
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(form);

                fetch("{{ route('user.binhluan') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const comment = data.comment;

                            // Tạo HTML hiển thị sao
                            let starsHtml = '';
                            for (let i = 1; i <= 5; i++) {
                                if (i <= comment.danhgia) {
                                    starsHtml += '<i class="ci-star-filled text-warning"></i>';
                                } else {
                                    starsHtml += '<i class="ci-star text-body-tertiary opacity-75"></i>';
                                }
                            }

                            // Tạo HTML bình luận mới
                            const newCommentHTML = `
                                                                    <div class="border-bottom pb-4 mb-4">
                                                                        <div class="d-flex gap-3 mb-4">
                                                                            <img src="{{ asset('storage/') }}${comment.user.hinhanh}" 
                                                                                 width="50" height="50"
                                                                                 class="rounded-circle border border-2 border-primary" 
                                                                                 style="object-fit: cover;"
                                                                                 alt="Avatar" />
                                                                            <div class="flex-grow-1">
                                                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                                                    <div>
                                                                                        <h6 class="mb-1">${comment.user.name}</h6>
                                                                                        <div class="d-flex gap-1 fs-xs">
                                                                                            ${starsHtml}
                                                                                        </div>
                                                                                    </div>
                                                                                    <span class="text-body-tertiary fs-sm">${comment.created_at}</span>
                                                                                </div>
                                                                                <p class="mb-2">${comment.noidung}</p>
                                                                                <div class="d-flex gap-3 fs-sm">
                                                                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                                        <i class="ci-thumbs-up me-1"></i> Hữu ích (0)
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                                                                        <i class="ci-thumbs-down me-1"></i> Không hữu ích (0)
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                `;

                            // Thêm vào đầu danh sách bình luận
                            document.getElementById('ds-binhluan').insertAdjacentHTML('afterbegin', newCommentHTML);

                            // Reset form và sao
                            form.reset();
                            updateStars(0);
                            ratingInput.value = 0;

                            // Hiển thị thông báo
                            showToast(data.message, 'success');
                        } else {
                            showToast('Gửi bình luận thất bại!', 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showToast('Lỗi kết nối!', 'error');
                    });
            });

            // ===================== Toast Notification =====================
            function showToast(message, type = 'success') {
                const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
                const icon = type === 'success' ? 'ci-check-circle' : 'ci-x-circle';

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
                                                        </div>
                                                    `;

                const wrapper = document.createElement('div');
                wrapper.innerHTML = toastHTML;
                document.body.appendChild(wrapper);

                const toastEl = wrapper.querySelector('.toast');
                const bsToast = new bootstrap.Toast(toastEl, { delay: 3000 });
                bsToast.show();

                toastEl.addEventListener('hidden.bs.toast', () => wrapper.remove());
            }
        });
    </script>

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