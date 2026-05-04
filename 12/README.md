# Lab 12: Attendance Management System

## How to Run
1. Start XAMPP/WAMP.
2. Place the `12/` folder in `htdocs`.
3. Open `http://localhost/WTLab/12/index.php`.

## Requirements
- MySQL (database `attendance_db`).

## Example Input
- **Registration:** Roll: `CS101`, Name: `Sanskriti`.
- **Mark Attendance:** Check/Uncheck the "Present?" boxes for registered students and click **Submit**.

## Expected Output
- Registered students appear in the teacher's list.
- When attendance is submitted, a record is added to the `attendance` table with the current date and status (Present/Absent).

## Notes
- `status[]` is an array of roll numbers that are checked.
- The logic handles 'Absent' status by checking which registered students are NOT in the submitted status array.
