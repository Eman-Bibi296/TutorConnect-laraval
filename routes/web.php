<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\AdminController;

// ==================== HOME PAGES ====================
Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// ==================== LOGIN PAGE (NAVBAR WALA) ====================
Route::get('/login', function() {
    return view('auth.login');
});

// ==================== STUDENT AUTH ====================
Route::get('/student/register', [AuthController::class, 'showStudentRegister']);
Route::post('/student/register', [AuthController::class, 'studentRegister']);
Route::get('/student/login', [AuthController::class, 'showStudentLogin']);
Route::post('/student/login', [AuthController::class, 'studentLogin']);

// ==================== TUTOR AUTH ====================
Route::get('/tutor/register', [AuthController::class, 'showTutorRegister']);
Route::post('/tutor/register', [AuthController::class, 'tutorRegister']);
Route::get('/tutor/login', [AuthController::class, 'showTutorLogin']);
Route::post('/tutor/login', [AuthController::class, 'tutorLogin']);

// ==================== LOGOUT ====================
Route::get('/logout', [AuthController::class, 'logout']);

// ==================== STUDENT ROUTES ====================
Route::get('/student/dashboard', [StudentController::class, 'dashboard']);
Route::get('/student/search', [StudentController::class, 'searchTutors']);
Route::get('/student/tutor/{id}', [StudentController::class, 'showTutorProfile']);
Route::post('/student/send-request', [StudentController::class, 'sendRequest']);
Route::post('/student/send-message', [StudentController::class, 'sendMessage']);
Route::post('/student/post-feedback', [StudentController::class, 'postFeedback']);
Route::get('/student/my-requests', [StudentController::class, 'myRequests']);
Route::get('/student/messages', [StudentController::class, 'messages']);
Route::get('/student/my-bookings', [StudentController::class, 'myBookings']);
Route::post('/student/cancel-booking', [StudentController::class, 'cancelBooking']);
Route::post('/student/book-session', [StudentController::class, 'submitBooking']);
Route::post('/student/send-message-ajax', [StudentController::class, 'sendMessageAjax']);
Route::get('/student/get-messages/{id}', [StudentController::class, 'getMessages']);
Route::get('/student/book-session-only/{id}', [StudentController::class, 'bookSessionOnly']);
Route::get('/student/chat-only/{id}', [StudentController::class, 'chatOnly']);
Route::get('/student/reviews', [StudentController::class, 'reviews']);
Route::get('/student/study-materials', [StudentController::class, 'studyMaterials']);
Route::get('/student/material/download/{id}', [StudentController::class, 'downloadMaterial']);
Route::post('/student/mark-messages-read', [StudentController::class, 'markMessagesRead']);
Route::post('/student/mark-requests-viewed', [StudentController::class, 'markRequestsViewed']);
Route::post('/student/mark-bookings-viewed', [StudentController::class, 'markBookingsViewed']);

Route::post('/student/submit-booking', [StudentController::class, 'submitBooking']);

// ==================== TUTOR ROUTES ====================
Route::get('/tutor/dashboard', [TutorController::class, 'dashboard']);
Route::get('/tutor/profile/complete', [TutorController::class, 'showCompleteProfile']);
Route::post('/tutor/profile/complete', [TutorController::class, 'saveCompleteProfile']);
Route::post('/tutor/update-status', [TutorController::class, 'updateStatus']);
Route::get('/tutor/profile/edit', [TutorController::class, 'editProfile']);
Route::post('/tutor/profile/update', [TutorController::class, 'updateProfile']);
Route::post('/tutor/update-booking-status', [TutorController::class, 'updateBookingStatus']);


Route::post('/tutor/confirm-payment', [TutorController::class, 'confirmPayment']);
Route::post('/tutor/complete-session', [TutorController::class, 'completeSession']);
Route::post('/tutor/reply-message', [TutorController::class, 'replyMessage']);
Route::get('/tutor/messages', [TutorController::class, 'messages']);
Route::post('/tutor/mark-messages-read', [TutorController::class, 'markMessagesRead']);
Route::get('/tutor/reviews', [TutorController::class, 'reviews']);
Route::get('/tutor/study-materials', [TutorController::class, 'studyMaterials']);
Route::post('/tutor/upload-material', [TutorController::class, 'uploadMaterial']);
Route::post('/tutor/material/upload', [TutorController::class, 'uploadMaterial']);
Route::get('/tutor/material/delete/{id}', [TutorController::class, 'deleteMaterial']);
Route::delete('/tutor/material/delete/{id}', [TutorController::class, 'deleteMaterial']);
Route::get('/tutor/get-student-messages/{id}', [TutorController::class, 'getStudentMessages']);
Route::post('/tutor/reply-message-ajax', [TutorController::class, 'replyMessageAjax']);
Route::delete('/student/review/delete/{id}', [StudentController::class, 'deleteReview']);
Route::post('/tutor/mark-reviews-read', [TutorController::class, 'markReviewsRead']);
Route::get('/tutor/requests', [TutorController::class, 'requests'])->name('tutor.requests');
Route::get('/tutor/bookings', [TutorController::class, 'bookings'])->name('tutor.bookings');

// ==================== ADMIN AUTH ====================

// ==================== ADMIN AUTH ====================
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ==================== ADMIN DASHBOARD ====================
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/students', [AdminController::class, 'students'])->name('admin.students');
Route::delete('/admin/student/delete/{id}', [AdminController::class, 'studentDelete']);

Route::get('/admin/tutors', [AdminController::class, 'tutors'])->name('admin.tutors');
Route::post('/admin/tutor/verify/{id}', [AdminController::class, 'tutorVerify']);
Route::delete('/admin/tutor/delete/{id}', [AdminController::class, 'tutorDelete']);

Route::get('/admin/requests', [AdminController::class, 'requests'])->name('admin.requests');
Route::delete('/admin/request/delete/{id}', [AdminController::class, 'requestDelete']);

Route::get('/admin/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
Route::post('/admin/booking/cancel/{id}', [AdminController::class, 'bookingCancel']);

Route::get('/admin/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
Route::delete('/admin/review/delete/{id}', [AdminController::class, 'reviewDelete']);

Route::get('/admin/messages', [AdminController::class, 'messages'])->name('admin.messages');
Route::delete('/admin/message/delete/{id}', [AdminController::class, 'messageDelete']);
use App\Http\Controllers\PaymentController;

// ⭐ PAYMENT ROUTES
Route::get('/payment/{bookingId}', [PaymentController::class, 'showPaymentPage']);
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);
Route::post('/book-and-pay', [PaymentController::class, 'bookAndPay']);
Route::get('/booking/success/{bookingId}', [PaymentController::class, 'bookingSuccess']);