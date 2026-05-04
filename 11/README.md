# Lab 11: Concurrent Session Limiter

## How to Run
1. Place the `11/` folder in `htdocs`.
2. Open `http://localhost/WTLab/11/index.php`.

## How to Test the Limit (Demo)
1. Open the page in **Chrome**. (Session 1)
2. Open the page in **Firefox** or **Edge**. (Session 2)
3. Open the page in **Chrome Incognito**. (Session 3)
4. Open the page in **Firefox Private Mode**. (Session 4) -> **You will see the "Access Denied" message.**

## Requirements
- PHP 7.x or higher.
- Write permissions for the folder (to create `sessions.json`).

## Expected Output
- Shows the current session ID and a list of all active sessions.
- Blocks access once more than 3 distinct session IDs are registered.
- Automatically clears sessions older than 5 minutes.

## Notes
- `sessions.json` acts as a central registry to track concurrent logins.
- `session_set_cookie_params(300)` ensures the browser forgets the session after 5 minutes of inactivity.
