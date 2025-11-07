<?php

namespace App\Imports;

use App\Models\HangSanXuat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class HangSanXuatImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $hsx = HangSanXuat::where('tenhang', $row['tenhang'])->first();
        if ($hsx)
            return null;

        return new HangSanXuat([
            'tenhang' => $row['tenhang'],
            'tenhang_slug' => $row['tenhang_slug'],
            'hinhanh' => $row['hinhanh'],
        ]);
    }
}
