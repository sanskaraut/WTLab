# Lab 13: User Login & Registration Module

## How to Run
1. Start XAMPP/WAMP (Apache + MySQL).
2. Place the `13/` folder in `htdocs`.
3. Open `http://localhost/WTLab/13/index.php`.

## Requirements
- MySQL (database `auth_db` will be created).

## Example Input
- **Register:** Username: `admin`, Password: `password123`.
- **Login:** Use the same credentials.

## Expected Output
- After registration: Success message appears.
- After login: Displays a welcome message and shows the "Last Login" time retrieved from a cookie.
- After logout: Returns to the login/registration screen.

## Notes
- `password_hash()` and `password_verify()` are used for secure credential management.
- `$_SESSION` tracks the user's login state.
- `setcookie()` stores the last login timestamp on the user's browser.
