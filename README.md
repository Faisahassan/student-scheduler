# Student-Instructor Appointment Scheduler

This web application allows students to view and book available appointment slots with instructors, while instructors can manage their availability and scheduled meetings. Built for an academic setting, it streamlines communication and time management between students and faculty.

## Features

### For Students
- Secure login
- View available time slots
- Book, view, and cancel appointments

### For Instructors
- Secure login
- Add, edit, and delete available time slots
- View booked appointments

##  Technologies Used
- **Frontend:** HTML, CSS, student_styles.css, styles.css
- **Backend:** PHP
- **Database:** MySQL (via `connect.php`)
- **Version Control:** Git/GitHub

##  Key Files
- `login.php` – Login interface for both users
- `student_dashboard.php` – Main dashboard for student users
- `instructor_dashboard.php` – Main dashboard for instructors
- `schedule_appointment.php` – Handles student appointment booking
- `add_timeslot.php`, `edit_timeslot.php`, `delete_timeslot.php` – Instructors’ timeslot management
- `connect.php` – Database connection logic
- `styles.css`, `student_styles.css` – UI styling

##  Setup Instructions
1. Clone the repository or download the ZIP.
2. Place the files in a local server environment (e.g., XAMPP/Apache).
3. Import the SQL database (not included in ZIP, assumed to be available).
4. Start your server and access `login.php` to begin testing.

## 🚀 Future Improvements
- Add password encryption and better session security
- Create a user-friendly admin dashboard
- Add form validations and error handling
- Include email confirmations for appointments

## Author
-Faisa Hassan
[Email Me](mailto:Faisaah917@gmail.com)



