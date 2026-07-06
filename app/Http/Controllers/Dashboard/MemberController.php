<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(Request $request): View
    {
        $members = Member::query()
            ->withCount('orders')
            ->when($request->get('q'), fn ($q, $s) => $q->where(fn ($w) => $w->where('name', 'like', "%{$s}%")->orWhere('phone', 'like', "%{$s}%")))
            ->when($request->get('status'), fn ($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('dashboard.members.index', compact('members'));
    }

    public function create(): View
    {
        $member = new Member(['status' => Member::STATUS_PENDING]);

        return view('dashboard.members.form', compact('member'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        $member = new Member;
        $member->name = $data['name'];
        $member->phone = $data['phone'];
        $member->email = $data['email'] ?? null;
        $member->status = $data['status'];
        if (filled($data['password'] ?? null)) {
            $member->password = $data['password'];
        }
        $member->save();

        return redirect()->route('dashboard.members.index')->with('status', 'Member berhasil ditambahkan.');
    }

    public function show(Member $member): View
    {
        $orders = $member->orders()->latest()->get();

        return view('dashboard.members.show', compact('member', 'orders'));
    }

    public function edit(Member $member): View
    {
        return view('dashboard.members.form', compact('member'));
    }

    public function update(Request $request, Member $member): RedirectResponse
    {
        $data = $this->validated($request, $member);

        $member->name = $data['name'];
        $member->phone = $data['phone'];
        $member->email = $data['email'] ?? null;
        $member->status = $data['status'];
        if (filled($data['password'] ?? null)) {
            $member->password = $data['password'];
        }
        $member->save();

        return redirect()->route('dashboard.members.index')->with('status', 'Member berhasil diperbarui.');
    }

    public function destroy(Member $member): RedirectResponse
    {
        $member->delete();

        return redirect()->route('dashboard.members.index')->with('status', 'Member berhasil dihapus.');
    }

    public function verify(Member $member): RedirectResponse
    {
        $member->update(['status' => Member::STATUS_VERIFIED]);

        return back()->with('status', 'Member '.$member->name.' telah diverifikasi.');
    }

    public function reject(Member $member): RedirectResponse
    {
        $member->update(['status' => Member::STATUS_REJECTED]);

        return back()->with('status', 'Member '.$member->name.' ditolak.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function validated(Request $request, ?Member $member = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', Rule::unique('members', 'phone')->ignore($member?->id)],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('members', 'email')->ignore($member?->id)],
            'status' => ['required', Rule::in([Member::STATUS_PENDING, Member::STATUS_VERIFIED, Member::STATUS_REJECTED])],
            'password' => [$member ? 'nullable' : 'nullable', 'string', 'min:6'],
        ], [], ['phone' => 'nomor HP']);
    }
}
