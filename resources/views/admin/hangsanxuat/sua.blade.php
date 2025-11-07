<!-- modal Thêm -->
<div class="modal fade" id="modalSua{{ $hsx->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cập nhật loại sản phẩm</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.hangsanxuat.sua', ['id' => $hsx->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="tenhang">Tên loại sản phẩm</label>
                                <input type="text" class="form-control @error('tenhang') is-invalid @enderror"
                                    id="tenhang" name="tenhang" placeholder="Nhập tên hãng (ví dụ: Samsung)"
                                    autofocus value="{{ $hsx->tenhang }}">
                                @error('tenhang')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror

                                <label for="hinhanh" class="mt-3">Hình ảnh</label>
                                <input type="file" class="form-control @error('hinhanh') is-invalid @enderror"
                                    id="hinhanh" name="hinhanh">
                                @error('hinhanh')
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