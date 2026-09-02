<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\RequestModel;
use App\Models\Booking;
use App\Models\Message;
use App\Models\Feedback;
use App\Models\StudyMaterial;
use App\Models\Payment;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with complete prototype parity data.
     */
    public function run(): void
    {
        // ==========================================
        // 1. SUPER ADMIN
        // ==========================================
        Admin::updateOrCreate(
            ['email' => 'admin@tutorconnect.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password123')
            ]
        );

        // ==========================================
        // 2. ENROLLED STUDENTS
        // ==========================================
        $studentsData = [
            [
                'name' => 'Eman Bibi',
                'email' => 'eman@student.com',
                'password' => bcrypt('password123'),
                'location' => 'Islamabad'
            ],
            [
                'name' => 'Ali Raza',
                'email' => 'ali@student.com',
                'password' => bcrypt('password123'),
                'location' => 'Lahore'
            ],
            [
                'name' => 'Hasan Tariq',
                'email' => 'hasan@student.com',
                'password' => bcrypt('password123'),
                'location' => 'Rawalpindi'
            ],
            [
                'name' => 'Zainab Tariq',
                'email' => 'zainab@student.com',
                'password' => bcrypt('password123'),
                'location' => 'Karachi'
            ]
        ];

        $students = [];
        foreach ($studentsData as $sData) {
            $students[$sData['email']] = Student::updateOrCreate(['email' => $sData['email']], $sData);
        }

        // ==========================================
        // 3. VERIFIED FACULTY & TUTORS
        // ==========================================
        $tutorsData = [
            'burhan@tutorconnect.com' => [
                'name' => 'Dr. Burhan Ahmad',
                'email' => 'burhan@tutorconnect.com',
                'password' => bcrypt('password123'),
                'subject' => 'Computer Science & Web Dev',
                'qualification' => 'PhD in Computer Science',
                'experience' => 10,
                'hourly_rate' => '1500',
                'location' => 'Sheikhupura',
                'profile_picture' => 'images/burhan.png',
                'bio' => 'Senior university lecturer specialized in Full-Stack Web Development, PHP Laravel, Database Systems, and Software Architecture with 10+ years of teaching experience.',
                'is_verified' => true,
                'status' => 'approved',
                'availability' => 'Monday - Friday: 4:00 PM - 8:00 PM'
            ],
            'rabia@tutorconnect.com' => [
                'name' => 'Prof. Rabia Tariq',
                'email' => 'rabia@tutorconnect.com',
                'password' => bcrypt('password123'),
                'subject' => 'Mathematics & Calculus',
                'qualification' => 'MPhil in Applied Mathematics',
                'experience' => 8,
                'hourly_rate' => '1200',
                'location' => 'Lahore',
                'profile_picture' => 'images/rabia.jpg',
                'bio' => 'MPhil in Applied Mathematics with 8+ years helping university and A-Level students master Calculus, Linear Algebra, and Differential Equations.',
                'is_verified' => true,
                'status' => 'approved',
                'availability' => 'Monday - Saturday: 2:00 PM - 7:00 PM'
            ],
            'ahmad@tutorconnect.com' => [
                'name' => 'Engr. Ahmad Ali',
                'email' => 'ahmad@tutorconnect.com',
                'password' => bcrypt('password123'),
                'subject' => 'Physics & Applied Electronics',
                'qualification' => 'BSc Electrical Engineering',
                'experience' => 6,
                'hourly_rate' => '1000',
                'location' => 'Lahore',
                'profile_picture' => 'images/ahmad.jpg',
                'bio' => 'Electrical engineer passionate about interactive problem solving in Applied Physics, Circuit Analysis, and Electromagnetism for engineering and college students.',
                'is_verified' => true,
                'status' => 'approved',
                'availability' => 'Weekdays: 5:00 PM - 9:00 PM'
            ],
            'muneeb@tutorconnect.com' => [
                'name' => 'Prof. Muneeb Ur Rehman',
                'email' => 'muneeb@tutorconnect.com',
                'password' => bcrypt('password123'),
                'subject' => 'Computer Science & Python',
                'qualification' => 'MS Computer Science',
                'experience' => 7,
                'hourly_rate' => '1400',
                'location' => 'Islamabad',
                'profile_picture' => 'images/muneeb.jpg',
                'bio' => 'MS Computer Science. Step-by-step programming mentorship in Python, Data Structures, Algorithms, and Object Oriented Programming.',
                'is_verified' => true,
                'status' => 'approved',
                'availability' => 'Tuesday - Sunday: 3:00 PM - 8:00 PM'
            ],
            'azan@tutorconnect.com' => [
                'name' => 'Sir Azan Farooq',
                'email' => 'azan@tutorconnect.com',
                'password' => bcrypt('password123'),
                'subject' => 'Chemistry & Organic Chemistry',
                'qualification' => 'MSc Organic Chemistry',
                'experience' => 5,
                'hourly_rate' => '1600',
                'location' => 'Karachi',
                'profile_picture' => 'images/azan.jpg',
                'bio' => 'Specialist in MDCAT, F.Sc Chemistry, reaction mechanism cheat-sheets, chemical kinetics, and exam strategy.',
                'is_verified' => true,
                'status' => 'approved',
                'availability' => 'Daily: 4:00 PM - 9:00 PM'
            ],
            'rafay@tutorconnect.com' => [
                'name' => 'Abdul Rafay',
                'email' => 'rafay@tutorconnect.com',
                'password' => bcrypt('password123'),
                'subject' => 'English & IELTS Preparation',
                'qualification' => 'MA English Literature & CELTA',
                'experience' => 6,
                'hourly_rate' => '1300',
                'location' => 'Rawalpindi',
                'profile_picture' => 'images/rafay.jpg',
                'bio' => 'Certified English and IELTS coach helping university students master academic writing, speaking fluency, and Band 8+ exam techniques.',
                'is_verified' => true,
                'status' => 'approved',
                'availability' => 'Monday - Friday: 10:00 AM - 6:00 PM'
            ]
        ];

        $tutors = [];
        foreach ($tutorsData as $email => $tData) {
            $tutors[$email] = Tutor::updateOrCreate(['email' => $email], $tData);
        }

        // ==========================================
        // 4. TUTOR REQUESTS
        // ==========================================
        $requestsData = [
            [
                'student_id' => $students['eman@student.com']->id,
                'tutor_id' => $tutors['burhan@tutorconnect.com']->id,
                'status' => 'accepted',
                'is_viewed' => 1,
                'created_at' => Carbon::now()->subDays(3)
            ],
            [
                'student_id' => $students['eman@student.com']->id,
                'tutor_id' => $tutors['rabia@tutorconnect.com']->id,
                'status' => 'accepted',
                'is_viewed' => 1,
                'created_at' => Carbon::now()->subDays(4)
            ],
            [
                'student_id' => $students['eman@student.com']->id,
                'tutor_id' => $tutors['ahmad@tutorconnect.com']->id,
                'status' => 'pending',
                'is_viewed' => 0,
                'created_at' => Carbon::now()->subDays(1)
            ],
            [
                'student_id' => $students['ali@student.com']->id,
                'tutor_id' => $tutors['rabia@tutorconnect.com']->id,
                'status' => 'accepted',
                'is_viewed' => 1,
                'created_at' => Carbon::now()->subDays(5)
            ],
            [
                'student_id' => $students['hasan@student.com']->id,
                'tutor_id' => $tutors['ahmad@tutorconnect.com']->id,
                'status' => 'accepted',
                'is_viewed' => 1,
                'created_at' => Carbon::now()->subDays(6)
            ],
            [
                'student_id' => $students['zainab@student.com']->id,
                'tutor_id' => $tutors['muneeb@tutorconnect.com']->id,
                'status' => 'pending',
                'is_viewed' => 0,
                'created_at' => Carbon::now()->subHours(8)
            ]
        ];

        foreach ($requestsData as $req) {
            RequestModel::create($req);
        }

        // ==========================================
        // 5. SESSION BOOKINGS
        // ==========================================
        $bookingsData = [
            [
                'student_id' => $students['eman@student.com']->id,
                'tutor_id' => $tutors['burhan@tutorconnect.com']->id,
                'preferred_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'preferred_time' => '16:00:00',
                'mode' => 'Online',
                'sessions_per_week' => 2,
                'status' => 'confirmed',
                'amount' => 3000.00,
                'payment_status' => 'paid',
                'payment_id' => 'pi_test_3N8x729YkPqL',
                'is_viewed' => 1,
                'message' => 'Need revision for Laravel MVC, RESTful APIs, and database architecture.',
                'created_at' => Carbon::now()->subDays(2)
            ],
            [
                'student_id' => $students['eman@student.com']->id,
                'tutor_id' => $tutors['rabia@tutorconnect.com']->id,
                'preferred_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'preferred_time' => '18:00:00',
                'mode' => 'Online',
                'sessions_per_week' => 3,
                'status' => 'pending',
                'amount' => 3600.00,
                'payment_status' => 'pending',
                'payment_id' => null,
                'is_viewed' => 0,
                'message' => 'Calculus II integration techniques and multivariable functions.',
                'created_at' => Carbon::now()->subDays(1)
            ],
            [
                'student_id' => $students['ali@student.com']->id,
                'tutor_id' => $tutors['rabia@tutorconnect.com']->id,
                'preferred_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'preferred_time' => '14:00:00',
                'mode' => 'Online',
                'sessions_per_week' => 2,
                'status' => 'completed',
                'amount' => 2400.00,
                'payment_status' => 'paid',
                'payment_id' => 'pi_test_9M1x452ZtRmK',
                'is_viewed' => 1,
                'message' => 'Calculus II multivariable integrals and series convergence.',
                'created_at' => Carbon::now()->subDays(6)
            ],
            [
                'student_id' => $students['hasan@student.com']->id,
                'tutor_id' => $tutors['ahmad@tutorconnect.com']->id,
                'preferred_date' => Carbon::now()->addDays(6)->format('Y-m-d'),
                'preferred_time' => '17:00:00',
                'mode' => 'Online',
                'sessions_per_week' => 1,
                'status' => 'confirmed',
                'amount' => 1000.00,
                'payment_status' => 'paid',
                'payment_id' => 'pi_test_5K2x891VwJnX',
                'is_viewed' => 1,
                'message' => 'Circuit analysis, Kirchhoff laws, and AC impedance practice.',
                'created_at' => Carbon::now()->subDays(3)
            ],
            [
                'student_id' => $students['zainab@student.com']->id,
                'tutor_id' => $tutors['burhan@tutorconnect.com']->id,
                'preferred_date' => Carbon::now()->subDays(4)->format('Y-m-d'),
                'preferred_time' => '15:00:00',
                'mode' => 'Online',
                'sessions_per_week' => 2,
                'status' => 'completed',
                'amount' => 3000.00,
                'payment_status' => 'paid',
                'payment_id' => 'pi_test_1P7x330QwLtM',
                'is_viewed' => 1,
                'message' => 'Database normalization and SQL queries optimization.',
                'created_at' => Carbon::now()->subDays(8)
            ]
        ];

        $createdBookings = [];
        foreach ($bookingsData as $bData) {
            $createdBookings[] = Booking::create($bData);
        }

        // ==========================================
        // 6. PAYMENTS RECORD
        // ==========================================
        foreach ($createdBookings as $bk) {
            if ($bk->payment_status === 'paid') {
                Payment::create([
                    'booking_id' => $bk->id,
                    'student_id' => $bk->student_id,
                    'tutor_id' => $bk->tutor_id,
                    'amount' => $bk->amount,
                    'currency' => 'PKR',
                    'transaction_id' => $bk->payment_id,
                    'status' => 'succeeded',
                    'created_at' => $bk->created_at
                ]);
            }
        }

        // ==========================================
        // 7. REAL-TIME CONVERSATIONS & MESSAGES
        // ==========================================
        $messagesData = [
            // Conversation: Dr. Burhan Ahmad & Eman Bibi
            [
                'sender_id' => $tutors['burhan@tutorconnect.com']->id,
                'sender_type' => 'tutor',
                'receiver_id' => $students['eman@student.com']->id,
                'receiver_type' => 'student',
                'message' => 'Hello Eman! Looking forward to our session on Laravel MVC and database architecture. Have you prepared your questions?',
                'is_read' => 1,
                'created_at' => Carbon::now()->subDays(1)->setTime(10, 15, 0)
            ],
            [
                'sender_id' => $students['eman@student.com']->id,
                'sender_type' => 'student',
                'receiver_id' => $tutors['burhan@tutorconnect.com']->id,
                'receiver_type' => 'tutor',
                'message' => 'Hi Dr. Burhan, yes! I reviewed the controller models and prepared questions on Eloquent relationships.',
                'is_read' => 1,
                'created_at' => Carbon::now()->subDays(1)->setTime(10, 18, 0)
            ],
            [
                'sender_id' => $tutors['burhan@tutorconnect.com']->id,
                'sender_type' => 'tutor',
                'receiver_id' => $students['eman@student.com']->id,
                'receiver_type' => 'student',
                'message' => 'Excellent! We will start right on time and build a live RESTful API together.',
                'is_read' => 1,
                'created_at' => Carbon::now()->subDays(1)->setTime(10, 20, 0)
            ],

            // Conversation: Prof. Rabia Tariq & Eman Bibi
            [
                'sender_id' => $tutors['rabia@tutorconnect.com']->id,
                'sender_type' => 'tutor',
                'receiver_id' => $students['eman@student.com']->id,
                'receiver_type' => 'student',
                'message' => 'Hello Eman, please review the integration by parts formula before our scheduled session.',
                'is_read' => 1,
                'created_at' => Carbon::now()->subHours(12)
            ],
            [
                'sender_id' => $students['eman@student.com']->id,
                'sender_type' => 'student',
                'receiver_id' => $tutors['rabia@tutorconnect.com']->id,
                'receiver_type' => 'tutor',
                'message' => 'Thank you Professor, I have solved the practice questions from Chapter 7.',
                'is_read' => 1,
                'created_at' => Carbon::now()->subHours(11)
            ],

            // Conversation: Engr. Ahmad Ali & Hasan Tariq
            [
                'sender_id' => $tutors['ahmad@tutorconnect.com']->id,
                'sender_type' => 'tutor',
                'receiver_id' => $students['hasan@student.com']->id,
                'receiver_type' => 'student',
                'message' => 'Welcome to Physics tutoring! Check out the formula cheat-sheet in Study Materials.',
                'is_read' => 1,
                'created_at' => Carbon::now()->subDays(2)->setTime(14, 0, 0)
            ]
        ];

        foreach ($messagesData as $msg) {
            Message::create($msg);
        }

        // ==========================================
        // 8. VERIFIED FEEDBACK & REVIEWS
        // ==========================================
        $reviewsData = [
            [
                'student_id' => $students['eman@student.com']->id,
                'tutor_id' => $tutors['burhan@tutorconnect.com']->id,
                'rating' => 5,
                'comment' => 'Dr. Burhan is an outstanding instructor! He simplified complex full-stack web development and Laravel concepts, providing hands-on coding guidance for my project.',
                'status' => 'approved',
                'is_read' => 1,
                'created_at' => Carbon::now()->subDays(3)
            ],
            [
                'student_id' => $students['ali@student.com']->id,
                'tutor_id' => $tutors['rabia@tutorconnect.com']->id,
                'rating' => 5,
                'comment' => 'Excellent Calculus II tutoring. She gave intuitive geometric explanations for multivariable integrals that helped me score an A in my semester finals.',
                'status' => 'approved',
                'is_read' => 1,
                'created_at' => Carbon::now()->subDays(5)
            ],
            [
                'student_id' => $students['hasan@student.com']->id,
                'tutor_id' => $tutors['ahmad@tutorconnect.com']->id,
                'rating' => 5,
                'comment' => 'Very patient teacher for circuit analysis and AC impedance. Solved multiple past exam papers with me before my midterms.',
                'status' => 'approved',
                'is_read' => 1,
                'created_at' => Carbon::now()->subDays(7)
            ],
            [
                'student_id' => $students['zainab@student.com']->id,
                'tutor_id' => $tutors['burhan@tutorconnect.com']->id,
                'rating' => 5,
                'comment' => 'High quality database normalization and SQL query guidance. Truly a senior level expert!',
                'status' => 'approved',
                'is_read' => 1,
                'created_at' => Carbon::now()->subDays(9)
            ]
        ];

        foreach ($reviewsData as $rev) {
            Feedback::create($rev);
        }

        // ==========================================
        // 9. SHARED STUDY MATERIALS
        // ==========================================
        $materialsData = [
            [
                'tutor_id' => $tutors['burhan@tutorconnect.com']->id,
                'title' => 'Laravel Full-Stack MVC Cheat Sheet',
                'material_type' => 'PDF Resource',
                'description' => 'Full solved guide for Laravel routing, controllers, Eloquent ORM relations, and API endpoints.',
                'file_path' => 'materials/laravel-mvc-cheatsheet.pdf',
                'file_name' => 'laravel-mvc-cheatsheet.pdf',
                'created_at' => Carbon::now()->subDays(3)
            ],
            [
                'tutor_id' => $tutors['rabia@tutorconnect.com']->id,
                'title' => 'Calculus II - Integration Problem Sheet',
                'material_type' => 'Solved PDF',
                'description' => 'Comprehensive practice problems for integration by substitution, parts, and partial fractions.',
                'file_path' => 'materials/calculus-integration-sheet.pdf',
                'file_name' => 'calculus-integration-sheet.pdf',
                'created_at' => Carbon::now()->subDays(5)
            ],
            [
                'tutor_id' => $tutors['ahmad@tutorconnect.com']->id,
                'title' => 'Applied Physics Circuit Analysis Formulae',
                'material_type' => 'Study Guide',
                'description' => 'Quick reference cheat-sheet for Kirchhoff Laws, AC circuit impedance, and magnetic induction.',
                'file_path' => 'materials/physics-circuit-formulae.pdf',
                'file_name' => 'physics-circuit-formulae.pdf',
                'created_at' => Carbon::now()->subDays(6)
            ],
            [
                'tutor_id' => $tutors['muneeb@tutorconnect.com']->id,
                'title' => 'Python Data Structures & OOP Guide',
                'material_type' => 'Notes / Slides',
                'description' => 'Complete overview of Lists, Dictionaries, Recursion, and Object-Oriented design patterns.',
                'file_path' => 'materials/python-data-structures.pdf',
                'file_name' => 'python-data-structures.pdf',
                'created_at' => Carbon::now()->subDays(8)
            ],
            [
                'tutor_id' => $tutors['azan@tutorconnect.com']->id,
                'title' => 'Organic Chemistry Reaction Mechanism Summary',
                'material_type' => 'Handout',
                'description' => 'Essential reaction pathways, electrophilic additions, and nucleophilic substitution mechanisms.',
                'file_path' => 'materials/organic-chemistry-mechanisms.pdf',
                'file_name' => 'organic-chemistry-mechanisms.pdf',
                'created_at' => Carbon::now()->subDays(10)
            ]
        ];

        foreach ($materialsData as $mat) {
            StudyMaterial::create($mat);
        }
    }
}
