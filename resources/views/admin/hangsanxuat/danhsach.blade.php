@extends('layouts.admin.app')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Hãng Sản Xuất</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <!-- <h2 class="m-0 font-weight-bold text-primary">Danh Sách</h2> -->
                <div>
                    <a class="btn bg-gradient-info text-gray-100 " href=""><i class="fa-regular fa-plus"></i> Import</a>
                    <a class="btn bg-gradient-success text-gray-100 " href=""><i class="fa-regular fa-plus"></i> Export</a>
                </div>
                <a class="btn bg-gradient-primary text-gray-100" href="#" data-bs-toggle="modal"
                    data-bs-target="#modalThem">
                    <i class="fa-regular fa-plus"></i> Thêm
                </a>
            </div>


            <!-- thông báo thành công -->
            @if (session('success'))
                <div id="success" class="alert alert-success alert-dismissible fade show d-flex justify-content-between"
                    role="alert">
                    <strong>{{ session('success') }}</strong>
                    <div>
                        <span id="countdown">Đống sau 3 giây</span>
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                </div>
            @endif

            <!-- thông báo thất bại -->
            @if (session('error'))
                <div id="success" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Hình ảnh</th>
                                <th>Tên hãng</th>
                                <th>Tên hãng không dấu</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hangsanxuat as $hsx)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center"><img src="{{ asset('storage/' . $hsx->hinhanh) }}" width="100"
                                            class="img-thumbnail" /></td>
                                    <td>{{ $hsx->tenhang }}</td>
                                    <td>{{ $hsx->tenhang_slug }}</td>

                                    <td class="text-center"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalSua{{ $hsx->id }}"><i class="fa-light fa-edit"></i></a>
                                    </td>

                                    <td class="text-center"><a href="{{ route('admin.hangsanxuat.xoa', ['id' => $hsx->id]) }}"
                                            onclick="return confirm('Bạn có muốn xóa loại sản phẩm {{ $hsx->tenhang }} không?')"><i
                                                class="fa-light fa-trash-alt text-danger"></i></a>
                                    </td>
                                </tr>
                                @include('admin.hangsanxuat.sua')

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- cuối content: include modal partial -->
    @include('admin.hangsanxuat.them')



@endsection

@section('js')
    <script>
        @if ($errors->any())
            var modal = new bootstrap.Modal(document.getElementById('modal'));
            modal.show();
        @endif

        setTimeout(() => {
            $('#success').alert('close');
        }, 3000);
    </script>
@endsection