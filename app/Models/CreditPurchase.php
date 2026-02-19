<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreditPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'credits_purchased',
        'amount',
        'payment_method',
        'screenshot_path',
        'status',
        'admin_notes',
        'approved_at',
        'approved_by'
    ];

    protected $casts = [
        'approved_at' => 'datetime'
    ];

    /**
     * Relation: purchase belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation: The approver admin
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Relation: purchase belongs to user's credits
     * Useful for updating or checking balances
     */
    public function credit()
    {
        return $this->hasOne(Credit::class, 'user_id', 'user_id');
    }

    /**
     * Check if user has credits record, if not create one
     * 
     * @return Credit
     */
    public function ensureUserCreditsRecord()
    {
        return Credit::firstOrCreate(
            ['user_id' => $this->user_id],
            ['credits' => 0]
        );
    }

    /**
     * Atomic approve with credits addition
     * یہ میتھڈ دونوں کام ایک ساتھ کرے گی:
     * 1. کریڈٹس ٹیبل میں چیک کرے گی کہ ریکارڈ موجود ہے یا نہیں
     * 2. اگر نہیں ہے تو نیا بنا دے گی
     * 3. پھر کریڈٹس ایڈ کرے گی
     * 4. اور آخر میں پرفیز کو اپروو کر دے گی
     *
     * @param int $adminId
     * @return bool
     * @throws \Exception
     */
    public function approveWithCredits($adminId)
    {
        // پہلے چیک کریں کہ سٹیٹس پینڈنگ ہے
        if ($this->status !== 'pending') {
            Log::warning('Attempted to approve non-pending purchase', [
                'purchase_id' => $this->id,
                'current_status' => $this->status
            ]);
            return false;
        }

        try {
            // ڈیٹا بیس ٹرانزیکشن شروع کریں
            DB::beginTransaction();

            // 1️⃣ پہلے یقینی بنائیں کہ یوزر کا کریڈٹ ریکارڈ موجود ہے
            $credit = $this->ensureUserCreditsRecord();
            
            // 2️⃣ یوزر کے کریڈٹس میں اضافہ کریں
            $credit->increment('credits', $this->credits_purchased);
            
            // 3️⃣ پرفیز کو اپروو کریں
            $this->update([
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => $adminId
            ]);

            // سب کچھ ٹھیک رہا تو ٹرانزیکشن کمٹ کریں
            DB::commit();

            // لاگ میں ریکارڈ کریں
            Log::info('Credits approved successfully', [
                'purchase_id' => $this->id,
                'user_id' => $this->user_id,
                'credits_added' => $this->credits_purchased,
                'admin_id' => $adminId
            ]);

            return true;

        } catch (\Exception $e) {
            // کوئی ایرر آ گیا تو سب کچھ واپس لوٹائیں
            DB::rollBack();
            
            Log::error('Credit approval failed', [
                'purchase_id' => $this->id,
                'user_id' => $this->user_id,
                'error' => $e->getMessage()
            ]);
            
            throw $e;
        }
    }

    /**
     * Get user's current credits before approval
     * 
     * @return int
     */
    public function getCurrentUserCreditsAttribute()
    {
        $credit = Credit::where('user_id', $this->user_id)->first();
        return $credit ? $credit->credits : 0;
    }

    /**
     * Get credits after this approval
     * 
     * @return int
     */
    public function getCreditsAfterApprovalAttribute()
    {
        return $this->getCurrentUserCreditsAttribute() + $this->credits_purchased;
    }

    /**
     * Check if purchase is approvable
     * 
     * @return bool
     */
    public function isApprovable()
    {
        return $this->status === 'pending';
    }

    /**
     * Scope a query to only pending purchases
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only approved purchases
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope a query to only rejected purchases
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}