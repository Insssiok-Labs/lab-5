<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class TransactionController extends Controller
{
    public function index(): Factory|View|Application
    {
        $transactions = Transaction::all();
        $transactionAmountSum = Transaction::query()->sum('amount');
        $transactionCount = Transaction::query()->count();

        return view('transactions/index', compact(
            'transactions',
            'transactionCount',
            'transactionAmountSum',
        ));
    }

    public function create(): Factory|View|Application
    {
        return view('transactions/create');
    }

    public function store(TransactionRequest $request): RedirectResponse
    {
        Transaction::query()->create($request->validated());

        return redirect()->route('transactions.index');
    }

    public function edit(Transaction $transaction): Factory|View|Application
    {
        return view('transactions/edit', compact('transaction'));
    }

    public function update(TransactionRequest $request, Transaction $transaction): RedirectResponse
    {
        $transaction->update($request->validated());

        return redirect()->route('transactions.index');
    }

    public function destroy(Transaction $transaction): RedirectResponse
    {
        $transaction->delete();

        return back()->with('success', 'Successfully deleted transaction!');
    }
}
