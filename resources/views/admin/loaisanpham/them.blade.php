<!-- modal Thêm -->
<div class="modal fade" id="modalThem" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Thêm Loại Sản Phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>

            <div class="modal-body">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('admin.loaisanpham.them') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="tenloai">Tên loại sản phẩm</label>
                                <input type="text" class="form-control @error('tenloai') is-invalid @enderror"
                                    id="tenloai" name="tenloai" placeholder="Nhập tên loại (ví dụ: Điện thoại)"
                                    required autofocus>
                                @error('tenloai')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">
                                <i class="fas fa-save"></i> Lưu Lại
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>