<!-- Modal Thêm -->
<div class="modal fade" id="modalThem" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Thêm Sản phẩm
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <form action="{{ route('admin.sanpham.them') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Tên sản phẩm -->
                    <div class="mb-3">
                        <label for="tensanpham" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control @error('tensanpham') is-invalid @enderror"
                            id="tensanpham" name="tensanpham" placeholder="Nhập tên sản phẩm" required>
                        @error('tensanpham')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Loại sản phẩm & Hãng sản xuất -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="loaisanpham_id" class="form-label">Loại sản phẩm</label>
                            <select name="loaisanpham_id" id="loaisanpham_id"
                                class="form-select @error('loaisanpham_id') is-invalid @enderror" required>
                                <option value="">-- Chọn loại --</option>
                                @foreach ($loaisanpham as $lsp)
                                    <option value="{{ $lsp->id }}">{{ $lsp->tenloai }}</option>
                                @endforeach
                            </select>
                            @error('loaisanpham_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="hangsanxuat_id" class="form-label">Hãng sản xuất</label>
                            <select name="hangsanxuat_id" id="hangsanxuat_id"
                                class="form-select @error('hangsanxuat_id') is-invalid @enderror" required>
                                <option value="">-- Chọn hãng --</option>
                                @foreach ($hangsanxuat as $hsx)
                                    <option value="{{ $hsx->id }}">{{ $hsx->tenhang }}</option>
                                @endforeach
                            </select>
                            @error('hangsanxuat_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Giá & Khuyến mãi -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gia" class="form-label">Giá (VNĐ)</label>
                            <input type="number" step="0.01" min="0" name="gia" id="gia"
                                class="form-control @error('gia') is-invalid @enderror" required>
                            @error('gia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="khuyenmai" class="form-label">Khuyến mãi (%)</label>
                            <input type="number" min="0" max="100" name="khuyenmai" id="khuyenmai"
                                class="form-control @error('khuyenmai') is-invalid @enderror" value="0">
                            @error('khuyenmai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Số lượng & Trạng thái -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="soluong" class="form-label">Số lượng</label>
                            <input type="number" min="0" name="soluong" id="soluong"
                                class="form-control @error('soluong') is-invalid @enderror" required>
                            @error('soluong')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="trangthai" class="form-label">Trạng thái</label>
                            <select name="trangthai" id="trangthai"
                                class="form-select @error('trangthai') is-invalid @enderror" required>
                                <option value="1">Mở bán</option>
                                <option value="2">Đặt trước</option>
                                <option value="0">Dừng bán</option>

                            </select>
                            @error('trangthai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-3">
                        <label for="mota" class="form-label">Mô tả</label>
                        <textarea name="mota" id="mota" rows="3"
                            class="form-control @error('mota') is-invalid @enderror"
                            placeholder="Nhập mô tả sản phẩm (tối đa 255 ký tự)"></textarea>
                        @error('mota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Hình ảnh -->
                    <div class="mb-3">
                        <label for="hinhanh" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh"
                            name="hinhanh" accept="image/*">
                        @error('hinhanh')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Định dạng: JPG, PNG, GIF (Max: 2MB)</small>
                    </div>

                    <!-- Nút lưu -->
                    <div class="    ">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Lưu sản phẩm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>