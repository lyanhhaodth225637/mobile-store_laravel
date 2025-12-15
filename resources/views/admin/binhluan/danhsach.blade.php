@extends('layouts.admin.app')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Bình Luận</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">

                    <!-- Form lọc và nút thêm -->
                    <div class="d-flex align-items-center gap-2">
                        <form action="{{ route('admin.binhluan.loc') }}" method="GET"
                            class="d-flex align-items-center gap-2 m-0">

                            <select name="sosao" class="form-select" style="width: 180px;">
                                <option value="">Số sao</option>
                                <option value="1" {{ request('sosao') == '1' ? 'selected' : '' }}>1 sao</option>
                                <option value="2" {{ request('sosao') == '2' ? 'selected' : '' }}>2 sao</option>
                                <option value="3" {{ request('sosao') == '3' ? 'selected' : '' }}>3 sao</option>
                                <option value="4" {{ request('sosao') == '4' ? 'selected' : '' }}>4 sao</option>
                                <option value="5" {{ request('sosao') == '5' ? 'selected' : '' }}>5 sao</option>

                            </select>


                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-filter"></i>
                            </button>
                            <a href="{{ route('admin.binhluan.loc') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-rotate-right"></i>
                            </a>

                        </form>


                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Tên</th>
                                <th width="10%">Hình ảnh</th>
                                <th width="10%">Sản phẩm</th>
                                <th width="15%">Nội dung</th>
                                <th width="12%">đánh giá</th>


                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($binhluan as $bl)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bl->user->name }}</td>
                                    <td class="text-center"><img src="{{ asset('storage/' . $bl->sanpham->hinhanh) }}"
                                            width="100" class="img-thumbnail" /></td>
                                    <td>{{ $bl->sanpham->tensanpham }}</td>
                                    <td>{{ $bl->noidung }}</td>
                                    <td>{{ $bl->danhgia }} sao</td>
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