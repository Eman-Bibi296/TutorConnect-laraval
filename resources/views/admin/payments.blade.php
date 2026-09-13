@extends('admin.layout')

@section('title', 'Platform Payments')

@section('content')
<div style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 18px 24px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); border: 1px solid #E2E8F0; margin-bottom: 28px; flex-wrap: wrap; gap: 12px;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 800; color: #111827; margin: 0;">Platform Payments</h2>
        <p style="font-size: 0.88rem; color: #64748B; margin: 2px 0 0;">Detailed breakdown of every transaction, commission, and tutor payout</p>
    </div>
</div>

<!-- STATS -->
<div class="stats-grid">
    <div class="stat-card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div class="stat-label">TOTAL VOLUME</div>
            <div style="width: 44px; height: 44px; border-radius: 14px; background: #F3E8FF; color: #9333EA; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fa-solid fa-money-bill-trend-up"></i>
            </div>
        </div>
        <div class="stat-number">Rs {{ number_format($totalVolume, 0) }}</div>
        <small style="color: #10B981; font-weight: 600;">All processed payments</small>
    </div>

    <div class="stat-card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div class="stat-label">PLATFORM COMMISSION (20%)</div>
            <div style="width: 44px; height: 44px; border-radius: 14px; background: #ECFDF5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
        </div>
        <div class="stat-number">Rs {{ number_format($totalCommission, 0) }}</div>
        <small style="color: #059669; font-weight: 600;">Platform earnings</small>
    </div>

    <div class="stat-card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div class="stat-label">TUTOR PAYOUTS</div>
            <div style="width: 44px; height: 44px; border-radius: 14px; background: #EFF6FF; color: #3B82F6; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fa-solid fa-hand-holding-dollar"></i>
            </div>
        </div>
        <div class="stat-number">Rs {{ number_format($totalTutorPayouts, 0) }}</div>
        <small style="color: #3B82F6; font-weight: 600;">Total owed to tutors</small>
    </div>
</div>

<!-- TRANSACTIONS TABLE -->
<div class="section-card">
    <h3 class="section-title"><i class="fa-solid fa-receipt text-success me-2"></i> All Transactions</h3>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Student</th>
                    <th>Tutor</th>
                    <th>Total Amount</th>
                    <th>Platform Fee (20%)</th>
                    <th>Tutor Earning</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td style="font-size: 0.78rem; color: #64748B;">{{ $payment->transaction_id ?? 'N/A' }}</td>
                    <td><strong>{{ $payment->student->name ?? 'N/A' }}</strong></td>
                    <td><strong>{{ $payment->tutor->name ?? 'N/A' }}</strong></td>
                    <td style="font-weight: 700; color: #111827;">Rs {{ number_format($payment->amount, 0) }}</td>
                    <td style="font-weight: 700; color: #059669;">Rs {{ number_format($payment->platform_fee, 0) }}</td>
                    <td style="font-weight: 700; color: #3B82F6;">Rs {{ number_format($payment->tutor_earning, 0) }}</td>
                    <td>
                        @if($payment->status == 'completed')
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1"><i class="fa-solid fa-circle-check me-1"></i> Completed</span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-dark rounded-pill px-2 py-1">{{ ucfirst($payment->status) }}</span>
                        @endif
                    </td>
                    <td style="color: #64748B; font-size: 0.82rem;">{{ $payment->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align: center; color: #94A3B8; padding: 25px;">No payments recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection