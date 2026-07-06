<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('member.dashboard');
        }

        return view('member.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'phone' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [], ['phone' => 'nomor HP']);

        if (Auth::guard('member')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('member.dashboard'));
        }

        return back()
            ->withErrors(['phone' => 'Nomor HP atau kata sandi salah.'])
            ->onlyInput('phone');
    }

    public function showRegister(): View|RedirectResponse
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('member.dashboard');
        }

        return view('member.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'unique:members,phone'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [], ['phone' => 'nomor HP']);

        $member = Member::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => $data['password'],
            'status' => Member::STATUS_PENDING,
        ]);

        Auth::guard('member')->login($member);
        $request->session()->regenerate();

        return redirect()->route('member.dashboard')
            ->with('status', 'Pendaftaran berhasil! Akun Anda menunggu verifikasi admin.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('member.login');
    }

    public function google(): RedirectResponse
    {
        // Simulasi: login Google belum dikonfigurasi (butuh kredensial OAuth / Socialite).
        return back()->with('info', 'Login dengan Google belum dikonfigurasi. Silakan gunakan nomor HP & kata sandi.');
    }
}
