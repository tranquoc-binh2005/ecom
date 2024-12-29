<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = __('dashboard.dashboard');
        $breadcrumb = [
            'home' => 'dashboard.index',
        ];
        $modules = __('module');
        return view('backend.components.main', compact(
            'title',
            'breadcrumb',
            'modules',
        ));
    }
}
