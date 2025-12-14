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

                    <div>
                        <!-- Form lọc và nút thêm -->
                        <div class="d-flex align-items-center gap-2">
                            <form action="{{ route('admin.user.loc') }}" method="GET"
                                class="d-flex align-items-center gap-2 m-0">

                                <select name="vaitro" class="form-select" style="width: 180px;">
                                    <option value="">Vai trò</option>
                                    <option value="0" {{ request('vaitro') == '0' ? 'selected' : '' }}>Quản trị</option>
                                    <option value="1" {{ request('vaitro') == '1' ? 'selected' : '' }}>Nhân viên</option>
                                    <option value="2" {{ request('vaitro') == '2' ? 'selected' : '' }}>Khách hàng</option>
                                </select>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                                <a href="{{ route('admin.user.loc') }}" class="btn btn-secondary">
                                    <i class="fa-solid fa-rotate-right"></i>
                                </a>
                            </form>

                            <a class="btn bg-gradient-primary text-white" href="#" data-bs-toggle="modal"
                                data-bs-target="#modalThem">
                                <i class="fa-regular fa-plus"></i> Thêm
                            </a>
                        </div>
                    </div>

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
                                <th width="10%">Ảnh đai diện</th>
                                <th width="15%">Tên</th>
                                <th width="12%">Email</th>
                                <th width="8%">Vai trò</th>
                                <th width="10%">Điểm</th>
                                <th width="5%">Sửa</th>
                                <th width="5%">Xóa</th>
                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($user as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/' . $user->hinhanh) }}" width="50" height="50"
                                            class="rounded-circle border border-2 border-primary" style="object-fit: cover;"
                                            alt="Avatar" />
                                    </td>
                                    <td> <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalChiTiet{{ $user->id }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role == 0)
                                            <span class="badge bg-danger p-1">Quản trị</span>
                                        @elseif($user->role == 1)
                                            <span class="badge bg-success p-1">Khách hàng</span>
                                        @elseif($user->role == 2)
                                            <span class="badge bg-success p-1">Khách hàng</span>
                                        @endif
                                    </td>
                                   <td>{{ number_format($user->points, 0, ',', '.') }}</td>

                                    <td class="text-center"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalSua{{ $user->id }}"><i class="fa-light fa-edit"></i></a>
                                    </td>

                                    <td class="text-center"><a href="{{ route('admin.user.xoa', ['id' => $user->id]) }}"
                                            onclick="return confirm('Bạn có muốn xóa Người {{ $user->name }} không?')"><i
                                                class="fa-light fa-trash-alt text-danger"></i></a>
                                    </td>
                                </tr>
                                @include('admin.user.sua')
                                @include('admin.user.chitiet')

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- cuối content: include modal partial -->
    @include('admin.user.them')
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
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
@endsection