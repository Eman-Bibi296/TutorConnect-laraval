@extends('layouts.app')

@section('title', 'Registration Status - TutorConnect')

@section('content')
<div style="min-height: calc(100vh - 180px); display: flex; align-items: center; justify-content: center; padding: 40px 5%; background: #F8FAFC; font-family: 'Poppins', sans-serif;">
    <div id="statusCard" style="background: white; border-radius: 24px; padding: 45px 35px; max-width: 520px; width: 100%; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid #E2E8F0;">

        @if(!$tutor->is_verified)
            <div id="iconBox" style="width: 80px; height: 80px; border-radius: 50%; background: #FFFBEB; color: #D97706; font-size: 2.5rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; border: 3px solid #FDE68A;">
                <i class="fa-solid fa-clock"></i>
            </div>
            <h2 id="statusTitle" style="color: #111827; font-size: 1.7rem; font-weight: 800; margin: 0 0 12px;">Registration Submitted!</h2>
            <p id="statusMessage" style="color: #64748B; font-size: 0.95rem; margin: 0 0 25px; line-height: 1.7;">
                Your account is pending admin approval. You will be notified once approved.
            </p>
            <div id="loginBtnBox"></div>
        @else
            <div style="width: 80px; height: 80px; border-radius: 50%; background: #ECFDF5; color: #059669; font-size: 2.5rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; border: 3px solid #A7F3D0;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h2 style="color: #111827; font-size: 1.7rem; font-weight: 800; margin: 0 0 12px;">Account Approved!</h2>
            <p style="color: #64748B; font-size: 0.95rem; margin: 0 0 25px; line-height: 1.7;">
                Your account has been approved! Please login to continue.
            </p>
            <a href="/tutor/login" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 32px; background: linear-gradient(135deg, #059669 0%, #10B981 100%); color: white; border-radius: 30px; text-decoration: none; font-weight: 700; font-size: 0.95rem;">
                <i class="fa-solid fa-right-to-bracket"></i> Login Now
            </a>
        @endif

    </div>
</div>

@if(!$tutor->is_verified)
<script>
    // Har 5 second mein check karo ke admin ne approve kiya ya nahi
    setInterval(function() {
        fetch('/tutor/check-verification-status')
            .then(res => res.json())
            .then(data => {
                if (data.verified) {
                    document.getElementById('iconBox').outerHTML = `
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: #ECFDF5; color: #059669; font-size: 2.5rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; border: 3px solid #A7F3D0;">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>`;
                    document.getElementById('statusTitle').innerText = 'Account Approved!';
                    document.getElementById('statusMessage').innerText = 'Your account has been approved! Please login to continue.';
                    document.getElementById('loginBtnBox').innerHTML = `
                        <a href="/tutor/login" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 32px; background: linear-gradient(135deg, #059669 0%, #10B981 100%); color: white; border-radius: 30px; text-decoration: none; font-weight: 700; font-size: 0.95rem;">
                            <i class="fa-solid fa-right-to-bracket"></i> Login Now
                        </a>`;
                }
            });
    }, 5000);
</script>
@endif
@endsection