# Lab 4: PHP Form Processing & Sessions

## How to Run
1. Ensure XAMPP/WAMP is running.
2. Place the `4/` folder in `htdocs` (e.g., `C:/xampp/htdocs/WTLab/4/`).
3. Open `http://localhost/WTLab/4/index.php` in your browser.

## Requirements
- XAMPP / WAMP / Apache with PHP support.

## Example Input
- **POST Form:** Name: `John Doe`, Email: `john@example.com`, Password: `password123`.
- **GET Form:** Enter any text like `TestUser`.

## Expected Output
- **POST:** Success message, "Welcome John Doe", and cookie/session set.
- **GET:** "Data received via GET: TestUser" message.
- **Logout:** Returns to the login form.

## Notes
- `filter_var()` is used for email validation.
- `setcookie()` stores the username on the client side.
- `$_SESSION` stores the user state on the server side.
