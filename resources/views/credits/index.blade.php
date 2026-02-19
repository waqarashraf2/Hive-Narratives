@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Credit Balance Card -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-coin text-primary fs-2"></i>
                        </div>
                        <div>
                            <h5 class="text-muted text-uppercase small mb-1">Available Credits</h5>
                            <h2 class="display-6 fw-bold mb-0">{{ auth()->user()->credits ?? 0 }}</h2>
                        </div>
                    </div>
                    
                    <p class="text-muted mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                        10 Credits = 5 Articles (2 credits per article)
                    </p>
                    
                    <a href="{{ route('credits.purchase') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Purchase Credits
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Purchase History -->
    <h3 class="mb-3">Purchase History</h3>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">Date</th>
                        <th class="py-3">Credits</th>
                        <th class="py-3">Amount</th>
                        <th class="py-3">Payment Method</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $purchase)
                    <tr>
                        <td class="px-4">
                            <div>{{ $purchase->created_at->format('M d, Y') }}</div>
                            <small class="text-muted">{{ $purchase->created_at->format('h:i A') }}</small>
                        </td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                {{ $purchase->credits_purchased }} Credits
                            </span>
                        </td>
                        <td class="fw-medium">${{ number_format($purchase->amount, 2) }}</td>
                        <td>
                            @php
                                $method = $purchase->payment_method;
                                $displayMethod = match($method) {
                                    'credit_card' => 'Credit Card',
                                    'paypal' => 'PayPal',
                                    'bank_transfer' => 'Bank Transfer',
                                    'manual' => 'Manual',
                                    default => ucfirst($method)
                                };
                            @endphp
                            {{ $displayMethod }}
                        </td>
                        <td class="px-4">
                            @if($purchase->status == 'pending')
                                <span class="badge bg-warning bg-opacity-15 text-white px-3 py-2 rounded-pill">
                                    <i class="bi bi-hourglass me-1"></i>Pending
                                </span>
                            @elseif($purchase->status == 'approved')
                                <span class="badge bg-success bg-opacity-15 text-success px-3 py-2 rounded-pill">
                                    <i class="bi bi-check-circle me-1"></i>Approved
                                </span>
                            @elseif($purchase->status == 'rejected')
                                <span class="badge bg-danger bg-opacity-15 text-danger px-3 py-2 rounded-pill">
                                    <i class="bi bi-x-circle me-1"></i>Rejected
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <h5 class="text-muted mb-2">No Purchases Yet</h5>
                                <p class="text-muted mb-0">You haven't made any credit purchases.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection