<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('name')->paginate(15);

        return view('dashboard.users.index', compact('users'));
    }

    public function create(): View
    {
        $user = new User(['role' => User::ROLE_OPERATOR]);

        return view('dashboard.users.form', compact('user'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_OPERATOR])],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create($data);

        return redirect()->route('dashboard.users.index')->with('status', 'Pengguna berhasil dibuat.');
    }

    public function edit(User $user): View
    {
        return view('dashboard.users.form', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_OPERATOR])],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // Cegah admin menurunkan perannya sendiri (agar tak terkunci dari manajemen user).
        if ($user->id === $request->user()->id && $data['role'] !== User::ROLE_ADMIN) {
            return back()->withErrors(['role' => 'Anda tidak dapat mengubah peran akun Anda sendiri.'])->withInput();
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        if (filled($data['password'] ?? null)) {
            $user->password = $data['password'];
        }
        $user->save();

        return redirect()->route('dashboard.users.index')->with('status', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return back()->withErrors(['user' => 'Anda tidak dapat menghapus akun Anda sendiri.']);
        }

        $user->delete();

        return redirect()->route('dashboard.users.index')->with('status', 'Pengguna berhasil dihapus.');
    }
}
