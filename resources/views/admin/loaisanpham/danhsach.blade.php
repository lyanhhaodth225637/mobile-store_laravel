@extends('layouts.admin.app')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Loại Sản Phảm Phẩm</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h2 class="m-0 font-weight-bold text-primary">Danh Sách</h2>
                <a class="btn bg-gradient-primary text-gray-100 {{ Request::routeIs('loaisanpham.them') ? 'active' : '' }}"
                    href="{{ route('admin.loaisanpham.them') }}"><i class="fa-regular fa-plus"></i> Thêm</a>
            </div>

            <!-- thông báo thêm thành công -->
            @if (session('success'))
                <div id="success-them" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên loại</th>
                                <th>Tên loại không dấu</th>
                                <th>Sửa</th>
                                <th>xóa</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($loaisanpham as $lsp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lsp->tenloai }}</td>
                                    <td>{{ $lsp->tenloai_slug }}</td>

                                    <td class="text-center"><a href="#"><i class="fa-light fa-edit"></i></a></td>
                                    <td class="text-center"><a href="#"
                                            onclick="return confirm('Bạn có muốn xóa loại sản phẩm {{ $lsp->tenloai }} không?')"><i
                                                class="fa-light fa-trash-alt text-danger"></i></a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        setTimeout(() => {
            $('#success-them').alert('close');
        }, 3000);
    </script>
@endsection