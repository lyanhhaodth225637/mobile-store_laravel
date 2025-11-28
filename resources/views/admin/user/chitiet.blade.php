<!-- Modal Chi tiết Người dùng -->
<div class="modal fade" id="modalChiTiet{{ $user->id }}" tabindex="-1" aria-labelledby="modalChiTietLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title fw-bold" id="modalChiTietLabel">
                    <i class="fas fa-user-circle me-2"></i>Chi tiết Người dùng
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Đóng"></button>
            </div>

            <div class="modal-body bg-light p-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <!-- Avatar người dùng -->
                        <div class="text-center mb-4" id="user-image-container">
                            <img src="{{ asset('storage/' . $user->hinhanh) }}" alt="Avatar người dùng"
                                class="img-fluid rounded-circle shadow"
                                style="width: 150px; height: 150px; object-fit: cover;" id="chitiet-avatar">
                        </div>

                        <hr class="my-4">

                        <!-- Tên người dùng -->
                        <div class="row mb-3">
                            <div class="d-flex">
                                <label class="form-label fw-bold text-dark">
                                    <i class="fas fa-user text-primary me-2"></i>Tên:
                                </label>
                                <p class="ms-2" id="chitiet-name">{{ $user->name }}</p>
                            </div>
                        </div>

                        <!-- Username & Email -->
                        <div class="row mb-3">
                            <div class="col-md-6" hidden>
                                <div class="d-flex">
                                    <label class="form-label fw-bold text-dark">
                                        <i class="fas fa-at text-primary me-2"></i>Username:
                                    </label>
                                    <p class="ms-2" id="chitiet-username">{{ $user->username ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <label class="form-label fw-bold text-dark">
                                        <i class="fas fa-envelope text-primary me-2"></i>Email:
                                    </label>
                                    <p class="ms-2" id="chitiet-email">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Role & Points -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <label class="form-label fw-bold text-dark">
                                        <i class="fas fa-shield-alt text-warning me-2"></i>Vai trò:
                                    </label>
                                    <p class="ms-2" id="chitiet-role">
                                        @if($user->role == 0)
                                            <span class="badge bg-danger p-1">Quản trị</span>
                                        @elseif($user->role == 1)
                                            <span class="badge bg-warning p-1">Nhân viên</span>
                                        @elseif($user->role == 2)
                                            <span class="badge bg-success p-1">Khách hàng</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <label class="form-label fw-bold text-dark">
                                        <i class="fas fa-star text-success me-2"></i>Điểm:
                                    </label>
                                    <p class="ms-2" id="chitiet-points">{{ $user->points }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email Verified Status -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <label class="form-label fw-bold text-dark">
                                        <i class="fas fa-check-circle text-info me-2"></i>Email xác thực:
                                    </label>
                                    <p class="ms-2" id="chitiet-email-verified">
                                        @if($user->email_verified_at)
                                            <span class="badge bg-success">Đã xác thực</span>
                                        @else
                                            <span class="badge bg-danger">Chưa xác thực</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Ngày tạo & Ngày cập nhật -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-5">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-calendar-plus text-muted me-2"></i>Ngày tạo:
                                        </label>
                                    </div>
                                    <div class="col-7">
                                        <p class="form-control-plaintext text-muted small" id="chitiet-created">
                                            {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : '---' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-5">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-calendar-check text-muted me-2"></i>Cập nhật:
                                        </label>
                                    </div>
                                    <div class="col-7">
                                        <p class="form-control-plaintext text-muted small" id="chitiet-updated">
                                            {{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : '---' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Đóng
                </button>
            </div>
        </div>
    </div>
</div>