# Lab 5: PHP & MySQL CRUD Operations

## How to Run
1. Start XAMPP/WAMP (Apache and MySQL).
2. Create a database named `student_db` in `phpMyAdmin` OR the script will attempt to create it automatically.
3. Place the `5/` folder in `htdocs`.
4. Open `http://localhost/WTLab/5/index.php`.

## Requirements
- XAMPP / WAMP.
- MySQL Database.

## Example Input
- **Name:** `Alice Smith`
- **Email:** `alice@example.com`
- Click **Add Student**.

## Expected Output
- A new row appears in the table with ID, Name, and Email.
- "Update" allows inline editing of existing records.
- "Delete" removes the record from the database.

## Notes
- Database: `student_db`, Table: `students`.
- Connection is made using the `mysqli` object-oriented approach.
- The script automatically handles DB and Table creation if they don't exist.
