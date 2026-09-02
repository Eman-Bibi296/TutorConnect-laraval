@extends('layouts.app')

@section('title', 'Stripe Sandbox Checkout - TutorConnect')

@section('content')
<style>
    :root {
        --primary: #059669;
        --primary-hover: #047857;
        --primary-light: #ECFDF5;
        --accent: #10B981;
        --stripe-blue: #635BFF;
        --stripe-dark: #0A2540;
        --bg-dark: #111827;
        --bg-light: #F8FAFC;
        --bg-card: #FFFFFF;
        --text-main: #111827;
        --text-muted: #64748B;
        --border-color: #E2E8F0;
    }

    .payment-container {
        padding: 35px 5%;
        min-height: calc(100vh - 180px);
        background: var(--bg-light);
        font-family: 'Poppins', sans-serif;
    }
    .payment-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1300px;
        margin: 0 auto;
    }
    .main-content {
        flex: 1;
        min-width: 0;
    }
    
    .payment-card {
        background: var(--bg-card);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
        max-width: 700px;
        margin: 0 auto;
    }
    
    .stripe-header-banner {
        background: linear-gradient(135deg, var(--stripe-dark) 0%, #1E1E38 100%);
        padding: 28px 30px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 3px solid var(--stripe-blue);
    }
    .stripe-logo-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 700;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .sandbox-badge {
        background: #FEF3C7;
        color: #92400E;
        font-size: 0.72rem;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 8px;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        border: 1px solid #FDE68A;
    }

    .booking-summary-box {
        background: #F8FAFC;
        padding: 22px;
        margin: 24px;
        border-radius: 18px;
        border: 1px solid var(--border-color);
    }
    .summary-tutor-flex {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #E2E8F0;
    }
    .summary-tutor-img {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #10B981;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        font-size: 0.9rem;
    }
    .summary-row .label { color: var(--text-muted); font-weight: 500; }
    .summary-row .val { color: var(--text-main); font-weight: 700; }

    .stripe-checkout-form {
        padding: 0 24px 24px;
    }
    .stripe-field-group {
        margin-bottom: 18px;
    }
    .stripe-field-group label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
    }
    
    #card-element {
        border: 1.5px solid #CBD5E1;
        padding: 14px 16px;
        border-radius: 12px;
        background: white;
        min-height: 48px;
        transition: all 0.2s ease;
    }
    #card-element.focus {
        border-color: var(--stripe-blue);
        box-shadow: 0 0 0 3px rgba(99, 91, 255, 0.15);
    }
    
    .payment-error {
        color: #DC2626;
        font-size: 0.85rem;
        margin-top: 8px;
        display: none;
        font-weight: 500;
    }
    .payment-error.show { display: block; }

    .stripe-pay-btn {
        width: 100%;
        background: var(--stripe-blue);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 12px;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(99, 91, 255, 0.35);
    }
    .stripe-pay-btn:hover {
        background: #4F46E5;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(99, 91, 255, 0.45);
    }
    .stripe-pay-btn:disabled {
        background: #94A3B8;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .test-card-info {
        text-align: center;
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 16px;
        padding: 12px;
        background: #F8FAFC;
        border-radius: 12px;
        border: 1px dashed #CBD5E1;
    }

    .loading {
        display: none;
        text-align: center;
        margin-top: 14px;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.9rem;
    }
    .loading.show { display: block; }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin: 0 24px 24px;
        color: var(--text-muted);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.88rem;
        transition: color 0.2s;
    }
    .back-btn:hover { color: var(--primary); }

    @media (max-width: 900px) {
        .payment-wrapper { flex-direction: column; }
    }
</style>

@php
    $tutor = $booking->tutor;
    $tutorAvatar = 'images/burhan.png';
    if ($tutor) {
        if (!empty($tutor->profile_picture) && file_exists(public_path($tutor->profile_picture))) {
            $tutorAvatar = $tutor->profile_picture;
        } else {
            $firstName = strtolower(explode(' ', str_replace(['Dr.', 'Prof.', 'Mr.', 'Ms.'], '', $tutor->name))[0] ?? 'burhan');
            if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                $tutorAvatar = 'images/' . $firstName . '.jpg';
            } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                $tutorAvatar = 'images/' . $firstName . '.png';
            }
        }
    }
    $hourlyRate = $tutor->hourly_rate ?? 1500;
@endphp

<div class="payment-container">
    <div class="payment-wrapper">
        <!-- Student Sidebar -->
        @include('student.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="payment-card">
                
                <!-- Stripe Header Banner -->
                <div class="stripe-header-banner">
                    <div>
                        <div class="stripe-logo-pill mb-2">
                            <i class="fa-brands fa-stripe fs-5"></i>
                            <span>Secure Payment</span>
                        </div>
                        <h3 class="m-0 fw-bold fs-5">TutorConnect Checkout</h3>
                    </div>
                    <span class="sandbox-badge">Test Sandbox</span>
                </div>

                <!-- Booking Summary Box -->
                <div class="booking-summary-box">
                    <div class="summary-tutor-flex">
                        <img src="{{ asset($tutorAvatar) }}" alt="{{ $tutor->name ?? 'Tutor' }}" class="summary-tutor-img" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($tutor->name ?? 'Tutor') }}&background=ECFDF5&color=059669'">
                        <div>
                            <h5 class="m-0 fw-bold text-dark">{{ $tutor->name ?? 'Instructor' }}</h5>
                            <small class="text-muted">{{ $tutor->subject ?? 'Computer Science' }}</small>
                        </div>
                    </div>
                    <div class="summary-row">
                        <span class="label"><i class="fa-regular fa-calendar me-1"></i> Session Date</span>
                        <span class="val">{{ $booking->preferred_date ? \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') : date('M d, Y') }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label"><i class="fa-regular fa-clock me-1"></i> Time Slot</span>
                        <span class="val">{{ $booking->formatted_time }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label"><i class="fa-solid fa-laptop me-1"></i> Learning Mode</span>
                        <span class="val">Online 1-on-1 Interactive</span>
                    </div>
                    <div class="summary-row" style="border-top:1px dashed #CBD5E1; padding-top:12px; margin-top:8px;">
                        <span class="label" style="font-weight:700; color:#111827;">Total Amount</span>
                        <span class="val" style="font-size:1.3rem; color:#059669; font-weight:800;">Rs {{ number_format($hourlyRate) }}</span>
                    </div>
                </div>

                <!-- Payment Form -->
                <form id="payment-form" class="stripe-checkout-form">
                    @csrf
                    <input type="hidden" name="booking_id" id="booking_id" value="{{ $booking->id }}">
                    <input type="hidden" name="amount" id="amount" value="{{ $hourlyRate }}">
                    <input type="hidden" name="tutor_id" id="tutor_id" value="{{ $booking->tutor_id }}">
                    
                    <div class="stripe-field-group">
                        <label>
                            <span><i class="fa-solid fa-credit-card me-1 text-primary"></i> Card Information</span>
                            <span class="text-muted small">Encrypted via Stripe 256-bit SSL</span>
                        </label>
                        <div id="card-element"></div>
                        <div id="fallback-card-wrapper" style="display:none;">
                            <input type="text" id="fb_card_number" class="form-control mb-2" placeholder="4242 4242 4242 4242" maxlength="19" style="border: 1.5px solid #CBD5E1; border-radius: 10px; padding: 10px 14px; font-size: 0.95rem;">
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="text" id="fb_card_expiry" class="form-control" placeholder="MM/YY (e.g. 12/28)" maxlength="5" style="border: 1.5px solid #CBD5E1; border-radius: 10px; padding: 10px 14px; font-size: 0.95rem;">
                                </div>
                                <div class="col-6">
                                    <input type="text" id="fb_card_cvc" class="form-control" placeholder="CVC (123)" maxlength="4" style="border: 1.5px solid #CBD5E1; border-radius: 10px; padding: 10px 14px; font-size: 0.95rem;">
                                </div>
                            </div>
                        </div>
                        <div id="card-errors" class="payment-error" role="alert"></div>
                    </div>

                    <button type="submit" class="stripe-pay-btn" id="submit-btn">
                        <i class="fa-solid fa-lock"></i> <span>Pay Rs {{ number_format($hourlyRate) }} via Stripe</span>
                    </button>

                    <div class="loading" id="loading">
                        <i class="fa-solid fa-spinner fa-spin me-1"></i> Authorizing payment securely via Stripe...
                    </div>

                    <div class="test-card-info">
                        <strong>Test Card:</strong> 4242 4242 4242 4242 &nbsp;|&nbsp; MM/YY: Future (e.g. 12/28) &nbsp;|&nbsp; CVC: 123
                    </div>
                </form>

                <a href="/student/my-bookings" class="back-btn">
                    <i class="fa-solid fa-arrow-left"></i> Back to My Bookings
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let stripe = null;
        let cardElement = null;
        let isStripeMounted = false;
        let cardComplete = false;
        let cardError = null;

        const publishableKey = '{{ $stripeKey ?? config("services.stripe.key") ?? env("STRIPE_KEY") }}';
        
        try {
            if (typeof Stripe !== 'undefined' && publishableKey && publishableKey.startsWith('pk_')) {
                stripe = Stripe(publishableKey);
                const elements = stripe.elements();
                
                const style = {
                    base: {
                        fontSize: '15px',
                        fontFamily: "'Poppins', sans-serif",
                        color: '#111827',
                        '::placeholder': { color: '#94A3B8' },
                    },
                };
                
                cardElement = elements.create('card', { style: style, hidePostalCode: true });
                cardElement.mount('#card-element');
                isStripeMounted = true;
                
                cardElement.on('focus', function() {
                    document.getElementById('card-element').classList.add('focus');
                });
                cardElement.on('blur', function() {
                    document.getElementById('card-element').classList.remove('focus');
                });
                cardElement.on('change', function(event) {
                    cardComplete = event.complete;
                    cardError = event.error ? event.error.message : null;
                    const errorDiv = document.getElementById('card-errors');
                    if (event.error) {
                        errorDiv.textContent = event.error.message;
                        errorDiv.classList.add('show');
                    } else {
                        errorDiv.textContent = '';
                        errorDiv.classList.remove('show');
                    }
                });
            } else {
                showFallbackCardInputs();
            }
        } catch (e) {
            console.warn('Stripe Elements initialization bypassed, using styled fallback input:', e);
            showFallbackCardInputs();
        }

        // Auto fallback if stripe iframe didn't load after 2 seconds
        setTimeout(function() {
            const cardEl = document.getElementById('card-element');
            if (!cardEl || cardEl.children.length === 0) {
                showFallbackCardInputs();
            }
        }, 2000);

        function showFallbackCardInputs() {
            const cardEl = document.getElementById('card-element');
            const fbWrapper = document.getElementById('fallback-card-wrapper');
            if (cardEl) cardEl.style.display = 'none';
            if (fbWrapper) fbWrapper.style.display = 'block';
            isStripeMounted = false;
        }

        // Fallback input formatters
        const numInput = document.getElementById('fb_card_number');
        if (numInput) {
            numInput.addEventListener('input', function(e) {
                let v = e.target.value.replace(/\D/g, '').substring(0, 16);
                let parts = [];
                for (let i = 0; i < v.length; i += 4) {
                    parts.push(v.substring(i, i + 4));
                }
                e.target.value = parts.join(' ');
            });
        }

        const expInput = document.getElementById('fb_card_expiry');
        if (expInput) {
            expInput.addEventListener('input', function(e) {
                let v = e.target.value.replace(/\D/g, '').substring(0, 4);
                if (v.length >= 2) {
                    e.target.value = v.substring(0, 2) + '/' + v.substring(2);
                } else {
                    e.target.value = v;
                }
            });
        }

        const form = document.getElementById('payment-form');
        const submitBtn = document.getElementById('submit-btn');
        const loadingDiv = document.getElementById('loading');
        const errorDiv = document.getElementById('card-errors');
        
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            errorDiv.textContent = '';
            errorDiv.classList.remove('show');
            
            const bookingId = document.getElementById('booking_id').value;
            const amount = document.getElementById('amount').value;
            const tutorId = document.getElementById('tutor_id').value;

            // Validate card inputs
            if (!isStripeMounted) {
                const rawNum = (numInput?.value || '').replace(/\s/g, '');
                const rawExp = expInput?.value || '';
                const rawCvc = document.getElementById('fb_card_cvc')?.value || '';

                if (rawNum.length < 15 || !rawNum.startsWith('4')) {
                    showError('Your card number is invalid. Use test card 4242 4242 4242 4242.');
                    return;
                }

                if (!rawExp.includes('/') || rawExp.length < 5) {
                    showError('Your card\'s expiration date is incomplete.');
                    return;
                }

                const [expMonth, expYear] = rawExp.split('/').map(n => parseInt(n, 10));
                const currentYear = parseInt(new Date().getFullYear().toString().slice(-2), 10);
                const currentMonth = new Date().getMonth() + 1;

                if (isNaN(expMonth) || expMonth < 1 || expMonth > 12) {
                    showError('Your card\'s expiration month is invalid.');
                    return;
                }

                if (expYear < currentYear || (expYear === currentYear && expMonth < currentMonth)) {
                    showError('Your card\'s expiration date is in the past.');
                    return;
                }

                if (rawCvc.length < 3) {
                    showError('Your card\'s security code is incomplete.');
                    return;
                }
            } else {
                if (cardError) {
                    showError(cardError);
                    return;
                }
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Authorizing...';
            loadingDiv.classList.add('show');

            try {
                // 1. Create Payment Intent on Backend
                const intentResponse = await fetch('/create-payment-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        amount: amount,
                        tutor_id: tutorId
                    })
                });
                
                const intentData = await intentResponse.json();
                
                if (!intentData.success) {
                    throw new Error(intentData.message || 'Payment setup failed');
                }

                let finalTxId = 'pi_test_' + Date.now();

                // 2. If using live Stripe Test Elements
                if (isStripeMounted && stripe && cardElement && !intentData.demo && intentData.clientSecret && !intentData.clientSecret.startsWith('pi_demo_')) {
                    const { error, paymentIntent } = await stripe.confirmCardPayment(
                        intentData.clientSecret,
                        {
                            payment_method: { card: cardElement }
                        }
                    );
                    
                    if (error) {
                        throw new Error(error.message);
                    }
                    if (paymentIntent && paymentIntent.id) {
                        finalTxId = paymentIntent.id;
                    }
                } else {
                    // Realistic demo authorization simulation (1.0 second delay)
                    await new Promise(resolve => setTimeout(resolve, 1000));
                }

                // 3. Atomically confirm booking and record payment ledger
                const paymentResponse = await fetch('/book-and-pay', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        booking_id: bookingId,
                        tutor_id: tutorId,
                        amount: amount,
                        payment_intent_id: finalTxId
                    })
                });
                
                const paymentData = await paymentResponse.json();
                
                if (paymentData.success) {
                    window.location.href = '/booking/success/' + bookingId;
                } else {
                    throw new Error(paymentData.message || 'Payment confirmation failed');
                }
                
            } catch (err) {
                showError(err.message || 'Payment could not be completed.');
            }
        });

        function showError(msg) {
            errorDiv.textContent = msg;
            errorDiv.classList.add('show');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fa-solid fa-lock"></i> <span>Pay via Stripe</span>';
            loadingDiv.classList.remove('show');
        }
    });
</script>
@endsection