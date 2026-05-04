# Lab 29: Real-time Digital Clock (React Hooks)

## How to Run
1. Run this folder through a local server (like XAMPP or VS Code **Live Server**).
2. Open `http://localhost/WTLab/29/index.html`.

## Requirements
- Browser.
- Internet (React CDN).

## Example Input
- The clock starts automatically.
- Click **STOP CLOCK** to pause the time.
- Click **START CLOCK** to resume.

## Expected Output
- A glowing green digital clock display.
- The seconds update every 1000ms.
- Format: `HH:MM:SS` (24-hour format).

## Notes
- Uses `useEffect` with a `setInterval` to create the ticking effect.
- The interval is cleared (cleanup) whenever the component unmounts or the clock is stopped.
