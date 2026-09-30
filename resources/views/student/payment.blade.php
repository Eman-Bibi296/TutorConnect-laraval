@extends('layouts.app')

@section('title', 'Manual Payment - TutorConnect')

@section('content')
<style>
    .payment-container {
        padding: 35px 5%;
        min-height: calc(100vh - 180px);
        background: #F8FAFC;
        font-family: 'Poppins', sans-serif;
    }
    .payment-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1300px;
        margin: 0 auto;
    }
    .main-content { flex: 1; min-width: 0; }
    .payment-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        max-width: 700px;
        margin: 0 auto;
    }
    .payment-header {
        background: linear-gradient(135deg, #111827 0%, #1e293b 100%);
        padding: 28px 30px;
        color: white;
    }
    .booking-summary-box {
        background: #F8FAFC;
        padding: 22px;
        margin: 24px;
        border-radius: 18px;
        border: 1px solid #E2E8F0;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 0.9rem;
    }
    .summary-row .label { color: #64748B; }
    .summary-row .val { color: #111827; font-weight: 700; }

    .account-box {
        background: #ECFDF5;
        border: 1.5px dashed #10B981;
        border-radius: 16px;
        padding: 20px;
        margin: 0 24px 24px;
    }
    .account-box h5 { color: #047857; font-weight: 800; margin-bottom: 12px; }
    .account-box p { margin: 4px 0; font-size: 0.92rem; color: #065F46; }

    .form-section { padding: 0 24px 24px; }
    .form-group { margin-bottom: 18px; }
    .form-group label { display:block; font-weight:600; margin-bottom:8px; font-size:0.9rem; }
    .form-group select, .form-group input {
        width: 100%; padding: 12px 16px; border: 1.5px solid #CBD5E1;
        border-radius: 12px; font-size: 0.95rem;
    }
    .btn-submit-proof {
        width: 100%; background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white; padding: 14px; border: none; border-radius: 12px;
        font-weight: 700; font-size: 1rem; cursor: pointer;
    }
    .back-btn {
        display: inline-flex; align-items: center; gap: 6px; margin: 0 24px 24px;
        color: #64748B; text-decoration: none; font-weight: 600; font-size: 0.88rem;
    }
</style>

@php
    $tutor = $booking->tutor;
    $amount = $booking->amount ?? $tutor->hourly_rate ?? 1500;
@endphp

<div class="payment-container">
    <div class="payment-wrapper">
        @include('student.partials.sidebar')

        <div class="main-content">
            <div class="payment-card">

                <div class="payment-header">
                    <h3 class="m-0 fw-bold"><i class="fa-solid fa-money-bill-transfer me-2"></i> Manual Payment</h3>
                    <p class="m-0" style="color:#94A3B8; font-size:0.9rem;">Pay via JazzCash or EasyPaisa and submit your transaction ID</p>
                </div>

                <div class="booking-summary-box">
                    <div class="summary-row">
                        <span class="label">Tutor</span>
                        <span class="val">{{ $tutor->name ?? 'Instructor' }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Session Date</span>
                        <span class="val">{{ $booking->preferred_date ? \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') : date('M d, Y') }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Time Slot</span>
                        <span class="val">{{ $booking->formatted_time }}</span>
                    </div>
                    <div class="summary-row" style="border-top:1px dashed #CBD5E1; padding-top:12px; margin-top:8px;">
                        <span class="label" style="font-weight:700; color:#111827;">Amount to Pay</span>
                        <span class="val" style="font-size:1.3rem; color:#059669; font-weight:800;">Rs {{ number_format($amount) }}</span>
                    </div>
                </div>

                <div class="account-box">
                    <h5><i class="fa-solid fa-wallet me-1"></i> Send Payment To</h5>
                    <p><strong>JazzCash:</strong> 0316-6325085 (Account Title: TutorConnect)</p>
                    <p><strong>EasyPaisa:</strong> 0315-6148018 (Account Title: TutorConnect)</p>
                </div>

                @if(session('error'))
                    <div style="margin:0 24px 16px;"><div class="alert alert-danger">{{ session('error') }}</div></div>
                @endif

                <form action="/submit-payment-proof" method="POST" class="form-section">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                    <div class="form-group">
                        <label><i class="fa-solid fa-credit-card"></i> Payment Method</label>
                        <select name="payment_method" required>
                            <option value="">-- Select --</option>
                            <option value="JazzCash">JazzCash</option>
                            <option value="EasyPaisa">EasyPaisa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-hashtag"></i> Transaction ID / Reference</label>
                        <input type="text" name="transaction_reference" placeholder="Paste your transaction reference here" required>
                    </div>

                    <button type="submit" class="btn-submit-proof">
                        <i class="fa-solid fa-paper-plane me-1"></i> Submit Payment Proof
                    </button>
                </form>

                <a href="/student/my-bookings" class="back-btn">
                    <i class="fa-solid fa-arrow-left"></i> Back to My Bookings
                </a>
            </div>
        </div>
    </div>
</div>
@endsection