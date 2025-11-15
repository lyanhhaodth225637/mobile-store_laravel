@extends('layouts.admin.app')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Người dùng</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Nút Import/Export -->
                    <div class="d-flex gap-2">
                        <a class="btn bg-gradient-info text-white" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalImport">
                            <i class="fa-solid fa-upload"></i> Import
                        </a>
                        <a class="btn bg-gradient-success text-white" href="{{ route('admin.sanpham.xuat') }}">
                            <i class="fa-solid fa-download"></i> Export
                        </a>
                    </div>

                    <!-- Form lọc và nút thêm -->

                </div>
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
                                <th width="5%">#</th>
                                <th width="10%">Avatar</th>
                                <th width="15%">Tên</th>
                                <th width="12%">Email</th>
                                <th width="8%">Vai trò</th>
                                <th width="10%">Rank</th>
                                <th width="5%">Sửa</th>
                                <th width="5%">Xóa</th>
                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($user as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center"><img src="" width="100" class="img-thumbnail" /></td>
                                    <td> <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalChiTiet{{ $user->id }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role == 0)
                                            <span class="badge bg-danger">Quản trị</span>
                                        @elseif($user->role == 1)
                                            <span class="badge bg-success">Nhân viên</span>
                                        @elseif($user->role == 2)
                                            <span class="badge bg-warning">Khách hàng</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->points < 1)
                                            <img width="50px" src="{{ asset('assets/img/dong.png') }}" alt="">Đồng
                                        @elseif($user->points > 1 && $user->points < 1000)
                                            <img width="50px" src="{{ asset('assets/img/kimcuong.png') }}" alt="">Kim cương
                                        @elseif($user->points > 1000 && $user->points < 5000)
                                            <img width="50px" src="{{ asset('assets/img/caothu.png') }}" alt="">Cao thủ

                                        @endif

                                    </td>
                                    <td class="text-center"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalSua{{ $user->id }}"><i class="fa-light fa-edit"></i></a>
                                    </td>

                                    <td class="text-center"><a href="{{ route('admin.sanpham.xoa', ['id' => $user->id]) }}"
                                            onclick="return confirm('Bạn có muốn xóa Người {{ $user->name }} không?')"><i
                                                class="fa-light fa-trash-alt text-danger"></i></a>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- cuối content: include modal partial -->
@endsection

@section('js')
    <script>
        @if ($errors->any())
            var modal = new bootstrap.Modal(document.getElementById('modalThem'));
            modal.show();
        @endif

        setTimeout(() => {
            $('#success').alert('close');
        }, 3000);
    </script>
@endsection