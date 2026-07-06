<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function members(): View
    {
        $members = Member::withCount('orders')->latest()->get();

        return view('dashboard.reports.members', compact('members'));
    }

    public function finance(): View
    {
        $entries = Transaction::with('order')->orderBy('date')->orderBy('id')->get();

        $income = (int) $entries->where('type', Transaction::TYPE_INCOME)->sum('amount');
        $expense = (int) $entries->where('type', Transaction::TYPE_EXPENSE)->sum('amount');

        // Grafik: pemasukan 6 bulan terakhir.
        $monthly = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $amount = (int) $entries
                ->where('type', Transaction::TYPE_INCOME)
                ->filter(fn ($t) => $t->date->isSameMonth($month))
                ->sum('amount');
            $monthly[] = ['month' => $month->locale('id')->translatedFormat('M'), 'amount' => $amount];
        }

        return view('dashboard.reports.finance', [
            'entries' => $entries,
            'monthly' => $monthly,
            'income' => $income,
            'expense' => $expense,
            'net' => $income - $expense,
        ]);
    }
}
