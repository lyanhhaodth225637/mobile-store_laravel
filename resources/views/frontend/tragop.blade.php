@extends('layouts.frontend.app')
@section('title', 'Chính sách trả góp')
@section('content')
    <!-- Page content -->

    <main class="content-wrapper">
        <nav class="container pt-3 my-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active">Chính sách trả góp</li>
            </ol>
        </nav>

        <h1 class="h3 container mb-4">Chính sách và điều kiện trả góp</h1>

        <section class="container mb-5">
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <!-- Sidebar navigation -->
                    <div class="list-group sticky-top" style="top: 100px;">
                        <a href="#dieu-kien" class="list-group-item list-group-item-action">Điều kiện trả góp</a>
                        <a href="#ho-so" class="list-group-item list-group-item-action">Hồ sơ cần thiết</a>
                        <a href="#cac-goi" class="list-group-item list-group-item-action">Các gói trả góp</a>
                        <a href="#ngan-hang" class="list-group-item list-group-item-action">Ngân hàng hỗ trợ</a>
                        <a href="#quy-trinh" class="list-group-item list-group-item-action">Quy trình trả góp</a>
                        <a href="#luu-y" class="list-group-item list-group-item-action">Lưu ý quan trọng</a>
                        <a href="#cau-hoi" class="list-group-item list-group-item-action">Câu hỏi thường gặp</a>
                        <a href="{{ route('user.hopdong.tragop') }}" class="list-group-item list-group-item-action">Lập hợp
                            đồng</a>
                    </div>
                </div>

                <div class="col-lg-9">
                    <!-- Điều kiện trả góp -->
                    <div id="dieu-kien" class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Điều kiện trả góp</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="text-primary">1. Điều kiện về độ tuổi và giấy tờ</h5>
                            <ul class="mb-4">
                                <li>Công dân Việt Nam từ đủ 18 tuổi trở lên</li>
                                <li>Có CMND/CCCD hoặc Hộ chiếu còn hiệu lực</li>
                                <li>Đối với người nước ngoài: Hộ chiếu + thẻ tạm trú</li>
                            </ul>

                            <h5 class="text-primary">2. Điều kiện về thu nhập</h5>
                            <ul class="mb-4">
                                <li>Có thu nhập ổn định từ 3 triệu đồng/tháng trở lên</li>
                                <li>Đang làm việc tại công ty, doanh nghiệp hoặc có hoạt động kinh doanh</li>
                                <li>Không cần chứng minh thu nhập đối với một số gói trả góp đặc biệt</li>
                            </ul>

                            <h5 class="text-primary">3. Điều kiện về nơi cư trú</h5>
                            <ul>
                                <li>Có địa chỉ thường trú hoặc tạm trú rõ ràng</li>
                                <li>Có thể xác minh được địa chỉ hiện tại</li>
                                <li>Ưu tiên khách hàng có hộ khẩu tại địa phương</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Hồ sơ cần thiết -->
                    <div id="ho-so" class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0">Hồ sơ cần thiết</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Hồ sơ có thể thay đổi tùy theo từng ngân hàng/công ty tài
                                chính
                            </div>

                            <h5 class="text-success">Hồ sơ cơ bản (bắt buộc)</h5>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>STT</th>
                                            <th>Loại giấy tờ</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>CMND/CCCD/Hộ chiếu</td>
                                            <td>Bản gốc, còn hiệu lực</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Hộ khẩu</td>
                                            <td>Bản sao có công chứng hoặc bản gốc</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Sổ hộ khẩu tạm trú</td>
                                            <td>Nếu không có hộ khẩu thường trú</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h5 class="text-success">Hồ sơ bổ sung (tùy trường hợp)</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h6 class="card-title">Người đi làm</h6>
                                            <ul class="mb-0">
                                                <li>Hợp đồng lao động</li>
                                                <li>Bảng lương 3 tháng gần nhất</li>
                                                <li>Xác nhận công việc</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h6 class="card-title">Kinh doanh tự do</h6>
                                            <ul class="mb-0">
                                                <li>Giấy phép kinh doanh</li>
                                                <li>Hóa đơn bán hàng</li>
                                                <li>Sao kê ngân hàng</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Các gói trả góp -->
                    <div id="cac-goi" class="card mb-4">
                        <div class="card-header bg-warning">
                            <h4 class="mb-0">Các gói trả góp</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card border-primary h-100">
                                        <div class="card-header bg-primary text-white text-center">
                                            <h5 class="mb-0">Trả góp 0%</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul>
                                                <li>Lãi suất: <strong>0%</strong></li>
                                                <li>Kỳ hạn: 3, 6, 9, 12 tháng</li>
                                                <li>Trả trước: 10-20%</li>
                                                <li>Không phí ẩn</li>
                                            </ul>
                                            <div class="alert alert-success small mb-0">
                                                <strong>Phù hợp:</strong> Mua sắm lớn, không muốn trả lãi
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="card border-info h-100">
                                        <div class="card-header bg-info text-white text-center">
                                            <h5 class="mb-0">Trả góp thẻ tín dụng</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul>
                                                <li>Lãi suất: Theo ngân hàng</li>
                                                <li>Kỳ hạn: 3-24 tháng</li>
                                                <li>Trả trước: 0%</li>
                                                <li>Duyệt nhanh</li>
                                            </ul>
                                            <div class="alert alert-info small mb-0">
                                                <strong>Phù hợp:</strong> Đã có thẻ tín dụng, cần nhanh chóng
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="card border-success h-100">
                                        <div class="card-header bg-success text-white text-center">
                                            <h5 class="mb-0">Công ty tài chính</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul>
                                                <li>Lãi suất: 1.5-2.5%/tháng</li>
                                                <li>Kỳ hạn: 6-18 tháng</li>
                                                <li>Trả trước: 0-10%</li>
                                                <li>Thủ tục đơn giản</li>
                                            </ul>
                                            <div class="alert alert-success small mb-0">
                                                <strong>Phù hợp:</strong> Không có thẻ tín dụng
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive mt-4">
                                <h5>So sánh các gói trả góp</h5>
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tiêu chí</th>
                                            <th>Trả góp 0%</th>
                                            <th>Thẻ tín dụng</th>
                                            <th>Công ty tài chính</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Thời gian duyệt</td>
                                            <td>30-60 phút</td>
                                            <td>5-10 phút</td>
                                            <td>15-30 phút</td>
                                        </tr>
                                        <tr>
                                            <td>Giá trị tối thiểu</td>
                                            <td>3.000.000đ</td>
                                            <td>1.000.000đ</td>
                                            <td>2.000.000đ</td>
                                        </tr>
                                        <tr>
                                            <td>Độ phổ biến</td>
                                            <td>⭐⭐⭐⭐⭐</td>
                                            <td>⭐⭐⭐⭐</td>
                                            <td>⭐⭐⭐</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Ngân hàng hỗ trợ -->
                    <div id="ngan-hang" class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h4 class="mb-0">Ngân hàng và công ty tài chính hỗ trợ</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="text-info">Ngân hàng</h5>
                            <div class="row mb-4">
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="border rounded p-3 text-center h-100">
                                        <strong>VPBank</strong>
                                        <p class="small mb-0 text-muted">Lãi suất ưu đãi</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="border rounded p-3 text-center h-100">
                                        <strong>TPBank</strong>
                                        <p class="small mb-0 text-muted">Duyệt nhanh</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="border rounded p-3 text-center h-100">
                                        <strong>Shinhan Bank</strong>
                                        <p class="small mb-0 text-muted">Hạn mức cao</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="border rounded p-3 text-center h-100">
                                        <strong>VIB</strong>
                                        <p class="small mb-0 text-muted">Linh hoạt</p>
                                    </div>
                                </div>
                            </div>

                            <h5 class="text-info">Công ty tài chính</h5>
                            <div class="row">
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="border rounded p-3 text-center h-100">
                                        <strong>Home Credit</strong>
                                        <p class="small mb-0 text-muted">Thủ tục đơn giản</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="border rounded p-3 text-center h-100">
                                        <strong>FE Credit</strong>
                                        <p class="small mb-0 text-muted">Tỷ lệ duyệt cao</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="border rounded p-3 text-center h-100">
                                        <strong>HD Saison</strong>
                                        <p class="small mb-0 text-muted">Uy tín</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="border rounded p-3 text-center h-100">
                                        <strong>Mirae Asset</strong>
                                        <p class="small mb-0 text-muted">Nhanh chóng</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quy trình trả góp -->
                    <div id="quy-trinh" class="card mb-4">
                        <div class="card-header bg-danger text-white">
                            <h4 class="mb-0">Quy trình đăng ký trả góp</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    <div class="text-center">
                                        <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                            style="width: 60px; height: 60px;">
                                            <h3 class="mb-0">1</h3>
                                        </div>
                                        <h5>Chọn sản phẩm</h5>
                                        <p class="small text-muted">Lựa chọn sản phẩm và gói trả góp phù hợp</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="text-center">
                                        <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                            style="width: 60px; height: 60px;">
                                            <h3 class="mb-0">2</h3>
                                        </div>
                                        <h5>Chuẩn bị hồ sơ</h5>
                                        <p class="small text-muted">Mang theo CMND/CCCD và các giấy tờ cần thiết</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="text-center">
                                        <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                            style="width: 60px; height: 60px;">
                                            <h3 class="mb-0">3</h3>
                                        </div>
                                        <h5>Điền đơn đăng ký</h5>
                                        <p class="small text-muted">Nhân viên hỗ trợ điền đơn và kiểm tra hồ sơ</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="text-center">
                                        <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                            style="width: 60px; height: 60px;">
                                            <h3 class="mb-0">4</h3>
                                        </div>
                                        <h5>Nhận sản phẩm</h5>
                                        <p class="small text-muted">Được duyệt và nhận sản phẩm ngay lập tức</p>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-warning mt-4">
                                <strong>Lưu ý:</strong> Thời gian duyệt hồ sơ thường từ 15-60 phút tùy theo từng đối tác tài
                                chính.
                            </div>
                        </div>
                    </div>

                    <!-- Lưu ý quan trọng -->
                    <div id="luu-y" class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h4 class="mb-0">Lưu ý quan trọng</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="alert alert-danger">
                                        <h6 class="alert-heading">❌ Những điều KHÔNG nên</h6>
                                        <ul class="mb-0 small">
                                            <li>Cung cấp thông tin sai lệch trong hồ sơ</li>
                                            <li>Trả góp vượt quá khả năng tài chính</li>
                                            <li>Chậm trễ thanh toán các kỳ</li>
                                            <li>Đăng ký nhiều khoản trả góp cùng lúc</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="alert alert-success">
                                        <h6 class="alert-heading">✅ Nên thực hiện</h6>
                                        <ul class="mb-0 small">
                                            <li>Đọc kỹ hợp đồng trước khi ký</li>
                                            <li>Thanh toán đúng hạn mỗi tháng</li>
                                            <li>Giữ liên lạc với ngân hàng/công ty tài chính</li>
                                            <li>Lưu giữ các chứng từ thanh toán</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h5 class="mt-3">Hậu quả khi chậm trả góp</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Thời gian chậm</th>
                                            <th>Hậu quả</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1-7 ngày</td>
                                            <td>Nhắc nhở qua điện thoại, phí phạt nhỏ</td>
                                        </tr>
                                        <tr>
                                            <td>8-30 ngày</td>
                                            <td>Phí phạt tăng, ảnh hưởng điểm tín dụng</td>
                                        </tr>
                                        <tr>
                                            <td>Trên 30 ngày</td>
                                            <td>Chuyển hồ sơ sang bộ phận pháp lý, thu hồi tài sản</td>
                                        </tr>
                                        <tr>
                                            <td>Trên 90 ngày</td>
                                            <td>Đưa vào danh sách đen CIC, khó vay mượn trong tương lai</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Câu hỏi thường gặp -->
                    <div id="cau-hoi" class="card mb-4">
                        <div class="card-header bg-dark text-white">
                            <h4 class="mb-0">Câu hỏi thường gặp</h4>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="faqAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq1">
                                            Trả góp 0% có thật sự không mất phí gì không?
                                        </button>
                                    </h2>
                                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Đúng vậy! Với chương trình trả góp 0%, bạn chỉ cần trả đúng giá trị sản phẩm
                                            chia đều theo số tháng, không có bất kỳ khoản lãi suất hay phí ẩn nào. Shop và
                                            đối tác tài chính sẽ hỗ trợ phần lãi suất cho bạn.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq2">
                                            Tôi không có thẻ tín dụng, có thể trả góp không?
                                        </button>
                                    </h2>
                                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Hoàn toàn có thể! Bạn có thể đăng ký trả góp qua các công ty tài chính như Home
                                            Credit, FE Credit, HD Saison mà không cần thẻ tín dụng. Chỉ cần CMND/CCCD và một
                                            số giấy tờ đơn giản.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq3">
                                            Có thể trả trước hạn không? Có mất phí không?
                                        </button>
                                    </h2>
                                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Bạn có thể trả trước hạn bất cứ lúc nào. Tuy nhiên, một số ngân hàng/công ty tài
                                            chính có thể tính phí trả trước hạn (thường 1-3% số dư còn lại). Vui lòng kiểm
                                            tra kỹ hợp đồng hoặc liên hệ với đối tác tài chính để biết chính xác.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq4">
                                            Hồ sơ bị từ chối, tôi nên làm gì?
                                        </button>
                                    </h2>
                                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Nếu hồ sơ bị từ chối, bạn có thể: (1) Thử đăng ký với đối tác tài chính khác vì
                                            mỗi đơn vị có tiêu chí khác nhau, (2) Kiểm tra và bổ sung đầy đủ hồ sơ, (3) Xem
                                            xét giảm số tiền vay hoặc tăng số tiền trả trước, (4) Liên hệ nhân viên tư vấn
                                            để được hỗ trợ cụ thể.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq5">
                                            Trả góp có ảnh hưởng đến điểm tín dụng không?
                                        </button>
                                    </h2>
                                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Trả góp đúng hạn sẽ giúp xây dựng lịch sử tín dụng tốt và cải thiện điểm tín
                                            dụng của bạn. Tuy nhiên, nếu trả chậm hoặc nợ xấu sẽ ảnh hưởng tiêu cực đến điểm
                                            tín dụng, khiến bạn khó vay mượn trong tương lai.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq6">
                                            Tôi có thể trả góp bao nhiêu sản phẩm cùng lúc?
                                        </button>
                                    </h2>
                                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Số lượng sản phẩm trả góp phụ thuộc vào hạn mức được duyệt và khả năng tài chính
                                            của bạn. Tuy nhiên, chúng tôi khuyến nghị chỉ nên trả góp số lượng vừa phải với
                                            thu nhập của bạn để đảm bảo khả năng thanh toán.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq7">
                                            Sinh viên có thể đăng ký trả góp không?
                                        </button>
                                    </h2>
                                    <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Sinh viên từ 18 tuổi trở lên có thể đăng ký trả góp. Tuy nhiên, do chưa có thu
                                            nhập ổn định, bạn có thể cần người thân bảo lãnh hoặc cung cấp thêm giấy tờ
                                            chứng minh nguồn thu nhập (học bổng, làm thêm, hỗ trợ từ gia đình).
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq8">
                                            Nếu tôi mất việc làm trong thời gian trả góp thì sao?
                                        </button>
                                    </h2>
                                    <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Nếu gặp khó khăn về tài chính, hãy liên hệ ngay với ngân hàng/công ty tài chính
                                            để thông báo tình hình và tìm phương án hỗ trợ như: điều chỉnh kỳ hạn, tạm hoãn
                                            thanh toán, hoặc tái cơ cấu khoản vay. Tránh để nợ quá hạn vì sẽ ảnh hưởng xấu
                                            đến tín dụng.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-primary mt-4">
                                <h6 class="alert-heading">Cần hỗ trợ thêm?</h6>
                                <p class="mb-0">Liên hệ hotline: <strong>1900-xxxx</strong> hoặc email:
                                    <strong>support@shop.com</strong> để được tư vấn chi tiết về chính sách trả góp.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Lợi ích khi trả góp -->
                    <div class="card mb-4 border-primary">
                        <div class="card-body">
                            <h4 class="text-primary mb-3">🎁 Lợi ích khi trả góp tại Shop</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <h6>✓ Thủ tục nhanh chóng</h6>
                                    <p class="small text-muted mb-0">Duyệt hồ sơ chỉ từ 15-60 phút</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h6>✓ Nhiều lựa chọn</h6>
                                    <p class="small text-muted mb-0">Đa dạng ngân hàng và công ty tài chính</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h6>✓ Hỗ trợ tận tình</h6>
                                    <p class="small text-muted mb-0">Nhân viên tư vấn và hỗ trợ miễn phí</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h6>✓ Ưu đãi đặc biệt</h6>
                                    <p class="small text-muted mb-0">Thường xuyên có chương trình khuyến mãi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

@endsection