<!-- modal Thêm -->
<div class="modal fade" id="modalSua{{ $hsx->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalLabel">Sửa Hãng Sản Xuất</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <div class=" mb-4">


                    <div class="card-body">
                        <form action="{{ route('admin.hangsanxuat.sua', ['id' => $hsx->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="tenhang">Tên loại sản phẩm</label>
                                <input type="text" class="form-control @error('tenhang') is-invalid @enderror"
                                    id="tenhang" name="tenhang" placeholder="Nhập tên hãng (ví dụ: Samsung)" autofocus
                                    value="{{ $hsx->tenhang }}">
                                @error('tenhang')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror

                                <label for="hinhanh" class="form-label mt-3">Hình ảnh hiện tại</label>
                                @if($hsx->hinhanh)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $hsx->hinhanh) }}" alt="{{ $hsx->tensanpham }}"
                                            class="img-thumbnail" width="150">
                                    </div>
                                @endif
                                <label for="hinhanh" class="">Thay đổi hình ảnh (nếu có)</label>
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