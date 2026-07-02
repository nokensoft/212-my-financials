<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Support\SampleData;
use Illuminate\View\View;

/**
 * SIMULASI manajemen & verifikasi member. Data berasal dari SampleData
 * (in-memory), tanpa database atau proses CRUD nyata.
 */
class MemberController extends Controller
{
    public function index(): View
    {
        $members = SampleData::members();

        return view('dashboard.members.index', compact('members'));
    }

    public function show(int $member): View
    {
        $data = SampleData::member($member);
        abort_if($data === null, 404);

        $orders = collect(SampleData::orders())
            ->where('member', $data['name'])
            ->all();

        return view('dashboard.members.show', ['member' => $data, 'orders' => $orders]);
    }
}
