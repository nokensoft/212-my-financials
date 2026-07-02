<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * SIMULASI area member (publik). Halaman ini murni konsep desain —
 * belum ada proses autentikasi, database, maupun integrasi Google yang nyata.
 */
class MemberController extends Controller
{
    public function login(): View
    {
        return view('member.login');
    }

    public function register(): View
    {
        return view('member.register');
    }
}
