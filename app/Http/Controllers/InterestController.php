<?php

namespace App\Http\Controllers;

use App\Models\InterestPosting;
use App\Models\InterestRule;
use App\Models\SavingsProduct;
use App\Models\SavingsAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterestController extends Controller
{
    public function rules()
    {
        $rules = InterestRule::with('savingsProduct')->latest()->get();
        $products = SavingsProduct::all();
        return view('pages.interest.rules', compact('rules', 'products'));
    }

    public function storeRule(Request $request)
    {
        $validated = $request->validate([
            'savings_product_id' => 'required|exists:savings_products,id',
            'rule_name' => 'required|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'nullable|numeric',
            'interest_rate' => 'required|numeric',
            'effective_date' => 'required|date',
        ]);

        InterestRule::create($validated);
        return back()->with('success', 'Interest rule created successfully');
    }

    public function posting()
    {
        $products = SavingsProduct::all();
        return view('pages.interest.posting', compact('products'));
    }

    public function processPosting(Request $request)
    {
        $validated = $request->validate([
            'savings_product_id' => 'required|exists:savings_products,id',
            'period_start' => 'required|date',
            'period_end' => 'required|date',
        ]);

        $product = SavingsProduct::find($validated['savings_product_id']);
        $accounts = SavingsAccount::where('savings_product_id', $product->id)
            ->where('status', 'Active')
            ->get();

        DB::transaction(function () use ($accounts, $product, $validated) {
            foreach ($accounts as $account) {
                // Simplified interest calculation: balance * rate / 100
                // In a real system, this would be daily balance calculation
                $interestAmount = ($account->balance * $product->interest_rate) / 100;

                if ($interestAmount > 0) {
                    $account->balance += $interestAmount;
                    $account->last_interest_posting_date = now();
                    $account->save();

                    InterestPosting::create([
                        'savings_account_id' => $account->id,
                        'amount' => $interestAmount,
                        'posting_date' => now(),
                        'period_start' => $validated['period_start'],
                        'period_end' => $validated['period_end'],
                        'status' => 'posted'
                    ]);

                    \App\Models\Transaction::create([
                        'member_id' => $account->member_id,
                        'savings_account_id' => $account->id,
                        'type' => 'interest',
                        'amount' => $interestAmount,
                        'balance_after' => $account->balance,
                        'channel' => 'System',
                        'reference' => 'INT-' . time() . '-' . $account->id,
                        'narration' => 'Interest posting for ' . $validated['period_start'] . ' to ' . $validated['period_end'],
                        'status' => 'completed'
                    ]);
                }
            }
        });

        return back()->with('success', 'Interest posting completed for ' . $accounts->count() . ' accounts');
    }

    public function history()
    {
        $postings = InterestPosting::with(['savingsAccount.member', 'savingsAccount.savingsProduct'])->latest()->get();
        return view('pages.interest.history', compact('postings'));
    }
}
