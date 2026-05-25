<?php

namespace App\Http\Controllers;

use App\Models\SavingsAccount;
use App\Models\SavingsProduct;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingsController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_savings' => SavingsAccount::sum('balance'),
            'active_accounts' => SavingsAccount::where('status', 'Active')->count(),
            'total_products' => SavingsProduct::count(),
            'recent_transactions' => \App\Models\Transaction::whereIn('type', ['deposit', 'withdrawal'])
                ->latest()
                ->take(5)
                ->get()
        ];
        
        return view('pages.savings.dashboard', compact('stats'));
    }

    public function accounts()
    {
        $accounts = SavingsAccount::with(['member', 'savingsProduct'])->latest()->get();
        return view('pages.savings.accounts', compact('accounts'));
    }

    public function products()
    {
        $products = SavingsProduct::latest()->get();
        return view('pages.savings.products', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:savings_products',
            'interest_rate' => 'required|numeric',
            'min_balance' => 'required|numeric',
            'interest_calculation_method' => 'required|string',
            'interest_posting_frequency' => 'required|string',
        ]);

        SavingsProduct::create($validated);
        return back()->with('success', 'Savings product created successfully');
    }

    public function createAccount()
    {
        $members = Member::all();
        $products = SavingsProduct::where('status', 'active')->get();
        return view('pages.savings.create_account', compact('members', 'products'));
    }

    public function storeAccount(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'savings_product_id' => 'required|exists:savings_products,id',
            'opening_balance' => 'required|numeric|min:0',
        ]);

        $product = SavingsProduct::find($validated['savings_product_id']);
        
        DB::transaction(function () use ($validated, $product) {
            $account = SavingsAccount::create([
                'member_id' => $validated['member_id'],
                'savings_product_id' => $validated['savings_product_id'],
                'account_no' => 'SA-' . strtoupper(uniqid()),
                'product_type' => $product->name,
                'balance' => $validated['opening_balance'],
                'opening_balance' => $validated['opening_balance'],
                'status' => 'Active',
            ]);

            if ($validated['opening_balance'] > 0) {
                \App\Models\Transaction::create([
                    'member_id' => $validated['member_id'],
                    'savings_account_id' => $account->id,
                    'type' => 'deposit',
                    'amount' => $validated['opening_balance'],
                    'balance_after' => $validated['opening_balance'],
                    'channel' => 'Cash',
                    'reference' => 'OP-' . time(),
                    'narration' => 'Opening balance',
                    'status' => 'completed'
                ]);
            }
        });

        return redirect()->route('savings.accounts')->with('success', 'Savings account created successfully');
    }
}
