<?php

namespace App\Http\Controllers;

use App\Models\CreditPurchase;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreditController extends Controller
{
    /**
     * Show user credits and purchase history
     */
    public function index()
    {
        $user = Auth::user();
        $credit = Credit::firstOrCreate(['user_id' => $user->id], ['credits' => 0]);

        $purchases = CreditPurchase::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('credits.index', compact('user', 'purchases', 'credit'));
    }

    /**
     * Show the credit purchase form
     */
    public function showPurchaseForm()
    {
        return view('credits.purchase');
    }

    /**
     * Handle manual credit request submission
     */
    public function sendCreditRequest(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:10,20,50',
            'note' => 'nullable|string|max:500'
        ]);

        $user = Auth::user();
        $planAmount = (int)$request->plan;

        // Calculate credits based on plan & bonus
        switch ($planAmount) {
            case 10: $credits = 10; break;
            case 20: $credits = 25; break;
            case 50: $credits = 60; break;
            default: $credits = 10;
        }

        $note = $request->note ?? 'No additional note provided';

        // Save pending request
        $purchase = CreditPurchase::create([
            'user_id' => $user->id,
            'credits_purchased' => $credits,
            'amount' => $planAmount,
            'payment_method' => 'manual',
            'status' => 'pending',
            'admin_notes' => $note,
        ]);

        // Notify admin via email
        Mail::raw("
New Credit Purchase Request
User: {$user->name} (ID: {$user->id})
Plan: \${$planAmount}, Credits: {$credits}
Note: {$note}
        ", function ($message) {
            $message->to('waqargondal894@gmail.com')
                    ->subject('New Credit Purchase Request');
        });

        return redirect()->route('credits.index')
            ->with('success', 'Your credit request has been sent. Waiting for admin approval.');
    }
}
