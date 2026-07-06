<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        $transactions = Transaction::with('order')->orderByDesc('date')->orderByDesc('id')->paginate(20);

        $income = (int) Transaction::where('type', Transaction::TYPE_INCOME)->sum('amount');
        $expense = (int) Transaction::where('type', Transaction::TYPE_EXPENSE)->sum('amount');

        return view('dashboard.transactions.index', compact('transactions', 'income', 'expense'));
    }

    public function create(): View
    {
        $transaction = new Transaction(['type' => Transaction::TYPE_EXPENSE, 'date' => now()->toDateString()]);

        return view('dashboard.transactions.form', compact('transaction'));
    }

    public function store(Request $request): RedirectResponse
    {
        $transaction = new Transaction;
        $transaction->fill($this->validated($request))->save();

        return redirect()->route('dashboard.transactions.index')->with('status', 'Transaksi berhasil dicatat.');
    }

    public function edit(Transaction $transaction): View
    {
        return view('dashboard.transactions.form', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
        $transaction->fill($this->validated($request))->save();

        return redirect()->route('dashboard.transactions.index')->with('status', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction): RedirectResponse
    {
        $transaction->delete();

        return redirect()->route('dashboard.transactions.index')->with('status', 'Transaksi berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'date' => ['required', 'date'],
            'type' => ['required', Rule::in([Transaction::TYPE_INCOME, Transaction::TYPE_EXPENSE])],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'integer', 'min:0'],
        ]);
    }
}
