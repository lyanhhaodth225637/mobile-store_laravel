@extends('layouts.frontend.app')
@section('title', 'Hồ sơ khách hàng')
@section('content')
    <!-- Page content -->
    <main class="content-wrapper">
        <nav class="container pt-3 my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Khách hàng</a></li>
                <li class="breadcrumb-item active">Hồ sơ cá nhân</li>
            </ol>
        </nav>

        <div class="container mt-4">
            <div class="row">
                <!-- Sidebar navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
                @include('user.sidebar')

                <!-- Personal info content -->
                <div class="col-lg-9">
                    <div class="ps-lg-3 ps-xl-0">
                        <!-- msPay Wallet Section -->
                        <div class="border-bottom py-4">
                            <div class="nav flex-nowrap align-items-center justify-content-between pb-1 mb-3">
                                <div class="d-flex align-items-center gap-3 me-4">
                                    <h2 class="h6 mb-0">Ví điện tử msPay</h2>
                                </div>
                            </div>
                            <!-- thông báo thành công -->
                            @if (session('success'))
                                <div id="success"
                                    class="alert alert-success alert-dismissible fade show d-flex justify-content-between"
                                    role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <div>
                                        <span id="countdown">Đống sau 3 giây</span>
                                        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>

                                </div>
                            @endif

                            <!-- thông báo thất bại -->
                            @if (session('error'))
                                <div id="error"
                                    class="alert alert-danger alert-dismissible fade show d-flex justify-content-between"
                                    role="alert">
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif  
                            <!-- PIN Not Set Alert -->
                            @if(empty(Auth::user()->mspay_pin))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <div class="d-flex align-items-start">
                                        <i class="ci-alert fs-5 me-3 mt-1"></i>
                                        <div>
                                            <h6 class="alert-heading">Bạn chưa đặt mã PIN msPay</h6>
                                            <p class="mb-0">Vui lòng đặt mã PIN để sử dụng các tính năng nạp tiền, rút tiền và
                                                thanh toán trên ví msPay.</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                                <!-- Setup PIN Card -->
                                <div class="card border-0 bg-light mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h5 class="mb-0">Thiết lập mã PIN msPay</h5>
                                            <i class="ci-lock fs-3 text-muted"></i>
                                        </div>
                                        <p class="text-muted mb-3">Mã PIN là 6 chữ số, được dùng để xác nhận các giao dịch và
                                            bảo vệ tài khoản của bạn.</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#setupPinModal">
                                            <i class="ci-plus-circle me-2"></i>Đặt mã PIN
                                        </button>
                                    </div>
                                </div>
                            @else
                                <!-- Wallet Balance Card -->
                                <div class="card border-0 bg-primary bg-opacity-10 mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="text-muted mb-1">Số dư khả dụng</p>
                                                <h3 class="mb-0">
                                                    {{ number_format(Auth::user()->mspay_balance ?? 0, 0, ',', '.') }}đ
                                                </h3>
                                            </div>
                                            <div class="bg-primary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 60px;">
                                                <i class="ci-wallet fs-2 text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Wallet Actions -->
                                <div class="row g-3 mb-4">
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                            data-bs-target="#topUpModal">
                                            <i class="ci-plus-circle me-2"></i>Nạp tiền
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                                            data-bs-target="#withdrawModal">
                                            <i class="ci-arrow-up me-2"></i>Rút tiền
                                        </button>
                                    </div>
                                </div>

                                <!-- Transaction History -->
                                <div class="mb-3">
                                    <h6 class="mb-3">Lịch sử giao dịch gần đây</h6>
                                    <div class="list-group list-group-flush">
                                        @forelse($walletTransactions as $transaction)
                                            <div class="list-group-item px-0">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div class="d-flex gap-3">
                                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                                            style="width: 40px; height: 40px;">
                                                            @if($transaction->loai_giao_dich === 'nap_tien')
                                                                <i class="ci-arrow-down text-success"></i>
                                                            @else
                                                                <i class="ci-arrow-up text-danger"></i>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <p class="mb-0 fw-medium">{{ $transaction->mo_ta }}</p>
                                                            <small class="text-muted">
                                                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <p
                                                            class="mb-0 fw-semibold 
                                                        {{ $transaction->loai_giao_dich === 'nap_tien' ? 'text-success' : 'text-danger' }}">
                                                            {{ $transaction->loai_giao_dich === 'nap_tien' ? '+' : '-' }}
                                                            {{ number_format($transaction->so_tien, 0, ',', '.') }}đ
                                                        </p>
                                                        <small class="text-muted">
                                                            Số dư: {{ number_format($transaction->so_du_sau, 0, ',', '.') }}đ
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center py-4">
                                                <i class="ci-file-text fs-2 text-muted mb-2"></i>
                                                <p class="text-muted mb-0">Chưa có giao dịch nào</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>


                                <a href="#" class="btn btn-link text-decoration-none p-0">
                                    Xem tất cả giao dịch <i class="ci-arrow-right ms-1"></i>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--  PIN Modal -->
    <div class="modal fade" id="setupPinModal" tabindex="-1" aria-labelledby="setupPinModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setupPinModalLabel">Đặt mã PIN MSPay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.mspay.dk_pin') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <small>Mã PIN phải là 6 chữ số và được dùng để xác nhận các giao dịch quan trọng.</small>
                        </div>
                        <div class="mb-3">
                            <label for="mspayPin" class="form-label">Mã PIN (6 chữ số)</label>
                            <input type="password" class="form-control" id="mspayPin" name="pin" pattern="[0-9]{6}"
                                maxlength="6" placeholder="Nhập 6 chữ số" required>
                            <div class="form-text">Ví dụ: 123456</div>
                        </div>
                        <div class="mb-3">
                            <label for="mspayPinConfirm" class="form-label">Xác nhận mã PIN</label>
                            <input type="password" class="form-control" id="mspayPinConfirm" name="pin_confirmation"
                                pattern="[0-9]{6}" maxlength="6" placeholder="Nhập lại 6 chữ số" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Đặt mã PIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Top Up Modal -->
    <div class="modal fade" id="topUpModal" tabindex="-1" aria-labelledby="topUpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="topUpModalLabel">Nạp tiền vào ví msPay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.mspay.naptien') }}" method="POST">

                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="topUpAmount" class="form-label">Số tiền nạp</label>
                            <input type="number" class="form-control" id="topUpAmount" name="amount" min="10000"
                                step="10000" placeholder="Nhập số tiền" required>
                            <div class="form-text">Số tiền tối thiểu: 10.000đ</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Chọn nhanh</label>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="setAmount(50000)">50.000đ</button>
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="setAmount(100000)">100.000đ</button>
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="setAmount(200000)">200.000đ</button>
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="setAmount(500000)">500.000đ</button>
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="setAmount(1000000)">1.000.000đ</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="paymentMethod" class="form-label">Phương thức thanh toán</label>
                            <select class="form-select" id="paymentMethod" name="payment_method" required>
                                <option value="">Chọn phương thức</option>
                                <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                                <option value="momo">Ví MoMo</option>
                                <option value="vnpay">VNPay</option>
                                <option value="zalopay">ZaloPay</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mspayPin" class="form-label">Mã PIN MSPay</label>
                            <input type="password" class="form-control" id="mspayPin" name="pin" pattern="[0-9]{6}"
                                maxlength="6" placeholder="Nhập 6 chữ số" required>
                            <div class="form-text text-danger">
                                Nhập đúng mã PIN để xác nhận nạp tiền
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Xác nhận nạp tiền</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Withdraw Modal -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="withdrawModalLabel">Rút tiền từ ví msPay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <small>Số dư khả dụng:
                                <strong>{{ number_format($user->wallet_balance ?? 0, 0, ',', '.') }}đ</strong></small>
                        </div>
                        <div class="mb-3">
                            <label for="withdrawAmount" class="form-label">Số tiền rút</label>
                            <input type="number" class="form-control" id="withdrawAmount" name="amount" min="50000"
                                max="{{ $user->wallet_balance ?? 0 }}" step="10000" placeholder="Nhập số tiền" required>
                            <div class="form-text">Số tiền tối thiểu: 50.000đ</div>
                        </div>
                        <div class="mb-3">
                            <label for="bankName" class="form-label">Tên ngân hàng</label>
                            <input type="text" class="form-control" id="bankName" name="bank_name"
                                placeholder="VD: Vietcombank" required>
                        </div>
                        <div class="mb-3">
                            <label for="bankAccount" class="form-label">Số tài khoản</label>
                            <input type="text" class="form-control" id="bankAccount" name="bank_account"
                                placeholder="Nhập số tài khoản" required>
                        </div>
                        <div class="mb-3">
                            <label for="accountHolder" class="form-label">Tên chủ tài khoản</label>
                            <input type="text" class="form-control" id="accountHolder" name="account_holder" value=""
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Xác nhận rút tiền</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('floating-button')
    <button type="button"
        class="fixed-bottom z-sticky w-100 btn btn-lg btn-dark border-0 border-top border-light border-opacity-10 rounded-0 pb-4 d-lg-none"
        data-bs-toggle="offcanvas" data-bs-target="#accountSidebar" data-bs-theme="light">
        <i class="ci-sidebar fs-base me-2"></i> Quản lý tài khoản
    </button>
@endsection