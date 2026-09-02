/**
 * TutorConnect Real-Time Client-Side Data Store & State Engine
 * Handles persistent user registration, authentication, live tutor directory, bookings, and messaging
 */

(function(window) {
    'use strict';

    const INITIAL_TUTORS = [
        {
            id: 1,
            name: "Dr. Burhan Ahmad",
            email: "burhan@tutorconnect.com",
            password: "password123",
            subject: "Computer Science & Web Dev",
            qualification: "PhD in Computer Science",
            experience: 10,
            hourly_rate: 1500,
            location: "Sheikhupura",
            mode: "Hybrid / Online",
            rating: 4.9,
            reviews_count: 42,
            avatar: "public/images/burhan.png",
            bio: "Senior university lecturer specialized in Full-Stack Web Development, PHP Laravel, Database Systems, and Software Architecture with 10+ years of teaching experience."
        },
        {
            id: 2,
            name: "Prof. Rabia Tariq",
            email: "rabia@tutorconnect.com",
            password: "password123",
            subject: "Mathematics & Calculus",
            qualification: "MPhil in Applied Mathematics",
            experience: 8,
            hourly_rate: 1200,
            location: "Lahore",
            mode: "Online / Home",
            rating: 5.0,
            reviews_count: 38,
            avatar: "public/images/rabia.jpg",
            bio: "MPhil in Applied Mathematics with 8+ years helping university and A-Level students master Calculus, Linear Algebra, and Differential Equations."
        },
        {
            id: 3,
            name: "Engr. Ahmad Ali",
            email: "ahmad@tutorconnect.com",
            password: "password123",
            subject: "Physics & Applied Electronics",
            qualification: "BSc Electrical Engineering",
            experience: 6,
            hourly_rate: 1000,
            location: "Lahore",
            mode: "Online Sessions",
            rating: 4.8,
            reviews_count: 29,
            avatar: "public/images/ahmad.jpg",
            bio: "Electrical engineer passionate about interactive problem solving in Applied Physics, Circuit Analysis, and Electromagnetism for engineering and college students."
        },
        {
            id: 4,
            name: "Prof. Muneeb Ur Rehman",
            email: "muneeb@tutorconnect.com",
            password: "password123",
            subject: "Computer Science & Python",
            qualification: "MS Computer Science",
            experience: 7,
            hourly_rate: 1400,
            location: "Islamabad",
            mode: "Online Sessions",
            rating: 4.9,
            reviews_count: 35,
            avatar: "public/images/muneeb.jpg",
            bio: "MS Computer Science. Step-by-step programming mentorship in Python, Data Structures, Algorithms, and Object Oriented Programming."
        },
        {
            id: 5,
            name: "Sir Azan Farooq",
            email: "azan@tutorconnect.com",
            password: "password123",
            subject: "Chemistry & Organic Chemistry",
            qualification: "MSc Organic Chemistry",
            experience: 5,
            hourly_rate: 1600,
            location: "Karachi",
            mode: "Online / Home",
            rating: 5.0,
            reviews_count: 24,
            avatar: "public/images/azan.jpg",
            bio: "Specialist in MDCAT, F.Sc Chemistry, reaction mechanism cheat-sheets, chemical kinetics, and exam strategy."
        },
        {
            id: 6,
            name: "Abdul Rafay",
            email: "rafay@tutorconnect.com",
            password: "password123",
            subject: "English & IELTS Preparation",
            qualification: "MA English Literature & CELTA",
            experience: 6,
            hourly_rate: 1300,
            location: "Rawalpindi",
            mode: "Online Sessions",
            rating: 4.9,
            reviews_count: 27,
            avatar: "public/images/rafay.jpg",
            bio: "Certified English and IELTS coach helping university students master academic writing, speaking fluency, and Band 8+ exam techniques."
        }
    ];

    const INITIAL_STUDENTS = [
        {
            id: 1,
            name: "Eman Bibi",
            email: "eman@student.com",
            password: "password123",
            location: "Islamabad",
            avatar: "public/images/eman.jpg"
        },
        {
            id: 2,
            name: "Demo Student",
            email: "student@tutorconnect.com",
            password: "password123",
            location: "Lahore",
            avatar: "public/images/eman.jpg"
        }
    ];

    const INITIAL_BOOKINGS = [
        {
            id: "BK-101",
            student_name: "Eman Bibi",
            student_email: "eman@student.com",
            tutor_id: 1,
            tutor_name: "Dr. Burhan Ahmad",
            subject: "Computer Science & Web Dev",
            date: "2026-08-25",
            time: "16:00",
            mode: "Online (Google Meet)",
            fee: "Rs 1,500/hr",
            status: "Confirmed",
            notes: "Need revision for Laravel MVC and RESTful APIs."
        },
        {
            id: "BK-102",
            student_name: "Eman Bibi",
            student_email: "eman@student.com",
            tutor_id: 2,
            tutor_name: "Prof. Rabia Tariq",
            subject: "Mathematics & Calculus",
            date: "2026-08-27",
            time: "18:00",
            mode: "Online (Zoom)",
            fee: "Rs 1,200/hr",
            status: "Pending",
            notes: "Calculus integration techniques review."
        }
    ];

    const INITIAL_MESSAGES = [
        {
            from: "Dr. Burhan Ahmad",
            from_role: "tutor",
            to: "Eman Bibi",
            to_email: "eman@student.com",
            text: "Hello! Looking forward to our Laravel session on Tuesday at 4:00 PM. Please review the route documentation before class.",
            time: "10:30 AM"
        },
        {
            from: "Eman Bibi",
            from_role: "student",
            to: "Dr. Burhan Ahmad",
            to_email: "burhan@tutorconnect.com",
            text: "Thank you Dr. Burhan! I have reviewed the files and prepared questions on controllers.",
            time: "10:45 AM"
        }
    ];

    const INITIAL_REVIEWS = [
        {
            id: "REV-1",
            tutor_id: 1,
            tutor_name: "Dr. Burhan Ahmad",
            student_name: "Eman Bibi",
            student_avatar: "public/images/eman.jpg",
            rating: 5,
            comment: "Dr. Burhan is an outstanding instructor! He simplified complex full-stack web development and Laravel concepts, providing hands-on coding guidance for my project.",
            date: "Aug 18, 2026"
        },
        {
            id: "REV-2",
            tutor_id: 2,
            tutor_name: "Prof. Rabia Tariq",
            student_name: "Ali Raza",
            student_avatar: "public/images/ali.jpg",
            rating: 5,
            comment: "Excellent Calculus II tutoring. She gave intuitive geometric explanations for multivariable integrals that helped me score an A in my semester finals.",
            date: "Aug 16, 2026"
        },
        {
            id: "REV-3",
            tutor_id: 3,
            tutor_name: "Engr. Ahmad Ali",
            student_name: "Hasan Tariq",
            student_avatar: "public/images/hasan.jpg",
            rating: 5,
            comment: "Very patient teacher for circuit analysis and AC impedance. Solved multiple past exam papers with me before my midterms.",
            date: "Aug 12, 2026"
        },
        {
            id: "REV-4",
            tutor_id: 1,
            tutor_name: "Dr. Burhan Ahmad",
            student_name: "Zainab Tariq",
            student_avatar: "public/images/eman.jpg",
            rating: 5,
            comment: "High quality database normalization and SQL query guidance. Truly a senior level expert!",
            date: "Aug 10, 2026"
        }
    ];

    const TCStore = {
        init: function() {
            if (!localStorage.getItem('tc_tutors')) {
                localStorage.setItem('tc_tutors', JSON.stringify(INITIAL_TUTORS));
            }
            if (!localStorage.getItem('tc_students')) {
                localStorage.setItem('tc_students', JSON.stringify(INITIAL_STUDENTS));
            }
            if (!localStorage.getItem('tc_bookings')) {
                localStorage.setItem('tc_bookings', JSON.stringify(INITIAL_BOOKINGS));
            }
            if (!localStorage.getItem('tc_messages')) {
                localStorage.setItem('tc_messages', JSON.stringify(INITIAL_MESSAGES));
            }
            if (!localStorage.getItem('tc_reviews')) {
                localStorage.setItem('tc_reviews', JSON.stringify(INITIAL_REVIEWS));
            }
        },

        getTutors: function() {
            this.init();
            return JSON.parse(localStorage.getItem('tc_tutors') || '[]');
        },

        getTutorById: function(id) {
            const tutors = this.getTutors();
            return tutors.find(t => t.id == id) || tutors[0];
        },

        getTutorByName: function(name) {
            const tutors = this.getTutors();
            return tutors.find(t => t.name.toLowerCase().includes(name.toLowerCase())) || tutors[0];
        },

        // Reviews Management
        getReviews: function() {
            this.init();
            return JSON.parse(localStorage.getItem('tc_reviews') || '[]');
        },

        getReviewsByTutorId: function(tutorId) {
            const reviews = this.getReviews();
            return reviews.filter(r => r.tutor_id == tutorId);
        },

        addReview: function(reviewData) {
            this.init();
            const reviews = this.getReviews();
            const tutors = this.getTutors();
            
            // Find tutor
            let tutor = null;
            if (reviewData.tutor_id) {
                tutor = tutors.find(t => t.id == reviewData.tutor_id);
            }
            if (!tutor && reviewData.tutor_name) {
                tutor = tutors.find(t => t.name.toLowerCase().includes(reviewData.tutor_name.toLowerCase()));
            }
            if (!tutor) tutor = tutors[0];

            const newReview = {
                id: "REV-" + Math.floor(100 + Math.random() * 900),
                tutor_id: tutor.id,
                tutor_name: tutor.name,
                student_name: reviewData.student_name || "Eman Bibi",
                student_avatar: reviewData.student_avatar || "public/images/eman.jpg",
                rating: parseInt(reviewData.rating) || 5,
                comment: reviewData.comment || "Great teaching session!",
                date: new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
            };

            reviews.unshift(newReview);
            localStorage.setItem('tc_reviews', JSON.stringify(reviews));

            // Update tutor review statistics in storage
            const tutorReviews = reviews.filter(r => r.tutor_id == tutor.id);
            const totalRating = tutorReviews.reduce((sum, r) => sum + r.rating, 0);
            const avgRating = (totalRating / tutorReviews.length).toFixed(1);

            tutor.rating = parseFloat(avgRating);
            tutor.reviews_count = (tutor.reviews_count || 20) + 1;
            localStorage.setItem('tc_tutors', JSON.stringify(tutors));

            if (window.TCToast) {
                window.TCToast.show({
                    title: "Review Published ⭐",
                    sender: tutor.name,
                    text: `Thank you for leaving a ${newReview.rating}-star review for ${tutor.name}!`,
                    avatar: tutor.avatar || "public/images/burhan.png",
                    type: "review"
                });
            }

            return newReview;
        },

        deleteReview: function(id) {
            let reviews = this.getReviews();
            reviews = reviews.filter(r => r.id !== id);
            localStorage.setItem('tc_reviews', JSON.stringify(reviews));
        },

        getStudents: function() {
            this.init();
            return JSON.parse(localStorage.getItem('tc_students') || '[]');
        },

        getCurrentUser: function() {
            const userStr = localStorage.getItem('tc_current_user');
            if (userStr) {
                try { return JSON.parse(userStr); } catch (e) {}
            }
            // Default fallback
            return {
                id: 1,
                name: "Eman Bibi",
                email: "eman@student.com",
                type: "student",
                location: "Islamabad",
                avatar: "public/images/eman.jpg"
            };
        },

        setCurrentUser: function(user) {
            localStorage.setItem('tc_current_user', JSON.stringify(user));
        },

        registerStudent: function(studentData) {
            this.init();
            const students = this.getStudents();
            
            // Check if email already exists
            const existing = students.find(s => s.email.toLowerCase() === studentData.email.toLowerCase());
            if (existing) {
                return { success: false, message: "An account with this email already exists." };
            }

            const newStudent = {
                id: Date.now(),
                name: studentData.name,
                email: studentData.email,
                password: studentData.password,
                location: studentData.location || "Pakistan",
                avatar: "public/images/eman.jpg"
            };

            students.push(newStudent);
            localStorage.setItem('tc_students', JSON.stringify(students));
            
            // Auto login
            const userSession = {
                ...newStudent,
                type: "student"
            };
            this.setCurrentUser(userSession);

            return { success: true, user: userSession };
        },

        registerTutor: function(tutorData) {
            this.init();
            const tutors = this.getTutors();

            // Check if email exists
            const existing = tutors.find(t => t.email.toLowerCase() === tutorData.email.toLowerCase());
            if (existing) {
                return { success: false, message: "A tutor account with this email already exists." };
            }

            const newTutor = {
                id: Date.now(),
                name: tutorData.name,
                email: tutorData.email,
                password: tutorData.password,
                subject: tutorData.subject || "General Academic",
                qualification: tutorData.qualification || "Certified Educator",
                experience: parseInt(tutorData.experience || 3),
                hourly_rate: parseInt(tutorData.hourly_rate || 1500),
                location: tutorData.location || "Sheikhupura",
                mode: tutorData.mode || "Hybrid / Online",
                rating: 5.0,
                reviews_count: 0,
                avatar: tutorData.avatar || "public/images/burhan.png",
                bio: tutorData.bio || "Dedicated professional tutor committed to helping students achieve academic success."
            };

            tutors.push(newTutor);
            localStorage.setItem('tc_tutors', JSON.stringify(tutors));

            // Auto login
            const userSession = {
                ...newTutor,
                type: "tutor"
            };
            this.setCurrentUser(userSession);

            return { success: true, user: userSession };
        },

        login: function(email, password, expectedType) {
            this.init();
            email = (email || '').trim().toLowerCase();

            if (expectedType === 'student') {
                const students = this.getStudents();
                const student = students.find(s => s.email.toLowerCase() === email && s.password === password);
                if (student) {
                    const session = { ...student, type: 'student' };
                    this.setCurrentUser(session);
                    return { success: true, user: session };
                }
            } else if (expectedType === 'tutor') {
                const tutors = this.getTutors();
                const tutor = tutors.find(t => t.email.toLowerCase() === email && t.password === password);
                if (tutor) {
                    const session = { ...tutor, type: 'tutor' };
                    this.setCurrentUser(session);
                    return { success: true, user: session };
                }
            } else {
                // Check both
                const students = this.getStudents();
                const student = students.find(s => s.email.toLowerCase() === email && s.password === password);
                if (student) {
                    const session = { ...student, type: 'student' };
                    this.setCurrentUser(session);
                    return { success: true, user: session };
                }
                const tutors = this.getTutors();
                const tutor = tutors.find(t => t.email.toLowerCase() === email && t.password === password);
                if (tutor) {
                    const session = { ...tutor, type: 'tutor' };
                    this.setCurrentUser(session);
                    return { success: true, user: session };
                }
            }

            return { success: false, message: "Invalid email or password. Please verify credentials or register." };
        },

        addBooking: function(bookingData) {
            this.init();
            const bookings = JSON.parse(localStorage.getItem('tc_bookings') || '[]');
            const newBooking = {
                id: "BK-" + Math.floor(100 + Math.random() * 900),
                student_name: bookingData.student_name || "Eman Bibi",
                student_email: bookingData.student_email || "eman@student.com",
                tutor_id: bookingData.tutor_id || 1,
                tutor_name: bookingData.tutor_name || "Dr. Burhan Ahmad",
                subject: bookingData.subject || "Computer Science",
                date: bookingData.date || new Date().toISOString().split('T')[0],
                time: bookingData.time || "16:00",
                mode: bookingData.mode || "Online (Zoom / Meet)",
                fee: bookingData.fee || "Rs 1,500/hr",
                status: "Confirmed",
                notes: bookingData.notes || "Learning session requested via platform."
            };
            bookings.unshift(newBooking);
            localStorage.setItem('tc_bookings', JSON.stringify(bookings));

            // Increment count & update UI badges
            this.incrementCount('bookings');

            // Trigger WhatsApp-style Toast
            if (window.TCToast) {
                window.TCToast.show({
                    title: "Booking Order Confirmed 📅",
                    sender: newBooking.tutor_name,
                    text: `Session scheduled for ${newBooking.date} @ ${newBooking.time} (${newBooking.subject})`,
                    avatar: "public/images/burhan.png",
                    type: "booking",
                    link: "student-bookings.html"
                });
            }

            return newBooking;
        },

        getBookings: function() {
            this.init();
            return JSON.parse(localStorage.getItem('tc_bookings') || '[]');
        },

        addMessage: function(msg) {
            this.init();
            const messages = JSON.parse(localStorage.getItem('tc_messages') || '[]');
            const newMsg = {
                from: msg.from || "User",
                from_role: msg.from_role || "student",
                to: msg.to || "Tutor",
                to_email: msg.to_email || "",
                text: msg.text || "",
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            };
            messages.push(newMsg);
            localStorage.setItem('tc_messages', JSON.stringify(messages));

            // Increment count & update UI badges
            this.incrementCount('messages');

            // Show outgoing confirmation toast
            if (window.TCToast) {
                window.TCToast.show({
                    title: "Message Sent ✓✓",
                    sender: `To: ${newMsg.to}`,
                    text: newMsg.text,
                    avatar: msg.from_role === 'student' ? 'public/images/eman.jpg' : 'public/images/burhan.png',
                    type: "message"
                });

                // Simulate realistic WhatsApp incoming reply after 2.5s if sent by student
                if (msg.from_role === 'student') {
                    setTimeout(() => {
                        const replies = [
                            "Got your message! I will prepare the tutorial materials for our upcoming session.",
                            "Hello! Yes, that topic is on the syllabus. Let's cover it in depth.",
                            "Thanks for reaching out. Looking forward to our scheduled class!",
                            "I have uploaded new practice problems for you in Study Materials."
                        ];
                        const randomReply = replies[Math.floor(Math.random() * replies.length)];
                        
                        this.incrementCount('messages');

                        window.TCToast.show({
                            title: "WhatsApp • New Message 💬",
                            sender: newMsg.to || "Dr. Burhan Ahmad",
                            text: randomReply,
                            avatar: "public/images/burhan.png",
                            type: "incoming_message",
                            link: "student-messages.html"
                        });
                    }, 2800);
                }
            }

            return newMsg;
        },

        getMessages: function() {
            this.init();
            return JSON.parse(localStorage.getItem('tc_messages') || '[]');
        },

        // Counts Management
        getCounts: function() {
            const bookings = this.getBookings().length;
            const messages = parseInt(localStorage.getItem('tc_unread_msg_count') || '3');
            const requests = parseInt(localStorage.getItem('tc_pending_req_count') || '2');
            return {
                messages: Math.max(0, messages),
                requests: Math.max(0, requests),
                bookings: bookings
            };
        },

        incrementCount: function(type) {
            if (type === 'messages') {
                const current = parseInt(localStorage.getItem('tc_unread_msg_count') || '3');
                localStorage.setItem('tc_unread_msg_count', current + 1);
            } else if (type === 'requests') {
                const current = parseInt(localStorage.getItem('tc_pending_req_count') || '2');
                localStorage.setItem('tc_pending_req_count', current + 1);
            }
            this.updateBadgeCounters();
        },

        resetCount: function(type) {
            if (type === 'messages') {
                localStorage.setItem('tc_unread_msg_count', '0');
            } else if (type === 'requests') {
                localStorage.setItem('tc_pending_req_count', '0');
            }
            this.updateBadgeCounters();
        },

        updateBadgeCounters: function() {
            const counts = this.getCounts();

            // Inject counter CSS if not present
            if (!document.getElementById('tc-counter-styles')) {
                const style = document.createElement('style');
                style.id = 'tc-counter-styles';
                style.innerHTML = `
                    .tc-badge-pill {
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        min-width: 20px;
                        height: 20px;
                        padding: 0 6px;
                        border-radius: 10px;
                        font-size: 0.72rem;
                        font-weight: 700;
                        line-height: 1;
                        margin-left: auto;
                        color: white;
                        transition: all 0.3s ease;
                    }
                    .tc-badge-pill.msg-badge {
                        background: #10B981;
                        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.4);
                    }
                    .tc-badge-pill.req-badge {
                        background: #F59E0B;
                        box-shadow: 0 2px 6px rgba(245, 158, 11, 0.4);
                    }
                    .tc-badge-pill.book-badge {
                        background: #3B82F6;
                        box-shadow: 0 2px 6px rgba(59, 130, 246, 0.4);
                    }
                    .sidebar-menu li a {
                        display: flex !important;
                        align-items: center !important;
                    }
                `;
                document.head.appendChild(style);
            }

            // Update sidebar links
            document.querySelectorAll('.sidebar-menu a, .sidebar a').forEach(a => {
                const href = a.getAttribute('href') || '';
                const text = a.textContent.toLowerCase();

                // Messages link
                if (href.includes('messages') || text.includes('message')) {
                    let badge = a.querySelector('.msg-badge');
                    if (counts.messages > 0) {
                        if (!badge) {
                            badge = document.createElement('span');
                            badge.className = 'tc-badge-pill msg-badge';
                            a.appendChild(badge);
                        }
                        badge.innerText = counts.messages > 99 ? '99+' : counts.messages;
                    } else if (badge) {
                        badge.remove();
                    }
                }

                // Requests link
                if (href.includes('requests') || text.includes('request')) {
                    let badge = a.querySelector('.req-badge');
                    if (counts.requests > 0) {
                        if (!badge) {
                            badge = document.createElement('span');
                            badge.className = 'tc-badge-pill req-badge';
                            a.appendChild(badge);
                        }
                        badge.innerText = counts.requests;
                    } else if (badge) {
                        badge.remove();
                    }
                }

                // Bookings link
                if (href.includes('bookings') || text.includes('booking')) {
                    let badge = a.querySelector('.book-badge');
                    if (counts.bookings > 0) {
                        if (!badge) {
                            badge = document.createElement('span');
                            badge.className = 'tc-badge-pill book-badge';
                            a.appendChild(badge);
                        }
                        badge.innerText = counts.bookings;
                    } else if (badge) {
                        badge.remove();
                    }
                }
            });

            // Update any stat cards with counter attributes if present
            document.querySelectorAll('[data-tc-count="messages"]').forEach(el => el.innerText = counts.messages);
            document.querySelectorAll('[data-tc-count="requests"]').forEach(el => el.innerText = counts.requests);
            document.querySelectorAll('[data-tc-count="bookings"]').forEach(el => el.innerText = counts.bookings);
        },

        logout: function() {
            localStorage.removeItem('tc_current_user');
            window.location.href = 'index.html';
        }
    };

    /**
     * WhatsApp-Style Toast Notification Engine
     */
    const TCToast = {
        container: null,

        init: function() {
            if (this.container) return;
            
            const div = document.createElement('div');
            div.id = 'tc-toast-container';
            div.style.cssText = `
                position: fixed;
                top: 24px;
                right: 24px;
                z-index: 999999;
                display: flex;
                flex-direction: column;
                gap: 12px;
                max-width: 380px;
                width: calc(100vw - 32px);
                pointer-events: none;
                font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            `;
            document.body.appendChild(div);
            this.container = div;

            // In-page styles for Toast
            const style = document.createElement('style');
            style.innerHTML = `
                .tc-wa-toast {
                    background: rgba(17, 24, 39, 0.96);
                    backdrop-filter: blur(16px);
                    -webkit-backdrop-filter: blur(16px);
                    color: white;
                    padding: 14px 16px;
                    border-radius: 18px;
                    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.1);
                    border-left: 4.5px solid #10B981;
                    display: flex;
                    align-items: flex-start;
                    gap: 14px;
                    pointer-events: auto;
                    cursor: pointer;
                    transform: translateY(-25px) scale(0.92);
                    opacity: 0;
                    transition: all 0.38s cubic-bezier(0.34, 1.56, 0.64, 1);
                    position: relative;
                    overflow: hidden;
                }
                .tc-wa-toast.tc-show {
                    transform: translateY(0) scale(1);
                    opacity: 1;
                }
                .tc-wa-toast:hover {
                    box-shadow: 0 20px 42px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(16, 185, 129, 0.4);
                    transform: translateY(-2px);
                }
                .tc-wa-toast-avatar {
                    width: 44px;
                    height: 44px;
                    border-radius: 50%;
                    object-fit: cover;
                    border: 2px solid #10B981;
                    flex-shrink: 0;
                    position: relative;
                }
                .tc-wa-badge-dot {
                    width: 11px;
                    height: 11px;
                    background: #10B981;
                    border: 2px solid #111827;
                    border-radius: 50%;
                    position: absolute;
                    bottom: 0;
                    right: 0;
                }
                .tc-wa-content {
                    flex: 1;
                    min-width: 0;
                }
                .tc-wa-header {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    margin-bottom: 2px;
                }
                .tc-wa-app {
                    font-size: 0.68rem;
                    font-weight: 700;
                    color: #10B981;
                    letter-spacing: 0.8px;
                    text-transform: uppercase;
                    display: flex;
                    align-items: center;
                    gap: 5px;
                }
                .tc-wa-time {
                    font-size: 0.68rem;
                    color: #94A3B8;
                }
                .tc-wa-sender {
                    font-size: 0.92rem;
                    font-weight: 700;
                    color: #FFFFFF;
                    margin-bottom: 2px;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }
                .tc-wa-text {
                    font-size: 0.82rem;
                    color: #CBD5E1;
                    line-height: 1.35;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
                .tc-wa-progress {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    height: 3px;
                    background: linear-gradient(90deg, #059669, #10B981);
                    width: 100%;
                    animation: tcToastProgress 4.5s linear forwards;
                }
                @keyframes tcToastProgress {
                    from { width: 100%; }
                    to { width: 0%; }
                }
                @media (max-width: 576px) {
                    #tc-toast-container {
                        top: 12px;
                        right: 16px;
                        left: 16px;
                        width: auto;
                    }
                }
            `;
            document.head.appendChild(style);
        },

        playChime: function() {
            try {
                const AudioCtx = window.AudioContext || window.webkitAudioContext;
                if (!AudioCtx) return;
                const ctx = new AudioCtx();
                const now = ctx.currentTime;

                // WhatsApp-like gentle 2-tone chime
                const osc1 = ctx.createOscillator();
                const gain1 = ctx.createGain();
                osc1.type = 'sine';
                osc1.frequency.setValueAtTime(587.33, now); // D5
                osc1.frequency.exponentialRampToValueAtTime(880, now + 0.08); // A5
                gain1.gain.setValueAtTime(0.08, now);
                gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.28);
                osc1.connect(gain1);
                gain1.connect(ctx.destination);
                osc1.start(now);
                osc1.stop(now + 0.3);
            } catch(e) {
                // AudioContext autoplay restrictions are handled silently
            }
        },

        show: function(options) {
            this.init();
            this.playChime();

            const toast = document.createElement('div');
            toast.className = 'tc-wa-toast';
            
            const avatarSrc = options.avatar || 'public/images/burhan.png';
            const appLabel = options.title || 'TutorConnect';
            const sender = options.sender || 'System Notification';
            const text = options.text || 'You have a new update.';
            const link = options.link || null;

            toast.innerHTML = `
                <div style="position:relative; flex-shrink:0;">
                    <img src="${avatarSrc}" alt="Avatar" class="tc-wa-toast-avatar">
                    <span class="tc-wa-badge-dot"></span>
                </div>
                <div class="tc-wa-content">
                    <div class="tc-wa-header">
                        <span class="tc-wa-app"><i class="fa-brands fa-whatsapp" style="font-size:0.85rem;"></i> ${appLabel}</span>
                        <span class="tc-wa-time">now</span>
                    </div>
                    <div class="tc-wa-sender">${sender}</div>
                    <div class="tc-wa-text">${text}</div>
                </div>
                <div class="tc-wa-progress"></div>
            `;

            if (link) {
                toast.onclick = function() {
                    window.location.href = link;
                };
            } else {
                toast.onclick = function() {
                    toast.classList.remove('tc-show');
                    setTimeout(() => toast.remove(), 300);
                };
            }

            this.container.appendChild(toast);

            // Animate in
            requestAnimationFrame(() => {
                toast.classList.add('tc-show');
            });

            // Auto-dismiss after 4.5s
            setTimeout(() => {
                if (toast && toast.parentElement) {
                    toast.classList.remove('tc-show');
                    setTimeout(() => toast.remove(), 350);
                }
            }, 4500);
        }
    };

    // Auto-initialize
    TCStore.init();
    window.TCStore = TCStore;
    window.TCToast = TCToast;

    // Attach listeners for cross-tab notifications and badge counters
    window.addEventListener('DOMContentLoaded', () => {
        TCToast.init();
        TCStore.updateBadgeCounters();
    });

    window.addEventListener('storage', () => {
        TCStore.updateBadgeCounters();
    });

})(window);
