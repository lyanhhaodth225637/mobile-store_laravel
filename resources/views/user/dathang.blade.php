@extends('layouts.frontend.app')
@section('title', 'Thanh toán đơn hàng')

@section('content')
<main class="content-wrapper bg-light">
    <div class="container py-5">
        <div class="row g-4">

            <!-- ================= LEFT COLUMN ================= -->
            <div class="col-lg-7 col-xl-8">

                <!-- FORM ĐẶT HÀNG -->
                <form id="checkout-form" method="POST" novalidate>
                    @csrf

                    <!-- THÔNG TIN GIAO HÀNG -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" 
                                     style="width: 40px; height: 40px; font-weight: 600;">1</div>
                                <h5 class="mb-0 fw-bold">Thông tin giao hàng</h5>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small mb-2">Họ và tên</label>
                                <input type="text" class="form-control form-control-lg bg-light" 
                                       value="{{ Auth::user()->name }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small mb-2">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" name="sodienthoai" class="form-control form-control-lg" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small mb-2">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                                <input type="text" name="diachi" class="form-control form-control-lg" required>
                            </div>
                        </div>
                    </div>

                    <!-- PHƯƠNG THỨC THANH TOÁN -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" 
                                     style="width: 40px; height: 40px; font-weight: 600;">2</div>
                                <h5 class="mb-0 fw-bold">Phương thức thanh toán</h5>
                            </div>

                            <!-- COD -->
                            <div hidden class="payment-option mb-3">
                                <input class="form-check-input payment-method d-none" type="radio" 
                                       name="payment_method" id="payment-cod" value="cod" checked>
                                <label for="payment-cod" class="payment-label card border rounded-3 p-3 cursor-pointer w-100 mb-0">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check-radio me-3">
                                            <span class="radio-icon"></span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold mb-1">Thanh toán khi nhận hàng (COD)</div>
                                            <small class="text-muted">Thanh toán bằng tiền mặt khi nhận hàng</small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- MSPAY -->
                            <div class="payment-option mb-3">
                                <input class="form-check-input payment-method d-none" type="radio" 
                                       name="payment_method" id="payment-mspay" value="mspay">
                                <label for="payment-mspay" class="payment-label card border rounded-3 p-3 cursor-pointer w-100 mb-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check-radio me-3">
                                                <span class="radio-icon"></span>
                                            </div>
                                            <div>
                                                <div class="fw-semibold mb-1">Ví MSPay</div>
                                                <small class="text-muted">Thanh toán nhanh và bảo mật</small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted d-block">Số dư:</small>
                                            <strong class="text-primary">{{ number_format(Auth::user()->mspay_balance, 0, ',', '.') }}đ</strong>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- PIN MSPAY -->
                            <div id="mspay-pin-box" class="d-none">
                                <div class="alert alert-info border-0 mb-3">
                                    <small>Vui lòng nhập mã PIN để xác thực thanh toán</small>
                                </div>
                                <label class="form-label text-muted small mb-2">Mã PIN MSPay</label>
                                <input type="password" name="pin" class="form-control form-control-lg text-center" 
                                       maxlength="6" placeholder="••••••" style="letter-spacing: 8px; font-size: 24px;">
                            </div>

                            <!-- ĐIỀU KHOẢN -->
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" id="accept-terms" name="accept_terms" checked>
                                <label class="form-check-label" for="accept-terms">
                                    Tôi đồng ý với <a href="#" class="text-decoration-underline">Điều khoản và Điều kiện</a>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4 py-3 fw-semibold">
                                XÁC NHẬN ĐẶT HÀNG
                            </button>
                        </div>
                    </div>
                </form>

            </div>

            <!-- ================= RIGHT COLUMN ================= -->
            <div class="col-lg-5 col-xl-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Đơn hàng của bạn</h5>

                        <!-- Products List -->
                        <div class="order-items mb-3">
                            @foreach(Cart::content() as $item)
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">{{ $item->name }}</div>
                                        <small class="text-muted">Số lượng: {{ $item->qty }}</small>
                                    </div>
                                    <div class="fw-semibold text-primary ms-3">
                                        {{ number_format($item->price * $item->qty, 0, ',', '.') }}đ
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-3">

                        <!-- VOUCHER -->
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-2">Mã giảm giá</label>
                            <form action="{{ route('user.apply-voucher') }}" method="POST" class="d-flex gap-2">
                                @csrf
                                <select name="ma_voucher" class="form-select">
                                    <option value="">Chọn voucher</option>
                                    @foreach($userVouchers as $uv)
                                        <option value="{{ $uv->voucher->ma_voucher }}"
                                            @if(session('voucher') && session('voucher')->id == $uv->voucher->id) selected @endif
                                            @if($uv->voucher->trang_thai==0 || $uv->voucher->so_luong==0 || \Carbon\Carbon::parse($uv->voucher->het_han)->isPast()) disabled @endif>
                                            {{ $uv->voucher->ma_voucher }} - {{ number_format($uv->voucher->gia_tri,0,',','.') }}đ
                                            @if($uv->voucher->trang_thai==0 || $uv->voucher->so_luong==0 || \Carbon\Carbon::parse($uv->voucher->het_han)->isPast()) (hết hạn) @endif
                                        </option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-primary">Áp dụng</button>
                            </form>
                        </div>

                        @if(session('voucher'))
                            <div class="alert alert-success border-0 py-2 mb-3">
                                <small>✓ Giảm {{ number_format(session('voucher')->gia_tri,0,',','.') }}đ với mã {{ session('voucher')->ma_voucher }}</small>
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger border-0 py-2 mb-3">
                                <small>{{ session('error') }}</small>
                            </div>
                        @endif

                        <!-- Summary -->
                        <div class="order-summary">
                           
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">VAT (10%)</span>
                                <span class="text-success"> {{ Cart::tax(0, ',', '.') }}đ</span>
                            </div>
                             <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Tạm tính</span>
                                <span>{{ Cart::total(0, ',', '.') }} đ</span>
                            </div>
                            @if(session('voucher'))
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Giảm giá</span>
                                <span class="text-danger">-{{ number_format(session('voucher')->gia_tri,0,',','.') }}đ</span>
                            </div>
                            @endif

                            <hr class="my-3">

                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">Tổng cộng</h5>
                                @php
                                    $voucher = session('voucher');
                                    $discount = $voucher ? $voucher->gia_tri : 0;
                                    $cartTotal = (float) str_replace(['.', ','], ['', '.'], Cart::total());
                                    $grandTotal = max($cartTotal - $discount, 0);
                                @endphp
                                <h4 class="mb-0 fw-bold text-primary">{{ number_format($grandTotal,0,',','.') }}đ</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection

@section('styles')
<style>
    .payment-label {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .payment-label:hover {
        border-color: #0d6efd !important;
        background-color: #f8f9ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
    }

    .payment-method:checked + .payment-label {
        border-color: #0d6efd !important;
        background-color: #f0f7ff;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }

    .form-check-radio {
        width: 20px;
        height: 20px;
        border: 2px solid #dee2e6;
        border-radius: 50%;
        position: relative;
        transition: all 0.3s ease;
    }

    .payment-method:checked + .payment-label .form-check-radio {
        border-color: #0d6efd;
        background-color: #0d6efd;
    }

    .payment-method:checked + .payment-label .form-check-radio::after {
        content: '';
        position: absolute;
        width: 8px;
        height: 8px;
        background: white;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
    }

    @media (max-width: 991px) {
        .sticky-top {
            position: relative !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
const radios = document.querySelectorAll('.payment-method');
const pinBox = document.getElementById('mspay-pin-box');
const form = document.getElementById('checkout-form');

radios.forEach(radio => {
    radio.addEventListener('change', () => {
        if (radio.value === 'mspay' && radio.checked) {
            pinBox.classList.remove('d-none');
            form.action = "{{ route('user.dathang.mspay') }}";
        } else {
            pinBox.classList.add('d-none');
            form.action = "{{ route('user.dathang') }}";
        }
    });
});
</script>
@endsection