<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Subscriptions page
    public function subscriptions()
    {
        return view('payments.subscriptions');
    }

    // Checkout page
    public function checkout(Request $request)
    {
        $plan     = $request->query('plan');
        $duration = $request->query('duration');
        $price    = $request->query('price');

        // direct checkout access block
        if (!$plan || !$price) {
            return redirect()->route('payments.subscriptions');
        }

        return view('payments.checkout', compact('plan', 'duration', 'price'));
    }
}

