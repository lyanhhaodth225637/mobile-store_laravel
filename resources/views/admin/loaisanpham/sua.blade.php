<!-- modal Thêm -->
<div class="modal fade" id="modalSua{{ $lsp->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            

            <div class="modal-body">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cập nhật loại sản phẩm</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.loaisanpham.sua', ['id'=> $lsp->id] ) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="tenloai">Tên loại sản phẩm</label>
                                <input type="text" class="form-control @error('tenloai') is-invalid @enderror"
                                    id="tenloai" name="tenloai" placeholder="Nhập tên loại (ví dụ: Điện thoại)"
                                    required autofocus value="{{ $lsp->tenloai }}">
                                @error('tenloai')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">
                                <i class="fas fa-save"></i> Cập nhật
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>