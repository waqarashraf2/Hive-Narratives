@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-sm-3 py-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-11 col-lg-10">

            {{-- Simple Header --}}
            <div class="text-center mb-3">
                <h1 class="h4 fw-bold text-primary mb-1">💎 Purchase Credits</h1>
                <p class="text-muted small">Choose a plan and start publishing</p>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3 py-2" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        <span class="small">{{ session('success') }}</span>
                        <button type="button" class="btn-close btn-close-sm ms-auto" data-bs-dismiss="alert" style="font-size: 0.7rem;"></button>
                    </div>
                </div>
            @endif

            {{-- Payoneer Payment Badge --}}
            <div class="bg-primary bg-opacity-10 rounded-3 p-2 mb-3 border border-primary border-opacity-25">
                <div class="d-flex align-items-center">
                    <div class="bg-primary rounded-circle p-1 me-2" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-globe text-white small"></i>
                    </div>
                    <div>
                        <strong class="small text-primary">Primary Payment Method: Payoneer</strong>
                        <p class="text-muted mb-0 small" style="font-size: 0.7rem;">We accept international payments via Payoneer</p>
                    </div>
                </div>
            </div>

            {{-- Quick Process Steps --}}
            <div class="bg-light rounded-3 p-2 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-center flex-fill">
                        <span class="badge bg-primary rounded-circle mb-1" style="width: 22px; height: 22px; line-height: 22px; padding: 0;">1</span>
                        <small class="d-block text-muted" style="font-size: 0.65rem;">Submit</small>
                    </div>
                    <div class="text-center flex-fill">
                        <span class="badge bg-secondary rounded-circle mb-1" style="width: 22px; height: 22px; line-height: 22px; padding: 0;">2</span>
                        <small class="d-block text-muted" style="font-size: 0.65rem;">Contact</small>
                    </div>
                    <div class="text-center flex-fill">
                        <span class="badge bg-secondary rounded-circle mb-1" style="width: 22px; height: 22px; line-height: 22px; padding: 0;">3</span>
                        <small class="d-block text-muted" style="font-size: 0.65rem;">Pay</small>
                    </div>
                    <div class="text-center flex-fill">
                        <span class="badge bg-secondary rounded-circle mb-1" style="width: 22px; height: 22px; line-height: 22px; padding: 0;">4</span>
                        <small class="d-block text-muted" style="font-size: 0.65rem;">Credits</small>
                    </div>
                </div>
            </div>

            {{-- Pricing Cards - Horizontal Scroll on Mobile --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold mb-2">📦 Select Package</label>
                <div class="d-flex gap-2 overflow-auto pb-1" style="scrollbar-width: thin;">
                    {{-- Basic --}}
                    <div class="card border-0 shadow-sm rounded-3 flex-shrink-0" style="width: 130px;">
                        <div class="card-body p-2 text-center">
                            <span class="badge bg-primary bg-opacity-10 text-primary mb-1" style="font-size: 0.6rem;">BASIC</span>
                            <h5 class="fw-bold mb-0">$10</h5>
                            <small class="d-block text-muted" style="font-size: 0.65rem;">10 Credits</small>
                        </div>
                    </div>
                    
                    {{-- Standard (Popular) --}}
                    <div class="card border-warning shadow-sm rounded-3 flex-shrink-0 position-relative" style="width: 130px; border-width: 2px;">
                        <div class="position-absolute top-0 start-50 translate-middle badge bg-warning text-dark px-2 py-0" style="font-size: 0.5rem;">BEST</div>
                        <div class="card-body p-2 text-center">
                            <span class="badge bg-warning bg-opacity-10 text-warning mb-1" style="font-size: 0.6rem;">STANDARD</span>
                            <h5 class="fw-bold mb-0">$20</h5>
                            <small class="d-block text-muted" style="font-size: 0.65rem;">25 Credits</small>
                            <small class="text-success d-block" style="font-size: 0.55rem;">+5 Free</small>
                        </div>
                    </div>
                    
                    {{-- Premium --}}
                    <div class="card border-0 shadow-sm rounded-3 flex-shrink-0" style="width: 130px;">
                        <div class="card-body p-2 text-center">
                            <span class="badge bg-success bg-opacity-10 text-success mb-1" style="font-size: 0.6rem;">PREMIUM</span>
                            <h5 class="fw-bold mb-0">$50</h5>
                            <small class="d-block text-muted" style="font-size: 0.65rem;">60 Credits</small>
                            <small class="text-success d-block" style="font-size: 0.55rem;">+10 Free</small>
                        </div>
                    </div>
                </div>
                <small class="text-muted d-block mt-1" style="font-size: 0.65rem;">
                    <i class="fas fa-info-circle me-1"></i>2 credits per article
                </small>
            </div>

            {{-- Main Form Card --}}
            <div class="card border-0 shadow-sm rounded-3 mb-3">
                <div class="card-header bg-white border-0 py-2 px-3">
                    <h6 class="fw-semibold mb-0 small">📝 Request Credits</h6>
                </div>
                
                <div class="card-body p-3">
                    <form action="{{ route('credits.purchase.submit') }}" method="POST">
                        @csrf

                        {{-- Plan Selection --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold mb-1">Plan <span class="text-danger">*</span></label>
                            <select name="plan" class="form-select form-select-sm bg-light border-0 rounded-2" style="font-size: 0.85rem;" required>
                                <option value="">-- Select plan --</option>
                                <option value="10">💰 Basic - $10 (10 credits)</option>
                                <option value="20">🔥 Standard - $20 (25 credits)</option>
                                <option value="50">💎 Premium - $50 (60 credits)</option>
                            </select>
                            @error('plan')
                                <small class="text-danger d-block mt-1" style="font-size: 0.7rem;">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Payoneer Email Field --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold mb-1">
                                <i class="fab fa-paypal text-primary me-1"></i>Payoneer Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" 
                                   name="payoneer_email" 
                                   class="form-control bg-light border-0 rounded-2" 
                                   style="font-size: 0.85rem;"
                                   placeholder="your@payoneer-email.com"
                                   value="{{ old('payoneer_email') }}"
                                   required>
                            <small class="text-muted d-block mt-1" style="font-size: 0.65rem;">
                                <i class="fas fa-info-circle me-1"></i>We'll send payment request to this Payoneer email
                            </small>
                            @error('payoneer_email')
                                <small class="text-danger d-block mt-1" style="font-size: 0.7rem;">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Note --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold mb-1">Additional Note (Optional)</label>
                            <textarea name="note" 
                                      class="form-control bg-light border-0 rounded-2" 
                                      rows="2"
                                      style="font-size: 0.85rem;"
                                      placeholder="Any special instructions...">{{ old('note') }}</textarea>
                            @error('note')
                                <small class="text-danger d-block mt-1" style="font-size: 0.7rem;">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Payment Methods Card --}}
                        <div class="bg-light rounded-3 p-2 mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-credit-card text-primary me-2" style="font-size: 0.9rem;"></i>
                                <span class="small fw-semibold">Accepted Payment Methods</span>
                            </div>
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                <span class="badge bg-primary bg-opacity-25 text-primary px-2 py-1" style="font-size: 0.7rem;">
                                    <i class="fab fa-paypal me-1"></i>Payoneer
                                </span>
                                <span class="badge bg-secondary bg-opacity-25 text-secondary px-2 py-1" style="font-size: 0.7rem;">
                                    <i class="fas fa-university me-1"></i>Bank Transfer
                                </span>
                                <span class="badge bg-info bg-opacity-25 text-info px-2 py-1" style="font-size: 0.7rem;">
                                    <i class="fas fa-mobile-alt me-1"></i>Easypaisa
                                </span>
                                <span class="badge bg-success bg-opacity-25 text-success px-2 py-1" style="font-size: 0.7rem;">
                                    <i class="fas fa-bolt me-1"></i>JazzCash
                                </span>
                            </div>
                            <small class="text-success d-block" style="font-size: 0.65rem;">
                                <i class="fas fa-check-circle me-1"></i>Payoneer is our primary payment method for international clients
                            </small>
                        </div>

                        {{-- Contact Info --}}
                        <div class="bg-light rounded-3 p-2 mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-headset text-primary me-2" style="font-size: 0.9rem;"></i>
                                <span class="small fw-semibold">Admin Contact on WhatsApp</span>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone-alt text-muted me-1" style="font-size: 0.7rem;"></i>
                                    <small class="text-muted">+92 321 1417347</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-envelope text-muted me-1" style="font-size: 0.7rem;"></i>
                                    <small class="text-muted" style="font-size: 0.7rem;">mail@hivenarratives.com</small>
                                </div>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 0.6rem;">
                                <i class="fas fa-check-circle text-success me-1"></i>Admin will contact from same number/email
                            </small>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1 py-2 rounded-2" style="font-size: 0.9rem;">
                                <i class="fas fa-paper-plane me-1"></i>Submit Request
                            </button>
                            <a href="{{ route('credits.index') }}" class="btn btn-light py-2 px-3 rounded-2 border" style="font-size: 0.9rem;">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Payoneer Instructions --}}
            <div class="card border-0 bg-primary bg-opacity-5 rounded-3 mb-3">
                <div class="card-body p-3">
                    <h6 class="small fw-semibold mb-2 text-primary">💳 How Payoneer Payment Works</h6>
                    <ol class="ps-3 mb-0" style="font-size: 0.75rem;">
                        <li class="mb-1">Submit your request with Payoneer email</li>
                        <li class="mb-1">Admin sends payment request to your Payoneer account</li>
                        <li class="mb-1">You receive and complete payment via Payoneer</li>
                        <li class="mb-1">Credits added immediately after confirmation</li>
                    </ol>
                </div>
            </div>

            {{-- FAQ Accordion - Compact --}}
            <div class="card border-0 bg-light rounded-3">
                <div class="card-body p-3">
                    <h6 class="small fw-semibold mb-2">❓ Quick Help</h6>
                    <div class="vstack gap-2">
                        <div class="bg-white rounded-2 p-2">
                            <div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#faq1" style="cursor: pointer;">
                                <small class="fw-medium">How to pay with Payoneer?</small>
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem;"></i>
                            </div>
                            <div class="collapse mt-1" id="faq1">
                                <small class="text-muted d-block" style="font-size: 0.75rem;">Enter your Payoneer email, admin sends payment request, you complete payment online.</small>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-2 p-2">
                            <div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#faq2" style="cursor: pointer;">
                                <small class="fw-medium">Other payment methods?</small>
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem;"></i>
                            </div>
                            <div class="collapse mt-1" id="faq2">
                                <small class="text-muted d-block" style="font-size: 0.75rem;">Bank Transfer, Easypaisa, JazzCash also accepted. Admin will provide details.</small>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-2 p-2">
                            <div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#faq3" style="cursor: pointer;">
                                <small class="fw-medium">Processing time?</small>
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem;"></i>
                            </div>
                            <div class="collapse mt-1" id="faq3">
                                <small class="text-muted d-block" style="font-size: 0.75rem;">Payoneer payments processed instantly. Other methods take 24hrs.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Styles --}}
<style>
    /* Mobile-first adjustments */
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
        
        /* Better touch targets */
        select, button, .btn, input, textarea {
            min-height: 40px;
        }
        
        /* Horizontal scroll hints */
        .overflow-auto {
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
        }
        
        .overflow-auto::-webkit-scrollbar {
            height: 3px;
        }
        
        .overflow-auto::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
        
        /* Better spacing */
        .card-body {
            padding: 12px !important;
        }
    }

    /* Remove hover effects on mobile */
    @media (hover: none) {
        .hover-lift:hover {
            transform: none;
        }
    }

    /* Card improvements */
    .card {
        border-radius: 12px !important;
    }
    
    /* Badge adjustments */
    .badge.rounded-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Form improvements */
    .form-control, .form-select {
        padding: 0.6rem 0.75rem;
    }
    
    /* FAQ chevron rotation */
    .collapse.show + .fa-chevron-down {
        transform: rotate(180deg);
    }
    
    /* Payoneer badge */
    .bg-primary.bg-opacity-5 {
        background-color: rgba(13, 110, 253, 0.05);
    }
</style>

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

{{-- Bootstrap JS for collapse --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection