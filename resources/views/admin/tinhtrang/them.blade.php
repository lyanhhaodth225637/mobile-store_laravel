$cartsp<!-- modal Thêm -->
<div class="modal fade" id="modalThem" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalLabel">Thêm Tình Trạng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>

            <div class="modal-body">
                <div class=" mb-4">

                    <div class="card-body">
                        <form action="{{ route('admin.tinhtrang.them') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="tinhtrang">Tên hãng sản xuất</label>
                                <input type="text" class="form-control @error('tinhtrang') is-invalid @enderror"
                                    id="tinhtrang" name="tinhtrang" placeholder="Nhập tình trạng (ví dụ: Mớ i)" required
                                    autofocus>
                                @error('tinhtrang')
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