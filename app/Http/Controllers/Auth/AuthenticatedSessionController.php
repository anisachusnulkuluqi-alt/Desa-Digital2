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

        // Alur pembagian dashboard backend sesuai role admin
        if ($user->role === 'kominfo') {
            return redirect()->intended(route('admin.kominfo.dashboard', absolute: false));
        } elseif ($user->role === 'kecamatan') {
            return redirect()->intended(route('admin.kecamatan.dashboard', absolute: false));
        } else {
            // Default untuk admin tingkat desa / kelurahan
            return redirect()->intended(route('admin.desa.dashboard', absolute: false));
        }
    }

    /**
     * Proses keluar (logout) dan kembali ke beranda landing page.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}