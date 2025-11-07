<!-- modal Thêm -->
<div class="modal fade" id="modalThem" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Thêm Sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>

            <div class="modal-body">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thông tin Sản phẩm</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.sanpham.them') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Tên sản phẩm -->
                            <div class="form-group mb-3">
                                <label for="tensanpham">Tên sản phẩm</label>
                                <input type="text" class="form-control @error('tensanpham') is-invalid @enderror"
                                    id="tensanpham" name="tensanpham" placeholder="Nhập tên sản phẩm..." required
                                    autofocus>
                                @error('tensanpham')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <!-- Loại sản phẩm -->
                            <div class="form-group mb-3">
                                <label for="loaisanpham_id">Loại sản phẩm</label>
                                <select name="loaisanpham_id" id="loaisanpham_id"
                                    class="form-control @error('loaisanpham_id') is-invalid @enderror" required>
                                    <option value="">-- Chọn loại sản phẩm --</option>
                                    @foreach ($loaisanpham as $lsp)
                                        <option value="{{ $lsp->id }}">{{ $lsp->tenloai }}</option>
                                    @endforeach
                                </select>
                                @error('loaisanpham_id')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <!-- Hãng sản xuất -->
                            <div class="form-group mb-3">
                                <label for="hangsanxuat_id">Hãng sản xuất</label>
                                <select name="hangsanxuat_id" id="hangsanxuat_id"
                                    class="form-control @error('hangsanxuat_id') is-invalid @enderror" required>
                                    <option value="">-- Chọn hãng sản xuất --</option>
                                    @foreach ($hangsanxuat as $hsx)
                                        <option value="{{ $hsx->id }}">{{ $hsx->tenhang }}</option>
                                    @endforeach
                                </select>
                                @error('hangsanxuat_id')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <!-- Giá và khuyến mãi -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="gia">Giá (VNĐ)</label>
                                    <input type="number" step="0.01" min="0" name="gia" id="gia"
                                        class="form-control @error('gia') is-invalid @enderror" required>
                                    @error('gia')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="khuyenmai">Khuyến mãi (%)</label>
                                    <input type="number" min="0" max="100" name="khuyenmai" id="khuyenmai"
                                        class="form-control @error('khuyenmai') is-invalid @enderror" value="0">
                                    @error('khuyenmai')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Số lượng -->
                            <div class="form-group mb-3">
                                <label for="soluong">Số lượng</label>
                                <input type="number" min="0" name="soluong" id="soluong"
                                    class="form-control @error('soluong') is-invalid @enderror" required>
                                @error('soluong')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <!-- Trạng thái -->
                            <div class="form-group mb-3">
                                <label for="trangthai">Trạng thái</label>
                                <select name="trangthai" id="trangthai"
                                    class="form-control @error('trangthai') is-invalid @enderror" required>
                                    <option value="1">Đang bán</option>
                                    <option value="2">Đặt trước</option>
                                    <option value="0">Chưa hàng</option>
                                </select>
                                @error('trangthai')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <!-- Mô tả -->
                            <div class="form-group mb-3">
                                <label for="mota">Mô tả</label>
                                <textarea name="mota" id="mota" rows="3"
                                    class="form-control @error('mota') is-invalid @enderror"
                                    placeholder="Nhập mô tả sản phẩm (tối đa 255 ký tự)..."></textarea>
                                @error('mota')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <!-- Hình ảnh -->
                            <div class="form-group mb-3">
                                <label for="hinhanh">Hình ảnh</label>
                                <input type="file" class="form-control @error('hinhanh') is-invalid @enderror"
                                    id="hinhanh" name="hinhanh" accept="image/*">
                                @error('hinhanh')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <!-- Nút lưu -->
                            <button type="submit" class="btn btn-primary mt-3">
                                <i class="fas fa-save"></i> Lưu sản phẩm
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>