<!-- Modal Chi tiết Hợp đồng trả góp -->
<div class="modal fade" id="modalChiTiet{{ $hd->id }}" tabindex="-1" aria-labelledby="modalChiTietLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient text-white"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h5 class="modal-title fw-bold" id="modalChiTietLabel">
                    <i class="fas fa-file-contract me-2"></i>Chi tiết Hợp đồng trả góp #{{ $hd->id }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Đóng"></button>
            </div>

            <div class="modal-body bg-light p-4">

                <!-- Trạng thái duyệt -->
                <div class="alert border-0 shadow-sm mb-4" @if($hd->duyet == 0)
                style="background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);" @elseif($hd->duyet == 1)
                    style="background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);" @else
                    style="background: linear-gradient(135deg, #fab1a0 0%, #ff7675 100%);" @endif>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-1">
                                <i class="fas fa-info-circle me-2"></i>Trạng thái xét duyệt
                            </h6>
                            <span class="badge fs-6" @if($hd->duyet == 0) style="background-color: #fdcb6e;"
                            @elseif($hd->duyet == 1) style="background-color: #00b894;" @else
                                style="background-color: #ff7675;" @endif>
                                @if($hd->duyet == 0)
                                    <i class="fas fa-clock me-1"></i>Chờ duyệt
                                @elseif($hd->duyet == 1)
                                    <i class="fas fa-check-circle me-1"></i>Đã duyệt
                                @else
                                    <i class="fas fa-times-circle me-1"></i>Từ chối
                                @endif
                            </span>
                        </div>

                        @if($hd->duyet == 0)
                            <div>
                                <!-- Form Duyệt -->
                                <form action="{{ route('admin.hopdongtragop.duyet', $hd->id) }}" method="POST"
                                    style="display: inline-block;"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn duyệt hợp đồng này?')">
                                    @csrf
                                    <input type="hidden" name="duyet" value="1">
                                    <button type="submit" class="btn btn-success me-2">
                                        <i class="fas fa-check me-1"></i>Duyệt
                                    </button>
                                </form>

                                <!-- Form Từ chối -->
                                <form action="{{ route('admin.hopdongtragop.duyet', $hd->id) }}" method="POST"
                                    style="display: inline-block;"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn từ chối hợp đồng này?')">
                                    @csrf
                                    <input type="hidden" name="duyet" value="2">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-times me-1"></i>Từ chối
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <!-- Thông tin sản phẩm -->
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-0 pt-4">
                                <h6 class="fw-bold text-primary mb-0">
                                    <i class="fas fa-shopping-cart me-2"></i>THÔNG TIN SẢN PHẨM
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 pb-3 border-bottom">
                                    <small class="text-muted d-block mb-1">Tên sản phẩm</small>
                                    <p class="mb-0 fw-bold">{{ $hd->sanpham->tensanpham }}</p>
                                </div>
                                <div class="mb-0">
                                    <small class="text-muted d-block mb-1">Giá sản phẩm</small>
                                    <p class="mb-0 text-danger fw-bold fs-5">
                                        {{ number_format($hd->gia_san_pham, 0, ',', '.') }} VNĐ</p>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin người đăng ký -->
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-header bg-white border-0 pt-4">
                                <h6 class="fw-bold text-primary mb-0">
                                    <i class="fas fa-user me-2"></i>THÔNG TIN NGƯỜI ĐĂNG KÝ
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block mb-1">Họ tên</small>
                                        <p class="mb-0 fw-bold">{{ $hd->ho_ten }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block mb-1">CCCD</small>
                                        <p class="mb-0 fw-bold">{{ $hd->cccd }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block mb-1">Số điện thoại</small>
                                        <p class="mb-0 fw-bold">{{ $hd->sdt }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block mb-1">Địa chỉ</small>
                                        <p class="mb-0 fw-bold">{{ $hd->dia_chi }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <!-- Thông tin hợp đồng -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 pt-4">
                                <h6 class="fw-bold text-primary mb-0">
                                    <i class="fas fa-file-invoice-dollar me-2"></i>THÔNG TIN HỢP ĐỒNG
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="p-3 rounded" style="background-color: #f8f9fa;">
                                            <small class="text-muted d-block mb-1">
                                                <i class="fas fa-calendar-alt me-1"></i>Thời hạn
                                            </small>
                                            <p class="mb-0 text-primary fw-bold fs-5">{{ $hd->thoi_han }} tháng</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 rounded" style="background-color: #f8f9fa;">
                                            <small class="text-muted d-block mb-1">
                                                <i class="fas fa-percent me-1"></i>Trả trước
                                            </small>
                                            <p class="mb-0 text-info fw-bold fs-5">{{ $hd->tra_truoc }}%</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 rounded" style="background-color: #f8f9fa;">
                                            <small class="text-muted d-block mb-1">
                                                <i class="fas fa-hand-holding-usd me-1"></i>Số tiền trả trước
                                            </small>
                                            <p class="mb-0 text-success fw-bold">
                                                {{ number_format($hd->so_tien_tra_truoc, 0, ',', '.') }} VNĐ</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 rounded" style="background-color: #f8f9fa;">
                                            <small class="text-muted d-block mb-1">
                                                <i class="fas fa-money-bill-wave me-1"></i>Số tiền còn lại
                                            </small>
                                            <p class="mb-0 text-danger fw-bold">
                                                {{ number_format($hd->so_tien_con_lai, 0, ',', '.') }} VNĐ</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 rounded" style="background-color: #f8f9fa;">
                                            <small class="text-muted d-block mb-1">
                                                <i class="fas fa-chart-line me-1"></i>Lãi suất/tháng
                                            </small>
                                            <p class="mb-0 text-warning fw-bold fs-5">{{ $hd->lai_suat_hang_thang }}%
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 rounded"
                                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <small class="text-white d-block mb-1">
                                                <i class="fas fa-credit-card me-1"></i>Trả mỗi tháng
                                            </small>
                                            <p class="mb-0 text-white fw-bold">
                                                {{ number_format($hd->so_tien_tra_moi_thang, 0, ',', '.') }} VNĐ</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thời gian -->
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-6 text-center">
                                        <i class="fas fa-calendar-plus text-muted mb-2 d-block"></i>
                                        <small class="text-muted d-block">Ngày tạo</small>
                                        <p class="mb-0 fw-bold">
                                            {{ $hd->created_at ? $hd->created_at->format('d/m/Y H:i') : '---' }}</p>
                                    </div>
                                    <div class="col-6 text-center">
                                        <i class="fas fa-calendar-check text-muted mb-2 d-block"></i>
                                        <small class="text-muted d-block">Cập nhật</small>
                                        <p class="mb-0 fw-bold">
                                            {{ $hd->updated_at ? $hd->updated_at->format('d/m/Y H:i') : '---' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="modal-footer bg-white border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Đóng
                </button>
            </div>
        </div>
    </div>
</div>