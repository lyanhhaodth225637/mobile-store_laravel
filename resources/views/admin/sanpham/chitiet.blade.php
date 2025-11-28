<!-- Modal Chi tiết Sản phẩm -->
<div class="modal fade" id="modalChiTiet{{ $sp->id }}" tabindex="-1" aria-labelledby="modalChiTietLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title fw-bold" id="modalChiTietLabel">
                    <i class="fas fa-info-circle me-2"></i>Chi tiết Sản phẩm
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Đóng"></button>
            </div>

            <div class="modal-body bg-light p-4">
                <div class="card border-0 shadow-sm">


                    <div class="card-body p-4">

                        <!-- Hình ảnh sản phẩm -->
                        <div class="text-center mb-4" id="product-image-container">
                            <img src="{{ asset('storage/' . $sp->hinhanh) }}" alt="Hình ảnh sản phẩm"
                                class="img-fluid rounded shadow" style="max-height: 300px; object-fit: cover;"
                                id="chitiet-hinhanh">
                        </div>

                        <hr class="my-4">

                        <!-- Tên sản phẩm -->
                        <div class="row mb-3">
                            <div class="d-flex">
                                <label class="form-label fw-bold text-dark">
                                    <i class="fas fa-tag text-primary me-2"></i>Tên sản phẩm:
                                </label>
                                <p class="ms-2" id="chitiet-tensanpham">{{ $sp->tensanpham }}</p>
                            </div>

                        </div>

                        <!-- Loại sản phẩm & Hãng sản xuất -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class=" d-flex">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-list text-primary me-2"></i>Sản phẩm:
                                        </label>
                                        <p class="ms-2" id="chitiet-loaisanpham">{{ $sp->loaisanpham->tenloai }}</p>
                                    </div>



                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="d-flex">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-industry text-primary me-2"></i>Hãng:
                                        </label> 
                                        <p class="ms-2" id="chitiet-hangsanxuat">
                                            {{ $sp->hangsanxuat->tenhang }}</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Giá & Khuyến mãi -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="d-flex">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-dollar-sign text-success me-2"></i>Giá:
                                        </label>
                                        <p class="ms-2" id="chitiet-gia">
                                            {{ $sp->gia }} VNĐ</p>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="d-flex">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-percent text-danger me-2"></i>Khuyến mãi:
                                        </label>
                                        <p class="ms-2" id="chitiet-khuyenmai">
                                            {{ $sp->khuyenmai ?? 0 }}%
                                        </p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Giá sau khuyến mãi -->
                        <div class="row mb-3" id="chitiet-giasaukm-container">
                            <div class="d-flex">
                                <label class="form-label fw-bold text-dark">
                                    <i class="fas fa-tags text-warning me-2"></i>Giá sau KM:
                                </label>
                                 <p class="ms-2" id="chitiet-giasaukm">
                                    <!-- {{ ($sp->gia)-($sp->gia * ($sp->khuyenmai/100)) }} VNĐ -->
                                      {{ $sp->gia_khuyenmai }} VNĐ
                                </p>
                            </div>
                            
                             
                        </div>

                        <!-- Số lượng & Trạng thái -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="d-flex">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-boxes text-warning me-2"></i>Số lượng:
                                        </label>
                                        <p class="ms-2" id="chitiet-soluong">
                                            {{ $sp->soluong }}</p>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="d-flex">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-toggle-on text-info me-2"></i>Trạng thái:
                                        </label>
                                         <p class="ms-2" id="chitiet-trangthai">
                                            @if($sp->trangthai == 0)
                                                <span class="badge bg-danger">Hết Hàng</span>
                                            @elseif($sp->trangthai == 1)
                                                <span class="badge bg-success">Đang bán</span>
                                            @elseif($sp->trangthai == 2)
                                                <span class="badge bg-warning">Đặt trước</span>
                                            @endif
                                        </p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>


                        <!-- Mô tả -->
                        <div class=" mb-3">
                            <div class="">
                                <label class="form-label fw-bold text-dark">
                                    <i class="fas fa-align-left text-secondary me-2"></i>Mô tả:
                                </label>
                                 <p class="ms-2" id="chitiet-mota"
                                    style="white-space: pre-wrap;">{{ $sp->mota ?? 'Trống' }}</p>
                            </div>
                            
                        </div>

                        <!-- Thông số kỹ thuật (thêm mới) -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-cogs text-primary me-2"></i>Thông số kỹ thuật:
                            </label>
                            @php
                                $thongso = json_decode($sp->thongso, true) ?? [];
                            @endphp
                            @if (!empty($thongso))
                                <ul class="list-group list-group-flush ms-2">
                                    @foreach ($thongso as $key => $value)
                                        <li class="list-group-item d-flex justify-content-between align-items-start border-0 p-1">
                                            <span class="fw-bold text-capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                            <span class="ms-2">{{ $value }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="ms-2 text-muted" id="chitiet-thongso">Trống</p>
                            @endif
                        </div>

                        <!-- Ngày tạo & Ngày cập nhật -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-5">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-calendar-plus text-muted me-2"></i>Ngày tạo:
                                        </label>
                                    </div>
                                    <div class="col-7">
                                        <p class="form-control-plaintext text-muted small" id="chitiet-created">{{ $sp->created_at ? $sp->created_at->format('d/m/Y H:i') : '---' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-5">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-calendar-check text-muted me-2"></i>Cập nhật:
                                        </label>
                                    </div>
                                    <div class="col-7">
                                        <p class="form-control-plaintext text-muted small" id="chitiet-updated">{{ $sp->updated_at ? $sp->updated_at->format('d/m/Y H:i') : '---' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Đóng
                </button>
            </div>
        </div>
    </div>
</div>