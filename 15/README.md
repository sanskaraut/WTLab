# Lab 15: Student Complaint System

## How to Run
1. Start XAMPP/WAMP.
2. Place the `15/` folder in `htdocs`.
3. Open `http://localhost/WTLab/15/index.php`.

## Requirements
- MySQL (database `complaint_db`).

## Example Input
- **Student Login:** Password: `123`.
- **Submit Complaint:** Subject: `Lab Internet Slow`, Description: `Wifi in Lab 5 is very slow today`.
- **Admin Login:** Password: `123`.

## Expected Output
- Students can submit complaints through a form.
- Admins can view a table of all complaints submitted by students.

## Notes
- Roles are managed via `$_SESSION['role']`.
- Simplified login (just password) for demo speed.
