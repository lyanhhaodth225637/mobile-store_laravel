<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SanPham;
use Illuminate\Support\Str;

class ThongsoSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {

        $sanpham = SanPham::all();
        foreach ($sanpham as $sp) {
            $ten = $sp->tensanpham;
            $specs = [];

            // --- LOGIC PHÂN LOẠI THÔNG SỐ CHI TIẾT ---

            // Phân loại dựa trên loaisanpham_id để xử lý riêng cho Điện thoại (1), Máy tính bảng (2), Laptop (3)
            if ($sp->loaisanpham_id == 1) { // Điện thoại
                // 1. Nhóm iPhone (hangsanxuat_id = 2)
                if ($sp->hangsanxuat_id == 2) {
                    // 1.1 iPhone 12 Series
                    if (Str::contains($ten, 'iPhone 12')) {
                        // Trích xuất dung lượng từ tên (ví dụ: 64GB, 128GB,...)
                        $dung_luong = Str::afterLast($ten, ' ') ?? '64 GB'; // Mặc định nếu không tìm thấy
                        $specs = [
                            'man_hinh' => 'OLED, 6.1", Super Retina XDR',
                            'he_dieu_hanh' => 'iOS 15',
                            'camera_sau' => '2 camera 12 MP (Chính & Phụ siêu rộng)',
                            'camera_truoc' => '12 MP',
                            'chip' => 'Apple A14 Bionic 6 nhân',
                            'ram' => '4 GB',
                            'dung_luong_luu_tru' => $dung_luong,
                            'sim' => '1 Nano SIM & 1 eSIM, Hỗ trợ 5G',
                            'pin_sac' => '2815 mAh, Sạc nhanh 20 W, Sạc không dây MagSafe 15 W'
                        ];
                        // Điều chỉnh cho các biến thể như mini, Pro, Pro Max
                        if (Str::contains($ten, 'mini')) {
                            $specs['man_hinh'] = 'OLED, 5.4", Super Retina XDR';
                            $specs['pin_sac'] = '2227 mAh, Sạc nhanh 20 W';
                        } elseif (Str::contains($ten, 'Pro Max')) {
                            $specs['man_hinh'] = 'OLED, 6.7", Super Retina XDR';
                            $specs['camera_sau'] = '3 camera 12 MP (Chính, Telephoto, Siêu rộng)';
                            $specs['pin_sac'] = '3687 mAh, Sạc nhanh 20 W';
                        } elseif (Str::contains($ten, 'Pro')) {
                            $specs['man_hinh'] = 'OLED, 6.1", Super Retina XDR';
                            $specs['camera_sau'] = '3 camera 12 MP (Chính, Telephoto, Siêu rộng)';
                            $specs['pin_sac'] = '2815 mAh, Sạc nhanh 20 W';
                        }
                    }
                    // 1.2 iPhone 11 Series
                    elseif (Str::contains($ten, 'iPhone 11')) {
                        $dung_luong = Str::afterLast($ten, ' ') ?? '64 GB';
                        $specs = [
                            'man_hinh' => 'IPS LCD, 6.1", Liquid Retina HD',
                            'he_dieu_hanh' => 'iOS 15',
                            'camera_sau' => '2 camera 12 MP (Chính & Phụ siêu rộng)',
                            'camera_truoc' => '12 MP',
                            'chip' => 'Apple A13 Bionic 6 nhân',
                            'ram' => '4 GB',
                            'dung_luong_luu_tru' => $dung_luong,
                            'sim' => '1 Nano SIM & 1 eSIM, Hỗ trợ 4G',
                            'pin_sac' => '3110 mAh, Sạc nhanh 18 W'
                        ];
                        // Biến thể Pro và Pro Max
                        if (Str::contains($ten, 'Pro Max')) {
                            $specs['man_hinh'] = 'OLED, 6.5", Super Retina XDR';
                            $specs['camera_sau'] = '3 camera 12 MP (Chính, Telephoto, Siêu rộng)';
                            $specs['pin_sac'] = '3969 mAh, Sạc nhanh 18 W';
                        } elseif (Str::contains($ten, 'Pro')) {
                            $specs['man_hinh'] = 'OLED, 5.8", Super Retina XDR';
                            $specs['camera_sau'] = '3 camera 12 MP (Chính, Telephoto, Siêu rộng)';
                            $specs['pin_sac'] = '3046 mAh, Sạc nhanh 18 W';
                        }
                    }
                    // 1.3 iPhone cũ hơn (7, 8, SE, Xr, Xs)
                    elseif (Str::contains($ten, ['iPhone 7', 'iPhone 8', 'iPhone SE', 'iPhone Xr', 'iPhone Xs'])) {
                        $dung_luong = Str::afterLast($ten, ' ') ?? '32 GB';
                        $specs = [
                            'man_hinh' => 'IPS LCD, 4.7" đến 6.5", Retina HD',
                            'he_dieu_hanh' => 'iOS 14 hoặc mới hơn',
                            'camera_sau' => '12 MP (đơn hoặc kép tùy model)',
                            'camera_truoc' => '7 MP hoặc 12 MP',
                            'chip' => 'Apple A10 đến A12 Bionic',
                            'ram' => '2 GB đến 4 GB',
                            'dung_luong_luu_tru' => $dung_luong,
                            'sim' => '1 Nano SIM',
                            'pin_sac' => '1821 mAh đến 3174 mAh, Sạc nhanh 18 W'
                        ];
                    }
                }
                // 2. Nhóm Samsung (hangsanxuat_id = 17)
                elseif ($sp->hangsanxuat_id == 17) {
                    // 2.1 Cao cấp (Note, S20, Z series)
                    if (Str::contains($ten, ['Note 20', 'S20', 'Z Fold', 'Z Flip'])) {
                        $dung_luong = Str::afterLast($ten, ' ') ?? '256 GB';
                        $specs = [
                            'man_hinh' => 'Dynamic AMOLED 2X, 6.7" đến 7.6", Quad HD+ (2K+)',
                            'he_dieu_hanh' => 'Android 11, One UI 3.1',
                            'camera_sau' => 'Chính 108 MP & Phụ 12 MP, 12 MP (siêu rộng, tele)',
                            'camera_truoc' => '10 MP hoặc kép',
                            'chip' => 'Exynos 990 hoặc Snapdragon 865+',
                            'ram' => '8 GB đến 12 GB',
                            'dung_luong_luu_tru' => $dung_luong,
                            'sim' => '2 Nano SIM hoặc 1 Nano + eSIM, Hỗ trợ 5G',
                            'pin_sac' => '4300 mAh đến 4500 mAh, Sạc nhanh 25 W, Sạc không dây'
                        ];
                        if (Str::contains($ten, 'Z Fold')) {
                            $specs['man_hinh'] = 'Dynamic AMOLED 2X gập, 7.6" chính + 6.2" phụ';
                        } elseif (Str::contains($ten, 'Z Flip')) {
                            $specs['man_hinh'] = 'Dynamic AMOLED gập, 6.7" chính + 1.1" phụ';
                        }
                    }
                    // 2.2 Tầm trung (A series, M series)
                    elseif (Str::contains($ten, ['Galaxy A', 'Galaxy M'])) {
                        $dung_luong = Str::afterLast($ten, ' ') ?? '128 GB';
                        $specs = [
                            'man_hinh' => 'Super AMOLED, 6.4" đến 6.7", Full HD+',
                            'he_dieu_hanh' => 'Android 10 hoặc 11, One UI',
                            'camera_sau' => 'Chính 48 MP & Phụ 8 MP, 5 MP, 5 MP (siêu rộng, macro, chiều sâu)',
                            'camera_truoc' => '32 MP',
                            'chip' => 'Exynos 9611 hoặc Snapdragon 720G',
                            'ram' => '6 GB đến 8 GB',
                            'dung_luong_luu_tru' => $dung_luong,
                            'sim' => '2 Nano SIM',
                            'pin_sac' => '5000 mAh đến 7000 mAh, Sạc nhanh 15 W đến 25 W'
                        ];
                    }
                }
                // 3. Nhóm Android Tầm trung khác (OPPO=15, Vivo=18, Realme=16, Xiaomi=19)
                elseif (in_array($sp->hangsanxuat_id, [15, 18, 16, 19])) {
                    $dung_luong = Str::afterLast($ten, ' ') ?? '128 GB';
                    $specs = [
                        'man_hinh' => 'AMOLED hoặc IPS LCD, 6.4" đến 6.5", Full HD+',
                        'he_dieu_hanh' => 'Android 10 hoặc 11, ColorOS/Funtouch OS/Realme UI/MIUI',
                        'camera_sau' => 'Chính 48 MP hoặc 64 MP & Phụ 8 MP, 2 MP, 2 MP',
                        'camera_truoc' => '16 MP hoặc 32 MP',
                        'chip' => 'Snapdragon 720G / Helio G90T / Dimensity series',
                        'ram' => '4 GB đến 8 GB',
                        'dung_luong_luu_tru' => $dung_luong,
                        'sim' => '2 Nano SIM, Hỗ trợ 4G/5G tùy model',
                        'pin_sac' => '4000 mAh đến 5000 mAh, Sạc nhanh 30 W đến 65 W'
                    ];
                }
                // 4. Nhóm Giá rẻ / Cơ bản (Nokia=13, Masstel=10, Itel=7, OnePlus=14, v.v.)
                else {
                    $specs = [
                        'man_hinh' => 'IPS LCD hoặc TFT, 5.5" đến 6.5", HD+',
                        'he_dieu_hanh' => 'Android 10 (Go edition) hoặc KaiOS',
                        'camera_sau' => '8 MP đến 13 MP (đơn hoặc kép)',
                        'camera_truoc' => '5 MP',
                        'chip' => 'MediaTek MT6762 hoặc tương đương',
                        'ram' => '1 GB đến 4 GB',
                        'dung_luong_luu_tru' => '16 GB đến 64 GB',
                        'sim' => '2 Nano SIM',
                        'pin_sac' => '3000 mAh đến 4000 mAh, Sạc 10 W'
                    ];
                    if (Str::contains($ten, 'Nokia') && !Str::contains($ten, 'smartphone')) {
                        $specs = [ // Cho Nokia cơ bản
                            'man_hinh' => 'TFT LCD, 2.4" đến 2.8", QVGA',
                            'he_dieu_hanh' => 'Nokia OS',
                            'camera_sau' => 'VGA hoặc 2 MP',
                            'camera_truoc' => 'Không',
                            'chip' => 'Không',
                            'ram' => 'Không',
                            'dung_luong_luu_tru' => 'MicroSD lên đến 32 GB',
                            'sim' => '2 Micro SIM',
                            'pin_sac' => '1020 mAh đến 1500 mAh'
                        ];
                    }
                }
            } elseif ($sp->loaisanpham_id == 2) { // Máy tính bảng
                // Phân loại dựa trên hãng
                if ($sp->hangsanxuat_id == 2) { // iPad (Apple)
                    $specs = [
                        'man_hinh' => 'IPS LCD hoặc OLED, 10.2" đến 12.9", Retina hoặc Liquid Retina',
                        'he_dieu_hanh' => 'iPadOS 14 hoặc mới hơn',
                        'camera_sau' => '12 MP (đơn hoặc kép với LiDAR)',
                        'camera_truoc' => '7 MP hoặc 12 MP',
                        'chip' => 'Apple A12 Bionic đến A14 Bionic',
                        'ram' => '3 GB đến 6 GB',
                        'dung_luong_luu_tru' => '64 GB đến 256 GB',
                        'ket_noi' => 'WiFi hoặc WiFi + Cellular, Hỗ trợ Apple Pencil',
                        'pin_sac' => '7000 mAh đến 10000 mAh, Sạc nhanh 18 W'
                    ];
                    if (Str::contains($ten, 'Pro')) {
                        $specs['chip'] = 'Apple M1';
                        $specs['ram'] = '8 GB đến 16 GB';
                    }
                } elseif ($sp->hangsanxuat_id == 17) { // Samsung Tab
                    $specs = [
                        'man_hinh' => 'Super AMOLED hoặc TFT, 8" đến 11", Full HD+',
                        'he_dieu_hanh' => 'Android 10 hoặc 11, One UI',
                        'camera_sau' => '13 MP',
                        'camera_truoc' => '8 MP',
                        'chip' => 'Exynos hoặc Snapdragon',
                        'ram' => '3 GB đến 6 GB',
                        'dung_luong_luu_tru' => '32 GB đến 128 GB',
                        'ket_noi' => 'WiFi hoặc LTE, Hỗ trợ S Pen (tùy model)',
                        'pin_sac' => '5100 mAh đến 8000 mAh, Sạc nhanh 15 W'
                    ];
                } else { // Các hãng khác (Huawei, Lenovo, Masstel,...)
                    $specs = [
                        'man_hinh' => 'IPS LCD, 8" đến 10", HD+ hoặc Full HD',
                        'he_dieu_hanh' => 'Android 9 hoặc 10',
                        'camera_sau' => '5 MP đến 8 MP',
                        'camera_truoc' => '2 MP đến 5 MP',
                        'chip' => 'MediaTek hoặc Kirin',
                        'ram' => '2 GB đến 4 GB',
                        'dung_luong_luu_tru' => '16 GB đến 64 GB',
                        'ket_noi' => 'WiFi hoặc 4G',
                        'pin_sac' => '4000 mAh đến 6000 mAh'
                    ];
                }
            } elseif ($sp->loaisanpham_id == 3) { // Laptop
                // Phân loại dựa trên hãng (Acer=1, Apple=2, Asus=3, Dell=4, HP=5,...)
                if ($sp->hangsanxuat_id == 2) { // MacBook (Apple)
                    $specs = [
                        'man_hinh' => '13.3", Retina',
                        'he_dieu_hanh' => 'macOS',
                        'cpu' => 'Intel Core i3 hoặc Apple M1',
                        'ram' => '8 GB',
                        'o_cung' => '256 GB SSD',
                        'card_do_hoa' => 'Intel Iris Plus hoặc Apple Integrated',
                        'ket_noi' => 'Thunderbolt 3, USB-C',
                        'pin' => 'Lên đến 18 giờ',
                        'trong_luong' => '1.29 kg'
                    ];
                } else { // Các hãng khác
                    $specs = [
                        'man_hinh' => '14" đến 15.6", Full HD IPS',
                        'he_dieu_hanh' => 'Windows 10',
                        'cpu' => 'Intel Core i3/i5/i7 thế hệ 10 hoặc 11',
                        'ram' => '4 GB đến 16 GB',
                        'o_cung' => '256 GB đến 512 GB SSD',
                        'card_do_hoa' => 'Intel UHD hoặc NVIDIA MX series',
                        'ket_noi' => 'USB 3.0, HDMI, Type-C',
                        'pin' => 'Lên đến 8 giờ',
                        'trong_luong' => '1.5 kg đến 2.2 kg'
                    ];
                    if (Str::contains($ten, 'Gaming')) {
                        $specs['card_do_hoa'] = 'NVIDIA GTX hoặc RTX series';
                        $specs['ram'] = '8 GB đến 16 GB';
                    }
                }
            }

            // Cập nhật vào DB (thongso là JSON column)
            $sp->thongso = $specs;
            $sp->save();
        }

        echo "Đã cập nhật thông số mẫu chi tiết thành công!";
    }
}