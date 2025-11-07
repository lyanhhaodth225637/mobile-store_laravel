<!-- modal Import -->
<form action="{{ route('admin.hangsanxuat.nhap') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-0">
                        <label for="file_excel" class="form-label">Chọn tập tin Excel</label>
                        <input type="file" class="form-control @error('file_excel') is-invalid @enderror"
                            id="file_excel" name="file_excel" required />
                        @error('file_excel')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-light text-gray-900" data-bs-dismiss="modal"><i
                            class="fa-light fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn bg-gradient-danger text-gray-100"><i
                            class="fa-light fa-upload"></i> Nhập dữ
                        liệu</button>
                </div>
            </div>
        </div>
    </div>
</form>