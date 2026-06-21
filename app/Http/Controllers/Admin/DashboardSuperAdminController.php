<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ukm;

class DashboardSuperAdminController extends Controller
{
    public function index()
    {
        $totalUkm = Ukm::count();
        $totalUser = User::count();

        $seuramoe = User::count();

        $ululAlbab = User::where('ukm_id', 2)
            ->where('status_diterima', 'diterima')
            ->count();

        $barracuda = User::where('ukm_id', 3)
            ->where('status_diterima', 'diterima')
            ->count();

        return view(
    'admin.pages.dashboard_super_admin.index',
    compact(
        'totalUkm',
        'totalUser',
        'seuramoe',
        'ululAlbab',
        'barracuda'
    )
);
}

}