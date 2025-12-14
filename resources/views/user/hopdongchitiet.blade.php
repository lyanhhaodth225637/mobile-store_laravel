<!-- Modal Chi tiết Hợp đồng trả góp - User View -->
<div class="modal fade" id="modalChiTiet{{ $hd->id }}" tabindex="-1" aria-labelledby="modalChiTietLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient text-white"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h5 class="modal-title fw-bold" id="modalChiTietLabel">
                    <i class="ci-document me-2"></i>Chi tiết Hợp đồng trả góp #{{ $hd->id }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Đóng"></button>
            </div>

            <div class="modal-body bg-light p-4">
                <!-- Trạng thái -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="alert border-0 shadow-sm mb-0" @if($hd->duyet == 0)
                            style="background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);"
                        @elseif($hd->duyet == 1)
                            style="background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);" @else
                            style="background: linear-gradient(135deg, #fab1a0 0%, #ff7675 100%);" @endif>
                            <div class="d-flex align-items-center">
                                <div>
                                    <small class="d-block mb-1 opacity-75">Trạng thái xét duyệt</small>
                                    <h6 class="mb-0 fw-bold">
                                        @if($hd->duyet == 0)
                                            <i class="ci-time me-1"></i>Chờ duyệt
                                        @elseif($hd->duyet == 1)
                                            <i class="ci-check-circle me-1"></i>Đã duyệt
                                        @else
                                            <i class="ci-close-circle me-1"></i>Từ chối
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($hd->duyet == 1)
                        <div class="col-md-6">
                            <div class="alert border-0 shadow-sm mb-0" @if($hd->trang_thai_hop_dong == 0)
                            style="background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);" @else
                                style="background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);" @endif>
                                <div class="d-flex align-items-center">
                                    <div class="text-white">
                                        <small class="d-block mb-1 opacity-75">Trạng thái hợp đồng</small>
                                        <h6 class="mb-0 fw-bold">
                                            @if($hd->trang_thai_hop_dong == 0)
                                                <i class="ci-refresh me-1"></i>Đang trả góp
                                            @else
                                                <i class="ci-check-circle me-1"></i>Hoàn thành
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <!-- Thông tin sản phẩm -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 pt-4">
                                <h6 class="fw-bold text-primary mb-0">
                                    <i class="ci-cart me-2"></i>THÔNG TIN SẢN PHẨM
                                </h6>
                            </div>
                            <div class="card-body">
                                <!-- Hình ảnh sản phẩm -->
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/' . $hd->sanpham->hinhanh) }}"
                                        alt="{{ $hd->sanpham->tensanpham }}" class="img-fluid rounded shadow-sm"
                                        style="max-height: 200px; object-fit: cover;">
                                </div>

                                <div class="mb-3 pb-3 border-bottom">
                                    <small class="text-muted d-block mb-1">Tên sản phẩm</small>
                                    <p class="mb-0 fw-bold">{{ $hd->sanpham->tensanpham }}</p>
                                </div>
                                <div class="mb-3 pb-3 border-bottom">
                                    <small class="text-muted d-block mb-1">Loại sản phẩm</small>
                                    <p class="mb-0">{{ $hd->sanpham->loaisanpham->tenloai ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3 pb-3 border-bottom">
                                    <small class="text-muted d-block mb-1">Hãng</small>
                                    <p class="mb-0">{{ $hd->sanpham->hangsanxuat->tenhang ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-0">
                                    <small class="text-muted d-block mb-1">Giá sản phẩm</small>
                                    <p class="mb-0 text-danger fw-bold fs-4">
                                        {{ number_format($hd->gia_san_pham, 0, ',', '.') }} VNĐ
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin người đăng ký -->
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-header bg-white border-0 pt-4">
                                <h6 class="fw-bold text-primary mb-0">
                                    <i class="ci-user me-2"></i>THÔNG TIN ĐĂNG KÝ
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <small class="text-muted d-block mb-1">Họ và tên</small>
                                        <p class="mb-0 fw-bold">{{ $hd->ho_ten }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block mb-1">CCCD</small>
                                        <p class="mb-0 fw-medium">{{ $hd->cccd }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block mb-1">Số điện thoại</small>
                                        <p class="mb-0 fw-medium">{{ $hd->sdt }}</p>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted d-block mb-1">Địa chỉ</small>
                                        <p class="mb-0">{{ $hd->dia_chi }}</p>
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
                                    <i class="ci-calculator me-2"></i>THÔNG TIN HỢP ĐỒNG
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="p-3 rounded" style="background-color: #f8f9fa;">
                                            <small class="text-muted d-block mb-1">
                                                <i class="ci-time me-1"></i>Thời hạn
                                            </small>
                                            <p class="mb-0 text-primary fw-bold fs-5">{{ $hd->thoi_han }} tháng</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 rounded" style="background-color: #f8f9fa;">
                                            <small class="text-muted d-block mb-1">
                                                <i class="ci-percent me-1"></i>Trả trước
                                            </small>
                                            <p class="mb-0 text-info fw-bold fs-5">{{ $hd->tra_truoc }}%</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 rounded" style="background-color: #f8f9fa;">
                                            <small class="text-muted d-block mb-1">
                                                <i class="ci-wallet me-1"></i>Số tiền trả trước
                                            </small>
                                            <p class="mb-0 text-success fw-bold fs-5">
                                                {{ number_format($hd->so_tien_tra_truoc, 0, ',', '.') }} VNĐ
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 rounded"
                                            style="background-color: #fff3cd; border: 2px dashed #ffc107;">
                                            <small class="text-muted d-block mb-1">
                                                <i class="ci-coin me-1"></i>Số tiền còn lại (chưa tính lãi)
                                            </small>
                                            <p class="mb-0 text-warning fw-bold fs-5">
                                                {{ number_format($hd->so_tien_con_lai, 0, ',', '.') }} VNĐ
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 rounded" style="background-color: #f8f9fa;">
                                            <small class="text-muted d-block mb-1">
                                                <i class="ci-trending-up me-1"></i>Lãi suất/tháng
                                            </small>
                                            <p class="mb-0 text-warning fw-bold fs-5">{{ $hd->lai_suat_hang_thang }}%
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 rounded"
                                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <small class="text-white d-block mb-1">
                                                <i class="ci-credit-card me-1"></i>Trả mỗi tháng
                                            </small>
                                            <p class="mb-0 text-white fw-bold fs-5">
                                                {{ number_format($hd->so_tien_tra_moi_thang, 0, ',', '.') }} VNĐ
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tổng quan thanh toán -->
                        <div class="card border-0 shadow-sm mt-4"
                            style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">
                                    <i class="ci-pie-chart me-2"></i>TỔNG QUAN THANH TOÁN
                                </h6>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Đã trả trước:</span>
                                    <strong
                                        class="text-success">{{ number_format($hd->so_tien_tra_truoc, 0, ',', '.') }}
                                        VNĐ</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Số tháng trả góp:</span>
                                    <strong>{{ $hd->thoi_han }} tháng</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Trả mỗi tháng:</span>
                                    <strong
                                        class="text-primary">{{ number_format($hd->so_tien_tra_moi_thang, 0, ',', '.') }}
                                        VNĐ</strong>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Tổng thanh toán:</span>
                                    <strong
                                        class="text-danger fs-5">{{ number_format($hd->so_tien_tra_truoc + ($hd->so_tien_tra_moi_thang * $hd->thoi_han), 0, ',', '.') }}
                                        VNĐ</strong>
                                </div>
                                <small class="text-muted d-block mt-2">
                                    <i class="ci-info-circle me-1"></i>Bao gồm: Trả trước + ({{ $hd->thoi_han }} tháng ×
                                    {{ number_format($hd->so_tien_tra_moi_thang, 0, ',', '.') }})
                                </small>
                            </div>
                        </div>

                        <!-- Thời gian -->
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-6 text-center">
                                        <i class="ci-calendar fs-2 text-muted mb-2 d-block"></i>
                                        <small class="text-muted d-block">Ngày đăng ký</small>
                                        <p class="mb-0 fw-bold">
                                            {{ $hd->created_at ? $hd->created_at->format('d/m/Y H:i') : '---' }}
                                        </p>
                                    </div>
                                    <div class="col-6 text-center">
                                        <i class="ci-reload fs-2 text-muted mb-2 d-block"></i>
                                        <small class="text-muted d-block">Cập nhật</small>
                                        <p class="mb-0 fw-bold">
                                            {{ $hd->updated_at ? $hd->updated_at->format('d/m/Y H:i') : '---' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Lưu ý quan trọng -->
                @if($hd->duyet == 0)
                    <div class="alert alert-info border-0 shadow-sm mt-4 mb-0">
                        <h6 class="alert-heading fw-bold">
                            <i class="ci-announcement me-2"></i>Lưu ý
                        </h6>
                        <p class="mb-0">Hợp đồng của bạn đang chờ xét duyệt. Chúng tôi sẽ liên hệ với bạn trong thời gian
                            sớm nhất.</p>
                    </div>
                @elseif($hd->duyet == 2)
                    <div class="alert alert-danger border-0 shadow-sm mt-4 mb-0">
                        <h6 class="alert-heading fw-bold">
                            <i class="ci-announcement me-2"></i>Thông báo
                        </h6>
                        <p class="mb-0">Rất tiếc, hợp đồng của bạn đã bị từ chối. Vui lòng liên hệ với chúng tôi để biết
                            thêm chi tiết.</p>
                    </div>
                @elseif($hd->duyet == 1 && $hd->trang_thai_hop_dong == 0)
                    <div class="alert alert-success border-0 shadow-sm mt-4 mb-0">
                        <h6 class="alert-heading fw-bold">
                            <i class="ci-check-circle me-2"></i>Hướng dẫn thanh toán
                        </h6>
                        <p class="mb-2">Hợp đồng đã được duyệt. Vui lòng thanh toán:</p>
                        <ul class="mb-0">
                            <li><strong>{{ number_format($hd->so_tien_tra_moi_thang, 0, ',', '.') }} VNĐ</strong> mỗi tháng
                            </li>
                            <li>Trong vòng <strong>{{ $hd->thoi_han }} tháng</strong></li>
                        </ul>
                    </div>
                @else
                    <div class="alert alert-secondary border-0 shadow-sm mt-4 mb-0">
                        <h6 class="alert-heading fw-bold">
                            <i class="ci-check-circle me-2"></i>Hoàn thành
                        </h6>
                        <p class="mb-0">Chúc mừng! Bạn đã hoàn thành hợp đồng trả góp này.</p>
                    </div>
                @endif

            </div>

            <div class="modal-footer bg-white border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ci-close me-2"></i>Đóng
                </button>

            </div>
        </div>
    </div>
</div>