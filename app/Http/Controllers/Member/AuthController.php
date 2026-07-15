<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

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
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable) {
            return redirect()->route('member.login')
                ->with('info', 'Autentikasi Google gagal atau dibatalkan. Silakan coba lagi.');
        }

        // Cari member berdasarkan google_id
        $member = Member::where('google_id', $googleUser->getId())->first();

        if (! $member) {
            // Cari berdasarkan email (akun lama yang belum link Google)
            $member = Member::where('email', $googleUser->getEmail())->first();

            if ($member) {
                // Tautkan google_id ke akun yang sudah ada
                $member->update([
                    'google_id' => $googleUser->getId(),
                    'avatar'    => $member->avatar ?? $googleUser->getAvatar(),
                ]);
            } else {
                // Daftar otomatis sebagai member baru
                $member = Member::create([
                    'name'      => $googleUser->getName(),
                    'email'     => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar'    => $googleUser->getAvatar(),
                    'status'    => Member::STATUS_PENDING,
                ]);
            }
        }

        Auth::guard('member')->login($member, remember: true);
        $request->session()->regenerate();

        return redirect()->intended(route('member.dashboard'))
            ->with('status', $member->wasRecentlyCreated
                ? 'Pendaftaran via Google berhasil! Akun Anda menunggu verifikasi admin.'
                : 'Selamat datang kembali, '.$member->name.'!');
    }
}
