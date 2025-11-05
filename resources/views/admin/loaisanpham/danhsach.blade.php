@extends('layouts.admin.app')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Loại Sản Phảm Phẩm</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh Sách</h6>
            </div>
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
                                    <td>sua</td>
                                    <td>xóa</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection