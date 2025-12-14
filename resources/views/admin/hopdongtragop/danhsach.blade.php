@extends('layouts.admin.app')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Hợp Đồng Trả Góp</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center gap-2">
                        <form action="{{ route('admin.hopdongtragop.loc') }}" method="GET"
                            class="d-flex align-items-center gap-2 m-0">

                            <select name="hopdong" class="form-select" style="width: 180px;">
                                <option value="">Trạng thái</option>
                                <option value="0" {{ request('duyet') == 'choduyet' ? 'selected' : '' }}>Chờ duyệt</option>
                                <option value="1" {{ request('duyet') == 'daduyet' ? 'selected' : '' }}>Đã duyệt</option>
                                <option value="2" {{ request('duyet') == 'tuchoi' ? 'selected' : '' }}>Từ chối</option>
                                
                            </select>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-filter"></i>
                            </button>
                            <a href="{{ route('admin.hopdongtragop.loc') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-rotate-right"></i>
                            </a>

                        </form>


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
                                <th>#</th>
                                <th>Tên</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Thời hạn góp</th>
                                <th>Lãi</th>
                                <th>Trả tước</th>
                                <th>Duyệt</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hopdong as $hd)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalChiTiet{{ $hd->id }}">{{ $hd->ho_ten }}</a></td>
                                    <td>{{ $hd->sanpham->tensanpham }}</td>
                                    <td>{{ number_format($hd->gia_san_pham, 0, ',', '.') }}</td>

                                    <td>{{ $hd->thoi_han }} tháng</td>
                                    <td>{{ $hd->lai_suat_hang_thang }}%</td>
                                    <td>{{ number_format($hd->so_tien_tra_truoc, 0, ',', '.') }}
                                        ({{ $hd->tra_truoc }}%)</td>

                                    @if($hd->duyet == 0)
                                        <td class="text-center">
                                            <a href="#" class="badge bg-warning text-dark text-decoration-none">Chờ duyệt</a>
                                        </td>
                                    @elseif($hd->duyet == 1)
                                        <td class="text-center">
                                            <a href="#" class="badge bg-success text-white text-decoration-none">Đã duyệt</a>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <a href="#" class="badge bg-danger text-white text-decoration-none">Từ chối</a>
                                        </td>
                                    @endif
                                </tr>
                                @include('admin.hopdongtragop.chitiet')
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