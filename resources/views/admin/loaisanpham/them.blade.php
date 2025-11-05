@extends('layouts.admin.app') {{-- (Kế thừa layout của bạn) --}}

@section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Thêm Loại Sản Phẩm</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin loại sản phẩm</h6>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.loaisanpham.them') }}" method="POST">

                    @csrf

                    <div class="form-group">
                        <label for="tenloai">Tên loại sản phẩm</label>

                        <input type="text" class="form-control @error('tenloai') is-invalid @enderror" id="tenloai" name="tenloai"
                            placeholder="Nhập tên loại (ví dụ: Điện thoại)" required>
                            @error('tenloai')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    {{-- (Bạn có thể thêm các ô input khác ở đây) --}}

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu Lại
                    </button>

                </form>
            </div>
        </div>

    </div>

@endsection