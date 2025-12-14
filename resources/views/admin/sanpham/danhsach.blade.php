@extends('layouts.admin.app')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sản Phẩm</h1>
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
                    <div class="d-flex align-items-center gap-2">
                        <form action="{{ route('admin.sanpham.loc') }}" method="GET"
                            class="d-flex align-items-center gap-2 m-0">
                            <input type="text" name="loai" value="danhsach" hidden>

                            <select name="hangsanxuat_id" class="form-select" style="width: 180px;">
                                <option value="">Hãng sản xuất</option>
                                @foreach ($hangsanxuat as $hsx)
                                    <option value="{{ $hsx->id }}" {{ request('hangsanxuat_id') == $hsx->id ? 'selected' : '' }}>
                                        {{ $hsx->tenhang }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="loaisanpham_id" class="form-select" style="width: 180px;">
                                <option value="">Loại sản phẩm</option>
                                @foreach ($loaisanpham as $lsp)
                                    <option value="{{ $lsp->id }}" {{ request('loaisanpham_id') == $lsp->id ? 'selected' : '' }}>
                                        {{ $lsp->tenloai }}
                                    </option>
                                @endforeach
                            </select>

                           <select name="kho" class="form-select" style="width: 180px;">
                                <option value="">Trạng thái</option>
                                <option value="0" {{ request('kho') == '0' ? 'selected' : '' }}>Ngưng bán</option>
                                <option value="1" {{ request('kho') == '1' ? 'selected' : '' }}>Đang bán</option>
                                <option value="2" {{ request('kho') == '2' ? 'selected' : '' }}>Đặt trước</option>
                            </select>


                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-filter"></i>
                            </button>
                            <a href="{{ route('admin.sanpham.loc', ['loai' => 'danhsach']) }}" class="btn btn-secondary">
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
                                <th width="10%">Hình ảnh</th>
                                <th width="15%">Tên sản phẩm</th>
                                <th width="12%">Loại sản phẩm</th>
                                <th width="8%">Hãng</th>
                                <th width="10%">Số lượng</th>
                                <th width="10%">Đã bán</th>
                                <th width="10%">Giá</th>

                                <th width="10%">Trạng thái</th>

                                <th width="5%">Sửa</th>
                                <th width="5%">Xóa</th>
                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($sanpham as $sp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center"><img src="{{ asset('storage/' . $sp->hinhanh) }}" width="100"
                                            class="img-thumbnail" /></td>
                                    <td> <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalChiTiet{{ $sp->id }}">{{ $sp->tensanpham }}</a></td>
                                    <td>{{ $sp->loaisanpham->tenloai }}</td>
                                    <td>{{ $sp->hangsanxuat->tenhang }}</td>
                                    <td>{{ $sp->soluong }}</td>
                                    <td>{{ $sp->daban }}</td>
                                  <td>{{ number_format($sp->gia, 0, ',', '.') }}₫</td>

                                    <td>@if($sp->trangthai == 0)
                                                <span class="badge bg-danger">Dừng bán</span>
                                            @elseif($sp->trangthai == 1)
                                                <span class="badge bg-success">Đang bán</span>
                                            @elseif($sp->trangthai == 2)
                                                <span class="badge bg-warning">Đặt trước</span>
                                            @endif</td>
                                    <td class="text-center"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalSua{{ $sp->id }}"><i class="fa-light fa-edit"></i></a>
                                    </td>

                                    <td class="text-center"><a href="{{ route('admin.sanpham.xoa', ['id' => $sp->id]) }}"
                                            onclick="return confirm('Bạn có muốn xóa loại sản phẩm {{ $sp->tensanpham }} không?')"><i
                                                class="fa-light fa-trash-alt text-danger"></i></a>
                                    </td>
                                </tr>
                                @include('admin.sanpham.chitiet')
                                @include('admin.sanpham.sua')
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- cuối content: include modal partial -->
    @include('admin.sanpham.them')
    @include('admin.sanpham.nhap')




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