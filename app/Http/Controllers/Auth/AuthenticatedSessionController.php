<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Tangani autentikasi login dan arahkan sesuai role admin.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        if ($user->hasRole('kontributor')) {
            return redirect()->route('dashboard');
        }

        if ($user->role === 'kominfo') {
            return redirect()->route('admin.kominfo.dashboard');
        } elseif ($user->role === 'kecamatan') {
            return redirect()->route('admin.kecamatan.dashboard');
        }

        return redirect()->route('home');
    }

    /**
    * Proses keluar (logout) dan kembali ke halaman login.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}