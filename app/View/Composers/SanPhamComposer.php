<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\SanPham;

class SanPhamComposer
{
    public function compose(View $view)
    {
        $sanphams = SanPham::withCount('ratings')
            ->withAvg('ratings', 'danhgia')
            ->get();

        $view->with('sanphams', $sanphams);
    }
}
