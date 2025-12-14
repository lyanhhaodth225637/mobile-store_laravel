<x-mail::message>
# 🎉 Đặt hàng thành công!

Xin chào **{{ $donhang->user->name ?? 'Quý khách' }}**,

Cảm ơn bạn đã đặt hàng tại **{{ config('app.name', 'Laravel') }}**.

---

## 🚚 Thông tin giao hàng
- **Điện thoại:** {{ $donhang->sodienthoai }}
- **Địa chỉ:** {{ $donhang->diachi }}

---

## 🛒 Chi tiết đơn hàng
<x-mail::table>
| # | Sản phẩm | SL | Đơn giá | Thành tiền |
|:-:|----------|:--:|--------:|-----------:|
@php $tongtien = 0; @endphp
@foreach($donhang->DonHang_ChiTiet as $ct)
| {{ $loop->iteration }} | {{ $ct->SanPham->tensanpham }} | {{ $ct->soluong }} | {{ number_format($ct->gia_khuyenmai, 0, ',', '.') }}đ | {{ number_format($ct->soluong * $ct->gia_khuyenmai, 0, ',', '.') }}đ |
@php $tongtien += $ct->soluong * $ct->gia_khuyenmai; @endphp
@endforeach
| | | | **Tổng cộng** | **{{ number_format($donhang->tongtien, 0, ',', '.') }}đ** |
</x-mail::table>

<x-mail::button :url="route('frontend.home')">
Tiếp tục mua sắm
</x-mail::button>

Trân trọng,  
**{{ config('app.name', 'Laravel') }}**
</x-mail::message>
