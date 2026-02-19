<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreditPurchase;
use App\Models\Credit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminCreditController extends Controller
{
    /**
     * Display a listing of the credit requests
     */
    public function index()
    {
        $purchases = CreditPurchase::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.credits.index', compact('purchases'));
    }

    /**
     * Approve a credit purchase request
     * 
     * یہ میتھڈ اٹامک طریقے سے کام کرتی ہے:
     * 1. چیک کرتی ہے کہ پرفیز پینڈنگ ہے
     * 2. کریڈٹس ٹیبل میں ریکارڈ بناتی ہے اگر نہیں ہے
     * 3. کریڈٹس ایڈ کرتی ہے
     * 4. پرفیز کو اپروو کرتی ہے
     */
public function approve($id)
{
    $purchase = CreditPurchase::findOrFail($id);

    if ($purchase->status !== 'pending') {
        return redirect()->back()->with('error', 
            'یہ درخواست پہلے ہی ' . $purchase->status . ' ہو چکی ہے۔'
        );
    }

    try {
        DB::transaction(function () use ($purchase) {
            // Step 1: User کے credit record کو fetch یا create کریں
            $credit = Credit::firstOrCreate(
                ['user_id' => $purchase->user_id],
                ['credits' => 0]
            );

            // Step 2: Purchased credits add کریں
            $credit->increment('credits', $purchase->credits_purchased);

            // Step 3: Purchase status update کریں
            $purchase->update([
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => Auth::id()
            ]);

            // Optional: Log کریں
            Log::info('Credits approved successfully', [
                'purchase_id' => $purchase->id,
                'user_id' => $purchase->user_id,
                'credits_added' => $purchase->credits_purchased,
                'admin_id' => Auth::id()
            ]);
        });

        return redirect()->back()->with('success', 
            'کریڈٹس اپروو ہو گئی اور یوزر کے اکاؤنٹ میں شامل کر دی گئی۔'
        );

    } catch (\Exception $e) {
        Log::error('Credit approval failed: ' . $e->getMessage(), [
            'purchase_id' => $id
        ]);

        return redirect()->back()->with('error', 'کریڈٹس اپروو کرتے وقت ایک مسئلہ ہوا۔');
    }
}


    /**
     * Reject a credit purchase request
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:500'
        ]);

        try {
            $purchase = CreditPurchase::findOrFail($id);

            if ($purchase->status !== 'pending') {
                return redirect()->back()->with('error', 
                    'یہ درخواست پہلے ہی ' . $purchase->status . ' ہو چکی ہے۔'
                );
            }

            // ریجیکٹ کرتے وقت ٹرانزیکشن کی ضرورت نہیں کیونکہ کریڈٹس میں کوئی تبدیلی نہیں
            $purchase->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes ?? 'No reason provided',
                'approved_by' => Auth::id()
            ]);

            Log::info('Credit request rejected', [
                'purchase_id' => $purchase->id,
                'user_id' => $purchase->user_id,
                'admin_id' => Auth::id()
            ]);

            return redirect()->back()->with('success', 
                'کریڈٹ درخواست مسترد کر دی گئی۔'
            );

        } catch (\Exception $e) {
            Log::error('Credit rejection failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 
                'درخواست مسترد کرتے وقت ایک مسئلہ ہو گیا۔'
            );
        }
    }

    /**
     * Bulk approve multiple pending requests
     * ایک ساتھ کئی درخواستیں اپروو کرنے کے لیے
     */
    public function bulkApprove(Request $request)
    {
        $request->validate([
            'purchase_ids' => 'required|array',
            'purchase_ids.*' => 'exists:credit_purchases,id'
        ]);

        $successCount = 0;
        $failedCount = 0;

        foreach ($request->purchase_ids as $id) {
            try {
                $purchase = CreditPurchase::find($id);
                
                if ($purchase && $purchase->status === 'pending') {
                    DB::transaction(function () use ($purchase) {
                        $credit = Credit::firstOrCreate(
                            ['user_id' => $purchase->user_id],
                            ['credits' => 0]
                        );
                        
                        $credit->increment('credits', $purchase->credits_purchased);
                        
                        $purchase->update([
                            'status' => 'approved',
                            'approved_at' => now(),
                            'approved_by' => Auth::id()
                        ]);
                    });
                    
                    $successCount++;
                } else {
                    $failedCount++;
                }
            } catch (\Exception $e) {
                $failedCount++;
                Log::error('Bulk approve failed for purchase ' . $id . ': ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 
            "{$successCount} درخواستیں اپروو ہو گئیں۔ " . 
            ($failedCount > 0 ? "{$failedCount} ناکام رہیں۔" : '')
        );
    }

    /**
     * Get pending requests count for dashboard
     */
    public function getPendingCount()
    {
        $count = CreditPurchase::where('status', 'pending')->count();
        return response()->json(['pending_count' => $count]);
    }

    // Keep empty methods if needed for resource routes
    public function create() {}
    public function store(Request $request) {}
    public function show(CreditPurchase $credit) {}
    public function edit(CreditPurchase $credit) {}
    public function update(Request $request, CreditPurchase $credit) {}
    public function destroy(CreditPurchase $credit) {}
}