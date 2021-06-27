<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.dashboard');
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function verifyEmail()
    {
        if(auth()->user()->email_verified_at != null)
            return redirect()->route('dashboard');
        return view('auth.verify-email');
    }
}
