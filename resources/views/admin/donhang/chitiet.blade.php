<!-- Modal Chi tiết Sản phẩm -->
<div class="modal fade" id="modalChiTiet{{ $dh->id }}" tabindex="-1" aria-labelledby="modalChiTietLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <!-- Header -->
            <div class="modal-header bg-gradient text-white"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h5 class="modal-title fw-bold text-black" id="modalChiTietLabel">
                    <i class="fas fa-shopping-bag me-2 text-black"></i>Chi tiết Đơn hàng
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Đóng"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4" style="background-color: #f8f9fa;">

                <!-- Thông tin khách hàng -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-3">
                        <h6 class="text-uppercase text-muted mb-3 fw-bold">
                            <i class="fas fa-user-circle me-2"></i>Thông tin khách hàng
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-user text-primary"></i>
                                    <div>
                                        <small class="text-muted d-block">Họ tên</small>
                                        <span class="fw-semibold">{{ $dh->user->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-phone text-success"></i>
                                    <div>
                                        <small class="text-muted d-block">Số điện thoại</small>
                                        <span class="fw-semibold">{{ $dh->sodienthoai }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-danger"></i>
                                    <div>
                                        <small class="text-muted d-block">Địa chỉ</small>
                                        <span class="fw-semibold">{{ $dh->diachi }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-uppercase text-muted mb-0 fw-bold">
                        <i class="fas fa-list me-2"></i>Sản phẩm đã đặt
                    </h6>
                    <span class="badge bg-info">{{ count($dh->donhang_chitiet) }} sản phẩm</span>
                </div>

                @php
                    $tamTinh = 0;
                @endphp

                @foreach ($dh->donhang_chitiet as $ct)
                    @php
                        $tamTinh += $ct->thanhtien ?? 0;
                    @endphp

                    <div class="card mb-3 border-0 shadow-sm hover-shadow" style="transition: all 0.3s ease;">
                        <div class="card-body p-3">
                            <div class="row align-items-center g-3">
                                <!-- Hình ảnh & Tên SP -->
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <span
                                            class="badge bg-info rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 32px; height: 32px; font-size: 0.9rem; flex-shrink: 0;">
                                            {{ $loop->iteration }}
                                        </span>

                                        <img src="{{ asset('storage/' . $ct->hinhanh) }}"
                                            alt="{{ $ct->sanpham->tensanpham }}" class="img-thumbnail rounded"
                                            style="width: 80px; height: 80px; object-fit: cover; flex-shrink: 0;" />

                                        <div class="flex-grow-1">
                                            <h6 class="mb-2 fw-bold text-dark">{{ $ct->sanpham->tensanpham }}</h6>

                                            <div class="d-flex flex-column gap-1">
                                                <small class="text-muted">
                                                    <i class="fas fa-tag me-1 text-primary"></i>
                                                    Giá gốc: <span
                                                        class="text-decoration-line-through">{{ number_format($ct->gia ?? 0, 0, ',', '.') }}
                                                        đ</span>
                                                </small>

                                                @if($ct->khuyenmai > 0)
                                                    <small class="text-danger fw-semibold">
                                                        <i class="fas fa-gift me-1"></i>
                                                        Giảm {{ $ct->khuyenmai }}%
                                                        <i class="fas fa-arrow-right mx-1"></i>
                                                        {{ number_format($ct->dongia ?? 0, 0, ',', '.') }} đ
                                                    </small>
                                                @else
                                                    <small class="text-success fw-semibold">
                                                        <i class="fas fa-dollar-sign me-1"></i>
                                                        {{ number_format($ct->dongia ?? 0, 0, ',', '.') }} đ
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Số lượng -->
                                <div class="col-md-3 text-center">
                                    <small class="text-muted d-block mb-2">Số lượng</small>
                                    <div class="d-inline-flex align-items-center gap-2 px-3 py-2 bg-light rounded">
                                        <i class="fas fa-cubes text-secondary"></i>
                                        <span class="fw-bold fs-5">{{ $ct->soluong ?? 1 }}</span>
                                    </div>
                                </div>

                                <!-- Thành tiền -->
                                <div class="col-md-3 text-end">
                                    <small class="text-muted d-block mb-2">Thành tiền</small>
                                    <div class="">
                                        <h6 class="mb-0 text-success fw-bold">
                                            {{ number_format($ct->thanhtien ?? 0, 0, ',', '.') }} đ
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Tổng tiền -->
                <div class="card border-0 shadow mt-4"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body text-white p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2">
                            <span class="d-flex align-items-center gap-2">
                                <i class="fas fa-calculator"></i>Tạm tính:
                            </span>
                            <span class="fw-semibold fs-6">{{ number_format($tamTinh, 0, ',', '.') }} đ</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2">
                            <span class="d-flex align-items-center gap-2">
                                <i class="fas fa-percent"></i>VAT:
                            </span>
                            <span class="fw-semibold fs-6">{{ number_format($dh->VAT ?? 0, 0, ',', '.') }} đ</span>
                        </div>

                        <div
                            class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom border-light border-opacity-25">
                            <span class="d-flex align-items-center gap-2">
                                <i class="fas fa-shipping-fast"></i>Phí vận chuyển:
                            </span>
                            <span class="badge bg-light text-success px-3 py-2">
                                <i class="fas fa-check-circle me-1"></i>Miễn phí
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                                <i class="fas fa-wallet"></i>Tổng cộng:
                            </h5>
                            <h3 class="mb-0 fw-bold">
                                {{ number_format($dh->tongtien ?? 0, 0, ',', '.') }} đ
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer bg-light border-top">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Đóng
                </button>
                <!-- <button type="button" class="btn text-white"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-print me-2"></i>In hóa đơn
                </button> -->
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>