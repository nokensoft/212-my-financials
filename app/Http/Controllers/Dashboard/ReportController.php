<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Support\SampleData;
use Illuminate\View\View;

/**
 * SIMULASI laporan: rekap member & laporan keuangan (terintegrasi invoice).
 * Semua angka disimulasikan dari SampleData.
 */
class ReportController extends Controller
{
    public function members(): View
    {
        $members = SampleData::members();
        $recap = SampleData::recap();

        return view('dashboard.reports.members', compact('members', 'recap'));
    }

    public function finance(): View
    {
        $entries = SampleData::financeEntries();
        $recap = SampleData::recap();
        $monthly = SampleData::monthlyRevenue();

        $income = collect($entries)->where('type', 'pemasukan')->sum('amount');
        $expense = collect($entries)->where('type', 'pengeluaran')->sum('amount');

        return view('dashboard.reports.finance', [
            'entries' => $entries,
            'recap' => $recap,
            'monthly' => $monthly,
            'income' => (int) $income,
            'expense' => (int) $expense,
            'net' => (int) ($income - $expense),
        ]);
    }
}
