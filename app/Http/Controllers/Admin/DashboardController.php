<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
{
    $user = auth()->user()->load('ukm');

    return view('views.admin_pengurus.dashboard', compact('user'));
}
}
