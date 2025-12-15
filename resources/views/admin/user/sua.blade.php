<!-- Modal Thêm User -->
<div class="modal fade" id="modalSua{{ $user->id }}" tabindex="-1" aria-labelledby="modalUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalUserLabel">
                    <i class="fas fa-user-plus me-2"></i>Sửa Người Dùng
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <form action="{{ route('admin.user.sua', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ & Tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Nhập họ và tên" value="{{ $user->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="Nhập email" value="{{ $user->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-3" hidden>
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" placeholder="Nhập username">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Bỏ qua nếu không đổi mật khẩu">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Quyền</label>
                        <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="0" {{ old('role', $user->role) == 0 ? 'selected' : '' }}>Admin</option>
                            <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>khách hàng</option>
                           

                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Avatar -->
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $user->hinhanh) }}" width="50" height="50"
                            class="rounded-circle border border-2 border-primary mb-1" style="object-fit: cover;"
                            alt="Avatar" />
                        <label for="hinhanh" class="form-label">Ảnh đại diện <span class="text-primary">Để trống nếu
                                không đổi</span></label>
                        <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh"
                            name="hinhanh" accept="image/*">
                        @error('hinhanh')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Định dạng: JPG, PNG, GIF (Max: 2MB)</small>
                    </div>

                    <!-- Nút lưu -->
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Lưu Người Dùng
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>

</script>